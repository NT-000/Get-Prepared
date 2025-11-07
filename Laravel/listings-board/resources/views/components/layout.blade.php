<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Workland {{$title ? '●' : ''}} {{$title ?? '' }}</title>
    @vite('resources/css/app.css')
    @vite('resources/css/style.css')

</head>
<body class="bg-gray-100">
<x-header/>
@if(request()->is('/'))
    <x-hero title="Find a job"/>
    <x-top-banner/>

@endif
<main class="container mx-auto p-4 mt-4">
    {{$slot}}
</main>

</body>
</html>
