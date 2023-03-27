<x-app-layout>

    <div class=" container mx-auto px-2">
        <x-card class="my-10 p-2  space-y-1">
            <p class="text-center">Show Name: <span class=" font-bold">{{ $show->title }}</span></p>
            <p class="text-center">Movie Name: <span class=" font-bold">{{ $show->movie->title }}</span></p>
            <p class="text-center">Show Time: <span class=" font-bold">
                    {{ date('d M, Y h:i A', strtotime($show->date)) . ' (GMT)' }}</span></p>
            <p class="text-center">Starting in:
                <span class="cd_show font-bold" data-now="{{ $dateTime }}" data-show_time="{{ $show->date }}">
                    calculating...
                </span>
            </p>
        </x-card>
    </div>

    <div class="container mx-auto px-2  flex  justify-center">




        <x-card class="px-5 py-2  mt-10 flex flex-wrap gap-4 ">
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

    <div class="screen-wrapper max-w-sm mx-auto">
        <div class="screen"></div>
    </div>


    @livewire('shows.ticket-booking', ['show' => $show])



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

        .screen-wrapper {
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



</x-app-layout>
