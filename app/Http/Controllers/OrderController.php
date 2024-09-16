<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Chat;
use App\Models\User;
use App\Models\Offer;
use App\Models\Order;
use App\Models\ChatText;
use App\Enums\UserTypeEnum;
use Illuminate\Http\Request;
use App\Enums\OrderStatusEnum;
use App\Enums\ChatTextTypeEnum;

class OrderController extends Controller
{
        public function index(Request $request){

            $userStatus = User::select('type')->findOrFail(auth()->id());

            $statuses = [
                OrderStatusEnum::NEW,
                OrderStatusEnum::IN_PROGRESS,
                OrderStatusEnum::PAID,
            ];

            // Query for seller
            if($userStatus->type == UserTypeEnum::SELLER){
                // Show all / available
                if($request->show_all || $request->status){
                    $orders = Order::where('seller_id', auth()->id())->orderByDesc('updated_at')->with(['client:id,username'])->get();
                }else{
                    $orders = Order::where('seller_id', auth()->id())->whereIn('status', $statuses)->orderByDesc('updated_at')->with(['client:id,username'])->get();
                }
                
                $uniqueUsernames = $orders->pluck('client.username', 'client.id')->unique();
                
                if($request->user){
                    $orders = $orders->where('client_id', $request->user);
                }
            // Query for user
            }elseif($userStatus->type == UserTypeEnum::USER){
                // Show all / available
                if($request->show_all || $request->status){
                    $orders = Order::where('client_id', auth()->id())->orderByDesc('updated_at')->with(['seller:id,username'])->get();
                }else{
                    $orders = Order::where('client_id', auth()->id())->whereIn('status', $statuses)->orderByDesc('updated_at')->with(['seller:id,username'])->get();
                }
                
                $uniqueUsernames = $orders->pluck('seller.username', 'seller.id')->unique();
                
                if($request->user){
                    $orders = $orders->where('seller_id', $request->user);
                }
            }

            // Filter orders
            if($request->status){
                $orders = $orders->where('status', $request->status);
            }

            // TODO filtr for deadline
            if($request->deadline){
                if($request->deadline == 'asc'){
                    $orders = $orders->sortBy('deadline');
                }elseif($request->deadline == 'desc'){
                    $orders = $orders->sortByDesc('deadline');
                }
            }

            return view('users.orders', compact(['orders', 'uniqueUsernames']));
        }

        public function singleOrder(Request $request){

            $order = Order::with('chat:id,offer_id')->findOrFail($request->id);

            if($order->seller_id == auth()->id() || $order->client_id == auth()->id()){
            // Get cover for this order
            $cover = Offer::select('id', 'cover')->findOrFail($order->chat->offer_id);
            $order['cover'] = $cover->cover;

                return view('users.singleOrder', compact('order'));
            }else{
                abort(403);
            }

        }

        public function createOrder(Request $request){
        
            $chat = Chat::select('id','seller_id', 'client_id')->where('id', $request['id'])->firstOrFail();
            
            $auth_id = auth()->id();
            
        // Validate if user belongs to this chat and can create order
        if($auth_id == $chat->seller_id){

            // Ensure only one order with status new per chat 
            if(Order::where('status', 'new')->where('chat_id', $request->id)->exists()){
                return redirect()->back()->with('error', 'Możesz mieć tylko jedną aktywną ofertę');
            }else{
                $formfields = $request->validate([
                    'description' => 'required|string|max:1500',
                    'price' => 'required|integer|max:10000',
                    'order_ready_in' => 'required|integer|max:365',
                    'available_for_days' => 'required|integer|max:30',
                ]);
    
                // $sumOfOrderReadyIn = Order::where('seller_id', $auth_id)->sum('order_ready_in');
    
                // if($sumOfOrderReadyIn){
                //     $sumOfOrderReadyIn += $formfields['order_ready_in'];
                //     $deadline = Carbon::today()->addDays($sumOfOrderReadyIn);
                //     $formfields['deadline'] = $deadline;
                // }else{
                //     $deadline = Carbon::today()->addDays((int)$formfields['order_ready_in']);
                //     $formfields['deadline'] = $deadline;
                // }
    
                $formfields['chat_id'] = $request->id;
                $formfields['seller_id'] = $chat->seller_id;
                $formfields['client_id'] = $chat->client_id;
                $formfields['available_until'] = Carbon::today()->addDays((int)$formfields['available_for_days']);
    
                $order = Order::create($formfields);
                
                $this->createMessageInChat($request->id, $chat->seller_id, $order->id);

                $chat->touch();
    
                return redirect()->route('profile.chat', ['id' => $request->id])->with('success', 'Oferta została stworzona!');
            }
            

        }else{
            abort(403);
        }
    }

