<x-layout>
    <x-profileMenu>
        <div class="flex flex-col">
            <div class="w-100 mt-4">
                <x-buttons.success link="{{ route('profile.showEdit') }}" classes='px-6 py-2 font-bold text-backgroundl text-xl float-right'>
                    <i class="fa-solid fa-pencil"></i> Edytuj
                </x-buttons.success>
            </div>
            <div class="w-100 min-h-96 rounded-2xl flex flex-col justify-center mt-10 px-10 py-6 bg-backgroundl">
                
            </div>
        </div>
    </x-profileMenu>
</x-layout>