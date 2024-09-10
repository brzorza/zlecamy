<?php

namespace App\Http\Controllers;

use App\Enums\ChatTextTypeEnum;
use App\Models\Chat;
use App\Models\User;
use App\Models\Offer;
use App\Models\ChatText;
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
            return redirect()->route('profile.chat', ['id' => $chatExists->id]);
        }

        $formfields['client_id'] = auth()->id();
        $formfields['seller_id'] = $offer->user_id;
        $formfields['title'] = $user->username . ' (' . $offer->title . ')';
        
        $chat = Chat::create($formfields);
        
        return redirect()->route('profile.chat', ['id' => $chat->id]);
    }

    public function empty(){

        $allChats = Chat::select('id', 'title', 'seller_id', 'client_id')
                        ->where('seller_id', auth()->id())
                        ->orWhere('client_id', auth()->id())
                        ->orderBy('updated_at', 'desc')
                        ->with(['seller', 'client'])
                        ->get();

        return view('chat.empty', compact('allChats'));
    }
    
    public function index(Request $request){

        $allChats = Chat::select('id', 'title', 'seller_id', 'client_id')
                        ->where('seller_id', auth()->id())
                        ->orWhere('client_id', auth()->id())
                        ->orderBy('updated_at', 'desc')
                        ->with(['seller', 'client'])
                        ->get();

        if($request->id){
        // Render chats with chosen user
        $chat = Chat::where('id', $request->id)->with('offer')->first();
        // TODO ograniczyć ilość widomości fetchowanych
        
        if($chat){
                $chatTexts = $chat->chatTexts;
        
                return view('chat.index', compact('chat', 'chatTexts', 'allChats'));
            }else{
                return redirect()->route('profile.chat.empty');
            }

        }else{
        // Render chats not chosen
            return view('chat.index', compact('allChats'));
        }


    }

    public function sendMessage(Request $request){

        $formfields = $request->validate([
            'chat_id' => 'required|string',
            'value' => 'required|string|max:255'
        ]);

        // $formfields['type'] = ChatTextTypeEnum::TEXT;
        
        $usersInConversation = Chat::select('seller_id', 'client_id')->where('id', $formfields['chat_id'])->firstOrFail();
        
        // Validate if user belongs to conversation
        if(auth()->id() == $usersInConversation->seller_id || auth()->id() == $usersInConversation->client_id){
            $formfields['sender_id'] = auth()->id();
            $formfields['type'] = 'text';

            // update updated at chat to be on top
            $chat = Chat::find($formfields['chat_id']);
            $chat->touch();
    
            // dd($formfields);

            $data = ChatText::create($formfields);
    
            $conversation = ChatText::select('type', 'value', 'sender_id', 'created_at')->where('chat_id', $formfields['chat_id'])->get();
    
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
            $conversation = ChatText::select('type', 'value', 'sender_id', 'created_at')->where('chat_id', $formfields['chat_id'])->get();
    
            return response()->json([
                'data' => $conversation
            ]);
        }else{
            abort(403);
        }

    }
}
