<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ItSourov</title>



    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/video.js'])
    @livewireStyles


    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>

<body class="bg-white text-gray-900 dark:text-white dark:bg-gray-900 antialiased">

    <video width="640" height="300" id="videojs-vr-player" class="video-js vjs-default-skin" controls playsinline>
        <source src="https://videojs-vr.netlify.app/samples/eagle-360.mp4" type="video/mp4">
    </video>

    <script type="module">
        (function(window, videojs) {
            var player = window.player = videojs('videojs-vr-player');
            player.mediainfo = player.mediainfo || {};
            player.mediainfo.projection = '360';

            // AUTO is the default and looks at mediainfo
            var vr = window.vr = player.vr({
                projection: 'AUTO',
                debug: true,
                forceCardboard: false
            });
        }(window, window.videojs));
    </script>
    @include('inc.message')
    @livewireScripts
    @yield('scripts')
</body>

</html>
