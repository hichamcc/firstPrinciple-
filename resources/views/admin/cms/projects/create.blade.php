<x-layouts.app :title="__('Add Project')">
    <x-headbar :title="__('Add Project')" />

    <div class="mt-6 max-w-2xl">
        <x-form method="post" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data" class="space-y-0">

            <div class="bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-2xl divide-y divide-gray-100 dark:divide-white/10 overflow-hidden">

                {{-- Image --}}
                <div class="p-6" x-data="imageUpload()">
                    <x-label :value="__('Project Image')" />
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5 mb-4">Upload a photo or paste an image URL.</p>

                    {{-- Tab switcher --}}
                    <div class="flex gap-1 bg-gray-100 dark:bg-white/10 rounded-xl p-1 mb-4 w-fit">
                        <button type="button" @click="tab = 'upload'"
                            :class="tab === 'upload' ? 'bg-white dark:bg-white/15 shadow-sm text-gray-900 dark:text-white' : 'text-gray-500 hover:text-gray-700 dark:hover:text-gray-300'"
                            class="px-4 py-1.5 text-sm font-medium rounded-lg transition-all">
                            Upload File
                        </button>
                        <button type="button" @click="tab = 'url'"
                            :class="tab === 'url' ? 'bg-white dark:bg-white/15 shadow-sm text-gray-900 dark:text-white' : 'text-gray-500 hover:text-gray-700 dark:hover:text-gray-300'"
                            class="px-4 py-1.5 text-sm font-medium rounded-lg transition-all">
                            Image URL
                        </button>
                    </div>

                    {{-- Upload area --}}
                    <div x-show="tab === 'upload'" x-transition>
                        <label for="image_file"
                            class="relative flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-300 dark:border-white/20 rounded-xl cursor-pointer hover:border-orange-400 hover:bg-orange-50/50 dark:hover:bg-orange-900/10 transition-all"
                            :class="preview ? 'border-orange-400 bg-orange-50/50 dark:bg-orange-900/10' : ''">
                            <template x-if="!preview">
                                <div class="flex flex-col items-center gap-2 text-gray-400">
                                    <x-phosphor-upload-simple width="32" height="32" />
                                    <div class="text-sm font-medium">Click to upload an image</div>
                                    <div class="text-xs">JPG, PNG, WEBP up to 4MB</div>
                                </div>
                            </template>
                            <template x-if="preview">
                                <div class="w-full h-full relative">
                                    <img :src="preview" class="w-full h-full object-cover rounded-xl">
                                    <div class="absolute inset-0 bg-black/30 rounded-xl flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity">
                                        <span class="text-white text-sm font-medium">Change image</span>
                                    </div>
                                </div>
                            </template>
                            <input id="image_file" name="image_file" type="file" accept="image/*" class="sr-only"
                                @change="previewFile($event)">
                        </label>
                        <x-error for="image_file" />
                    </div>

                    {{-- URL input --}}
                    <div x-show="tab === 'url'" x-transition>
                        <x-input name="image_url" :value="old('image_url')" type="url"
                            placeholder="https://example.com/photo.jpg"
                            description="Paste a direct link to a photo." />
                    </div>
                </div>

                {{-- Title & Category --}}
                <div class="p-6 space-y-5">
                    <x-input
                        label="Project Title"
                        description="The headline shown on the project card."
                        name="title"
                        :value="old('title')"
                        required
                        autofocus
                        placeholder="e.g. Riverside Community Plan"
                    />
                    <x-input
                        label="Category Tag"
                        description="A short label shown as a badge, e.g. 'Area Structure Plan' or 'Landscape Architecture'."
                        name="category"
                        :value="old('category')"
                        required
                        placeholder="e.g. Area Structure Plan"
                    />
                </div>

                {{-- Description --}}
                <div class="p-6">
                    <x-textarea
                        label="Project Description"
                        description="A short summary of the project. 2–3 sentences is ideal."
                        name="description"
                        rows="4"
                        required
                        placeholder="Describe the project scope, key features, and outcomes..."
                    >{{ old('description') }}</x-textarea>
                </div>

            </div>

            <div class="flex gap-3 pt-5">
                <x-button variant="primary">Save Project</x-button>
                <x-button type="button" onclick="history.back()">Cancel</x-button>
            </div>

        </x-form>
    </div>
</x-layouts.app>

<script>
function imageUpload() {
    return {
        tab: 'upload',
        preview: null,
        previewFile(event) {
            const file = event.target.files[0];
            if (file) this.preview = URL.createObjectURL(file);
        }
    }
}
</script>
