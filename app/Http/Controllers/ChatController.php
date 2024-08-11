<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatText;
use App\Models\User;
use App\Models\Offer;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\HttpCache\ResponseCacheStrategy;

class ChatController extends Controller
{
    public function create(Request $request){

        $formfields = $request->validate([
            'offer_id' => 'required|integer',
        ]);

        $offer = Offer::select('title', 'user_id')->findOrFail($formfields['offer_id']);
        $user = User::select('username')->findOrFail($offer->user_id);

        if(empty(auth()->id())){
            return redirect()->route('login');
        }elseif($offer['user_id'] == auth()->id()){
            return redirect()->route('profile.show')->with('error', 'Nie możesz zamówić swojej oferty!');
        }

        $chatExists = Chat::where('seller_id', $offer->user_id)
                        ->where('client_id', auth()->id())
                        ->where('offer_id', $formfields['offer_id'])
                        ->first();
        if($chatExists){
            // TODO redirect to chat
            dd('Chat exists!');
            // return redirect()
        }

        $formfields['client_id'] = auth()->id();
        $formfields['seller_id'] = $offer->user_id;
        $formfields['title'] = $user->username . ' - ' . $offer->title;
        
        $chat = Chat::create($formfields);
        
        return redirect()->route('profile.chat', ['chat' => $chat->id]);
    }

    public function empty(){

        $allChats = Chat::select('id', 'title')
                        ->where('seller_id', auth()->id())
                        ->orWhere('client_id', auth()->id())
                        ->get();

        return view('chat.empty', compact('allChats'));
    }
    
    public function index(Request $request){
        // dd($request->id);

        $allChats = Chat::select('id', 'title')
                        ->where('seller_id', auth()->id())
                        ->orWhere('client_id', auth()->id())
                        ->get();

        if($request->id){

            $chat = Chat::where('id', $request->id)->first();
            
            if($chat){
                $chatTexts = $chat->chatTexts;
        
                return view('chat.index', compact('chat', 'chatTexts', 'allChats'));
            }else{
                return redirect()->route('profile.chat.empty');
            }

        }else{
            return view('chat.index', compact('allChats'));
        }


    }

    public function sendMessage(Request $request){

        $formfields = $request->validate([
            'chat_id' => 'required|string',
            'text' => 'required|string|max:255'
        ]);

        $usersInConversation = Chat::select('seller_id', 'client_id')->where('id', $formfields['chat_id'])->firstOrFail();

        // Validate if user belongs to conversation
        if(auth()->id() == $usersInConversation->seller_id || auth()->id() == $usersInConversation->client_id){
            $formfields['sender_id'] = auth()->id();
    
            $data = ChatText::create($formfields);
    
            $conversation = ChatText::select('text', 'sender_id', 'created_at')->where('chat_id', $formfields['chat_id'])->get();
    
            return response()->json([
                'data' => $conversation
            ]);
        }else{
            abort(403);
        }
    }

    public function getMessages(Request $request){

        $formfields = $request->validate([
            'chat_id' => 'required|string',
        ]);

        $usersInConversation = Chat::select('seller_id', 'client_id')->where('id', $formfields['chat_id'])->firstOrFail();

        // Validate if user belongs to conversation
        if(auth()->id() == $usersInConversation->seller_id || auth()->id() == $usersInConversation->client_id){
            $conversation = ChatText::select('text', 'sender_id', 'created_at')->where('chat_id', $formfields['chat_id'])->get();
    
            return response()->json([
                'data' => $conversation
            ]);
        }else{
            abort(403);
        }

    }
}