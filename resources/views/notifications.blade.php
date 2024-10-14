@extends('app')

    @section('title')
        Powiadomienia
    @endsection

    @section('head')

    @endsection

    @section('content')
        <x-profile-menu>
            <div class="flex flex-col">
                <div class="w-100 mt-4 flex flex-row justify-between">
                    <h1 class="text-gray-500 text-5xl">Powiadomienia</h1>
                </div>

                <div class="w-100 min-h-96 rounded-2xl flex flex-col gap-10 items-center justify-center px-20 pt-10 pb-14 my-10 bg-backgroundl">
                    @if($notifications->count() > 0)
                        <div class="flex flex-col gap-4 w-full">
                            @foreach ($notifications as $notification)
                                <a class="cursor-pointer" onClick="markNotificationRead({{$notification->id}}, '{{ $notification->link }}')">
                                    <div class="border border-primary rounded-xl px-6 py-2 relative @if($notification->read == 1) notification-read @endif">
                                        {{ $notification->message }}
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="ml-auto">
                            {{ $notifications->links('pagination::tailwind') }}
                        </div>
                    @else
                        <p class="text-4xl font-semibold">
                            Brak powiadomień :(
                        </p>
                    @endif
                </div>
            </div>
        </x-profile-menu>
    @endsection