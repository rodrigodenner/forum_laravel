
@if($textStatus != "A")
<div class="inline-flex items-center bg-{{$color}}-100 text-{{$color}}-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-{{$color}}-900 dark:text-{{$color}}-300">
    {{ $textStatus }}
</div>

@else
<div class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
    {{ $textStatus }}
</div>
@endif


