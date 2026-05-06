<x-layouts.app :title="__('Site Settings')">

    <x-headbar :title="__('Site Settings')" />

    @if(session('status') === 'settings-updated')
        <div class="mt-4 flex items-center gap-3 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 px-4 py-3 rounded-xl text-sm text-green-700 dark:text-green-300">
            <x-phosphor-check-circle width="18" height="18" class="shrink-0" />
            Settings saved successfully.
        </div>
    @endif

    <x-form method="put" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6 max-w-2xl">

        {{-- ── Hero ── --}}
        <div class="bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-2xl overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 dark:border-white/10 bg-gray-50/50 dark:bg-white/3">
                <h2 class="text-sm font-semibold text-gray-800 dark:text-white">Hero Section</h2>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">The large banner at the top of the homepage.</p>
            </div>
            <div class="divide-y divide-gray-100 dark:divide-white/10">

                <div class="p-6">
                    <x-input
                        label="Main Headline"
                        description="The large text visitors see first."
                        name="hero_headline"
                        :value="old('hero_headline', $settings['hero_headline'] ?? '')"
                        required
                        placeholder="Urban Planning & Landscape Architecture"
                    />
                </div>

                <div class="p-6">
                    <x-textarea
                        label="Subheadline"
                        description="The smaller text below the headline."
                        name="hero_subheadline"
                        rows="2"
                    >{{ old('hero_subheadline', $settings['hero_subheadline'] ?? '') }}</x-textarea>
                </div>

                <div class="p-6" x-data="imageUpload('{{ $settings['hero_image'] ?? null ? (str_starts_with($settings['hero_image'], 'http') ? $settings['hero_image'] : Storage::disk('public')->url($settings['hero_image'])) : null }}')">
                    <x-label :value="__('Background Image')" />
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5 mb-4">The photo behind the hero text. Use a high-resolution landscape image.</p>

                    <div class="flex gap-1 bg-gray-100 dark:bg-white/10 rounded-xl p-1 mb-4 w-fit">
                        <button type="button" @click="tab = 'upload'"
                            :class="tab === 'upload' ? 'bg-white dark:bg-white/15 shadow-sm text-gray-900 dark:text-white' : 'text-gray-500 hover:text-gray-700'"
                            class="px-4 py-1.5 text-sm font-medium rounded-lg transition-all">Upload File</button>
                        <button type="button" @click="tab = 'url'"
                            :class="tab === 'url' ? 'bg-white dark:bg-white/15 shadow-sm text-gray-900 dark:text-white' : 'text-gray-500 hover:text-gray-700'"
                            class="px-4 py-1.5 text-sm font-medium rounded-lg transition-all">Image URL</button>
                    </div>

                    <div x-show="tab === 'upload'" x-transition>
                        <label for="hero_image_file"
                            class="relative flex flex-col items-center justify-center w-full h-36 border-2 border-dashed border-gray-300 dark:border-white/20 rounded-xl cursor-pointer hover:border-orange-400 hover:bg-orange-50/50 transition-all overflow-hidden">
                            <template x-if="!preview">
                                <div class="flex flex-col items-center gap-2 text-gray-400">
                                    <x-phosphor-upload-simple width="28" height="28" />
                                    <span class="text-sm font-medium">Click to upload</span>
                                    <span class="text-xs">JPG, PNG, WEBP up to 4MB</span>
                                </div>
                            </template>
                            <template x-if="preview">
                                <div class="w-full h-full relative">
                                    <img :src="preview" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-black/30 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity">
                                        <span class="text-white text-sm font-medium">Change image</span>
                                    </div>
                                </div>
                            </template>
                            <input id="hero_image_file" name="hero_image_file" type="file" accept="image/*" class="sr-only"
                                @change="previewFile($event)">
                        </label>
                    </div>

                    <div x-show="tab === 'url'" x-transition>
                        <x-input name="hero_image_url"
                            :value="old('hero_image_url', str_starts_with($settings['hero_image'] ?? '', 'http') ? $settings['hero_image'] : '')"
                            type="url" placeholder="https://example.com/photo.jpg"
                            description="Paste a direct link to a photo." />
                    </div>
                </div>

            </div>
        </div>

        {{-- ── About ── --}}
        <div class="bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-2xl overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 dark:border-white/10 bg-gray-50/50 dark:bg-white/3">
                <h2 class="text-sm font-semibold text-gray-800 dark:text-white">About Section</h2>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">The "Who We Are" section on the homepage.</p>
            </div>
            <div class="divide-y divide-gray-100 dark:divide-white/10">

                <div class="p-6 grid sm:grid-cols-2 gap-5">
                    <x-input
                        label="Badge Text"
                        description="Small label above the heading."
                        name="about_badge"
                        :value="old('about_badge', $settings['about_badge'] ?? '')"
                        required
                        placeholder="Who We Are"
                    />
                    <x-input
                        label="Section Heading"
                        description="The bold heading text."
                        name="about_heading"
                        :value="old('about_heading', $settings['about_heading'] ?? '')"
                        required
                        placeholder="Planning from first principles"
                    />
                </div>

                @foreach([1 => 'First paragraph', 2 => 'Second paragraph', 3 => 'Third paragraph'] as $i => $label)
                    <div class="p-6">
                        <x-textarea
                            :label="$label"
                            name="about_text_{{ $i }}"
                            rows="3"
                            required
                        >{{ old("about_text_$i", $settings["about_text_$i"] ?? '') }}</x-textarea>
                        <x-error for="about_text_{{ $i }}" />
                    </div>
                @endforeach

            </div>
        </div>

        {{-- ── Contact Info ── --}}
        <div class="bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-2xl overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 dark:border-white/10 bg-gray-50/50 dark:bg-white/3">
                <h2 class="text-sm font-semibold text-gray-800 dark:text-white">Contact Details</h2>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Shown in the header bar, contact section, and footer.</p>
            </div>
            <div class="p-6 grid sm:grid-cols-2 gap-5">
                <x-input
                    label="Phone Number"
                    description="Displayed and linked as a click-to-call."
                    name="phone"
                    :value="old('phone', $settings['phone'] ?? '')"
                    required
                    placeholder="(403) 555-1234"
                />
                <x-input
                    label="Email Address"
                    description="Displayed and linked as mailto."
                    name="email"
                    type="email"
                    :value="old('email', $settings['email'] ?? '')"
                    required
                    placeholder="info@example.com"
                />
            </div>
        </div>

        <div class="flex gap-3 pb-8">
            <x-button variant="primary">Save All Settings</x-button>
        </div>

    </x-form>
</x-layouts.app>

<script>
function imageUpload(existing) {
    return {
        tab: existing ? 'upload' : 'upload',
        preview: existing || null,
        previewFile(event) {
            const file = event.target.files[0];
            if (file) this.preview = URL.createObjectURL(file);
        }
    }
}
</script>
