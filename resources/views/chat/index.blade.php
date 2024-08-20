<?php
    $months = [
        'January' => 'Sty',
        'February' => 'Lut',
        'March' => 'Mar',
        'April' => 'Kwi',
        'May' => 'Maj',
        'June' => 'Cze',
        'July' => 'Lip',
        'August' => 'Sie',
        'September' => 'Wrz',
        'October' => 'Paź',
        'November' => 'Lis',
        'December' => 'Gru',
    ];
?>

<x-layout>
    <x-profile-menu>
        <div class="flex flex-col">
            
            <div class="min-h-96 rounded-2xl flex flex-row justify-center w-full mt-4 mx-auto px-10 py-6 bg-backgroundl">

                <div class="w-2/5 flex flex-col">
                    <h1 class="text-gray-500 text-5xl text-left mb-6 float-left">Chats</h1>
                    <div class="scrollable-element h-120 flex flex-col mr-12 overflow-auto">
                        @foreach($allChats as $singleChat)
                        <a href="{{ route('profile.chat', ['id' => $singleChat->id]) }}" class="mb-4 mr-2">
                            <div class="border border-primary rounded-xl pointer p-4">
                                <p>{{$singleChat->seller->id == auth()->id() ? $singleChat->client->username : $singleChat->seller->username}}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>

                <div class="w-3/5">
                    @if(isset($chat))
                    {{-- Chat with chosen user --}}
                        <div class="border border-primary rounded-lg bg-background">
                            <div class="rounded-t-xl px-4 py-6 flex bg-backgroundl">
                                <p>{{ $chat->title }}</p>
                            </div>
                            <div id="chatContainer" class="h-120 flex flex-col px-4 overflow-auto scrollable-element">

                                @foreach ($chatTexts as $text)

                                <?php 
                                    $date = $text->created_at->format('Y F d H:i');
                                    $date_pl = str_replace(array_keys($months), array_values($months), $date);
                                ?>

                                    @if($text->sender_id == auth()->id())
                                    <div class="w-full">
                                        <p class="w-4/5 relative ml-auto mt-4 text-justify text-white bg-backgroundl border border-primary rounded-lg p-4">
                                            {{$text->text}}
                                            <span class="text-date">{{ $date_pl }}</span>
                                        </p>
                                    </div>
                                    @else
                                        <div class="w-full">
                                            <p class="w-4/5 relative mr-auto mt-4 text-justify text-white bg-backgroundll border border-primary rounded-lg p-4">
                                                {{$text->text}}
                                                <span class="text-date">{{ $date_pl }}</span>
                                            </p>
                                        </div>
                                    @endif
                                @endforeach

                            </div>
                            <div class="p-4">
                                <form action="{{ route('chat.send') }}" method="POST" id="messageForm">
                                    @csrf
                                    <div class="w-full h-12 flex items-center border border-primary rounded-lg ">
                                        @if($chat->seller_id == auth()->id())
                                            <div id="open-create-offer" class="border-2 border-primary mx-2 mr-4 px-2 rounded-lg whitespace-nowrap cursor-pointer">
                                                Stwórz ofertę
                                            </div>
                                        @endif

                                        <input type="hidden" name="chat_id" id="chat_id" value="{{ $chat->id }}">
                                        <input type="text" placeholder="Widomość..." name="text" id="text" autocomplete="off"
                                        class="bg-background w-full focus:outline-none">
                                        
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
                    {{-- Empty chat --}}
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

    {{-- TODO Add hidden so its hidden XD --}}
    @if($chat->seller_id == auth()->id())
        <div id="create-offer-wrapper" class=" absolute inset-0 w-[100vw] h-[100vh] z-50 flex items-center justify-center bg-overlay">
            <div class="relative bg-background border-2 border-primary h-4/5 w-3/5 rounded-3xl py-6 px-12">
                <i id="close-create-offer" class="fa-solid fa-xmark text-danger text-2xl absolute top-4 right-4 cursor-pointer"></i>

                <h4 class="text-gray-500 text-3xl text-center mb-2">Stwórz ofertę</h4>
            </div>
        </div>
    @endif

</x-layout>

<script>const myId = {{auth()->id()}};</script>
<script src="{{ asset('js/chat/chatScroll.js') }}"></script>
<script src="{{ asset('js/chat/sendMessage.js') }}"></script>
<script src="{{ asset('js/chat/fetchMessages.js') }}"></script>
<script>
    const openCreator = document.getElementById('open-create-offer');
    const closeCreator = document.getElementById('close-create-offer');

    function toggleClass() {
        const targetElement = document.getElementById('create-offer-wrapper');

        targetElement.classList.toggle('hidden');
    }

    openCreator.addEventListener('click', toggleClass);
    closeCreator.addEventListener('click', toggleClass);

</script>