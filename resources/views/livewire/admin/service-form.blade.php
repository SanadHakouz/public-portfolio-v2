<form wire:submit.prevent="save" class="space-y-4">
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
        <input type="text" id="title" wire:model="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
        @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
        <textarea id="description" wire:model="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
        @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="order" class="block text-sm font-medium text-gray-700">Display Order</label>
        <input type="number" id="order" wire:model="order" class="mt-1 block w-40 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
        @error('order') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Status</label>
        <div class="mt-2">
            <label class="inline-flex items-center">
                <input type="checkbox" wire:model="active" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                <span class="ml-2 text-sm text-gray-600">Active</span>
            </label>
        </div>
    </div>

    <div>
        <label for="image" class="block text-sm font-medium text-gray-700">
            Service Image
        </label>
        <div class="mt-2 flex items-center">
            <div class="flex-shrink-0" style="height: 120px; width: 120px;">
                @if ($image)
                    <img src="{{ $image->temporaryUrl() }}" alt="Preview"
                         style="max-height: 120px; max-width: 120px; object-fit: contain;"
                         class="border rounded shadow bg-gray-50">
                @elseif ($currentImage)
                    <img src="{{ asset(Storage::url($currentImage)) }}" alt="Current Image"
                         style="max-height: 120px; max-width: 120px; object-fit: contain;"
                         class="border rounded shadow bg-gray-50">
                @else
                    <div class="h-full w-full flex items-center justify-center bg-gray-100 border rounded text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                @endif
            </div>
            <input type="file" id="image" wire:model="image" class="ml-4">
        </div>
        @error('image') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
    </div>

    <div class="flex justify-end pt-4">
        <button type="button" wire:click="$dispatch('closeForm')" class="mr-3 px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Cancel
        </button>
        <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Save
        </button>
    </div>
</form>
