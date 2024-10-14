@extends('app')

    @section('title')
        Profil
    @endsection

    @section('head')

    @endsection

    @section('content')
        <x-profile-menu>
            <div class="flex flex-col">
                <div class="w-100 mt-4 flex flex-row justify-between">
                    <h1 class="text-gray-500 text-5xl text-left">Jak ci mija dzień <span class="text-primary font-semibold">{{ $user->username }}</span>?</h1>
                    <x-buttons.success link="{{ route('profile.showEdit') }}" classes='px-6 py-2 font-bold text-backgroundl text-xl'>
                        <i class="fa-solid fa-pencil"></i> Edytuj
                    </x-buttons.success>
                </div>

                <div class="w-100 min-h-96 rounded-2xl flex flex-col justify-center mt-10 px-10 py-6 bg-backgroundl">
                    Do zrobienia TODO
                </div>
            </div>
        </x-profile-menu>
    @endsection