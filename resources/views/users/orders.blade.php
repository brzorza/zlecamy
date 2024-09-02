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
<x-layout>
    <x-profile-menu>
        <div class="flex flex-col">
            <div class="w-100 mt-4">
                <h1 class="text-gray-500 text-5xl">Moje zamówienia</h1>
            </div>

            <div class="w-100 min-h-96 rounded-2xl flex flex-row gap-10 items-center px-20 pt-10 pb-14 my-10 bg-backgroundl">
                <div class="flex flex-col w-1/5">
                    <form action="{{ url()->current() }}" method="GET" class="flex flex-col">
                        {{-- TODO całe filtrowanie --}}
                        <label class="text-sm" for="miejsce">Szukaj:</label>
                        <input type="text" name="query" 
                                placeholder="Tytuł..." 
                                value="{{ request()->get('query') }}"
                                class="bg-background border border-primary px-4 py-2 mt-2 mb-4 rounded-xl focus:outline-none focus:border-secondary">
                        
                        <label class="text-sm" for="miejsce" class="">Miejsce:</label>
                        <input type="text" name="miejsce" 
                                placeholder="Miejsce..." 
                                value="{{ request()->get('miejsce') }}"
                                class="bg-background border border-primary px-4 py-2 mt-2 mb-4 rounded-xl focus:outline-none focus:border-secondary">
    
                        <label class="text-sm" for="cena_min" class="whitespace-nowrap">Cena minimalna:</label>
                        <input type="number" name="cena_min" 
                                placeholder="Cena min..." 
                                value="{{ request()->get('cena_min') }}"
                                class="bg-background border border-primary px-4 py-2 mt-2 mb-4 rounded-xl focus:outline-none focus:border-secondary">
    
                        <label class="text-sm" for="cena_max" class="whitespace-nowrap">Cena maksymalna:</label>
                        <input type="number" name="cena_max" 
                                placeholder="Cena max..." 
                                value="{{ request()->get('cena_max') }}"
                                class="bg-background border border-primary px-4 py-2 mt-2 mb-4 rounded-xl focus:outline-none focus:border-secondary">
    
                        <label class="text-sm" for="sorttitle" class="whitespace-nowrap">Sortuj A-Z:</label>
                        <select name="sorttitle" id="sorttitle" class="px-4 py-2 mt-2 mb-4 rounded-xl bg-background border border-primary focus:outline-none focus:border-secondary">
                            <option value="">-</option>
                            <option value="asc">od A do Z</option>
                            <option value="desc">od Z do A</option>
                        </select>
    
                        <label class="text-sm" for="sortprice" class="whitespace-nowrap">Sortuj cena:</label>
                        <select name="sortprice" id="sortprice" class="px-4 py-2 mt-2 mb-4 rounded-xl bg-background border border-primary focus:outline-none focus:border-secondary">
                            <option value="">-</option>
                            <option value="asc">rosnąco</option>
                            <option value="desc">malejąco</option>
                        </select>
                        
                        <div class="flex flex-row gap-6">
                            <button type="submit" class="w-1/2 filters-buttons rounded-xl px-2 py-1 bg-primary text-backgroundll"><i class="fa-solid fa-magnifying-glass"> <span>Filtruj</span></i></button>
                            <a href="{{ url()->current() }}" class="w-1/2 filters-buttons rounded-xl px-2 py-1 bg-danger text-center"><i class="fa-solid fa-xmark"></i> <span>Usuń</span></i></a>
                        </div>
                    </form>
                </div>
                <div class="w-4/5">

                    @if($orders->isEmpty())
                        <h2>Pusto</h2>
                    @else
                        <table id="orders-table">
                            <thead>
                                <tr>
                                    <th>Lp.</th>
                                    <th>Dla kogo</th>
                                    <th>Deadline</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
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
                                    <tr class="border border-primary {{$correct_bg}}">
                                        <td>{{$normie_index}}</td>
                                        <td>{{$order->client->username}}</td>
                                        <td>{{$date}}</td>
                                        <td>{{$status_pl}}</td>

                                        @if($order->seller_id === auth()->id())
                                            <td class="float-right">
                                                <form id="{{$order->id}}" action="{{ route('change.order.status') }}" method="POST">
                                                    @csrf
                                                    <input name="order_id" type="hidden" value="{{$order->id}}">
                                                    <select name="status" class="px-4 py-2 rounded-xl bg-background border border-primary focus:outline-none focus:border-secondary">
                                                        <option value="" disabled selected>Wybierz</option>
                                                        <option value="show">Pokaż</option>
                                                        
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
                                            </td>
                                        @elseif($order->client_id === auth()->id())
                                            <td class="float-right">
                                                <form id="{{$order->id}}" action="{{ route('change.order.status') }}" method="POST">
                                                    @csrf
                                                    <input name="order_id" type="hidden" value="{{$order->id}}">
                                                    <select name="status" class="px-4 py-2 rounded-xl bg-background border border-primary focus:outline-none focus:border-secondary">
                                                        <option value="" disabled selected>Wybierz</option>
                                                        <option value="show">Pokaż</option>
                                                        
                                                        @if($order->status === OrderStatusEnum::NEW->value)
                                                            <option value="pay">Opłać</option>
                                                            <option value="cancel">Anuluj</option>
                                                        @endif
                                                    </select>
                                                </form>
                                            </td>
                                        @endif

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                </div>
            </div>
        </div>
    </x-profile-menu>
</x-layout>

<div id="confirmation-status-wrapper-wrap" class="hidden fixed inset-0 w-[100vw] h-[100vh] z-10 flex items-center justify-center bg-overlay">
    <div id="confirmation-status-wrapper" class="relative bg-background border-2 border-primary max-w-4xl rounded-3xl py-6 px-12">
        {{-- <div>
            <div class="flex felx-row w-full gap-10 mb-6">
                <img src="/storage/images/offerCovers/1W2dV4ZMkQrIoDXYB3T645GyOnNzJrvj27f7UU64.webp" alt="Okładka oferty" class="user-offers-aspect max-w-96 rounded-xl">
                <div class="flex flex-col align-center justify-center">
                    <p class="text-xl font-semibold">Status: <span class="text-gray-400 text-md font-normal">nowy</span></p>
                    <p class="text-xl font-semibold">Cena: <span class="text-gray-400 text-md font-normal">100zł</span></p>
                    <p class="text-xl font-semibold">Czas realizacji: <span class="text-gray-400 text-md font-normal">2 dni</span></p>
                    <p class="text-xl font-semibold">Dostępne do: <span class="text-gray-400 text-md font-normal">16.09.2024</span></p>
                </div>
            </div>
            <div class="mb-6">
                <p class="text-xl font-semibold">Opis:</p>
                <p>Hi, I am Bikash from Bangladesh. I have been working as a Frontend Web Developer since 2021. I specialize in crafting visually appealing landing pages and portfolio websites. If you're in need of an eye-catching and budget-friendly landing page design, feel free to reach out to me.</p>
            </div>
            <div class="flex flex-row justify-between w-full">
                <div class="border border-primary py-4 px-16 rounded-xl text-lg font-semibold hover:bg-primary hover:text-background cursor-pointer">Pokaż chat</div>
                <div class="border border-danger py-4 px-16 rounded-xl text-lg font-semibold hover:bg-danger hover:text-background cursor-pointer">Zamknij</div>
            </div>
        </div> --}}
    </div>
</div>

<script src="{{ asset('js/order/submitOrderStatusChange.js') }}"></script>