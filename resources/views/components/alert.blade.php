@if($errors->any())
<div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
    @foreach ($errors->all() as $error )
     <p class="font-medium">{{$error}}</p>
    @endforeach
</div>
 @endif
