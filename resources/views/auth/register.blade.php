<x-guest-layout>
    <style>
        body::-webkit-scrollbar {
            width: 0; /* WebKit (Safari, Chrome) */
        }
    </style>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" onsubmit="showSuccessMessage()">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <div class="relative">
                <x-text-input id="password" class="block mt-1 w-full"
                    type="password"
                    name="password"
                    required autocomplete="new-password" />     
                <span class="absolute right-2 top-2">
                    <button type="button" id="togglePassword" onclick="togglePasswordVisibility()">👁️</button>
                </span>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <br>
        
        <!-- Gender -->
        <div>
            <x-input-label for="gender" :value="__('Gender')" />
            <div class="mt-2">
                <label for="male" class="inline-flex items-center">
                    <input type="radio" name="gender" id="male" value="Male" {{ old('gender') === 'Male' ? 'checked' : '' }} required autofocus autocomplete="gender">
                    <span class="ml-2">Male</span>
                </label>

                <label for="female" class="inline-flex items-center ml-6">
                    <input type="radio" name="gender" id="female" value="Female" {{ old('gender') === 'Female' ? 'checked' : '' }} required autofocus autocomplete="gender">
                    <span class="ml-2">Female</span>
                </label>
            </div>
            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
        </div>
        <br>
       
        <!-- Renter IC -->
        <div>
            <x-input-label for="renterIC" :value="__('Renter IC')" />
            <x-text-input id="renterIC" class="block mt-1 w-full" type="number" name="renterIC" :value="old('renterIC')" required autofocus autocomplete="renterIC" />
            <x-input-error :messages="$errors->get('renterIC')" class="mt-2" />
        </div> 
        <br>
        
        <!-- Address -->
        <div>
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autofocus autocomplete="address" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div> 
        <br>
        
        <!-- Student No. -->
        <div>
            <x-input-label for="studNo" :value="__('Student No. (If Any)')" />
            <x-text-input id="studNo" class="block mt-1 w-full" type="number" name="studNo" :value="old('studNo')" autofocus autocomplete="studNo" />
            <x-input-error :messages="$errors->get('studNo')" class="mt-2" />
        </div>        
        <br>
        
        <!-- License No. -->
        <div>
            <x-input-label for="licenseNo" :value="__('License No.')" />
            <x-text-input id="licenseNo" class="block mt-1 w-full" type="number" name="licenseNo" :value="old('licenseNo')" required autofocus autocomplete="licenseNo" />
            <x-input-error :messages="$errors->get('licenseNo')" class="mt-2" />
        </div> 
        <br>
        
        <!-- Phone No. -->
        <div>
            <x-input-label for="phoneNo" :value="__('Phone No.')" />
            <x-text-input id="phoneNo" class="block mt-1 w-full" type="number" name="phoneNo" :value="old('phoneNo')" required autofocus autocomplete="phoneNo" />
            <x-input-error :messages="$errors->get('phoneNo')" class="mt-2" />
        </div> 
        <br>

        <!-- IC Image (front) -->
        <div>
            <x-input-label for="icImg" :value="__('IC Image (front)')" />
            <x-text-input id="icImg" class="block mt-1 w-full" type="file" name="icImg" :value="old('icImg')" required autofocus autocomplete="icImg" />
            <x-input-error :messages="$errors->get('icImg')" class="mt-2" />
        </div> 
        <br>

        <!-- IC Image (back) -->
        <div>
            <x-input-label for="icImg2" :value="__('IC Image (back)')" />
            <x-text-input id="icImg2" class="block mt-1 w-full" type="file" name="icImg2" :value="old('icImg2')" required autofocus autocomplete="icImg2" />
            <x-input-error :messages="$errors->get('icImg2')" class="mt-2" />
        </div> 
        <br>

        <!-- License Image (front) -->
        <div>
            <x-input-label for="licImg" :value="__('License Image (front)')" />
            <x-text-input id="licImg" class="block mt-1 w-full" type="file" name="licImg" :value="old('licImg')" required autofocus autocomplete="licImg" />
            <x-input-error :messages="$errors->get('licImg')" class="mt-2" />
        </div> 
        <br>

        <!-- License Image (back) -->
        <div>
            <x-input-label for="licImg2" :value="__('License Image (back)')" />
            <x-text-input id="licImg2" class="block mt-1 w-full" type="file" name="licImg2" :value="old('licImg2')" required autofocus autocomplete="licImg2" />
            <x-input-error :messages="$errors->get('licImg2')" class="mt-2" />
        </div>
        <br>

        <!-- Role (dizsable)-->
        <input type="hidden" name="role" value="user">

        <!-- Status message (dizsable)-->
        <input type="hidden" name="status_message" value="in progress"> <!-- MASUK VALUE TERUS)-->

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
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
    function showSuccessMessage() {
            alert("Register successfully!");
    }
</script>

