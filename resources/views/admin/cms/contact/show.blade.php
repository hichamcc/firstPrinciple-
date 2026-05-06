<x-layouts.app :title="__('Lead: :name', ['name' => $contact->name])">
    <x-headbar :title="$contact->name" />

    <div class="mt-6 max-w-2xl space-y-6">
        <div class="bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-2xl divide-y divide-gray-100 dark:divide-white/10">
            @foreach([
                'Email'        => $contact->email,
                'Phone'        => $contact->phone ?? '—',
                'Project Type' => $contact->project_type ?? '—',
                'Received'     => $contact->created_at->format('M j, Y g:i a'),
            ] as $label => $value)
                <div class="flex items-start gap-4 px-6 py-4">
                    <span class="text-sm text-gray-500 w-32 shrink-0">{{ $label }}</span>
                    <span class="text-sm text-gray-800 dark:text-gray-200 font-medium">{{ $value }}</span>
                </div>
            @endforeach
            <div class="px-6 py-4">
                <span class="text-sm text-gray-500 block mb-2">Message</span>
                <p class="text-sm text-gray-800 dark:text-gray-200 whitespace-pre-wrap leading-relaxed">{{ $contact->message }}</p>
            </div>
        </div>

        <div class="flex gap-3">
            <x-button href="{{ route('admin.contact.index') }}">← Back to Leads</x-button>
            <x-spacer />
            <x-button variant="danger" form="delete_contact">Delete</x-button>
        </div>
    </div>

    <x-form id="delete_contact" method="delete" action="{{ route('admin.contact.destroy', $contact) }}" onsubmit="return confirm('Delete this submission?')" />
</x-layouts.app>
