@if(session()->has('success'))
  <div x-data="{show: true}" x-init="setTimeout(() => show = false, 9000)" x-show="show"
  class="fixed z-50 top-24 min-w-96 p-4 rounded-xl bg-green-400 text-gray-900 text-center text-xl font-medium animated-border-bottom animated-move-in-out">
    <p>{{session('success')}}</p>
  </div>
@elseif(session()->has('error'))
  <div x-data="{show: true}" x-init="setTimeout(() => show = false, 9000)" x-show="show"
  class="fixed z-50 top-24 min-w-96 p-4 rounded-xl bg-red-400 text-gray-900 text-center text-xl font-medium animated-border-bottom-fail animated-move-in-out">
    <p>{{session('error')}}</p>
  </div>
@endif