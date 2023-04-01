<div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <div class="md:col-span-2 space-y-3">
            <x-card class="space-y-3">
                <div>
                    <div class="flex items-center gap-2">
                        <x-input.text wire:model="movieArray.tmdb_id" placeholder="Enter TMDB id" />
                        <x-button.primary wire:click="getInfo" class=" flex-shrink-0 py-1 h-min">Get movie info
                        </x-button.primary>
                    </div>

                    <x-input.error :messages="$errors->get('movieArray.tmdb_id')" />
                </div>



                <div>
                    <x-input.label value="{{ __('Movie Title') }}" />
                    <x-input.text type="text" wire:model.lazy="movieArray.title" placeholder="Enter info here" />
                    <x-input.error :messages="$errors->get('movieArray.title')" />
                </div>
                <div>
                    <x-input.label value="{{ __('Movie Original Title') }}" />
                    <x-input.text type="text" wire:model.lazy="movieArray.original_title"
                        placeholder="Enter info here" />
                    <x-input.error :messages="$errors->get('movieArray.original_title')" />
                </div>
                <div>
                    <x-input.label value="{{ __('synopsis') }}" />
                    <x-input.text type="text" wire:model.lazy="movieArray.synopsis" placeholder="Enter info here" />
                    <x-input.error :messages="$errors->get('movieArray.synopsis')" />
                </div>
                <div>
                    <x-input.label value="{{ __('certification') }}" />
                    <x-input.text type="text" wire:model.lazy="movieArray.certification"
                        placeholder="Enter info here" />
                    <x-input.error :messages="$errors->get('movieArray.certification')" />
                </div>
                <div>
                    <x-input.label value="{{ __('is_adult') }}" />
                    <input type="checkbox" wire:model.lazy="movieArray.is_adult" placeholder="Enter info here" />
                    <x-input.error :messages="$errors->get('movieArray.is_adult')" />
                </div>
                <div>
                    <x-input.label value="{{ __('release_date') }}" />
                    <x-input.text type="date" wire:model.lazy="movieArray.release_date"
                        placeholder="Enter info here" />
                    <x-input.error :messages="$errors->get('movieArray.release_date')" />
                </div>
                <div>
                    <x-input.label value="{{ __('runtime in min') }}" />
                    <x-input.text type="text" wire:model.lazy="movieArray.runtime" placeholder="Enter info here" />
                    <x-input.error :messages="$errors->get('movieArray.runtime')" />
                </div>
                <div>
                    <x-input.label value="{{ __('poster') }}" />
                    <x-input.text type="text" wire:model.lazy="movieArray.poster" placeholder="Enter info here" />
                    <x-input.error :messages="$errors->get('movieArray.poster')" />
                </div>
                <div>
                    <x-input.label value="{{ __('backdrop') }}" />
                    <x-input.text type="text" wire:model.lazy="movieArray.backdrop" placeholder="Enter info here" />
                    <x-input.error :messages="$errors->get('movieArray.backdrop')" />
                </div>
                <div>
                    <x-input.label value="{{ __('rating') }}" />
                    <x-input.text type="text" wire:model.lazy="movieArray.rating" placeholder="Enter info here" />
                    <x-input.error :messages="$errors->get('movieArray.rating')" />
                </div>

            </x-card>

            <x-card class="space-y-2">
                <div class="flex justify-between items-center cursor-pointer hover:text-primary-500"
                    wire:click="videoSectionToggle">
                    <h2 class=" text-xl">Videos</h2>
                    <x-ri-arrow-down-s-line />
                </div>

                @if ($videoSectionOpened)
                    <div class="content">


                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach ($movieArray['trailers'] ?? [] as $index => $video)
                                <div class="border dark:border-gray-700 dark:bg-gray-900 rounded p-2 space-y-4">




                                    <img src="https://i.ytimg.com/vi/{{ $movieArray['trailers'][$index]['key'] ?? '' }}/sddefault.jpg"
                                        alt="">

                                    <div>
                                        <x-input.label value="{{ __('Video name') }}" />
                                        <x-input.text type="text"
                                            wire:model.lazy="movieArray.trailers.{{ $index }}.name"
                                            placeholder="Enter info here" />
                                        <x-input.error :messages="$errors->get('movieArray.trailers.{{ $index }}.name')" />
                                    </div>
                                    <div>
                                        <x-input.label value="{{ __('Video id') }}" />
                                        <x-input.text type="text"
                                            wire:model.lazy="movieArray.trailers.{{ $index }}.key"
                                            placeholder="Enter info here" />
                                        <x-input.error :messages="$errors->get('movieArray.trailers.{{ $index }}.key')" />
                                    </div>
                                    <div>
                                        <x-input.label value="{{ __('Video type') }}" />
                                        <x-input.text type="text"
                                            wire:model.lazy="movieArray.trailers.{{ $index }}.type"
                                            placeholder="Enter info here" />
                                        <x-input.error :messages="$errors->get('movieArray.trailers.{{ $index }}.type')" />
                                    </div>

                                    <x-button.danger wire:click="removeVideo({{ $index }})">Remove
                                    </x-button.danger>

                                </div>
                            @endforeach

                        </div>

                        <x-button.primary wire:click="addNewVideo">Add new</x-button.primary>
                    </div>
                @endif

            </x-card>
            <x-card class="space-y-2">
                <div class="flex justify-between items-center cursor-pointer hover:text-primary-500"
                    wire:click="castSectionToggle">
                    <h2 class=" text-xl">Cast</h2>
                    <x-ri-arrow-down-s-line />
                </div>

                @if ($castSectionOpened)
                    <div class="content">


                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach ($movieArray['cast'] ?? [] as $index => $cast)
                                <div class="border dark:border-gray-700 dark:bg-gray-900 rounded p-2 space-y-4">

                                    <div
                                        class="border dark:border-gray-800 dark:shadow dark:shadow-gray-800 dark:bg-gray-900 rounded p-2  flex flex-wrap md:flex-nowrap md:space-x-2 singel-cast">

                                        <img src="{{ $cast['profile_path'] ? 'https://image.tmdb.org/t/p/w500' . $cast['profile_path'] : 'https://movies.itsourov.com/wp-content/themes/dooplay/assets/img/no/cast.png' }}"
                                            alt="" class=" object-cover w-full md:w-1/3 rounded shadow">
                                        <div class="">
                                            <p class="text-md font-bold">{{ $cast['name'] }}</p>
                                            <p class=" font-light text-sm">{{ $cast['character'] }}</p>
                                        </div>
                                    </div>
                                    <div>
                                        <x-input.label value="{{ __('Cast name') }}" />
                                        <x-input.text type="text"
                                            wire:model.lazy="movieArray.cast.{{ $index }}.name"
                                            placeholder="Enter info here" />
                                        <x-input.error :messages="$errors->get('movieArray.cast.{{ $index }}.name')" />
                                    </div>
                                    <div>
                                        <x-input.label value="{{ __('character') }}" />
                                        <x-input.text type="text"
                                            wire:model.lazy="movieArray.cast.{{ $index }}.character"
                                            placeholder="Enter info here" />
                                        <x-input.error :messages="$errors->get('movieArray.cast.{{ $index }}.character')" />
                                    </div>
                                    <div>
                                        <x-input.label value="{{ __('profile_path') }}" />
                                        <x-input.text type="text"
                                            wire:model.lazy="movieArray.cast.{{ $index }}.profile_path"
                                            placeholder="Enter info here" />
                                        <x-input.error :messages="$errors->get('movieArray.cast.{{ $index }}.profile_path')" />
                                    </div>

                                    <x-button.danger wire:click="removeCast({{ $index }})">Remove
                                    </x-button.danger>

                                </div>
                            @endforeach

                        </div>

                        <x-button.primary wire:click="addNewCast">Add new</x-button.primary>
                    </div>
                @endif

            </x-card>
            <x-card class="space-y-2">
                <div class="flex justify-between items-center cursor-pointer hover:text-primary-500"
                    wire:click="crewSectionToggle">
                    <h2 class=" text-xl">Crew</h2>
                    <x-ri-arrow-down-s-line />
                </div>

                @if ($crewSectionOpened)
                    <div class="content">


                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach ($movieArray['crew'] ?? [] as $index => $crew)
                                @if ($crew['job'] == 'Director')
                                    <div class="border dark:border-gray-700 dark:bg-gray-900 rounded p-2 space-y-4">

                                        <div>
                                            <x-input.label value="{{ __('Crew name') }}" />
                                            <x-input.text type="text"
                                                wire:model.lazy="movieArray.crew.{{ $index }}.name"
                                                placeholder="Enter info here" />
                                            <x-input.error :messages="$errors->get('movieArray.crew.{{ $index }}.name')" />
                                        </div>
                                        <div>
                                            <x-input.label value="{{ __('job') }}" />
                                            <x-input.text type="text"
                                                wire:model.lazy="movieArray.crew.{{ $index }}.job"
                                                placeholder="Enter info here" />
                                            <x-input.error :messages="$errors->get('movieArray.crew.{{ $index }}.job')" />
                                        </div>
                                        <div>
                                            <x-input.label value="{{ __('profile_path') }}" />
                                            <x-input.text type="text"
                                                wire:model.lazy="movieArray.crew.{{ $index }}.profile_path"
                                                placeholder="Enter info here" />
                                            <x-input.error :messages="$errors->get(
                                                'movieArray.crew.{{ $index }}.profile_path',
                                            )" />
                                        </div>

                                        <x-button.danger wire:click="removeCrew({{ $index }})">Remove
                                        </x-button.danger>

                                    </div>
                                @endif
                            @endforeach

                        </div>

                        <x-button.primary wire:click="addNewCrew">Add new</x-button.primary>
                    </div>
                @endif

            </x-card>
            <x-card class="space-y-2">
                <div class="flex justify-between items-center cursor-pointer hover:text-primary-500"
                    wire:click="genreSectionToggle">
                    <h2 class=" text-xl">Genre</h2>
                    <x-ri-arrow-down-s-line />
                </div>
                <x-input.error :messages="$errors->get('genres')" />

                @if ($genreSectionOpened)
                    <div class="content">


                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach ($genres as $index => $gebre)
                                <div class="border dark:border-gray-700 dark:bg-gray-900 rounded p-2 space-y-4">



                                    <div>
                                        <x-input.label value="{{ __('Genre title') }}" />
                                        <x-input.text type="text" wire:model="genres.{{ $index }}.title"
                                            placeholder="Enter info here" />
                                        <x-input.error :messages="$errors->get("genres.$index.title")" />
                                        @error("genres.$index.title")
                                            <x-input.livewire-error>{{ $message }}</x-input.livewire-error>
                                        @enderror
                                    </div>
                                    <div>
                                        <x-input.label value="{{ __('TMDB ID') }}" />
                                        <x-input.text type="text" wire:model="genres.{{ $index }}.tmdb_id"
                                            placeholder="Enter info here" />
                                        <x-input.error :messages="$errors->get("genres.$index.tmdb_id")" />
                                        @error("genres.$index.tmdb_id")
                                            <x-input.livewire-error>{{ $message }}</x-input.livewire-error>
                                        @enderror
                                    </div>

                                    <x-button.danger wire:click="removeGenre({{ $index }})">
                                        Remove
                                    </x-button.danger>


                                </div>
                            @endforeach


                        </div>

                        <x-button.primary wire:click="addNewGenre">Add new</x-button.primary>
                    </div>
                @endif

            </x-card>

        </div>
        <div>
            <x-card>
                <x-button.primary class="w-full" wire:click="SaveNewMovie">Save new movie</x-button.primary>
                <x-input.error :messages="$errors->get('linkError')" />
            </x-card>
        </div>

    </div>

    <div wire:loading>
        <div
            class="fixed z-40 flex tems-center justify-center inset-0 bg-gray-700 dark:bg-gray-900 dark:bg-opacity-50 bg-opacity-50 transition-opacity">
            <div class="flex items-center justify-center ">
                <div class="w-40 h-40 border-t-4 border-b-4 border-green-900 rounded-full animate-spin">
                </div>
            </div>
        </div>
    </div>
</div>
