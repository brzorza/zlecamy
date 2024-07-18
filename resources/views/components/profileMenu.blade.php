<div class="fixed w-60 p-4 profile-menu profile-nav z-10">
        <ul class="flex flex-col space-y-2 p-4 w-100">
            <li><a href="/profile" class="block py-2 px-4 text-white text-xl rounded hover-link underline-link"><i class="fa-solid fa-house text-lg"></i> Główna</a></li>
            <li><a href="{{ route('profile.offers') }}" class="block py-2 px-4 text-white text-xl rounded hover-link underline-link"><i class="fa-solid fa-briefcase text-lg"></i> Oferty</a></li>
            <li><a href="/contact" class="block py-2 px-4 text-white text-xl rounded hover-link underline-link"><i class="fa-solid fa-folder-open text-lg"></i> Zamówienia</a></li>
            <li><a href="/services" class="block py-2 px-4 text-white text-xl rounded hover-link underline-link"><i class="fa-solid fa-chart-simple text-lg"></i> Statystyki</a></li>
        </ul>
</div>

<!-- Main content area -->
<div class="flex-1 ml-60 py-10 px-24">
    {{$slot}}
</div>