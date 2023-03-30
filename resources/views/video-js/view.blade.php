<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>videojs-vr Demo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/video.js@7.4.1/dist/video-js.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/videojs-vr@1.5.0/dist/videojs-vr.css">xd
</head>

<body>
    <video width="640" height="300" id="videojs-vr-player" class="video-js vjs-default-skin" controls playsinline
        crossorigin="anonymous">
        <source src="{{ asset('images/file_example_MP4_640_3MG.mp4') }}" type="video/mp4" crossorigin="anonymous">
    </video>
    <ul>
        <li><a href="test/debug.html">Run unit tests in browser.</a></li>
        <li><a href="examples/cube.html">Cube Video example</a></li>
        <li><a href="examples/fluid.html">"Fluid" video size example</a></li>
        <li><a href="examples/iframe.html">Iframe example</a></li>
    </ul>
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
