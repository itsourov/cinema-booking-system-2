<x-app-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <section class="bg-gray-50 dark:bg-gray-900 py-8">
        <div class="grid place-items-center my-8  px-6 py-8 lg:py-0">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg"
                    alt="logo">
                {{ config('app.name') }}
            </a>

            <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                role="alert">
                Admin login info <br>
                email: admin@email.com <br>
                password: password <br> <br>
                And for normal user just Register
            </div>
            <x-card class=" sm:max-w-md">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1
                        class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Sign in to your account
                    </h1>


                    @include('auth.inc.google-login-button')

                    <div class="inline-flex items-center justify-center w-full">
                        <hr class="w-11/12 h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
                        <span class="absolute px-3 f text-gray-900 -translate-x-1/2 left-1/2 dark:text-white">or</span>
                    </div>
                    <form class="space-y-4 md:space-y-6" method="POST" action="/login">

                        @csrf
                        <div>
                            <x-input-label>Your
                                email</x-input-label>
                            <x-text-input type="email" name="email" placeholder="name@company.com"
                                value="admin@email.com" />
                            <x-input-error class="" :messages="$errors->get('email')" />

                        </div>
                        <div>


                            <x-input-label>Password</x-input-label>
                            <x-text-input type="password" name="password" placeholder="••••••••" value="password" />
                            <x-input-error class="" :messages="$errors->get('password')" />
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="remember" aria-describedby="remember" type="checkbox" name="remember"
                                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                                </div>
                            </div>
                            <a href="/forgot-password"
                                class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot
                                password?</a>
                        </div>
                        <x-button.primary class="w-full ">Sign in</x-button.primary>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Don’t have an account yet? <a href="/register"
                                class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign up</a>
                        </p>
                    </form>
                </div>
            </x-card>
        </div>
    </section>
    </x-app>
