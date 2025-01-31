<?php

namespace App\Livewire\Pages\Jobs;

use App\Models\Job;
use Livewire\Component;

class Index extends Component
{
    public array $jobs = [];

    public function mount()
    {
       
        // Fetch jobs from the database
        $this->jobs = Job::with('skills','extra')->get()->toArray(); // Convert Collection to Array

    }

    public function deleteJob($jobId)
    {
       // Find the job by its ID and delete it
        $job = Job::findOrFail($jobId);
        $job->delete();

        // Use array_filter to remove the deleted job from the array
        $this->jobs = array_filter($this->jobs, function ($job) use ($jobId) {
            return $job['id'] !== $jobId;
        });

        // Optionally, reindex the array after filtering
        $this->jobs = array_values($this->jobs);

        // Provide feedback
        session()->flash('message', 'Job deleted successfully.');
    }

    public function render()
    {
        return view('livewire.pages.jobs.index');
    }
}
