<x-admin-layout>
    <div class="my-10 px-2 container mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">



        @include('profile.partial.profile-info-update')

        @include('profile.partial.password-change')
    </div>
    <div class="px-2 mb-10 container mx-auto ">
        @include('profile.partial.delete-user')
    </div>
</x-admin-layout>
