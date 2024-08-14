<x-layout>
    <x-profile-menu>
        <div class="flex flex-col">
            
            <div class="min-h-96 rounded-2xl flex flex-row justify-center w-full mt-4 mx-auto px-10 py-6 bg-backgroundl">
                <div class="w-2/5 flex flex-col">
                    <h1 class="text-gray-500 text-5xl text-left mb-6 float-left">Chats</h1>
                    <div class="scrollable-element h-120 flex flex-col mr-24 overflow-auto">
                        @foreach($allChats as $singleChat)
                        <a href="{{ route('profile.chat', ['id' => $singleChat->id]) }}" class="mb-4 mr-2">
                            <div class="border border-primary rounded-xl pointer p-4">
                                <p>{{$singleChat->seller->id == auth()->id() ? $singleChat->client->username : $singleChat->seller->username}}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                <div class="w-2/5">
                        <div class="border border-primary rounded-lg bg-background">
                            <div class="rounded-t-xl px-4 py-6 flex bg-backgroundl">
                                <p>Wyberz chat</p>
                            </div>
                            <div id="chatContainer" class="h-120 flex flex-col px-4 overflow-auto scrollable-element">


                            </div>
                            <div class="p-4">
                                    <div class="w-full h-12 flex items-center border border-primary rounded-lg ">
                                        <input type="text" placeholder="Widomość..."
                                        class="bg-background w-full pl-6 focus:outline-none">
                                        <button
                                        class="bg-primary hover:bg-primaryh float-right h-full text-background font-bold px-12 rounded">
                                            Wyślij
                                        </button>
                                    </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </x-profile-menu>
</x-layout>