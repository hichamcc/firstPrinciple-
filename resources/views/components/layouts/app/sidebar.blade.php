<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="layout sidebar min-h-screen bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300">
        <x-sidebar sticky stashable class="border-r border-gray-200 bg-gray-50 dark:border-gray-700 dark:bg-gray-900">
            <x-sidebar.toggle class="lg:hidden w-10 p-0">
                <x-phosphor-x aria-hidden="true" width="20" height="20" />
            </x-sidebar.toggle>

            <a href="{{ route('app') }}" class="mr-5 flex items-center space-x-2">
                <x-app-logo />
            </a>

            <x-navlist>
                <x-navlist.item before="phosphor-house-line" href="{{ route('app') }}" :current="request()->routeIs('app')">
                    {{ __('Dashboard') }}
                </x-navlist.item>
                <x-navlist.item before="phosphor-arrow-square-out" href="{{ route('home') }}" target="_blank">
                    {{ __('View Site') }}
                </x-navlist.item>
            </x-navlist>

            <x-separator />

            @can('admin')
                <x-navlist>
                    <x-navlist.group :heading="__('Content')">
                        <x-navlist.item href="{{ route('admin.settings.edit') }}" before="phosphor-sliders" :current="request()->routeIs('admin.settings.*')">{{ __('Site Settings') }}</x-navlist.item>
                        <x-navlist.item href="{{ route('admin.services.index') }}" before="phosphor-squares-four" :current="request()->routeIs('admin.services.*')">{{ __('Services') }}</x-navlist.item>
                        <x-navlist.item href="{{ route('admin.projects.index') }}" before="phosphor-images" :current="request()->routeIs('admin.projects.*')">{{ __('Projects') }}</x-navlist.item>
                        <x-navlist.item href="{{ route('admin.team.index') }}" before="phosphor-users" :current="request()->routeIs('admin.team.*')">{{ __('Team') }}</x-navlist.item>
                        <x-navlist.item href="{{ route('admin.why.index') }}" before="phosphor-check-circle" :current="request()->routeIs('admin.why.*')">{{ __('Why Cards') }}</x-navlist.item>
                        <x-navlist.item href="{{ route('admin.contact.index') }}" before="phosphor-envelope" :current="request()->routeIs('admin.contact.*')">
                            {{ __('Leads') }}
                            @php($unread = \App\Models\ContactSubmission::whereNull('read_at')->count())
                            @if($unread > 0)
                                <x-slot:after>
                                    <span class="ml-auto text-xs bg-orange-500 text-white rounded-full px-1.5 py-0.5 font-semibold">{{ $unread }}</span>
                                </x-slot:after>
                            @endif
                        </x-navlist.item>
                    </x-navlist.group>
                </x-navlist>

                <x-separator />

                <x-navlist>
                    <x-navlist.group :heading="__('Admin')">
                        <x-navlist.item href="{{ route('admin.users.index') }}" before="phosphor-user" :current="request()->routeIs('admin.users.*')">{{ __('Users') }}</x-navlist.item>
                    </x-navlist.group>
                </x-navlist>
            @endcan

            <x-spacer />

            <x-popover align="bottom" justify="left">
                <button type="button" class="w-full group flex items-center rounded-lg p-1 hover:bg-gray-800/5 dark:hover:bg-white/10">
                    <img class="size-8 flex-none rounded-full bg-gray-50" src="{{ auth()->user()->avatar }}" alt="">
                    <span class="ml-2 text-sm text-gray-500 dark:text-white/80 group-hover:text-gray-800 dark:group-hover:text-white font-medium truncate">
                        {{ auth()->user()->name }}
                    </span>
                    <span class="shrink-0 ml-auto size-8 flex justify-center items-center">
                        <x-phosphor-caret-up-down aria-hidden="true" width="16" height="16" class="text-gray-400 dark:text-white/80 group-hover:text-gray-800 dark:group-hover:text-white" />
                    </span>
                </button>
                <x-slot:menu class="w-max">
                    <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                        <img class="size-8 flex-none rounded-full bg-gray-50" src="{{ auth()->user()->avatar }}" alt="">
                        <div class="grid flex-1 text-left text-sm leading-tight">
                            <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                            <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                        </div>
                    </div>
                    <x-popover.separator />
                    <x-popover.item before="phosphor-gear-fine" href="{{ route('settings.profile.edit') }}">{{ __('Settings') }}</x-popover.item>
                    <x-popover.separator />
                    <x-form method="post" action="{{ route('logout') }}" class="w-full flex">
                        <x-popover.item before="phosphor-sign-out">{{ __('Log Out') }}</x-popover.item>
                    </x-form>
                </x-slot:menu>
            </x-popover>
        </x-sidebar>

        <!-- Mobile User Menu -->
        <x-header class="lg:hidden">
            <x-container class="min-h-14 flex items-center">
                <x-sidebar.toggle class="lg:hidden w-10 p-0">
                    <x-phosphor-list aria-hidden="true" width="20" height="20" />
                </x-sidebar.toggle>

                <x-spacer />

                <x-popover align="top" justify="right">
                    <button type="button" class="w-full group flex items-center rounded-lg p-1 hover:bg-gray-800/5 dark:hover:bg-white/10">
                        <img class="size-8 flex-none rounded-full bg-gray-50" src="{{ auth()->user()->avatar }}" alt="">
                        <span class="shrink-0 ml-auto size-8 flex justify-center items-center">
                            <x-phosphor-caret-down width="16" height="16" class="text-gray-400 dark:text-white/80 group-hover:text-gray-800 dark:group-hover:text-white" />
                        </span>
                    </button>
                    <x-slot:menu>
                        <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                            <img class="size-8 flex-none rounded-full bg-gray-50" src="{{ auth()->user()->avatar }}" alt="">
                            <div class="grid flex-1 text-left text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                        <x-popover.separator />
                        <x-popover.item before="phosphor-gear-fine" href="{{ route('settings.profile.edit') }}">{{ __('Settings') }}</x-popover.item>
                        <x-popover.separator />
                        <x-form method="post" action="{{ route('logout') }}" class="w-full flex">
                            <x-popover.item before="phosphor-sign-out">{{ __('Log Out') }}</x-popover.item>
                        </x-form>
                    </x-slot:menu>
                </x-popover>
            </x-container>
        </x-header>

        {{ $slot }}

        <div class="fixed bottom-4 right-6 z-50">
            <p class="text-xs text-gray-400 dark:text-gray-500">
                Created by <a href="https://codebyhicham.com/" target="_blank" rel="noopener" class="text-orange-500 hover:text-orange-400 transition-colors">codebyhicham.com</a>
            </p>
        </div>

    </body>
</html>
