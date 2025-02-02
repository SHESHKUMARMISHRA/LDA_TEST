<?php

namespace App\Livewire\Pages\Jobs;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Job;
use App\Models\Skill;

class Create extends Component
{
    use WithFileUploads;

    public $title, $description, $experience, $salary, $location, $extra_info, $company_name, $company_logo,$skills;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required',
        'experience' => 'required',
        'salary' => 'required',
        'location' => 'required',
        'company_name' => 'required',
        'company_logo' => 'nullable|image|max:2048',
        'skills' => 'required|array',
    ];

    public function save()
    {
        $this->validate();

        $logoPath = $this->company_logo ? $this->company_logo->store('logos', 'public') : null;

        Job::create([
            'title' => $this->title,
            'description' => $this->description,
            'experience' => $this->experience,
            'salary' => $this->salary,
            'location' => $this->location,
            'extra_info' => [$this->extra_info], // Ensure it's a JSON array
            'company_name' => $this->company_name,
            'company_logo' => $logoPath,
            'skills' => json_encode($this->skills), // Store as JSON
        ]);

        session()->flash('message', 'Job posted successfully!');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.pages.jobs.create', [
            'allSkills' => Skill::all(), // Fetch skills for selection
        ]);
    }
}
