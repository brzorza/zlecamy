<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Chat;
use App\Models\Order;
use App\Models\ChatText;
use Illuminate\Http\Request;
use App\Enums\ChatTextTypeEnum;

class OrderController extends Controller
{
        public function createOrder(Request $request){
        
            $chat = Chat::select('seller_id', 'client_id')->where('id', $request['id'])->firstOrFail();
            
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
    
                $sumOfOrderReadyIn = Order::where('seller_id', $auth_id)->sum('order_ready_in');
    
                if($sumOfOrderReadyIn){
                    $sumOfOrderReadyIn += $formfields['order_ready_in'];
                    $deadline = Carbon::today()->addDays($sumOfOrderReadyIn);
                }else{
                    $deadline = Carbon::today()->addDays((int)$formfields['order_ready_in']);
                }
    
                $formfields['chat_id'] = $request->id;
                $formfields['seller_id'] = $chat->seller_id;
                $formfields['client_id'] = $chat->client_id;
                $formfields['available_until'] = Carbon::today()->addDays((int)$formfields['available_for_days']);
                $formfields['deadline'] = $deadline;
    
                $order = Order::create($formfields);

                $this->createMessageInChat($request->id, $chat->seller_id);
    
                return redirect()->route('profile.chat', ['id' => $request->id])->with('success', 'Oferta została stworzona!');
            }
            

        }else{
            abort(403);
        }
    }

    private function createMessageInChat($chat_id, $sender_id){

        // declare values to create message
        $data['chat_id'] = $chat_id;
        $data['sender_id'] = $sender_id;
        $data['type'] = ChatTextTypeEnum::ORDER;
        $data['value'] = 'Nowe zamówienie';

        $new_order = ChatText::create($data);

    }
}
