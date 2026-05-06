<x-layouts.app :title="__('Team')">
    <x-headbar :title="__('Team')">
        <x-button variant="primary" href="{{ route('admin.team.create') }}">
            <x-phosphor-plus width="16" height="16" aria-hidden="true" />
            Add Member
        </x-button>
    </x-headbar>

    <div class="mt-6">
        @if($members->isNotEmpty())
            <div class="bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-2xl overflow-hidden">
                <div class="px-6 py-3 border-b border-gray-100 dark:border-white/10 bg-gray-50/50 dark:bg-white/3 flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                    <x-phosphor-arrows-down-up width="14" height="14" />
                    Use the arrows to reorder how team members appear on the website.
                </div>
                <div class="divide-y divide-gray-100 dark:divide-white/10">
                    @foreach($members as $member)
                        <div class="flex items-center gap-4 px-5 py-4 hover:bg-gray-50/50 dark:hover:bg-white/3 transition-colors">

                            <div class="flex flex-col gap-0.5 shrink-0">
                                <x-form method="patch" action="{{ route('admin.team.reorder', $member) }}" class="contents">
                                    <input type="hidden" name="direction" value="up">
                                    <button title="Move up" @disabled($loop->first)
                                        class="p-1 rounded hover:bg-gray-100 dark:hover:bg-white/10 disabled:opacity-25 disabled:cursor-not-allowed transition-colors">
                                        <x-phosphor-caret-up width="14" height="14" />
                                    </button>
                                </x-form>
                                <x-form method="patch" action="{{ route('admin.team.reorder', $member) }}" class="contents">
                                    <input type="hidden" name="direction" value="down">
                                    <button title="Move down" @disabled($loop->last)
                                        class="p-1 rounded hover:bg-gray-100 dark:hover:bg-white/10 disabled:opacity-25 disabled:cursor-not-allowed transition-colors">
                                        <x-phosphor-caret-down width="14" height="14" />
                                    </button>
                                </x-form>
                            </div>

                            {{-- Avatar --}}
                            @if($member->image_src)
                                <img src="{{ $member->image_src }}" alt="{{ $member->title }}"
                                    class="w-10 h-10 rounded-full object-cover shrink-0 border border-gray-200 dark:border-white/10">
                            @else
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-gray-600 to-gray-800 dark:from-gray-500 dark:to-gray-700 flex items-center justify-center shrink-0">
                                    <x-phosphor-user width="18" height="18" class="text-white" />
                                </div>
                            @endif

                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-800 dark:text-white">{{ $member->title }}</p>
                                <p class="text-xs text-orange-500 font-medium mt-0.5">{{ $member->years }}</p>
                                <div class="flex flex-wrap gap-1 mt-1.5">
                                    @foreach($member->skills as $skill)
                                        <span class="text-xs bg-gray-100 dark:bg-white/10 text-gray-500 dark:text-gray-400 px-2 py-0.5 rounded-full">{{ $skill }}</span>
                                    @endforeach
                                </div>
                            </div>

                            <div class="flex items-center gap-1 shrink-0">
                                <a href="{{ route('admin.team.edit', $member) }}"
                                    class="p-2 rounded-lg text-gray-400 hover:text-gray-700 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-white/10 transition-colors"
                                    title="Edit">
                                    <x-phosphor-pencil width="16" height="16" />
                                </a>
                                <x-form class="contents" method="delete" action="{{ route('admin.team.destroy', $member) }}"
                                    onsubmit="return confirm('Remove this team member from the website?')">
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
                <x-phosphor-users width="40" height="40" class="mx-auto text-gray-300 dark:text-gray-600 mb-4" />
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-4">No team members yet</p>
                <x-button variant="primary" href="{{ route('admin.team.create') }}">Add your first team member</x-button>
            </div>
        @endif
    </div>
</x-layouts.app>
