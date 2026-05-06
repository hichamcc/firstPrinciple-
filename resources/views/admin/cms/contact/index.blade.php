<x-layouts.app :title="__('Leads')">
    <x-headbar :title="__('Leads')" />

    <x-section class="mt-6">
        @if($submissions->isNotEmpty())
            <x-table>
                <x-slot:head>
                    <x-table.row>
                        <x-table.col>Name</x-table.col>
                        <x-table.col>Email</x-table.col>
                        <x-table.col>Phone</x-table.col>
                        <x-table.col>Type</x-table.col>
                        <x-table.col>Received</x-table.col>
                        <x-table.col class="text-right">Actions</x-table.col>
                    </x-table.row>
                </x-slot:head>
                <x-slot:body>
                    @foreach($submissions as $submission)
                        <x-table.row>
                            <x-table.cell>
                                <div class="flex items-center gap-2">
                                    @if($submission->isUnread())
                                        <span class="w-2 h-2 bg-orange-500 rounded-full flex-shrink-0"></span>
                                    @endif
                                    <x-link href="{{ route('admin.contact.show', $submission) }}" class="{{ $submission->isUnread() ? 'font-semibold' : '' }}">
                                        {{ $submission->name }}
                                    </x-link>
                                </div>
                            </x-table.cell>
                            <x-table.cell>{{ $submission->email }}</x-table.cell>
                            <x-table.cell>{{ $submission->phone ?? '—' }}</x-table.cell>
                            <x-table.cell>{{ $submission->project_type ?? '—' }}</x-table.cell>
                            <x-table.cell><x-time :datetime="$submission->created_at" /></x-table.cell>
                            <x-table.cell>
                                <div class="flex justify-end gap-3">
                                    <a href="{{ route('admin.contact.show', $submission) }}" title="View">
                                        <x-phosphor-eye width="18" height="18" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200" />
                                    </a>
                                    <x-form class="contents" method="delete" action="{{ route('admin.contact.destroy', $submission) }}" onsubmit="return confirm('Delete this submission?')">
                                        <button title="Delete">
                                            <x-phosphor-trash width="18" height="18" class="text-gray-400 hover:text-red-600" />
                                        </button>
                                    </x-form>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endforeach
                </x-slot:body>
            </x-table>
            <x-pagination class="mt-1" :paginator="$submissions" />
        @else
            <p class="text-sm text-gray-400 py-8 text-center">No submissions yet.</p>
        @endif
    </x-section>
</x-layouts.app>
