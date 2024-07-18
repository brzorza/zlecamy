<x-layoutLogin>

<div class="flex flex-row bg-background">
    <div class="w-3/5 h-screen">
        <img class="object-cover h-screen" src="{{asset('images/login.png')}}" alt="">
    </div>
    {{-- Login form --}}
    <div class="w-2/5 h-screen items-center justify-center">

        <a href="/" 
        class="cursor-pointer float-left mt-6 ml-10 px-3 py-1 bg-danger text-gray-300 text-md float-right font-bold rounded-md shadow-md hover:bg-dangerh focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
            <i class="fa-solid fa-chevron-left"></i> Wróć
        </a>

        <div class="form-swap flex flex-col items-center justify-center mt-40">
            <div class="w-full max-w-md bg-zinc-700 rounded-lg shadow-md">
    
                <div class="flex w-auto items-center justify-center">
                    <div class="bg-zinc-700 w-1/2 text-white text-center font-bold py-2 px-4 rounded-tl cursor-pointer  transition duration-300" onclick="formswap()">
                        Zarejestruj
                    </div>
                    <div class="bg-backgroundl w-1/2 text-white text-center font-bold py-2 px-4 rounded-t transition duration-300">
                        Zaloguj
                    </div>
                </div>
    
                <h2 class="text-3xl font-bold bg-backgroundl pt-10 pb-6 text-white px-8">Zaloguj się</h2>
                <form action="/login" method="POST" class="px-8 pb-10 bg-backgroundl rounded">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="block text-white">Email</label>
                        <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded-md text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500" required 
                        value={{old('email')}}>
                        @error('email')
                            <p class="text-red-500 text-xs-mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-10">
                        <label for="password" class="block text-white">Hasło</label>
                        <input type="password" id="password" name="password" class="w-full px-3 py-2 border rounded-md text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        @error('password')
                            <p class="text-red-500 text-xs-mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit" class="w-full bg-primary text-gray-700 text-lg font-semibold px-4 py-2 border-2 border-primary hover:text-gray-200 rounded-md hover:bg-backgroundl ">Login</button>
                    </div>
                </form>
            </div>
        </div>
    
        {{-- Register form --}}
        <div class="form-swap flex flex-col items-center justify-center hidden mt-40">
            <div class="w-full max-w-md bg-zinc-700 rounded-lg shadow-md">
    
                <div class="flex w-auto items-center justify-center">
                    <div class="bg-backgroundl w-1/2 text-white text-center font-bold py-2 px-4 rounded-t transition duration-300">
                        Zarejestruj
                    </div>
                    <div class="bg-zinc-700 w-1/2 text-white text-center  font-bold py-2 px-4 rounded-tr cursor-pointer transition duration-300" onclick="formswap()">
                        Zaloguj
                    </div>
                </div>
    
                <h2 class="text-3xl font-bold bg-backgroundl pt-10 pb-6 text-white px-8">Zarejestruj się</h2>
                <form action="/register" method="POST" class="px-8 pb-10 bg-backgroundl rounded">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-white">Username</label>
                        <input type="text" id="username" name="username" class="w-full px-3 py-2 border rounded-md text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500" required
                        value={{old('name')}}>
                        @error('name')
                            <p class="text-red-500 text-xs-mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-white">Email</label>
                        <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded-md text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500" required 
                        value={{old('email')}}>
                        @error('email')
                            <p class="text-red-500 text-xs-mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-10">
                        <label for="password" class="block text-white">Hasło</label>
                        <input type="password" id="password" name="password" class="w-full px-3 py-2 border rounded-md text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        @error('password')
                            <p class="text-red-500 text-xs-mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit" class="w-full bg-primary text-gray-700 text-lg font-semibold px-4 py-2 rounded-md hover:bg-secondary focus:outline-none focus:bg-secondary">Zarejestruj się</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</x-layoutLogin>


<script>
    function formswap(){
        const elements = document.querySelectorAll('.form-swap');
        elements.forEach(element => {
            element.classList.toggle('hidden');
        });
    }
</script>