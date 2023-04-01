     <div id="info-container" class="tab-content">
         <h4 class="text-base font-bold">Synopsis</h4>
         <p>{{ $movie->synopsis }}</p>

         <hr class="h-px my-5 bg-gray-200 border-0 dark:bg-gray-700">

         <div class="mt-2 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 md:gap-4">

             @foreach ($movie->images as $index => $image)
                 <a href="https://image.tmdb.org/t/p/original{{ $image['file_path'] }}" class="spotlight singel-image"
                     @if ($index > 7) style="display:none" @endif>
                     <img src="https://image.tmdb.org/t/p/w500{{ $image['file_path'] }}" alt=""
                         class=" rounded shadow ">
                 </a>
             @endforeach
         </div>
         <div class="flex justify-end">
             <button class="hover:text-primary-500" id="viewAllImageButton">View
                 all</button>
         </div>
     </div>
