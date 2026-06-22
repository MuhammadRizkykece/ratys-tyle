<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RATYS'TYLE</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-[#FAF8F5] text-[#1F1F1F]">

    @include('front.partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('front.partials.footer')

    @if(session('success'))
<div
    x-data="{ show:true }"
    x-show="show"
    x-init="setTimeout(() => show = false, 3000)"
    class="fixed top-5 right-5 z-50 bg-green-500 text-white px-6 py-3 rounded-xl shadow-lg"
>
    {{ session('success') }}
</div>
@endif

</body>
</html>
