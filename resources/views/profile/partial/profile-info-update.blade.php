<div x-data="{ showProfileImageUploader: false }"
    class=" py-5 px-3 md:px-5 bg-white border border-gray-200 rounded-lg shadow  dark:bg-gray-800 dark:border-gray-700">

    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <div>

        <a class="spotlight inline-block"
            href="{{ auth()->user()->getMedia('profileImages')->last()? auth()->user()->getMedia('profileImages')->last()->getUrl(): asset('images/user.png') }}">
            <img class="rounded shadow h-36 w-36 my-4"
                src="{{ auth()->user()->getMedia('profileImages')->last()? auth()->user()->getMedia('profileImages')->last()->getUrl('preview'): asset('images/user.png') }}"
                alt="">
        </a>
    </div>

    <x-button.secondary x-on:click="showProfileImageUploader = !showProfileImageUploader">{{ __('Change Picture') }}
    </x-button.secondary>
    <form method="post" action="{{ route('profile.update') }}" class="mt-2 space-y-6">
        @csrf
        @method('patch')

        <div x-show="showProfileImageUploader" x-transition>
            <input type="file" id="profilePicInput" accept="image/*" name="profileImage">
        </div>


        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                required autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>



        <div class="flex items-center gap-4">
            <x-button.primary>{{ __('Save') }}</x-button.primary>
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>

</div>


<script type="module">
    // Get a reference to the file input element
    const inputElement = document.querySelector('input[id="profilePicInput"]');
    // Create a FilePond instance
    const pond = FilePond.create(inputElement, {
        // Only accept images
        acceptedFileTypes: ['image/*'],

    });
    FilePond.setOptions({
        allowImageCrop: true,
        server: {
            url: '/upload',


            headers: {
                'X-CSRF-TOKEN': '{!! csrf_token() !!}',
            }

        },
    });
</script>
