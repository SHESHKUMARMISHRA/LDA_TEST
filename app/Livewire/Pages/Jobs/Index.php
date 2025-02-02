<?php

namespace App\Livewire\Pages\Jobs;

use App\Models\Job;
use App\Models\Skill;
use Livewire\Component;

class Index extends Component
{
    public array $jobs = [];

    public function mount()
    {
      // Fetch jobs from the database
        $this->jobs = Job::with('extra') // Load related 'extra' with the job
        ->get()
        ->map(function ($job) {
            // Decode the skills string into an array of IDs (if it's stored as a JSON string)
            $skillIds = json_decode($job->skills, true);

            // If valid skill IDs exist, fetch the skill names
            if (is_array($skillIds)) {
                // Fetch skills by their IDs
                $skills = Skill::whereIn('id', $skillIds)->pluck('name')->toArray();
                $job->skills = $skills;
            } else {
                // If no skills are found, set as an empty array
                $job->skills = [];
            }

            return $job;
        })
        ->toArray();
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
