   <div id="trailer-container" class="tab-content" style="display:none;">
       <h4 class="text-base font-bold">Videos</h4>

       @if (count($movie->trailers))
           <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
               <div class=" md:col-span-2">
                   <div class="video-container">


                       <iframe id="trailerVideoPreview"
                           src="https://www.youtube.com/embed/{{ $movie->trailers[array_key_last($movie->trailers)]['key'] ?? '' }}"
                           frameborder="0"
                           allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                           allowfullscreen></iframe>
                   </div>
               </div>
               <div class="relative overflow-hidden">
                   <div
                       class="space-y-3 grid grid-cols-1 overflow-y-scroll max-h-[60vh] border dark:border-gray-800 dark:shadow  p-1">
                       @foreach ($movie->trailers as $video)
                           <button
                               class="border dark:border-gray-800 dark:shadow dark:shadow-gray-800 dark:bg-gray-900 rounded p-2 flex gap-4 trailers-video-btn"
                               data-id="{{ $video['key'] }}">
                               <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor"
                                   stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                   aria-hidden="true">
                                   <path stroke-linecap="round" stroke-linejoin="round"
                                       d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z">
                                   </path>
                               </svg>
                               <p class=" truncate"> <span class="font-bold">{{ $video['type'] }}</span> -
                                   {{ $video['name'] }}</p>
                           </button>
                       @endforeach
                   </div>
               </div>

           </div>
       @endif

   </div>
