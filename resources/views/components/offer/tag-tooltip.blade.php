<div class="tag-hover relative bg-primary w-fit px-4 py-1 rounded-xl font-semibold cursor-default"
@if($tooltip != '') data-tooltip="{{$tooltip}}" @endif>
    <p class="max-w-24 whitespace-nowrap overflow-hidden text-ellipsis">
        {{$slot}} 
    </p>
</div>