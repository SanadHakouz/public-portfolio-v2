<div>
    <div class="p-6 bg-white border rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Manage Projects</h2>

            @if(!$showForm)
                <button wire:click="create" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                    Add New Project
                </button>
            @endif
        </div>

        @if(session()->has('message'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md">
                {{ session('message') }}
            </div>
        @endif

        @if($showForm)
            <div class="mb-8 p-6 bg-gray-50 rounded-lg border">
                <h3 class="text-xl font-medium mb-4">{{ $editingProjectId ? 'Edit' : 'Create' }} Project</h3>

                <form wire:submit.prevent="save" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                            <input wire:model="title" id="title" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md" placeholder="Project title">
                            @error('title') <span class="text-red-500 text-xs">{{ $errors->first('title') }}</span> @enderror
                        </div>

                        <div>
                            <label for="github_link" class="block text-sm font-medium text-gray-700 mb-1">GitHub Link</label>
                            <input wire:model="github_link" id="github_link" type="url" class="w-full px-3 py-2 border border-gray-300 rounded-md" placeholder="https://github.com/yourusername/project">
                            @error('github_link') <span class="text-red-500 text-xs">{{ $errors->first('github_link') }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea wire:model="description" id="description" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md" placeholder="Project description"></textarea>
                        @error('description') <span class="text-red-500 text-xs">{{ $errors->first('description') }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="new_image" class="block text-sm font-medium text-gray-700 mb-1">Project Image</label>
                            <input wire:model="new_image" id="new_image" type="file" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                            @error('new_image') <span class="text-red-500 text-xs">{{ $errors->first('new_image') }}</span> @enderror

                            @if($new_image)
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Preview:</p>
                                    <img src="{{ $new_image->temporaryUrl() }}" class="mt-1 h-24 w-auto object-cover rounded-md">
                                </div>
                            @endif
                        </div>

                        <div>
                            <label for="documentation_url" class="block text-sm font-medium text-gray-700 mb-1">Documentation URL (Google Drive)</label>
                            <input wire:model="documentation_url" id="documentation_url" type="url" class="w-full px-3 py-2 border border-gray-300 rounded-md" placeholder="https://drive.google.com/file/d/...">
                            @error('documentation_url') <span class="text-red-500 text-xs">{{ $errors->first('documentation_url') }}</span> @enderror

                            <div class="mt-2">
                                <p class="text-xs text-gray-500">Enter a Google Drive link to your project documentation</p>
                                @if($documentation_url)
                                    <div class="mt-1">
                                        <a href="{{ $documentation_url }}" target="_blank" rel="noopener noreferrer" class="text-sm text-blue-600 hover:underline flex items-center">
                                            <svg class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
                                                <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
                                            </svg>
                                            Verify Link
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Technologies</label>

                        <div class="space-y-2 mb-4">
                            @foreach($technologies as $index => $tech)
                                <div class="flex items-center bg-blue-50 px-3 py-2 rounded-md">
                                    <span class="flex-grow text-blue-700">{{ $tech }}</span>
                                    <button type="button" wire:click="removeTechnology({{ $index }})" class="text-red-500 hover:text-red-700">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        <div class="flex items-center">
                            <input wire:model="new_technology" wire:keydown.enter.prevent="addTechnology" type="text" class="flex-grow px-3 py-2 border border-gray-300 rounded-l-md" placeholder="Add technology (e.g., Laravel, React)">
                            <button type="button" wire:click="addTechnology" class="px-4 py-2 bg-blue-600 text-white rounded-r-md hover:bg-blue-700">
                                Add
                            </button>
                        </div>
                    </div>

                    <div class="flex space-x-4">
                        <label class="flex items-center">
                            <input wire:model="is_completed" type="checkbox" class="h-4 w-4 text-blue-600 rounded border-gray-300">
                            <span class="ml-2 text-sm text-gray-700">Completed Project</span>
                        </label>

                        <label class="flex items-center">
                            <input wire:model="is_active" type="checkbox" class="h-4 w-4 text-blue-600 rounded border-gray-300">
                            <span class="ml-2 text-sm text-gray-700">Active (visible on site)</span>
                        </label>
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" wire:click="cancel" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition-colors">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                            {{ $editingProjectId ? 'Update' : 'Create' }}
                        </button>
                    </div>
                </form>
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                        <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($projects as $project)
                        <tr>
                            <td class="py-4 px-4 text-sm">
                                @if(isset($project['image_path']))
                                    <img src="{{ Storage::url($project['image_path']) }}" alt="{{ $project['title'] }}" class="w-16 h-12 object-cover rounded">
                                @else
                                    <div class="w-16 h-12 bg-gray-200 flex items-center justify-center rounded">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </td>
                            <td class="py-4 px-4 text-sm font-medium text-gray-900">{{ $project['title'] }}</td>
                            <td class="py-4 px-4 text-sm text-gray-500">
                                {{ Str::limit($project['description'], 100) }}
                            </td>
                            <td class="py-4 px-4 text-sm">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $project['is_active'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $project['is_active'] ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="py-4 px-4 text-sm">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $project['is_completed'] ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $project['is_completed'] ? 'Completed' : 'Upcoming' }}
                                </span>
                            </td>
                            <td class="py-4 px-4 text-sm font-medium">
                                <div class="flex space-x-2">
                                    <button wire:click="edit({{ $project['id'] }})" class="text-blue-500 hover:text-blue-700">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                    </button>

                                    <button wire:click="toggleStatus({{ $project['id'] }})" class="{{ $project['is_active'] ? 'text-yellow-500 hover:text-yellow-700' : 'text-green-500 hover:text-green-700' }}">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zm-1 9a1 1 0 01-1-1v-4a1 1 0 112 0v4a1 1 0 01-1 1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <button wire:click="toggleCompleted({{ $project['id'] }})" class="{{ $project['is_completed'] ? 'text-purple-500 hover:text-purple-700' : 'text-blue-500 hover:text-blue-700' }}">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <button wire:click="delete({{ $project['id'] }})"
                                            onclick="return confirm('Are you sure you want to delete this project?')"
                                            class="text-red-500 hover:text-red-700">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-4 px-4 text-sm text-gray-500 text-center">
                                No projects found. Add your first project by clicking the "Add New Project" button.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
