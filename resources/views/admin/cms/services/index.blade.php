<x-layouts.app :title="__('Services')">
    <x-headbar :title="__('Services')">
        <x-button variant="primary" href="{{ route('admin.services.create') }}">
            <x-phosphor-plus width="16" height="16" aria-hidden="true" />
            Add Service
        </x-button>
    </x-headbar>

    <div class="mt-6">
        @if($services->isNotEmpty())
            <div class="bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-2xl overflow-hidden">
                <div class="px-6 py-3 border-b border-gray-100 dark:border-white/10 bg-gray-50/50 dark:bg-white/3 flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                    <x-phosphor-arrows-down-up width="14" height="14" />
                    Use the arrows to reorder how services appear on the website.
                </div>
                <div class="divide-y divide-gray-100 dark:divide-white/10">
                    @foreach($services as $service)
                        <div class="flex items-center gap-4 px-5 py-4 hover:bg-gray-50/50 dark:hover:bg-white/3 transition-colors">

                            {{-- Reorder --}}
                            <div class="flex flex-col gap-0.5 shrink-0">
                                <x-form method="patch" action="{{ route('admin.services.reorder', $service) }}" class="contents">
                                    <input type="hidden" name="direction" value="up">
                                    <button title="Move up" @disabled($loop->first)
                                        class="p-1 rounded hover:bg-gray-100 dark:hover:bg-white/10 disabled:opacity-25 disabled:cursor-not-allowed transition-colors">
                                        <x-phosphor-caret-up width="14" height="14" />
                                    </button>
                                </x-form>
                                <x-form method="patch" action="{{ route('admin.services.reorder', $service) }}" class="contents">
                                    <input type="hidden" name="direction" value="down">
                                    <button title="Move down" @disabled($loop->last)
                                        class="p-1 rounded hover:bg-gray-100 dark:hover:bg-white/10 disabled:opacity-25 disabled:cursor-not-allowed transition-colors">
                                        <x-phosphor-caret-down width="14" height="14" />
                                    </button>
                                </x-form>
                            </div>

                            {{-- Icon preview --}}
                            <div class="w-10 h-10 rounded-xl bg-orange-50 dark:bg-orange-900/20 flex items-center justify-center shrink-0">
                                <x-dynamic-component :component="$service->icon" width="20" height="20" class="text-orange-500" />
                            </div>

                            {{-- Content --}}
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-800 dark:text-white">{{ $service->title }}</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5 truncate">{{ $service->description }}</p>
                            </div>

                            {{-- Actions --}}
                            <div class="flex items-center gap-1 shrink-0">
                                <a href="{{ route('admin.services.edit', $service) }}"
                                    class="p-2 rounded-lg text-gray-400 hover:text-gray-700 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-white/10 transition-colors"
                                    title="Edit">
                                    <x-phosphor-pencil width="16" height="16" />
                                </a>
                                <x-form class="contents" method="delete" action="{{ route('admin.services.destroy', $service) }}"
                                    onsubmit="return confirm('Remove this service from the website?')">
                                    <button title="Delete"
                                        class="p-2 rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                        <x-phosphor-trash width="16" height="16" />
                                    </button>
                                </x-form>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-2xl p-16 text-center">
                <x-phosphor-squares-four width="40" height="40" class="mx-auto text-gray-300 dark:text-gray-600 mb-4" />
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-4">No services yet</p>
                <x-button variant="primary" href="{{ route('admin.services.create') }}">Add your first service</x-button>
            </div>
        @endif
    </div>
</x-layouts.app>
