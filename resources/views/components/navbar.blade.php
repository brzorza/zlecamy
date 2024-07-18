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
                    <a href="/profile" class="text-white hover:text-primary inline-flex items-center px-1 pt-1 text-md font-regular">{{auth()->user()->username}}</a>
                    <form method="POST" action="/logout" class="px-1 pt-1">
                        @csrf
                        <input type="submit" value="Wyloguj" class="text-white logout-form-input hover:text-primary block px-3 py-2 rounded-md text-base font-regular cursor-pointer">
                    </form>
                    @else
                    <a href="/login" class="text-white hover:text-primary inline-flex items-center px-1 pt-1 text-md font-regular">Zaloguj się</a>
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