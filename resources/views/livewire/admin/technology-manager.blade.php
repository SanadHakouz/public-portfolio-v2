<div>
    <div class="p-6 bg-white border rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Manage Technologies</h2>

            @if(!$showForm)
                <button wire:click="create" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                    Add New Technology
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
                <h3 class="text-xl font-medium mb-4">{{ $editingTechnologyId ? 'Edit' : 'Create' }} Technology</h3>

                <form wire:submit.prevent="save" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                            <input wire:model="category" id="category" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md" placeholder="Category name">
                            @error('category') <span class="text-red-500 text-xs">{{ $errors->first('category') }}</span> @enderror
                        </div>

                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                            <input wire:model="title" id="title" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md" placeholder="Display title">
                            @error('title') <span class="text-red-500 text-xs">{{ $errors->first('title') }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="icon" class="block text-sm font-medium text-gray-700 mb-1">Icon (FontAwesome name)</label>
                            <input wire:model="icon" id="icon" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md" placeholder="Icon name (e.g. 'code')">
                            @error('icon') <span class="text-red-500 text-xs">{{ $errors->first('icon') }}</span> @enderror
                        </div>

                        <div>
                            <label for="order" class="block text-sm font-medium text-gray-700 mb-1">Display Order</label>
                            <input wire:model="order" id="order" type="number" class="w-full px-3 py-2 border border-gray-300 rounded-md" min="0">
                            @error('order') <span class="text-red-500 text-xs">{{ $errors->first('order') }}</span> @enderror
                        </div>

                        <div class="flex items-center pt-8">
                            <input wire:model="is_active" id="is_active" type="checkbox" class="h-4 w-4 text-blue-600 rounded border-gray-300">
                            <label for="is_active" class="ml-2 block text-sm text-gray-700">Active</label>
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Technology Items</label>

                        <div class="space-y-2 mb-4">
                            @foreach($items as $index => $item)
                                <div class="flex items-center">
                                    <input type="checkbox" class="h-4 w-4 text-blue-600 rounded border-gray-300"
                                        wire:model="items.{{ $index }}.is_checked">
                                    <span class="ml-2 flex-grow text-gray-700">{{ $item['name'] }}</span>
                                    <button type="button" wire:click="removeItem({{ $index }})" class="text-red-500 hover:text-red-700">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        <div class="flex">
                            <input wire:model="newItemName" type="text" class="flex-grow px-3 py-2 border border-gray-300 rounded-l-md" placeholder="New item name">
                            <div class="px-3 py-2 bg-gray-100 border-t border-r border-b border-gray-300 flex items-center">
                                <input wire:model="newItemChecked" id="newItemChecked" type="checkbox" class="h-4 w-4 text-blue-600 rounded border-gray-300">
                                <label for="newItemChecked" class="ml-2 text-sm text-gray-700">Checked</label>
                            </div>
                            <button type="button" wire:click="addItem" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-r-md hover:bg-gray-300 transition-colors">
                                Add
                            </button>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" wire:click="cancel" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition-colors">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                            {{ $editingTechnologyId ? 'Update' : 'Create' }}
                        </button>
                    </div>
                </form>
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                        <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                        <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Items</th>
                        <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($technologies as $tech)
                        <tr>
                            <td class="py-4 px-4 text-sm text-gray-500">
                                <div class="flex items-center space-x-1">
                                    <button wire:click="moveUp({{ $tech['id'] }})" class="text-gray-400 hover:text-gray-600">
                                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <span>{{ $tech['order'] }}</span>
                                    <button wire:click="moveDown({{ $tech['id'] }})" class="text-gray-400 hover:text-gray-600">
                                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-sm text-gray-500">{{ $tech['category'] }}</td>
                            <td class="py-4 px-4 text-sm text-gray-900">
                                <div class="flex items-center">
                                    @if($tech['icon'])
                                        <i class="fas fa-{{ $tech['icon'] }} text-blue-500 mr-2"></i>
                                    @endif
                                    {{ $tech['title'] }}
                                </div>
                            </td>
                            <td class="py-4 px-4 text-sm text-gray-500">
                                {{ count($tech['items']) }} items
                            </td>
                            <td class="py-4 px-4 text-sm">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $tech['is_active'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $tech['is_active'] ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="py-4 px-4 text-sm font-medium">
                                <div class="flex space-x-2">
                                    <button wire:click="edit({{ $tech['id'] }})" class="text-blue-500 hover:text-blue-700">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                    </button>
                                    <button wire:click="toggleActiveStatus({{ $tech['id'] }})" class="{{ $tech['is_active'] ? 'text-yellow-500 hover:text-yellow-700' : 'text-green-500 hover:text-green-700' }}">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zm-1 9a1 1 0 01-1-1v-4a1 1 0 112 0v4a1 1 0 01-1 1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <button wire:click="delete({{ $tech['id'] }})"
                                            onclick="return confirm('Are you sure you want to delete this technology?')"
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
                                No technologies found. Add your first technology by clicking the "Add New Technology" button.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
