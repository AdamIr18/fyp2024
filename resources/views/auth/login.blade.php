<x-guest-layout>
    <style>
        .login-container {
            background-image: url('uploads/images/ksalogin.jpg');
            background-size: cover;
            background-position: center;
            min-height: 50vh;
            display: flex;
            justify-content: center;
            align-items: center;
            /* Adjust opacity to make the background image more faded */
            opacity: 1.0;
        }
        .logo-container {
            margin-left: 125px;
        }
    </style>

    <!-- Logo -->
    <div class="logo-container mb-8">
        <img src="uploads/images/ksalogo.jpg" alt="Your Logo" width="150">
    </div>

    <div class="login-container">
        <!-- Your existing login form content here -->
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        {{-- <!-- Top right button -->
        <div class="text-right">
            <a href="{{ route('admin.login') }}" class="text-indigo-600 hover:underline">Admin</a>
        </div> --}}

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <div class="relative">
                    <x-text-input id="password" class="block mt-1 w-full"
                        type="password"
                        name="password"
                        required autocomplete="current-password" />     
                    <span class="absolute right-2 top-2">
                        <button type="button" id="togglePassword" onclick="togglePasswordVisibility()">👁️</button>
                    </span>
                </div>

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4"> 
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="ml-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>

<script>
    function togglePasswordVisibility() {
        const passwordField = document.getElementById('password');
        const toggleButton = document.getElementById('togglePassword');

        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleButton.textContent = "👁️";
        } else {
            passwordField.type = "password";
            toggleButton.textContent = "👁️";
        }
    }
</script>