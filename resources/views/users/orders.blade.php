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

    $backgrounds = [
        'new' => 'bg-blue-500',
        'paid' => 'bg-lime-500',
        'in_progress' => 'bg-yellow-500',
        'finished' => 'bg-emerald-500',
        'expired' => 'bg-red-200',
        'cancelled' => 'bg-red-500',
    ];
?>

@extends('app')

    @section('title')
        Moje zamówienia
    @endsection

    @section('head')

    @endsection

    @section('content')
        <x-profile-menu>
            <div class="flex flex-col">
                <div class="w-100 mt-4">
                    <h1 class="text-gray-500 text-5xl">Moje zamówienia</h1>
                </div>

                <div class="w-100 min-h-96 rounded-2xl flex flex-row gap-10 items-center px-20 pt-10 pb-14 my-10 bg-backgroundl">
                    <div class="flex flex-col w-1/5">
                        <form action="{{ url()->current() }}" method="GET" class="flex flex-col">
                            {{-- TODO całe filtrowanie --}}
                            <label class="text-sm" for="status" class="whitespace-nowrap">Status:</label>
                            <select name="status" id="status" class="bg-background border border-primary px-4 py-2 mt-2 mb-4 rounded-xl focus:outline-none focus:border-secondary">
                                <option value="">-</option>
                                <option value="new">Nowe</option>
                                <option value="paid">Opłacone</option>
                                <option value="in_progress">W trakcie</option>
                                <option value="finished">Zakończone</option>
                                <option value="expired">Wygasłe</option>
                                <option value="cancelled">Anulowane</option>
                            </select>
        
                            <label class="text-sm" for="user" class="whitespace-nowrap">Użytkownik:</label>
                            <select name="user" id="user" class="bg-background border border-primary px-4 py-2 mt-2 mb-4 rounded-xl focus:outline-none focus:border-secondary">
                                <option value="">-</option>
                                @foreach ($uniqueUsernames as $id => $username)
                                    <option value="{{$id}}">{{$username}}</option>
                                @endforeach
                            </select>
        
                            <label class="text-sm" for="deadline" class="whitespace-nowrap">Deadline:</label>
                            <select name="deadline" id="deadline" class="px-4 py-2 mt-2 mb-4 rounded-xl bg-background border border-primary focus:outline-none focus:border-secondary">
                                <option value="">-</option>
                                <option value="asc">Najwcześniej</option>
                                <option value="desc">Najpóźniej</option>
                            </select>
                            
                            <div class="flex flex-row gap-2 mb-4">
                                <input id="show_all" name="show_all" type="checkbox">
                                <label for="show_all" class="text-sm">Pokaż wszystkie</label>
                            </div>
                            
                            <div class="flex flex-row gap-6">
                                <button type="submit" class="w-1/2 filters-buttons rounded-xl px-2 py-1 bg-primary text-backgroundll"><i class="fa-solid fa-magnifying-glass"> <span>Filtruj</span></i></button>
                                <a href="{{ url()->current() }}" class="w-1/2 filters-buttons rounded-xl px-2 py-1 bg-danger text-center"><i class="fa-solid fa-xmark"></i> <span>Usuń</span></i></a>
                            </div>
                        </form>
                    </div>
                    <div class="w-4/5 flex flex-col justify-center">

                        @if($orders->isEmpty())
                            <h2 class="text-gray-500 text-5xl mx-auto">Pusto :(</h2>
                        @else
                            <div class="">
                                <div class="grid grid-cols-9 mb-2">
                                    <div class="col-span-1 p-4 pb-0">Lp.</div>
                                    <div class="col-span-3 p-4 pb-0">Dla kogo</div>
                                    <div class="col-span-3 p-4 pb-0">Deadline</div>
                                    <div class="col-span-2 p-4 pb-0">Status</div>
                                </div>
                                @foreach($orders as $index => $order)
                                    <?php
                                                //index start from 1
                                                $normie_index = $index + 1;
                                                //Data we właściwym formacie
                                                $date_split = explode( '-', $order->deadline);
                                                $date_reversed = array_reverse($date_split);
                                                $date = implode('-', $date_reversed);
                                                //Status po polsku
                                                $status_pl = str_replace(array_keys($statuses), array_values($statuses), $order->status);
                                                // Właściwe tło
                                                $correct_bg = str_replace(array_keys($backgrounds), array_values($backgrounds), $order->status);
                                    ?>
                                    <a href="{{ route('profile.single.order', ['id' => $order->id]) }}">
                                        <div class="grid grid-cols-9">
                                            <div class="col-span-1 bg-background p-4">{{$normie_index}}</div>
                                            <div class="col-span-3 bg-background p-4">{{$order->client->username}}</div>
                                            <div class="col-span-3 bg-background p-4">{{$date}}</div>
                                            <div class="col-span-2 bg-background p-4">{{$status_pl}}</div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </x-profile-menu>


        <div id="confirmation-status-wrapper-wrap" class="hidden fixed inset-0 w-[100vw] h-[100vh] z-10 flex items-center justify-center bg-overlay">
            <div id="confirmation-status-wrapper" class="relative bg-background border-2 border-primary max-w-4xl rounded-3xl py-6 px-12">

            </div>
        </div>

    @endsection

@section('script')
    <script src="http://127.0.0.1:8000/js/offersFiltersOld.js"></script>
@endsection