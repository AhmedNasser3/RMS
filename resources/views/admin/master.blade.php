<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Font Awesome CDN (يجب تحميلها أولاً) -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">


        <!-- Boxicons CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/dist/boxicons.js" integrity="sha512-Dm5UxqUSgNd93XG7eseoOrScyM1BVs65GrwmavP0D0DujOA8mjiBfyj71wmI2VQZKnnZQsSWWsxDKNiQIqk8sQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <!-- باقي روابط الـ CSS الخاصة بك -->
        <link rel="stylesheet" href="{{ asset('css/bank.css') }}">
        <link rel="stylesheet" href="{{ asset('css/wage.css') }}">
        <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/home.css') }}">

        <title>تقارير جهاد اكاديمي</title>
    </head>
<body>
    {{-- sidebar --}}
    @include('admin.layouts.sidebar')
    <div>
        @yield('adminContent')
    </div>
    <script src="{{ asset('js/bank.js') }}"></script>
    <script src="{{ asset('js/wage.js') }}"></script>
    <script src="{{ asset('js/sidebar.js') }}"></script>

</body>
</html>
