<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{config('app.name')}}</title>

    @vite(['resources/css/app.css', 'resources/ts/app.ts'])
    @inertiaHead
</head>
<body class="antialiased bg-white text-black-900">
@inertia
</body>
</html>
