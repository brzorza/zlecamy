<x-layout>
    <x-profile-menu>
        <div class="flex flex-col">
            <div class="w-100 mt-4">
                <x-buttons.danger link="{{ route('profile.show') }}" classes='px-6 py-2 text-gray-200 text-xl float-left font-bold'>
                    <i class="fa-solid fa-chevron-left"></i> Wróć
                </x-buttons.danger>
            </div>
            <div class="min-h-96 rounded-2xl flex flex-col justify-center mt-10 px-10 py-6 bg-backgroundl">
                <form action="{{ route('profile.edit')}}" method="POST" enctype="multipart/form-data" class="min-w-120 max-w-120 mx-auto">
                    @csrf
                    <div class="flex flex-col">
                        <img src="{{asset('storage/' . $user->profile_picture)}}" alt="Zdjecie profilowe użytkowanika"
                        class="h-56 w-56 rounded-xl object-cover">
                        <input type="file" name="profile_picture" class="mt-2">
                    </div>
                    <div class="flex flex-col">
                        <x-input-field type="text" name="username" value="{{$user->username}}" label="Nazwa użytkownika" />

                        <x-input-field type="text" name="name" value="{{$user->name}}" label="Imię" />

                        <x-input-field type="text" name="surname" value="{{$user->surname}}" label="Nazwisko" />

                        <div id="add-languages mt-2">
                            {{-- TODO przycisk do dodania nowego języka --}}
                            {{-- TODO js do wywalania jezyka który jest juz wybrany --}}
                            
                            <x-input>
                                <label class="text-xl font-medium mb-2">Języki</label>
                                <div class="flex flex-row gap-10">
                                    <select name="language_id" class="w-full text-gray-200 text-xl px-2 py-1 rounded bg-backgroundl border border-primary focus:outline-none focus:border-secondary">
                                        <option value=""></option>
                                        @foreach ($languages as $language)
                                            <option value="{{$language->id}}">{{$language->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('language_id')
                                        <p class="text-red-500 text-xs-mt-1">{{$message}}</p>
                                    @enderror

                                    <select name="proficiency_id" class="w-full text-gray-200 text-xl px-2 py-1 rounded bg-backgroundl border border-primary focus:outline-none focus:border-secondary">
                                        <option value=""></option>
                                        @foreach($languages_proficiency as $proficiency)
                                            <option value="{{$proficiency->id}}">{{$proficiency->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('proficiency_id')
                                        <p class="text-red-500 text-xs-mt-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </x-input>
                        </div>

                        <button type="submit" class="mt-4 px-4 py-2 bg-primary border-2 border-primary hover:bg-backgroundl hover:text-gray-200 text-backgroundl text-xl font-semibold rounded">Aktualizuj</button>
                    </div>
                </form>
            </div>
        </div>
    </x-profile-menu>
</x-layout>