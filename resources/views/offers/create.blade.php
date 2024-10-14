{{-- TODO przerobić resztę widoków na @extends app --}}
@extends('app')

    @section('title')
        Stwórz ofertę
    @endsection

    @section('head')
        <link href="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.snow.css" rel="stylesheet"/>
        <link rel="stylesheet" href="{{ asset('css/quill.css') }}">
    @endsection

    @section('content')
        <x-profile-menu>
            <div class="flex flex-col">
                <div class="w-100 mt-4">
                    <x-buttons.danger link="{{ route('profile.offers') }}" classes='px-6 py-2 text-gray-200 text-xl float-left font-bold'>
                        <i class="fa-solid fa-chevron-left"></i> Wróć
                    </x-buttons.danger>
                </div>
                <div class="w-100 min-h-96 rounded-2xl flex flex-col items-center py-10 my-10 bg-backgroundl">
                    <h2 class="text-gray-300 text-5xl">Stwórz swoją ofertę</h2>
                    <div class="w-full mt-6 max-w-120">
                        <form id="form" action="{{ route('profile.offers.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <x-input-field type="text" name="title" value="{{old('title')}}" label="Tytuł: " labelclasses="input-required" />
                                <p id="title-error" class="text-red-500 text-xs-mt-1"></p>

                                <div class="mt-2">
                                    <label for="description" class="text-xl font-medium input-required">Opis: </label>
                                    <input id="description" name="description" type="hidden">
                                </div>
                                <div id="editor" class="description-box my-4">

                                </div>
                                <p id="description-error" class="text-red-500 text-xs-mt-1"></p>
                                @error('description')
                                    <p class="error text-red-500 text-xs-mt-1">{{$message}}</p>
                                @enderror
                                {{-- TODO tłumaczenie errorów --}}
                                {{-- TODO Front validacja? --}}

                                <x-input-field type="text" name="localization" value="{{old('localization')}}" label="Lokalizacja: " labelclasses="input-required"/>
                                <p id="localization-error" class="text-red-500 text-xs-mt-1"></p>

                                <x-input-field type="file" name="cover" label="Okładka: " />

                                <x-input>
                                    <label for="category" class="text-xl font-medium mb-1 input-required">Kategoria: </label>
                                    <select id="category" name="category_id" class="text-gray-200 text-xl px-2 py-1 rounded bg-backgroundl border border-primary focus:outline-none focus:border-secondary">
                                        <option></option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <p class="error text-red-500 text-xs-mt-1">{{$message}}</p>
                                    @enderror
                                </x-input>
                                <p id="category_id-error" class="text-red-500 text-xs-mt-1"></p>
                                
                                <x-input>
                                    <label for="tags" class="text-xl font-medium mb-1">Tagi: </label>
                                    <input type="hidden" name="all_tags" id="hiddenTags">
                                    <input id="tags" name="tags" type="text" class="text-gray-200 text-xl px-2 py-1 rounded bg-backgroundl border border-primary focus:outline-none focus:border-secondary" autocomplete="off">
                                    <div id="errorBox" class="text-danger">
                                        
                                    </div>
                                </x-input>
                                <div class="w-100 flex flex-row flex-wrap">
                                    <ul id="tagsContainer" class="flex flex-row flex-wrap g-2">
                                        {{-- Added tags go here --}}
                                    </ul>
                                </div>

                                <x-input-field type="number" name="price" label="Cena: " value="{{old('price')}}" labelclasses="input-required"/>
                                <p id="price-error" class="text-red-500 text-xs-mt-1"></p>
                                
                                <x-input>
                                    <label for="price_type" class="text-xl font-medium mb-1 input-required">Cena za: </label>
                                    <select id="price_type" name="price_type" class="text-gray-200 text-xl px-2 py-1 rounded bg-backgroundl border border-primary focus:outline-none focus:border-secondary">
                                        <option value="godzinę">Godzinę</option>
                                        <option value="realizację">Realizację</option>
                                    </select>
                                    @error('price_type')
                                        <p class="error text-red-500 text-xs-mt-1">{{$message}}</p>
                                    @enderror
                                </x-input>

                                <x-input-field type="text" name="delivery_time" label="Średni czas realizacji: " value="{{old('delivery_time')}}" labelclasses="input-required"/>
                                <p id="delivery_time-error" class="text-red-500 text-xs-mt-1"></p>

                                <button id="form-submit-quill" class="mt-4 px-4 py-2 bg-primary border border-primary hover:bg-backgroundl hover:text-gray-200 w-full text-backgroundl text-xl font-semibold rounded">Stwórz</button>
                        </form>
                    </div>
                </div>
            </div>
        </x-profile-menu>
    @endsection

@section('script')
    <script src="{{ asset('js/addTags.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.js"></script>
    <script src="{{ asset('js/quilljs/quillCreateOffer.js') }}"></script>
@endsection