<x-layouts.auth :title="__('Log in')">
<div class="space-y-6">

    <div>
        <h2 class="text-2xl font-bold text-gray-900">Welcome back</h2>
        <p class="text-sm text-gray-500 mt-1">Sign in to the admin panel</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <x-form method="post" :action="route('login.store')" class="space-y-5">

        <x-input
            type="email"
            :label="__('Email address')"
            name="email"
            required
            autofocus
            autocomplete="email"
        />

        <x-input
            type="password"
            :label="__('Password')"
            name="password"
            required
            autocomplete="current-password"
        />

        <div class="flex items-center justify-between">
            <x-checkbox name="remember" :label="__('Remember me')" />
        </div>

        <x-button variant="primary" class="w-full">{{ __('Sign in') }}</x-button>

    </x-form>

</div>
</x-layouts.auth>
