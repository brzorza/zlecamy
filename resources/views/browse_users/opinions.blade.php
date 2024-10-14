@extends('app')

    @section('title')
        Opinie {{$user->username}}
    @endsection

    @section('head')

    @endsection

    @section('content')
        <x-profile-menu username="{{$user->username}}">
            <div class="flex flex-col">
                <h1 class="text-gray-500 text-5xl text-left mb-6">Opinie użytkownika: <span class="text-primary font-semibold">{{ $user->username }}</span></h1>
                <div class="w-100 min-h-96 rounded-2xl flex flex-col justify-center mt-10 px-10 py-6 bg-backgroundl">
                    TODO user opinions
                </div>
            </div>
        </x-profile-menu>
    @endsection