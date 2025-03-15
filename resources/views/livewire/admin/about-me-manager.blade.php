<div class="p-6 bg-white border border-gray-200 rounded-lg">
    <h2 class="text-xl font-medium text-gray-800 mb-6">Manage About Me</h2>

    @if(session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- Basic Information -->
<form wire:submit.prevent="saveBasicInfo" enctype="multipart/form-data" class="mb-8">
    <h3 class="text-lg font-medium mb-4">Basic Information</h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" id="name" wire:model="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
            <input type="text" id="location" wire:model="location" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('location') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="mb-4">
        <label for="job_title" class="block text-sm font-medium text-gray-700">Job Title</label>
        <input type="text" id="job_title" wire:model="job_title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        @error('job_title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
        <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
        <textarea id="bio" wire:model="bio" rows="6" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
        @error('bio') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
        <label for="resume_file" class="block text-sm font-medium text-gray-700">Resume (PDF)</label>
        <div class="mt-1 flex items-center">
            @if($aboutMe->resume_file)
                <div class="flex items-center mr-4">
                    <svg class="w-8 h-8 text-red-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                        <path d="M181.9 256.1c-5-16-4.9-46.9-2-46.9 8.4 0 7.6 36.9 2 46.9zm-1.7 47.2c-7.7 20.2-17.3 43.3-28.4 62.7 18.3-7 39-17.2 62.9-21.9-12.7-9.6-24.9-23.4-34.5-40.8zM86.1 428.1c0 .8 13.2-5.4 34.9-40.2-6.7 6.3-29.1 24.5-34.9 40.2zM248 160h136v328c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V24C0 10.7 10.7 0 24 0h200v136c0 13.2 10.8 24 24 24zm-8 171.8c-20-12.2-33.3-29-42.7-53.8 4.5-18.5 11.6-46.6 6.2-64.2-4.7-29.4-42.4-26.5-47.8-6.8-5 18.3-.4 44.1 8.1 77-11.6 27.6-28.7 64.6-40.8 85.8-.1 0-.1.1-.2.1-27.1 13.9-73.6 44.5-54.5 68 5.6 6.9 16 10 21.5 10 17.9 0 35.7-18 61.1-61.8 25.8-8.5 54.1-19.1 79-23.2 21.7 11.8 47.1 19.5 64 19.5 29.2 0 31.2-32 19.7-43.4-13.9-13.6-54.3-9.7-73.6-7.2zM377 105L279 7c-4.5-4.5-10.6-7-17-7h-6v128h128v-6.1c0-6.3-2.5-12.4-7-16.9z"/>
                    </svg>
                    <a href="{{ Storage::url($aboutMe->resume_file) }}" target="_blank" class="ml-2 text-blue-600 hover:underline">Current Resume</a>
                </div>

                <!-- In your form, add this field -->
                <div class="mb-4">
    <label for="last_updated_at" class="block text-sm font-medium text-gray-700">CV Last Updated</label>
    <input type="date" id="last_updated_at" wire:model="last_updated_at" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
    @error('last_updated_at') <span class="text-red-500 text-xs">{{ $errors->first('last_updated_at') }}</span> @enderror
                </div>
            @endif
            <input type="file" id="resume_file" wire:model="new_resume_file" class="mt-1" accept="application/pdf">
        </div>
        @error('new_resume_file') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
        <label for="profile_image" class="block text-sm font-medium text-gray-700">Profile Image</label>
        <div class="mt-1 flex items-center">
            @if($aboutMe->profile_image)
                <img src="{{ asset(Storage::url($aboutMe->profile_image)) }}" alt="Profile" class="w-20 h-20 object-cover rounded-full mr-4">
            @endif
            <input type="file" id="profile_image" wire:model="new_profile_image" class="mt-1" accept="image/*">
        </div>
        @error('new_profile_image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
        Save Basic Information
    </button>
</form>

    <!-- Certificates -->
    <div class="mb-8">
        <h3 class="text-lg font-medium mb-4">Certificates</h3>

        <div class="space-y-2 mb-4">
            @foreach($certificates as $index => $certificate)
                <div class="flex items-center">
                    <span class="mr-2">{{ $certificate['name'] }}</span>
                    <a href="{{ $certificate['link'] }}" target="_blank" class="text-blue-600 hover:underline mr-2">Link</a>
                    <button wire:click="removeCertificate({{ $index }})" class="text-red-600 hover:text-red-800">Remove</button>
                </div>
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-2">
            <div>
                <label for="new_certificate_name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="new_certificate_name" wire:model="new_certificate_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('new_certificate_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="new_certificate_link" class="block text-sm font-medium text-gray-700">Link</label>
                <input type="text" id="new_certificate_link" wire:model="new_certificate_link" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('new_certificate_link') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <button wire:click="addCertificate" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
            Add Certificate
        </button>
    </div>

    <!-- Ongoing Courses -->
    <div class="mb-8">
        <h3 class="text-lg font-medium mb-4">Ongoing Courses</h3>

        <div class="space-y-2 mb-4">
            @foreach($ongoing_courses as $index => $course)
                <div class="flex items-center">
                    <span class="mr-2">{{ $course['name'] }}</span>
                    <a href="{{ $course['link'] }}" target="_blank" class="text-blue-600 hover:underline mr-2">Link</a>
                    <button wire:click="removeOngoingCourse({{ $index }})" class="text-red-600 hover:text-red-800">Remove</button>
                </div>
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-2">
            <div>
                <label for="new_ongoing_course_name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="new_ongoing_course_name" wire:model="new_ongoing_course_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('new_ongoing_course_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="new_ongoing_course_link" class="block text-sm font-medium text-gray-700">Link</label>
                <input type="text" id="new_ongoing_course_link" wire:model="new_ongoing_course_link" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('new_ongoing_course_link') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <button wire:click="addOngoingCourse" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
            Add Ongoing Course
        </button>
    </div>

    <!-- Completed Courses -->
    <div class="mb-8">
        <h3 class="text-lg font-medium mb-4">Completed Courses</h3>

        <div class="space-y-2 mb-4">
            @foreach($completed_courses as $index => $course)
                <div class="flex items-center">
                    <span class="mr-2">{{ $course['name'] }}</span>
                    <a href="{{ $course['link'] }}" target="_blank" class="text-blue-600 hover:underline mr-2">Link</a>
                    <button wire:click="removeCompletedCourse({{ $index }})" class="text-red-600 hover:text-red-800">Remove</button>
                </div>
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-2">
            <div>
                <label for="new_completed_course_name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="new_completed_course_name" wire:model="new_completed_course_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('new_completed_course_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="new_completed_course_link" class="block text-sm font-medium text-gray-700">Link</label>
                <input type="text" id="new_completed_course_link" wire:model="new_completed_course_link" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('new_completed_course_link') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <button wire:click="addCompletedCourse" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
            Add Completed Course
        </button>
    </div>

    <!-- Languages -->
    <div class="mb-8">
        <h3 class="text-lg font-medium mb-4">Languages</h3>

        <div class="space-y-2 mb-4">
            @foreach($languages as $index => $lang)
                <div class="flex items-center">
                    <span class="mr-2">{{ $lang['language'] }}</span>
                    <span class="text-gray-600 mr-2">- {{ $lang['proficiency'] }}</span>
                    <button wire:click="removeLanguage({{ $index }})" class="text-red-600 hover:text-red-800">Remove</button>
                </div>
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-2">
            <div>
                <label for="new_language_name" class="block text-sm font-medium text-gray-700">Language</label>
                <input type="text" id="new_language_name" wire:model="new_language_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('new_language_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="new_language_proficiency" class="block text-sm font-medium text-gray-700">Proficiency</label>
                <input type="text" id="new_language_proficiency" wire:model="new_language_proficiency" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('new_language_proficiency') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mt-4">
            <button
                wire:click="addLanguage"
                type="button"
                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
            >
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Add Language
            </button>
        </div>
    </div>
</div>




