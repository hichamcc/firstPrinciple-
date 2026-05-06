<x-layouts.app :title="__('Add Team Member')">
    <x-headbar :title="__('Add Team Member')" />

    <div class="mt-6 max-w-2xl">
        <x-form method="post" action="{{ route('admin.team.store') }}" enctype="multipart/form-data" class="space-y-0">

            <div class="bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-2xl divide-y divide-gray-100 dark:divide-white/10 overflow-hidden">

                {{-- Photo --}}
                <div class="p-6" x-data="imageUpload()">
                    <x-label :value="__('Photo')" />
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5 mb-4">Upload a headshot or paste a photo URL. Shown on the Team section of the website.</p>

                    <div class="flex gap-1 bg-gray-100 dark:bg-white/10 rounded-xl p-1 mb-4 w-fit">
                        <button type="button" @click="tab = 'upload'"
                            :class="tab === 'upload' ? 'bg-white dark:bg-white/15 shadow-sm text-gray-900 dark:text-white' : 'text-gray-500 hover:text-gray-700 dark:hover:text-gray-300'"
                            class="px-4 py-1.5 text-sm font-medium rounded-lg transition-all">Upload File</button>
                        <button type="button" @click="tab = 'url'"
                            :class="tab === 'url' ? 'bg-white dark:bg-white/15 shadow-sm text-gray-900 dark:text-white' : 'text-gray-500 hover:text-gray-700 dark:hover:text-gray-300'"
                            class="px-4 py-1.5 text-sm font-medium rounded-lg transition-all">Photo URL</button>
                    </div>

                    <div x-show="tab === 'upload'" x-transition>
                        <label for="image_file"
                            class="relative flex items-center justify-center w-32 h-32 border-2 border-dashed border-gray-300 dark:border-white/20 rounded-full cursor-pointer hover:border-orange-400 hover:bg-orange-50/50 dark:hover:bg-orange-900/10 transition-all overflow-hidden mx-auto">
                            <template x-if="!preview">
                                <div class="flex flex-col items-center gap-1 text-gray-400">
                                    <x-phosphor-user-circle width="36" height="36" />
                                    <span class="text-xs font-medium">Upload</span>
                                </div>
                            </template>
                            <template x-if="preview">
                                <div class="w-full h-full">
                                    <img :src="preview" class="w-full h-full object-cover">
                                </div>
                            </template>
                            <input id="image_file" name="image_file" type="file" accept="image/*" class="sr-only"
                                @change="previewFile($event)">
                        </label>
                        <p class="text-xs text-gray-400 text-center mt-2">Click the circle to upload a headshot</p>
                        <x-error for="image_file" />
                    </div>

                    <div x-show="tab === 'url'" x-transition>
                        <x-input name="image_url" :value="old('image_url')" type="url"
                            placeholder="https://example.com/photo.jpg"
                            description="Paste a direct link to a headshot photo." />
                    </div>
                </div>

                {{-- Title & Years --}}
                <div class="p-6 grid sm:grid-cols-2 gap-5">
                    <x-input
                        label="Job Title"
                        description="Their role at the firm."
                        name="title"
                        :value="old('title')"
                        required
                        autofocus
                        placeholder="e.g. Senior Urban Planner"
                    />
                    <x-input
                        label="Years of Experience"
                        description="Shown below their title."
                        name="years"
                        :value="old('years')"
                        required
                        placeholder="e.g. 25+ years"
                    />
                </div>

                {{-- Skills --}}
                <div class="p-6" x-data="skillsEditor(@js(old('skills') ? array_map('trim', explode(',', old('skills'))) : []))">
                    <x-label :value="__('Skills & Specialties')" />
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5 mb-4">
                        Add the areas this person specialises in. These appear as tags on the website.
                    </p>

                    <div class="flex flex-wrap gap-2 mb-3" x-show="skills.length > 0">
                        <template x-for="(skill, index) in skills" :key="index">
                            <span class="inline-flex items-center gap-1.5 bg-orange-50 dark:bg-orange-900/20 border border-orange-200 dark:border-orange-800 text-orange-700 dark:text-orange-300 text-sm font-medium px-3 py-1 rounded-full">
                                <span x-text="skill"></span>
                                <button type="button" @click="remove(index)" class="hover:text-red-500 transition-colors ml-0.5">
                                    <x-phosphor-x width="12" height="12" />
                                </button>
                            </span>
                        </template>
                    </div>

                    <p class="text-sm text-gray-400 dark:text-gray-500 mb-3 italic" x-show="skills.length === 0">
                        No skills added yet — use the field below.
                    </p>

                    <div class="flex gap-2">
                        <input type="text" x-model="newSkill"
                            @keydown.enter.prevent="add()" @keydown.comma.prevent="add()"
                            placeholder="Type a skill and press Enter"
                            class="flex-1 text-sm px-3 py-2 h-10 rounded-lg border border-gray-200 dark:border-white/10 bg-white dark:bg-white/5 text-gray-700 dark:text-gray-300 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-400">
                        <button type="button" @click="add()"
                            class="px-3 h-10 bg-gray-100 dark:bg-white/10 hover:bg-orange-100 dark:hover:bg-orange-900/30 text-gray-600 dark:text-gray-300 rounded-lg text-sm font-medium transition-colors whitespace-nowrap">
                            + Add
                        </button>
                    </div>
                    <p class="text-xs text-gray-400 mt-2">Press <kbd class="px-1 py-0.5 bg-gray-100 dark:bg-white/10 rounded text-xs">Enter</kbd> or comma to add each skill.</p>

                    <input type="hidden" name="skills" :value="skills.join(', ')">
                    <x-error for="skills" />
                </div>

            </div>

            <div class="flex gap-3 pt-5">
                <x-button variant="primary">Save Team Member</x-button>
                <x-button type="button" onclick="history.back()">Cancel</x-button>
            </div>

        </x-form>
    </div>
</x-layouts.app>

<script>
function imageUpload(existing) {
    return { tab: 'upload', preview: existing || null, previewFile(e) { const f = e.target.files[0]; if (f) this.preview = URL.createObjectURL(f); } }
}
function skillsEditor(initial) {
    return { skills: initial || [], newSkill: '', add() { const v = this.newSkill.trim().replace(/,$/, ''); if (v && !this.skills.includes(v)) this.skills.push(v); this.newSkill = ''; }, remove(i) { this.skills.splice(i, 1); } }
}
</script>
