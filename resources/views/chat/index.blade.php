<x-layout>
    <x-profile-menu>
        <div class="flex flex-col">
            
            <div class="min-h-96 rounded-2xl flex flex-row justify-center w-full mt-4 mx-auto px-10 py-6 bg-backgroundl">
                <div class="w-2/5 flex flex-col">
                    <h1 class="text-gray-500 text-5xl text-left mb-6 float-left">Chats</h1>
                    @foreach($allChats as $singleChat)
                        <a href="{{ route('profile.chat', ['id' => $singleChat->id]) }}" class="mb-2">{{$singleChat->title}}</a>
                    @endforeach
                </div>
                <div class="w-2/5">
                    @if(isset($chat))
                        <div class="border border-primary rounded-lg bg-background">
                            <div class="rounded-t-xl px-4 py-6 flex bg-backgroundl">
                                <p>{{ $chat->title }}</p>
                            </div>
                            <div id="chatContainer" class="h-120 flex flex-col px-4 overflow-auto scrollable-element">

                                @foreach ($chatTexts as $text)
                                    @if($text->sender_id == auth()->id())
                                        <x-chat.text-right>{{ $text->text }}</x-chat.text-right>
                                    @else
                                        <x-chat.text-left>{{ $text->text }}</x-chat.text-left>
                                    @endif
                                @endforeach

                            </div>
                            <div class="p-4">
                                <form action="{{ route('chat.send') }}" method="POST" id="messageForm">
                                    @csrf
                                    <div class="w-full h-12 flex items-center border border-primary rounded-lg ">
                                        <input type="hidden" name="chat_id" id="chat_id" value="{{ $chat->id }}">
                                        <input type="text" placeholder="Widomość..." name="text" id="text" autocomplete="off"
                                        class="bg-background w-full pl-6 focus:outline-none">
                                        <button id="sendMessage"
                                        type="submit"
                                        class="bg-primary hover:bg-primaryh float-right h-full text-background font-bold px-12 rounded">
                                            Wyślij
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="border border-primary rounded-lg bg-background">
                            <div class="rounded-t-xl px-4 py-6 flex bg-backgroundl">
                                <p>Wyberz chat</p>
                            </div>
                            <div id="chatContainer" class="h-120 flex flex-col px-4 overflow-auto scrollable-element">


                            </div>
                            <div class="p-4">
                                    <div class="w-full h-12 flex items-center border border-primary rounded-lg ">
                                        <input type="text" placeholder="Widomość..." autocomplete="off"
                                        class="bg-background w-full pl-6 focus:outline-none">
                                        <button
                                        class="bg-primary hover:bg-primaryh float-right h-full text-background font-bold px-12 rounded">
                                            Wyślij
                                        </button>
                                    </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </x-profile-menu>
</x-layout>

<script>const myId = {{auth()->id()}};</script>
<script src="{{ asset('js/chatScroll.js') }}"></script>
<script src="{{ asset('js/sendMessage.js') }}"></script>
<script src="{{ asset('js/fetchMessages.js') }}"></script>