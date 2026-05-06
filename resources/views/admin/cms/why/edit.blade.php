<x-layouts.app :title="__('Edit Why Card')">
    <x-headbar :title="__('Edit Why Card')" />

    <div class="mt-6 max-w-2xl">
        <x-form method="put" action="{{ route('admin.why.update', $why) }}" class="space-y-0">

            <div class="bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-2xl divide-y divide-gray-100 dark:divide-white/10 overflow-hidden">

                <div class="p-6">
                    <x-input
                        label="Heading"
                        description="A short, bold title for this reason."
                        name="title"
                        :value="old('title', $why->title)"
                        required
                        autofocus
                    />
                </div>

                <div class="p-6">
                    <x-textarea
                        label="Description"
                        description="1–2 sentences explaining why this matters to clients."
                        name="description"
                        rows="3"
                        required
                    >{{ old('description', $why->description) }}</x-textarea>
                </div>

                <div class="p-6">
                    <x-label :value="__('Icon')" />
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5 mb-4">Choose an icon that best represents this point.</p>
                    <x-icon-picker name="icon" :value="old('icon', $why->icon)" :icons="[
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
                <x-button variant="primary">Save Changes</x-button>
                <x-button type="button" onclick="history.back()">Cancel</x-button>
                <x-spacer />
                <x-button variant="danger" form="delete_why">Delete Card</x-button>
            </div>

        </x-form>

        <x-form id="delete_why" method="delete" action="{{ route('admin.why.destroy', $why) }}"
            onsubmit="return confirm('Remove this card from the website?')" />
    </div>
</x-layouts.app>
