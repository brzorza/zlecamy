<x-layout>
<div class="mx-36">
    <section class="py-24">
        <div class="flex flex-row items-center">
            <div class="w-3/5">
                <h1 class="text-5xl font-regular">Potrzebujesz <span id="typing-animation"></span></h1>
                <h2 class="text-7xl font-bold text-primary mt-4 mb-6">Zleć to!</h2>
                <a href="{{route('login')}}" 
                class="px-10 py-2 border-2 border-primary hover:border-secondary rounded-3xl text-xl font-regular home-button-animation">
                    Dołącz do nas!
                </a>
            </div>
            <div class="w-2/5">
                <img src="{{asset('storage/images/homeImages/home.jpg')}}" alt="Zdjęcie główne zlecamy"
                class="w-96 rounded-3xl">
            </div>
        </div>
    </section>

    <section class="py-24">
        <div>
            <div>
                <h2 class="text-xl">Jak to działa?</h2>
                <p class="text-4xl">Zrobisz to w 5 prostych krokach!</p>
            </div>
            <div class="flex flex-row mt-16 mx-auto">
                <x-home.offer-route>
                    Zacznij od założenia konta. Zrobisz to <span class="text-primary">za darmo!</span>
                </x-home.offer-route>
                <x-home.offer-route>
                    Wybierz ofertę dopasowaną do twoich potrzeb.
                </x-home.offer-route>
                <x-home.offer-route>
                    Omów szczegóły ze sprzedającym.
                </x-home.offer-route>
                <x-home.offer-route>
                    Opłać zamówienie. <br>Twoje środki są bezpiecznie bo zostają u nas!
                </x-home.offer-route>
                <x-home.offer-route>
                    Poczekaj na realizację! <br>Ty otrzymujesz zamówienie, a sprzedający pieniądze.
                </x-home.offer-route>
            </div>
        </div>
    </section>

    {{-- <section>
        przerywnik na ilosc klientow sprzedajacy zadowolenmie solid-bg 
    </section> --}}

    <section class="py-24">
        <div class="flex flex-row items-center">
            <div id="accordion" class="w-3/5 flex flex-row">
                <div class="w-4/5">
                    @forEach($categories as $index => $category)
                        <div id="wrapper-{{$index}}" class="expand-home-wrap border-2 mb-6 bg-background rounded-3xl cursor-pointer
                        @if($index == 1) border-secondary @else border-primary @endif">
                            <div class="p-4 flex relative" onclick="toggleContent({{$index}})">
                                <h2 class="text-lg font-semibold">{{$category->name}}</h2>
                                <i class="fa-solid fa-chevron-up float-right"></i>
                            </div>
                            <div id="content-{{$index}}" class="catrgory-box-content 
                            @if($index == 1) show @endif">
                                <p class="p-4 pt-2 text-md">{{$category->description}}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="w-2/5">
                <h1 class="text-5xl font-semibold mb-2">Poznaj nasze kategorie!</h1>
                <img src="{{asset('storage/images/homeImages/home-form.avif')}}" alt="Zdjęcie do przedstawienia kategorii"
                class="categories-image mt-6 h-150 w-4/5 object-cover">
            </div>
        
        </div>
    </section>

    <section class="py-24 mx-auto w-9/12">
        <div class="rounded-3xl home-form-bg flex flex-row h-150">
            <div class="w-2/5">
                <img src="{{asset('storage/images/homeImages/home-form.avif')}}" alt="Zdjęcie formularza kontaktowego"
                class="rounded-l-3xl h-150 object-cover w-full">
            </div>
            <div class="w-3/5 py-12 px-20 flex flex-col justify-center">
                <p class="text-2xl font-semibold uppercase text-background">Masz jakieś pytania?</p>
                <h3 class="text-4xl font-semibold uppercase text-background">Skontaktuj się z nami</h3>
                {{-- TODO handle form --}}
                <form method="POST" action="" class="mt-4">
                @csrf
                    <div class="flex flex-row gap-2">
                        <x-input-field classes="rounded-full px-4 py-2 focus:border-backgroundl border-backgroundl mt-2" 
                        divClasses="w-full"
                        type="text" name="name" value="{{old('name')}}" placeholder="Imię i Nazwisko" />
                        <x-input-field classes="rounded-full px-4 py-2 focus:border-backgroundl border-backgroundl mt-2" 
                        divClasses="w-full"
                        type="email" name="email" value="{{old('email')}}" placeholder="Adres e-mail" />
                    </div>
                    <x-input-field classes="rounded-full px-4 py-2 focus:border-backgroundl border-backgroundl mt-2" type="title" name="title" value="{{old('title')}}" placeholder="Tytuł" />
                    <x-input>
                        <textarea id="description" name="question" type="text" placeholder="Twoje pytanie..."  
                        class="rounded-2xl min-h-36 text-gray-200 text-xl px-4 py-2 max-w-full rounded bg-backgroundl border-backgroundl border border-primary focus:outline-none focus:border-backgroundl" autocomplete="off">{{old('description')}}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs-mt-1">{{$message}}</p>
                        @enderror
                    </x-input>
                    <button type="submit" class="mt-4 px-4 py-2 border-2 border-primary hover:bg-background bg-backgroundl text-gray-200 text-xl font-semibold rounded-full w-full">Wyślij!</button>
                </form>
            </div>
        </div>
    </section>
</div>
</x-layout>

<script src="{{ asset('js/homeExpandBoxes.js')}}"></script>
{{-- TODO dodać do bazy frazy ze skryptu --}}
<script src="{{ asset('js/typingAnimation.js') }}"></script>