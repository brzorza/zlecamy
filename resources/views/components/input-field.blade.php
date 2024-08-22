<div class="mt-2 flex flex-col {{ $divClasses }}">
    @if ($label)
        <label class="mb-1 text-xl font-medium" for="{{ $name }}">{{ $label }}</label>
    @endif
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ $value }}" placeholder="{{ $placeholder }}" max="{{ $max }}"
    class="text-gray-200 text-xl px-2 py-1 rounded bg-backgroundl border border-primary focus:outline-none focus:border-secondary {{ $classes }}" autocomplete="off"/>
    @error($name)
        <p class="text-red-500 text-xs-mt-1">{{ $message }}</p>
    @enderror
</div>