<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your phone_number address and we will phone_number you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.phone_number') }}">
        @csrf

        <!-- phone_number Address -->
        <div>
            <x-input-label for="phone_number" :value="__('Phone number')" />
            <x-text-input id="phone_number" class="block mt-1 w-full" type="tel" name="phone_number" :value="old('phone_number')" required autofocus />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Phone number Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
