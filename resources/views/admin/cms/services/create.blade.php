<x-layouts.app :title="__('Add Service')">
    <x-headbar :title="__('Add Service')" />

    <div class="mt-6 max-w-2xl">
        <x-form method="post" action="{{ route('admin.services.store') }}" class="space-y-0">

            <div class="bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-2xl divide-y divide-gray-100 dark:divide-white/10 overflow-hidden">

                {{-- Title --}}
                <div class="p-6">
                    <x-input
                        label="Service Name"
                        description="The name shown on the website, e.g. 'Development Permits & Approvals'"
                        name="title"
                        :value="old('title')"
                        required
                        autofocus
                        placeholder="e.g. Development Permits & Approvals"
                    />
                </div>

                {{-- Description --}}
                <div class="p-6">
                    <x-textarea
                        label="Short Description"
                        description="A 1–2 sentence summary shown under the service title on the website."
                        name="description"
                        rows="3"
                        required
                        placeholder="Describe what this service covers in plain language..."
                    >{{ old('description') }}</x-textarea>
                </div>

                {{-- Icon --}}
                <div class="p-6">
                    <x-label :value="__('Icon')" />
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5 mb-4">Choose an icon that represents this service.</p>
                    <x-icon-picker name="icon" :value="old('icon', 'phosphor-file-text')" />
                </div>

            </div>

            <div class="flex gap-3 pt-5">
                <x-button variant="primary">Save Service</x-button>
                <x-button type="button" onclick="history.back()">Cancel</x-button>
            </div>

        </x-form>
    </div>
</x-layouts.app>
