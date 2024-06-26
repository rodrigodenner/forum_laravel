<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body >
    <section class="container dark px-4 py-4 mx-auto ">
        @yield('header')
        <div>
          <x-message/>
          @yield('content')
        </div>
    </section>
</body>
</html>
