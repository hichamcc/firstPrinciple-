<x-layouts.app :title="__('Edit Service')">
    <x-headbar :title="__('Edit Service')" />

    <div class="mt-6 max-w-2xl">
        <x-form method="put" action="{{ route('admin.services.update', $service) }}" class="space-y-0">

            <div class="bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-2xl divide-y divide-gray-100 dark:divide-white/10 overflow-hidden">

                <div class="p-6">
                    <x-input
                        label="Service Name"
                        description="The name shown on the website."
                        name="title"
                        :value="old('title', $service->title)"
                        required
                        autofocus
                    />
                </div>

                <div class="p-6">
                    <x-textarea
                        label="Short Description"
                        description="A 1–2 sentence summary shown under the service title on the website."
                        name="description"
                        rows="3"
                        required
                    >{{ old('description', $service->description) }}</x-textarea>
                </div>

                <div class="p-6">
                    <x-label :value="__('Icon')" />
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5 mb-4">Choose an icon that represents this service.</p>
                    <x-icon-picker name="icon" :value="old('icon', $service->icon)" />
                </div>

            </div>

            <div class="flex gap-3 pt-5">
                <x-button variant="primary">Save Changes</x-button>
                <x-button type="button" onclick="history.back()">Cancel</x-button>
                <x-spacer />
                <x-button variant="danger" form="delete_service">Delete Service</x-button>
            </div>

        </x-form>

        <x-form id="delete_service" method="delete" action="{{ route('admin.services.destroy', $service) }}"
            onsubmit="return confirm('Remove this service from the website?')" />
    </div>
</x-layouts.app>
