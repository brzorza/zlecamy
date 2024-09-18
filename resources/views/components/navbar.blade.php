<div class="fixed top-0 w-full z-20">
    <nav class="relative top-0 bg-backgroundl text-white">
        <div class="">
            <div class="flex justify-between h-24 max-w-7xl mx-auto">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center mr-10">
                        <a href="/" class="text-xl font-bold text-white"><img src="{{asset('images/logo.png')}}" alt="Zlecamy" class="h-24"></a>
                    </div>
                    <div class="hidden md:flex md:ml-6 md:space-x-8">
                        <a href="/about" class="text-white hover:text-primary inline-flex items-center px-1 pt-1 text-md font-regular">Nowości</a>
                    </div>
                </div>
                <div class="hidden md:flex md:items-center md:space-x-8">
                    @auth
                    <div>
                        <a href="/profile" class="text-white hover:text-primary inline-flex items-center mx-1 text-xl"><i class="fa-regular fa-user"></i></a>
                    </div>
                    <div class="relative">
                        @if($count > 0)<div id="notification-dot"></div>@endif
                        <i class="bell-notification fa-regular fa-bell text-white hover:text-primary inline-flex items-center px-1 text-xl cursor-pointer @if($count > 0) bell-animation @endif"></i>
                        <div class="notifications-wrapper hidden z-50 absolute top-8 right-0 w-120 flex flex-col">
                            @if(count($notifications) > 0)
                                @foreach ($notifications as $notification)
                                <a onClick="markNotificationRead({{$notification->id}}, '{{ $notification->link }}')">
                                    <div class="border border-primary bg-background text-white text-md pl-4 pr-1 py-2 cursor-pointer relative @if($notification->read == 1) notification-read @endif">
                                            <div class="hover-link relative flex flex-row items-center mr-4">
                                                <p class="pr-2">{{ $notification->message }}</p>
                                                <svg class="after-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                                <div class="border border-primary bg-background text-primaryh text-center text-md px-4 py-2 cursor-pointer"> 
                                    <a href="{{ route('show.notifications') }}">Zobacz wszystkie <i class="fa-solid fa-arrow-right text-xs"></i></a>
                                </div>
                            @else
                                <div class="rounded-no-notify border border-primary bg-background text-gray-200 min-h-24 flex justify-center items-center text-center text-xl font-semibold px-4 py-2"> 
                                    <p>Brak powiadomień</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <form method="POST" action="/logout" class="px-1">
                        @csrf
                        <input type="submit" value="Wyloguj" class="text-white logout-form-input hover:text-primary block px-3 py-2 rounded-md text-base font-regular cursor-pointer">
                    </form>
                    @else
                    <a href="/login" class="text-white hover:text-primary inline-flex items-center px-1 text-md font-regular">Zaloguj się</a>
                    @endauth
                </div>
            </div>
        </div>
        <div class="flex justify-between bg-backgroundll {{request()->is('profile*') ? 'hidden' : ''}}">
            @foreach ($categories as $category)
                <a href="/offers/{{$category->slug}}" class="flex-1 text-md font-semibold text-white text-center px-2 py-3 hover:text-primary border-r-2 border-background underline-link">{{$category->name}}</a>
            @endforeach
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        <div class="md:hidden hidden fixed w-full bg-gray-900" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="/about" class="text-white hover:text-primary block px-3 py-2 rounded-md text-base font-regular">About</a>
                @auth
                    <a href="/users/edit" class="text-white hover:text-primary block px-3 py-2 rounded-md text-base font-regular">{{auth()->user()->name}}</a>
                    <form method="POST" action="/logout" class="pl-3">
                        @csrf
                        <input type="submit" value="Wyloguj" class="text-white p-0 hover:text-primary block py-2 rounded-md text-base font-regular cursor-pointer">
                    </form>
                @else
                    <a href="/register" class="text-white hover:text-primary block px-3 py-2 rounded-md text-base font-regular">Register</a>
                    <a href="/login" class="text-white hover:text-primary block px-3 py-2 rounded-md text-base font-regular">Login</a>
                @endauth
            </div>
        </div>
    </nav>
</div>

<script src="{{ asset('js/notifications/notificationShow.js') }}"></script>
<script src="{{ asset('js/notifications/readNotifications.js') }}"></script>