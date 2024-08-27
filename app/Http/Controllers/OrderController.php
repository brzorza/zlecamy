<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Chat;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
        public function createOrder(Request $request){
        
        // Validate if user belongs to this chat
        $chat = Chat::select('seller_id', 'client_id')->where('id', $request['id'])->firstOrFail();
        
        $auth_id = auth()->id(); 
        
        if($auth_id == $chat->seller_id){

            // Ensure only one order with status awaiting per chat 
            if(Order::where('status', 'awaiting')->where('chat_id', $request->id)->exists()){
                return redirect()->back()->with('error', 'Możesz mieć tylko jedną aktywną ofertę');
            }else{
                $formfields = $request->validate([
                    'description' => 'required|string|max:1500',
                    'price' => 'required|integer|max:10000',
                    'order_ready_in' => 'required|integer|max:365',
                    'available_for_days' => 'required|integer|max:30',
                ]);
                // dd($request);
    
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
    
                Order::create($formfields);
    
                return redirect()->route('profile.chat', ['id' => $request->id])->with('success', 'Oferta została stworzona!');
            }
            

        }else{
            abort(403);
        }
    }
}
