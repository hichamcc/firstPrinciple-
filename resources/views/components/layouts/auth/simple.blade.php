<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen antialiased bg-gray-950">
        <div class="min-h-screen flex">

            {{-- Left panel: branding --}}
            <div class="hidden lg:flex lg:w-1/2 relative flex-col justify-between p-12 bg-gray-900 overflow-hidden">
                {{-- Background texture --}}
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_rgba(249,115,22,0.15),_transparent_60%)]"></div>
                <div class="absolute bottom-0 left-0 w-80 h-80 bg-orange-500/5 rounded-full blur-3xl -translate-x-1/2 translate-y-1/2"></div>

                {{-- Logo --}}
                <div class="relative z-10">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-orange-500 flex items-center justify-center">
                            <span class="text-white font-bold text-lg leading-none">1P</span>
                        </div>
                        <div>
                            <p class="text-white font-semibold text-sm leading-tight">1st Principles</p>
                            <p class="text-gray-400 text-xs leading-tight">Planning</p>
                        </div>
                    </div>
                </div>

                {{-- Middle content --}}
                <div class="relative z-10">
                    <div class="inline-flex items-center gap-2 bg-orange-500/10 border border-orange-500/20 text-orange-400 text-xs font-medium px-3 py-1.5 rounded-full mb-6">
                        <span class="w-1.5 h-1.5 rounded-full bg-orange-400 inline-block"></span>
                        Admin Portal
                    </div>
                    <h1 class="text-3xl font-bold text-white leading-tight mb-4">
                        Manage your<br>
                        <span class="text-orange-400">website content</span><br>
                        with ease.
                    </h1>
                    <p class="text-gray-400 text-sm leading-relaxed max-w-xs">
                        Update projects, team members, services, and site settings — all from one place.
                    </p>
                </div>

                {{-- Bottom --}}
                <div class="relative z-10">
                    <p class="text-gray-600 text-xs">
                        &copy; {{ date('Y') }} 1st Principles Planning. All rights reserved.
                    </p>
                </div>
            </div>

            {{-- Right panel: form --}}
            <div class="flex-1 flex flex-col items-center justify-center p-8 bg-white">
                {{-- Mobile logo --}}
                <div class="lg:hidden mb-8 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-orange-500 flex items-center justify-center">
                        <span class="text-white font-bold text-base leading-none">1P</span>
                    </div>
                    <div>
                        <p class="text-gray-900 font-semibold text-sm leading-tight">1st Principles Planning</p>
                    </div>
                </div>

                <div class="w-full max-w-sm">
                    {{ $slot }}
                </div>
            </div>

        </div>
    </body>
</html>
