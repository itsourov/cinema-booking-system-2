<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>videojs-vr Demo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/video.js@7.4.1/dist/video-js.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/videojs-vr@1.5.0/dist/videojs-vr.css">

    <style type="text/css" media="all">
        html,
        body {
            padding: 0;
            margin: 0;
            height: 100%
        }

        #videojs-vr-player {
            width: 100% !important;
            height: 90% !important;
            overflow: hidden;
            background-color: #fff
        }

        .phpdebugbar {
            display: none;
        }
    </style>

</head>

<body>
    <video width="640" height="300" id="videojs-vr-player" class="video-js vjs-default-skin" controls playsinline
        crossorigin="anonymous">
        <source src="{{ asset('images/eagle-360.mp4') }}" type="video/mp4" crossorigin="anonymous">
    </video>

    <script src="https://cdn.jsdelivr.net/npm/video.js@7.4.1/dist/video.js"
        integrity="sha256-vrHnet1gn0rfMfcNSTaMvp7bW1MU+hBXCuyPjfdxXhc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/videojs-vr@1.5.0/dist/videojs-vr.js"
        integrity="sha256-aVLbKVeaTsLwmKYjya1a4xZGhAaG7j3Z4Ll7SkzSa6A=" crossorigin="anonymous"></script>
    <script>
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
</body>

</html>
