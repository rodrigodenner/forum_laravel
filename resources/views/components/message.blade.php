@if(session()->has('message'))
<div class="p-4 mb-4 mt-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
  <p class="font-medium">{{ session('message') }}</p>
</div>
@endif
