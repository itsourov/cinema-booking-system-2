<x-app-layout>
    <div class="bg-gradient-to-b from-green-50 to-green-100">


        <section class="py-10 sm:py-16 lg:py-24">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="grid items-center grid-cols-1 gap-12 lg:grid-cols-2">
                    <div>
                        <h1 class="text-4xl font-bold text-black sm:text-6xl lg:text-7xl">
                            Watch movie, Book ticket
                            <div class="relative inline-flex">
                                <span class="absolute inset-x-0 bottom-0 border-b-[30px] border-[#4ADE80]"></span>
                                <h1 class="relative text-4xl font-bold text-black sm:text-6xl lg:text-7xl">Online.
                                </h1>
                            </div>
                        </h1>

                        <p class="mt-8 text-base text-black sm:text-xl">Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Ipsam dolorem a maxime vero necessitatibus ullam quos magni ipsum minus
                            inventore at nam, excepturi dolores sint, amet ad quis, enim harum</p>

                        <div class="mt-10 sm:flex sm:items-center sm:space-x-8">
                            <a href="{{ route('movies.index') }}" title=""
                                class="inline-flex items-center justify-center px-10 py-4 text-base font-semibold text-white transition-all duration-200 bg-orange-500 hover:bg-orange-600 focus:bg-orange-600"
                                role="button"> Start exploring </a>


                        </div>
                    </div>

                    <div>
                        <img class="w-full" src="{{ asset('images/hero-image.png') }}" alt="" />
                    </div>
                </div>
            </div>
        </section>
    </div>


</x-app-layout>