    public function changeOrderStatus(Request $request){
        
        $formfields = $request->validate([
            'order_id' => 'required|string|uuid',
        ]);

        $order = Order::findOrFail($request->order_id);

        if($order->seller_id == auth()->id()){
            // User is seller
            
            $formfields = $request->validate([
                'status' => 'required|string|in:cancel,in_proggres,finish',
            ]);

            $this->validateStatusChange($order, $formfields['status'], 'seller');

        }elseif($order->client_id == auth()->id()){
            // User is client
            
            $formfields = $request->validate([
                'status' => 'required|string|in:cancel,pay',
            ]);

            $this->validateStatusChange($order, $formfields['status'], 'client');

        }else{
            abort(403);
        }

        return redirect()->back();

    } 

    public function getOrderInfo(Request $request){

        $order = Order::with('chat:id,offer_id')->findOrFail($request->id);

        $cover = Offer::select('id', 'cover')->findOrFail($order->chat->offer_id);
        $order['cover'] = $cover->cover;

        if($order->seller_id == auth()->id() || $order->client_id == auth()->id()){
            return response()->json([
                'data' => $order
            ]);
        }else{
            abort(403);
        }

    }

    public function payForOrder(Request $request){
        
        // TODO handle EVERY findOrFail!!! or any fails
        $order = Order::findOrFail($request->id);

        if(auth()->id() == $order->client_id){
            
            // TODO add P24 code here

            $seller = User::findOrFail($order->seller_id);

            // calculate deadline and add it to user and order table
            if($seller->deadline == null || $this->seeIfDeadlinePassed($seller->deadline)){
                $order->deadline = Carbon::today()->addDays($order->order_ready_in);
            }else{
                $order->deadline = Carbon::parse($seller->deadline)->addDays($order->order_ready_in);
            }

            $seller->deadline = $order->deadline;

            $order->status = OrderStatusEnum::PAID;

            $seller->save();
            $order->save();
            
            return redirect()->back()->with('success', 'Zamówienie zostało opłacone!');
        }else{
            abort(403);
        }
        
    }

    private function seeIfDeadlinePassed($deadline){

        $deadline_passed = Carbon::parse($deadline)->lte(Carbon::today());

        return $deadline_passed;
    }

    private function createMessageInChat($chat_id, $sender_id, $order_id){

        // declare values to create message
        $data['chat_id'] = $chat_id;
        $data['sender_id'] = $sender_id;
        $data['type'] = ChatTextTypeEnum::ORDER;
        $data['value'] = $order_id;

        $new_order = ChatText::create($data);

    }

    private function validateStatusChange($order, $status, $userStatus){

        if($userStatus == 'seller'){
            
            switch (true) {
                // Seller Order(new) -> Order(canceled)
                case ($order->status === OrderStatusEnum::NEW->value && $status == 'cancel'):
                    $order->status = OrderStatusEnum::CANCELLED;
                    break;
                    
                case ($order->status === OrderStatusEnum::PAID->value && $status == 'cancel'):
                    // Seller Order(paid) -> Order(canceled)
                    $order->status = OrderStatusEnum::CANCELLED;
                    break;

                case ($order->status === OrderStatusEnum::PAID->value && $status == 'in_proggres'):
                    // Seller Order(paid) -> Order(in_proggres)
                    $order->status = OrderStatusEnum::IN_PROGRESS;
                    break;

                case ($order->status === OrderStatusEnum::PAID->value && $status == 'finish'):
                    // Seller Order(paid) -> Order(finished)
                    $order->status = OrderStatusEnum::FINISHED;
                    break;

                case ($order->status === OrderStatusEnum::IN_PROGRESS->value && $status == 'cancel'):
                    // Seller Order(in_proggress) -> Order(canceled)
                    $order->status = OrderStatusEnum::CANCELLED;
                    break;

                case ($order->status === OrderStatusEnum::IN_PROGRESS->value && $status == 'finish'):
                    // Seller Order(in_proggress) -> Order(finished)
                    $order->status = OrderStatusEnum::FINISHED;
                    break;
                    
                default:
                    // Default case
                    break;
            }

        }elseif($userStatus == 'client'){

            switch (true) {
                case ($order->status === OrderStatusEnum::NEW->value && $status == 'pay'):
                    // TODO dodać płatność
                    break;

                // Client Order(new) -> Order(canceled)
                case ($order->status === OrderStatusEnum::NEW->value && $status == 'cancel'):
                    $order->status = OrderStatusEnum::CANCELLED;
                    break;

                default:
                    // Default case
                    break;
            }

        }

        $order->save();

    }
}
