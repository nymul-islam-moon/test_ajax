<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>{{ config('app.name') }}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @include('components.head')
    </head>
<body>

    <div class="container mt-2">
        @yield('content')
    </div>

</body>
    @include('components.script')
</html>
