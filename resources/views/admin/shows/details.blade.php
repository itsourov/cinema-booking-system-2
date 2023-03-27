<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
    @include('inc.navbar')

    <div class="container mx-auto px-2  flex  justify-center">




        <x-card class="px-5 py-2  mt-20 flex flex-wrap gap-4 ">
            <div class="grid grid-flow-col gap-2">
                <div class=" bg-gray-500 rounded-t-lg w-8 h-7"></div>
                <p class=" self-center">available</p>
            </div>
            <div class="grid grid-flow-col gap-2">
                <div class=" bg-green-500 rounded-t-lg w-8 h-7"></div>
                <p class=" self-center">Selected</p>
            </div>
            <div class="grid grid-flow-col gap-2">
                <div class="bg-gray-800 dark:bg-white  rounded-t-lg w-8 h-7"></div>
                <p class=" self-center">Booked</p>
            </div>
            <div class="grid grid-flow-col gap-2">
                <div class=" bg-red-500 rounded-t-lg w-8 h-7"></div>
                <p class=" self-center">Blocked</p>
            </div>

        </x-card>
    </div>

    <div class="container max-w-sm mx-auto">
        <div class="screen"></div>
    </div>


    @livewire('shows.ticket-booking', ['show' => $show])

    <script>
        window.onload = function(e) {
            // $('.available').click(function() {
            //     $(this).toggleClass('selected')
            // });

        }
    </script>
    <style>
        .screen {
            background-color: #c0c0c0;
            height: 120px;
            width: 100%;
            margin: 15px 0;
            transform: rotateX(-48deg);
            box-shadow: 0 3px 10px rgb(255 255 255 / 70%);
        }

        .dark .screen {
            background-color: #fff;
        }

        .container {
            perspective: 1000px;
        }

        .dark .booked {
            background-color: white;
            color: black;
        }

        .booked {
            background-color: black;
            cursor: not-allowed;
        }

        .blocked {
            background-color: red;
            cursor: not-allowed;

        }

        .available {
            background-color: gray;
            cursor: pointer;
        }

        .selected {
            background-color: green;
        }
    </style>



    @livewireScripts
    @yield('scripts')
</body>

</html>
