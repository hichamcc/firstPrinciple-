<x-layouts.app :title="__('Add Why Card')">
    <x-headbar :title="__('Add Why Card')" />

    <div class="mt-6 max-w-2xl">
        <x-form method="post" action="{{ route('admin.why.store') }}" class="space-y-0">

            <div class="bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-2xl divide-y divide-gray-100 dark:divide-white/10 overflow-hidden">

                <div class="p-6">
                    <x-input
                        label="Heading"
                        description="A short, bold title for this reason — e.g. 'Holistic Approach'."
                        name="title"
                        :value="old('title')"
                        required
                        autofocus
                        placeholder="e.g. Holistic Approach"
                    />
                </div>

                <div class="p-6">
                    <x-textarea
                        label="Description"
                        description="1–2 sentences explaining why this matters to clients."
                        name="description"
                        rows="3"
                        required
                        placeholder="Explain this point in plain language..."
                    >{{ old('description') }}</x-textarea>
                </div>

                <div class="p-6">
                    <x-label :value="__('Icon')" />
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5 mb-4">Choose an icon that best represents this point.</p>
                    <x-icon-picker name="icon" :value="old('icon', 'phosphor-shield-check')" :icons="[
                        'phosphor-shield-check'   => 'Protection',
                        'phosphor-check-circle'   => 'Approved',
                        'phosphor-users'          => 'People',
                        'phosphor-users-three'    => 'Community',
                        'phosphor-handshake'      => 'Partnership',
                        'phosphor-arrows-out'     => 'Scalable',
                        'phosphor-buildings'      => 'Buildings',
                        'phosphor-lightbulb'      => 'Ideas',
                        'phosphor-star'           => 'Quality',
                        'phosphor-heart'          => 'Care',
                        'phosphor-compass'        => 'Direction',
                        'phosphor-scales'         => 'Balance',
                        'phosphor-chart-bar'      => 'Results',
                        'phosphor-flag'           => 'Goals',
                        'phosphor-gear-fine'      => 'Expertise',
                        'phosphor-tree'           => 'Sustainability',
                        'phosphor-map-trifold'    => 'Planning',
                        'phosphor-calendar'       => 'Timeline',
                    ]" />
                </div>

            </div>

            <div class="flex gap-3 pt-5">
                <x-button variant="primary">Save Card</x-button>
                <x-button type="button" onclick="history.back()">Cancel</x-button>
            </div>

        </x-form>
    </div>
</x-layouts.app>
