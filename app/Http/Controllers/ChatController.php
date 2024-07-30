<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function create(Request $request){

        $formfields = $request->validate([
            'title' => 'required|string',
            'offer_id' => 'required|integer',
            'seller_id' => 'required|integer',
        ]);

        if(empty(auth()->id())){
            return redirect()->route('login');
        }elseif($formfields['seller_id'] == auth()->id()){
            return redirect()->route('profile.show')->with('error', 'Nie możesz zamówić swojej oferty!');
        }

        $chatExists = Chat::where('seller_id', $formfields['seller_id'])
                        ->where('client_id', auth()->id())
                        ->where('offer_id', $formfields['offer_id'])
                        ->first();
        if($chatExists){
            // TODO redirect to chat
            dd('Chat exists!');
            // return redirect()
        }

        $formfields['client_id'] = auth()->id();
        
        $chat = Chat::create($formfields);
        
        dd($chat);
    }
}
