<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Link --}}
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.css') }}">

    {{-- inertia Head --}}
    @inertiaHead
</head>

<body>

    @inertia

    {{-- plugins --}}
    <script src="{{ asset('plugins/js/jquery.min.js') }}"></script>
    {{-- script --}}
    <script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }}"></script>
    {{-- resource & vite --}}
    @vite(['resources/js/frontend/app.js'])
</body>

</html>
