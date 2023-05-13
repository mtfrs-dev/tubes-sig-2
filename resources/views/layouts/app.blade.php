<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="{{ asset('icons/icons8-location-50.png') }}" type="image/x-icon">
    
    <!-- MASTER CSS --> 
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
    
    <!-- LEAFLET CSS --> 
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" 
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" 
        crossorigin="" />
    <link rel="stylesheet" href="{{ asset('css/leaflet-routing-machine.css') }}">
    
    
    @yield('head')
    <title>@yield('title')</title>
    @livewireStyles

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @yield('banner')
    <div class="content">
        @yield('content')
    </div>

    @livewireScripts
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- SweetAlert -->
    <script src="{{ asset('js/sweet-alert.min.js') }}"></script>
    
    <!-- LEAFLET JS --> 
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" 
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" 
        crossorigin=""></script>
    <script src="{{ asset('js/leaflet-routing-machine.js') }}"></script>
    <!-- JQUERY --> 
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" 
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" 
        crossorigin="anonymous"></script>
    @yield('footer')
</body>

</html>