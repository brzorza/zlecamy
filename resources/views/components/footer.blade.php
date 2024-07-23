<footer>
    <div class="px-36 py-10 flex flex-row bg-backgroundl">
        <div class="w-4/12">
            <a href="/" class="text-xl font-bold text-white flex justify-center"><img src="{{asset('images/logo.png')}}" alt="Zlecamy" class="h-56"></a>
        </div>
        <div class="w-2/12 flex flex-col">
            <h6 class="text-xl font-semibold uppercase">Kategorie</h6>
            @foreach($categories as $category)
                <x-common-links link="/offers/{{$category->slug}}" classes="text-5xl">{{$category->name}}</x-common-links>
            @endforeach
        </div>
        <div class="w-2/12 flex flex-col">
            <h6 class="text-xl font-semibold uppercase">Przydatne linki</h6>
            {{-- TODO podlinkowac --}}
            <x-common-links link="/asd">O nas</x-common-links>
            <x-common-links link="/asd">Kontakt</x-common-links>
            <x-common-links link="/asd">Regulamin</x-common-links>
            <x-common-links link="/asd">Polityka prywatności</x-common-links>
        </div>
        <div class="w-3/12 flex flex-col">
            <h6 class="text-3xl font-semibold uppercase">Bądź na bierząco!</h6>
            <p class="text-md mt-2">Zapisz się na nasz newsletter</p>
            <form action="{{ route('newsletter') }}" method="POST">
                @csrf
                <x-input-field classes="rounded-full px-4 py-2 focus:border-backgroundl border-backgroundl mt-2" type="email" name="email" value="{{old('email')}}" 
                placeholder="Adres e-mail" />
                <button type="submit" 
                class="mt-4 px-10 py-1 border-2 border-primary text-background bg-primary hover:bg-backgroundl hover:text-gray-200 text-xl font-semibold rounded-full">
                    Zapisz się!
                </button>
            </form>
        </div>
    </div>
</footer>