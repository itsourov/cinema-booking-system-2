  <div id="casts-container" class="tab-content" style="display:none;">
      <h4 class="text-base font-bold">Director</h4>
      <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-2  mt-2">
          @foreach ($movie->crew as $crew)
              @if ($crew['job'] == 'Director')
                  <div
                      class="border dark:border-gray-800 dark:shadow dark:shadow-gray-800 dark:bg-gray-900 rounded p-2  flex flex-wrap md:flex-nowrap md:space-x-2">

                      <img src="{{ $crew['profile_path'] ? 'https://image.tmdb.org/t/p/w500' . $crew['profile_path'] : asset('images/no/cast.png') }}"
                          alt="" class=" object-cover w-full md:w-1/3 rounded shadow">
                      <div class="">
                          <p class="text-md font-bold">{{ $crew['name'] }}</p>
                          <p class=" font-light text-sm">{{ $crew['job'] }}</p>
                      </div>
                  </div>
              @endif
          @endforeach
      </div>

      <div class="flex justify-between">
          <h4 class="text-base font-bold mt-5">Casts</h4>
          <button class="hover:text-primary-500" id="viewAllCasttButton">View
              all</button>
      </div>

      <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-2  mt-2">
          @foreach ($movie->cast as $index => $cast)
              <div class="border dark:border-gray-800 dark:shadow dark:shadow-gray-800 dark:bg-gray-900 rounded p-2  flex flex-wrap md:flex-nowrap md:space-x-2 singel-cast"
                  @if ($index > 9) style="display:none" @endif>

                  <img src="{{ $cast['profile_path'] ? 'https://image.tmdb.org/t/p/w500' . $cast['profile_path'] : asset('images/no/cast.png') }}"
                      alt="" class=" object-cover w-full md:w-1/3 rounded shadow">
                  <div class="">
                      <p class="text-md font-bold">{{ $cast['name'] }}</p>
                      <p class=" font-light text-sm">{{ $cast['character'] }}</p>
                  </div>
              </div>
          @endforeach
      </div>
  </div>
