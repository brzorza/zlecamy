<x-layout>
    <x-profileMenu>
        <div class="flex flex-col">
            <div class="w-100 mt-4">
                <x-buttons.danger link="{{ route('profile.show') }}" classes='px-6 py-2 text-gray-200 text-xl float-left font-bold'>
                    <i class="fa-solid fa-chevron-left"></i> Wróć
                </x-buttons.danger>
            </div>
            <div class="w-100 min-h-96 rounded-2xl flex flex-col justify-center mt-10 px-10 py-6 bg-backgroundl">
                <form action="{{ route('profile.edit')}}" method="POST" enctype="multipart/form-data">
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

                        <label for="" class="mt-2 text-xl font-medium">Języki</label>
                        <div>
                            
                        </div>

                        <button type="submit" class="mt-4 px-4 py-2 bg-primary border-2 border-primary hover:bg-backgroundl hover:text-gray-200 text-backgroundl text-xl font-semibold rounded">Aktualizuj</button>
                    </div>
                </form>
            </div>
        </div>
    </x-profileMenu>
</x-layout>