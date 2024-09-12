<?php

use App\Enums\OrderStatusEnum;

$statuses = [
        'new' => 'Nowy',
        'paid' => 'Opłacone',
        'in_progress' => 'W trakcie',
        'finished' => 'Zakończone',
        'expired' => 'Wygasłe',
        'cancelled' => 'Anulowane',
    ];

    $status_pl = str_replace(array_keys($statuses), array_values($statuses), $order->status);
?>

<x-layout>
    <x-profile-menu>
        <div class="flex flex-col">
            <div class="w-100 mt-4 flex flex-row justify-between">
                <h1 class="text-gray-500 text-5xl">Szczegóły zamówienia</h1>
                <x-buttons.danger link="{{ route('profile.orders') }}" classes='px-6 py-2 text-gray-200 text-xl float-left font-bold'>
                    <i class="fa-solid fa-chevron-left"></i> Wróć
                </x-buttons.danger>
            </div>

            <div class="w-100 min-h-96 rounded-2xl flex flex-row gap-10 items-center px-20 pt-10 pb-14 my-10 bg-backgroundl">
                <div>
                    <div class="flex flex-row w-full items-center gap-10 mb-6">
                        <img src="/storage/{{$order->cover}}" alt="Okładka oferty" class="user-offers-aspect max-w-96 rounded-xl h-full">
                        <div>
                            <p class="text-xl font-semibold">Status: <span class="text-gray-400 text-md font-normal">{{$status_pl}}</span></p>
                            <p class="text-xl font-semibold">Cena: <span class="text-gray-400 text-md font-normal">{{$order->price}} zł</span></p>
                            <p class="text-xl font-semibold">Czas realizacji: <span class="text-gray-400 text-md font-normal">{{$order->order_ready_in}} @if($order->order_ready_in == 1)dzień @else dni @endif</span></p>
                            @if ($status_pl == 'Nowy')
                            <p class="text-xl font-semibold">Dostępne do: <span class="text-gray-400 text-md font-normal">{{\Carbon\Carbon::parse($order->available_until)->format('d.m.Y')}}</span></p>
                            @endif
                            @if ($order->deadline)
                                <p class="text-xl font-semibold">Deadline: <span class="text-gray-400 text-md font-normal">{{\Carbon\Carbon::parse($order->deadline)->format('d.m.Y')}}</span></p>
                            @endif
                        </div>
                    </div>
                    
                    <div class="flex flex-col gap-10">
                        <div>
                            <p class="text-xl font-semibold">Opis</p>
                            <p>{{ $order->description }}</p>
                        </div>
                        <div class="flex flex-row gap-10">

                            <a href="{{ route('profile.chat', ['id' => $order->chat_id]) }}" class="border border-primary py-2 px-6 rounded-xl text-lg font-semibold hover:bg-primary hover:text-background cursor-pointer">Pokaż chat</a>
                            
                            <div>
                                @if($order->seller_id === auth()->id())
                                    <form id="{{$order->id}}" action="{{ route('change.order.status') }}" method="POST">
                                        @csrf
                                        <input name="order_id" type="hidden" value="{{$order->id}}">
                                        <select name="status" class="px-6 py-2 rounded-xl text-lg font-semibold bg-transparent border border-primary focus:outline-none focus:border-secondary">
                                            <option value="" disabled selected>Wybierz</option>
                                            
                                            @if($order->status === OrderStatusEnum::NEW->value)
                                                <option value="cancel">Anuluj</option>
                                            
                                            @elseif($order->status === OrderStatusEnum::PAID->value)
                                                <option value="in_proggres">W trakcie</option>
                                                <option value="finish">Zakończ</option>
                                                <option value="cancel">Anuluj</option>
                                            @elseif($order->status === OrderStatusEnum::IN_PROGRESS->value)
                                                <option value="finish">Zakończ</option>
                                                <option value="cancel">Anuluj</option>
                                            @endif
                                        </select>
                                    </form>
                                @elseif($order->client_id === auth()->id() )
                                    <form id="{{$order->id}}" action="{{ route('change.order.status') }}" method="POST">
                                        @csrf
                                        <input name="order_id" type="hidden" value="{{$order->id}}">
                                        <select name="status" class="px-4 py-2 rounded-xl bg-background border border-primary focus:outline-none focus:border-secondary">
                                            <option value="" disabled selected>Wybierz</option>
                                            
                                            @if($order->status === OrderStatusEnum::NEW->value)
                                                <option value="pay">Opłać</option>
                                                <option value="cancel">Anuluj</option>
                                            @endif
                                        </select>
                                    </form>
                                @endif
                            </div>

                        </div>
                    </div>

                    <div class="flex flex-row justify-between w-full">


                    </div>
                </div>
            </div>
        </div>
    </x-profile-menu>
</x-layout>

<div id="confirmation-status-wrapper-wrap" class="hidden fixed inset-0 w-[100vw] h-[100vh] z-10 flex items-center justify-center bg-overlay">
    <div id="confirmation-status-wrapper" class="relative bg-background border-2 border-primary max-w-4xl rounded-3xl py-6 px-12">

    </div>
</div>

<script src="{{ asset('js/order/submitOrderStatusChange.js') }}"></script>