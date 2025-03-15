<div class="p-6 bg-white border border-gray-200 rounded-lg">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-medium text-gray-800">Manage Services</h2>
        <button
            wire:click="createNewService"
            class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition"
        >
            Add New Service
        </button>
    </div>
    <!-- Add new service-->
    @if($editingServiceId)
        <div class="mb-6 p-4 border border-gray-200 rounded-lg bg-gray-50">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium">{{ $editingServiceId === 'new' ? 'Create New' : 'Edit' }} Service</h3>
                <button wire:click="cancelEdit" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            <livewire:admin.service-form :serviceId="$editingServiceId" :key="$editingServiceId" />
        </div>
    @endif

      <!-- Delete Confirmation Modal -->
@if($confirmingDelete)
<div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Confirm Deletion</h3>
        <p class="text-gray-600 mb-6">Are you sure you want to delete this service? This action cannot be undone.</p>
        <div class="flex justify-end">
            <button
                wire:click="cancelDelete"
                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md mr-2 hover:bg-gray-300"
            >
                Cancel
            </button>
            <button
                wire:click="deleteService"
                style="background-color: #dc2626; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem;"
                class="inline-block"
            >
                Delete
            </button>
        </div>
    </div>
</div>
@endif

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($services as $service)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $service->order }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <img src="{{ $service->imageUrl }}" alt="{{ $service->title }}" class="h-10 w-10 object-cover rounded">                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $service->title }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">
                            {{ $service->description }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $service->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $service->active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button wire:click="editService({{ $service->id }})" class="text-blue-600 hover:text-blue-900 mr-3">
                                Edit
                            </button>
                            <button wire:click="toggleActive({{ $service->id }})" class="text-{{ $service->active ? 'red' : 'green' }}-600 hover:text-{{ $service->active ? 'red' : 'green' }}-900 mr-3">
                                {{ $service->active ? 'Deactivate' : 'Activate' }}
                            </button>
                            <button wire:click="confirmDelete({{ $service->id }})" class="text-red-600 hover:text-red-800 font-medium underline">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
