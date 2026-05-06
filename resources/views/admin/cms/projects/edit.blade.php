<x-layouts.app :title="__('Edit Project')">
    <x-headbar :title="__('Edit Project')" />

    <div class="mt-6 max-w-2xl">
        <x-form method="put" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data" class="space-y-0">

            <div class="bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-2xl divide-y divide-gray-100 dark:divide-white/10 overflow-hidden">

                {{-- Image --}}
                <div class="p-6" x-data="imageUpload('{{ $project->image_src }}')">
                    <x-label :value="__('Project Image')" />
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5 mb-4">Upload a new photo or paste an image URL to replace the current one.</p>

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

                    <div x-show="tab === 'upload'" x-transition>
                        <label for="image_file"
                            class="relative flex flex-col items-center justify-center w-full h-44 border-2 border-dashed border-gray-300 dark:border-white/20 rounded-xl cursor-pointer hover:border-orange-400 hover:bg-orange-50/50 dark:hover:bg-orange-900/10 transition-all overflow-hidden">
                            <template x-if="!preview">
                                <div class="flex flex-col items-center gap-2 text-gray-400">
                                    <x-phosphor-upload-simple width="32" height="32" />
                                    <div class="text-sm font-medium">Click to upload a new image</div>
                                    <div class="text-xs">JPG, PNG, WEBP up to 4MB</div>
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
                            <input id="image_file" name="image_file" type="file" accept="image/*" class="sr-only"
                                @change="previewFile($event)">
                        </label>
                        <x-error for="image_file" />
                    </div>

                    <div x-show="tab === 'url'" x-transition>
                        <x-input name="image_url"
                            :value="old('image_url', str_starts_with($project->image ?? '', 'http') ? $project->image : '')"
                            type="url"
                            placeholder="https://example.com/photo.jpg"
                            description="Paste a direct link to a photo." />
                    </div>
                </div>

                <div class="p-6 space-y-5">
                    <x-input
                        label="Project Title"
                        description="The headline shown on the project card."
                        name="title"
                        :value="old('title', $project->title)"
                        required
                        autofocus
                    />
                    <x-input
                        label="Category Tag"
                        description="Short label shown as a badge on the card."
                        name="category"
                        :value="old('category', $project->category)"
                        required
                    />
                </div>

                <div class="p-6">
                    <x-textarea
                        label="Project Description"
                        description="A short summary. 2–3 sentences is ideal."
                        name="description"
                        rows="4"
                        required
                    >{{ old('description', $project->description) }}</x-textarea>
                </div>

            </div>

            <div class="flex gap-3 pt-5">
                <x-button variant="primary">Save Changes</x-button>
                <x-button type="button" onclick="history.back()">Cancel</x-button>
                <x-spacer />
                <x-button variant="danger" form="delete_project">Delete Project</x-button>
            </div>

        </x-form>

        <x-form id="delete_project" method="delete" action="{{ route('admin.projects.destroy', $project) }}"
            onsubmit="return confirm('Remove this project from the website?')" />
    </div>
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
