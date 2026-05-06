<x-layouts.app :title="__('Dashboard')">
    <x-headbar :title="__('Dashboard')" />

    <div class="mt-6 space-y-6">

        {{-- Stats grid --}}
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-4">
            <a href="{{ route('admin.contact.index') }}" class="group block bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl p-5 hover:border-orange-300 transition-colors">
                <div class="text-2xl font-bold text-orange-500">{{ $stats['unread'] }}</div>
                <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">Unread Leads</div>
                <div class="text-xs text-gray-400 mt-0.5">{{ $stats['total_leads'] }} total</div>
            </a>
            <a href="{{ route('admin.services.index') }}" class="group block bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl p-5 hover:border-blue-300 transition-colors">
                <div class="text-2xl font-bold text-gray-800 dark:text-white">{{ $stats['services'] }}</div>
                <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">Services</div>
            </a>
            <a href="{{ route('admin.projects.index') }}" class="group block bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl p-5 hover:border-blue-300 transition-colors">
                <div class="text-2xl font-bold text-gray-800 dark:text-white">{{ $stats['projects'] }}</div>
                <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">Projects</div>
            </a>
            <a href="{{ route('admin.team.index') }}" class="group block bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl p-5 hover:border-blue-300 transition-colors">
                <div class="text-2xl font-bold text-gray-800 dark:text-white">{{ $stats['team_members'] }}</div>
                <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">Team Members</div>
            </a>
            <a href="{{ route('admin.why.index') }}" class="group block bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl p-5 hover:border-blue-300 transition-colors">
                <div class="text-2xl font-bold text-gray-800 dark:text-white">{{ $stats['why_cards'] }}</div>
                <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">Why Cards</div>
            </a>
            <a href="{{ route('admin.settings.edit') }}" class="group block bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl p-5 hover:border-blue-300 transition-colors">
                <div class="text-2xl font-bold text-gray-800 dark:text-white">
                    <x-phosphor-gear-fine width="28" height="28" class="text-gray-400" />
                </div>
                <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">Site Settings</div>
            </a>
        </div>

        {{-- Recent leads --}}
        @if($recentSubmissions->isNotEmpty())
        <div>
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Recent Leads</h2>
                <a href="{{ route('admin.contact.index') }}" class="text-xs text-orange-500 hover:text-orange-600">View all →</a>
            </div>
            <x-table>
                <x-slot:head>
                    <x-table.row>
                        <x-table.col>Name</x-table.col>
                        <x-table.col>Email</x-table.col>
                        <x-table.col>Type</x-table.col>
                        <x-table.col>Received</x-table.col>
                        <x-table.col></x-table.col>
                    </x-table.row>
                </x-slot:head>
                <x-slot:body>
                    @foreach($recentSubmissions as $submission)
                        <x-table.row>
                            <x-table.cell>
                                <span class="{{ $submission->isUnread() ? 'font-semibold text-gray-900 dark:text-white' : '' }}">
                                    {{ $submission->name }}
                                </span>
                                @if($submission->isUnread())
                                    <span class="ml-1.5 inline-block w-2 h-2 bg-orange-500 rounded-full"></span>
                                @endif
                            </x-table.cell>
                            <x-table.cell>{{ $submission->email }}</x-table.cell>
                            <x-table.cell>{{ $submission->project_type ?? '—' }}</x-table.cell>
                            <x-table.cell><x-time :datetime="$submission->created_at" /></x-table.cell>
                            <x-table.cell>
                                <a href="{{ route('admin.contact.show', $submission) }}" class="text-xs text-orange-500 hover:underline">View</a>
                            </x-table.cell>
                        </x-table.row>
                    @endforeach
                </x-slot:body>
            </x-table>
        </div>
        @else
        <div class="text-center py-16 text-gray-400 dark:text-gray-600 text-sm">
            No contact submissions yet.
        </div>
        @endif

    </div>

</x-layouts.app>
