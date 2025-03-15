<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\AboutMe;
use Illuminate\Support\Facades\Storage;

class AboutMeManager extends Component
{
    use WithFileUploads;

    public $aboutMe;
    public $name;
    public $location;
    public $job_title;
    public $bio;
    public $new_profile_image;
    public $new_resume_file; // New property for resume file upload
    public $last_updated_at;


    // For handling arrays
    public $certificates = [];
    public $ongoing_courses = [];
    public $completed_courses = [];
    public $languages = [];

    // For adding new items
    public $new_certificate_name;
    public $new_certificate_link;
    public $new_ongoing_course_name;
    public $new_ongoing_course_link;
    public $new_completed_course_name;
    public $new_completed_course_link;
    public $new_language_name;
    public $new_language_proficiency;

    public function mount()
    {
        $this->aboutMe = AboutMe::first();
        $this->name = $this->aboutMe->name;
        $this->location = $this->aboutMe->location;
        $this->job_title = $this->aboutMe->job_title;
        $this->bio = $this->aboutMe->bio;

        $this->last_updated_at = $this->aboutMe->last_updated_at;


        // Make sure to properly decode JSON if needed
        $this->certificates = $this->aboutMe->certificates ?: [];
        $this->ongoing_courses = $this->aboutMe->ongoing_courses ?: [];
        $this->completed_courses = $this->aboutMe->completed_courses ?: [];
        $this->languages = $this->aboutMe->languages ?: [];
    }

    public function saveBasicInfo()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'bio' => 'required|string',
            'new_profile_image' => 'nullable|image|max:1024',
            'new_resume_file' => 'nullable|file|mimes:pdf|max:5120', // Allow PDFs up to 5MB
        ]);

        if ($this->new_profile_image) {
            $imagePath = $this->new_profile_image->store('images', 'public');
            if ($this->aboutMe->profile_image && Storage::disk('public')->exists($this->aboutMe->profile_image)) {
                Storage::disk('public')->delete($this->aboutMe->profile_image);
            }
            $this->aboutMe->profile_image = $imagePath;
        }

        if ($this->new_resume_file) {
            $resumePath = $this->new_resume_file->store('resumes', 'public');
            if ($this->aboutMe->resume_file && Storage::disk('public')->exists($this->aboutMe->resume_file)) {
                Storage::disk('public')->delete($this->aboutMe->resume_file);
            }
            $this->aboutMe->resume_file = $resumePath;
        }

        // In your saveBasicInfo method
        if ($this->new_resume_file) {
            // Update the last_updated_at date when a new resume is uploaded
            $this->aboutMe->last_updated_at = now();
            $this->last_updated_at = now();
        }

        $this->aboutMe->name = $this->name;
        $this->aboutMe->location = $this->location;
        $this->aboutMe->job_title = $this->job_title;
        $this->aboutMe->bio = $this->bio;
        $this->aboutMe->last_updated_at = $this->last_updated_at;

        $this->aboutMe->save();

        session()->flash('message', 'Basic information updated successfully!');
    }

    // Certificate methods
    public function addCertificate()
    {
        $this->validate([
            'new_certificate_name' => 'required|string|max:255',
            'new_certificate_link' => 'required|url|max:255',
        ]);

        $this->certificates[] = [
            'name' => $this->new_certificate_name,
            'link' => $this->new_certificate_link,
        ];

        $this->aboutMe->certificates = $this->certificates;
        $this->aboutMe->save();

        $this->new_certificate_name = '';
        $this->new_certificate_link = '';

        session()->flash('message', 'Certificate added successfully!');
    }

    public function removeCertificate($index)
    {
        if (isset($this->certificates[$index])) {
            array_splice($this->certificates, $index, 1);
            $this->aboutMe->certificates = $this->certificates;
            $this->aboutMe->save();

            session()->flash('message', 'Certificate removed successfully!');
        }
    }

    // Ongoing Course methods
    public function addOngoingCourse()
    {
        $this->validate([
            'new_ongoing_course_name' => 'required|string|max:255',
            'new_ongoing_course_link' => 'required|url|max:255',
        ]);

        $this->ongoing_courses[] = [
            'name' => $this->new_ongoing_course_name,
            'link' => $this->new_ongoing_course_link,
        ];

        $this->aboutMe->ongoing_courses = $this->ongoing_courses;
        $this->aboutMe->save();

        $this->new_ongoing_course_name = '';
        $this->new_ongoing_course_link = '';

        session()->flash('message', 'Ongoing course added successfully!');
    }

    public function removeOngoingCourse($index)
    {
        if (isset($this->ongoing_courses[$index])) {
            array_splice($this->ongoing_courses, $index, 1);
            $this->aboutMe->ongoing_courses = $this->ongoing_courses;
            $this->aboutMe->save();

            session()->flash('message', 'Ongoing course removed successfully!');
        }
    }

    // Completed Course methods
    public function addCompletedCourse()
    {
        $this->validate([
            'new_completed_course_name' => 'required|string|max:255',
            'new_completed_course_link' => 'required|url|max:255',
        ]);

        $this->completed_courses[] = [
            'name' => $this->new_completed_course_name,
            'link' => $this->new_completed_course_link,
        ];

        $this->aboutMe->completed_courses = $this->completed_courses;
        $this->aboutMe->save();

        $this->new_completed_course_name = '';
        $this->new_completed_course_link = '';

        session()->flash('message', 'Completed course added successfully!');
    }

    public function removeCompletedCourse($index)
    {
        if (isset($this->completed_courses[$index])) {
            array_splice($this->completed_courses, $index, 1);
            $this->aboutMe->completed_courses = $this->completed_courses;
            $this->aboutMe->save();

            session()->flash('message', 'Completed course removed successfully!');
        }
    }

    // Language methods
    public function addLanguage()
    {
        $this->validate([
            'new_language_name' => 'required|string|max:255',
            'new_language_proficiency' => 'required|string|max:255',
        ]);

        $this->languages[] = [
            'language' => $this->new_language_name,
            'proficiency' => $this->new_language_proficiency,
        ];

        $this->aboutMe->languages = $this->languages;
        $this->aboutMe->save();

        $this->new_language_name = '';
        $this->new_language_proficiency = '';

        session()->flash('message', 'Language added successfully!');
    }

    public function removeLanguage($index)
    {
        if (isset($this->languages[$index])) {
            array_splice($this->languages, $index, 1);
            $this->aboutMe->languages = $this->languages;
            $this->aboutMe->save();

            session()->flash('message', 'Language removed successfully!');
        }
    }



    public function render()
    {
        return view('livewire.admin.about-me-manager');
    }
}
