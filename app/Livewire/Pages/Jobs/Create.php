<?php

namespace App\Livewire\Pages\Jobs;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Job;

class Create extends Component
{
    use WithFileUploads;

    public $title, $description, $experience, $salary, $location, $extra_info, $company_name, $company_logo;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required',
        'experience' => 'required',
        'salary' => 'required',
        'location' => 'required',
        'company_name' => 'required',
        'company_logo' => 'nullable|image|max:2048',
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
            'extra_info' => $this->extra_info,
            'company_name' => $this->company_name,
            'company_logo' => $logoPath,
        ]);

        session()->flash('message', 'Job posted successfully!');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.pages.jobs.create');
    }
}
