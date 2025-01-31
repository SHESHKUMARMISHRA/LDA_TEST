<?php

namespace App\Livewire\Pages\Skills;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Skill;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    protected $listeners = ['skillUpdated' => '$refresh']; // Listen for updates from AddSkill

    public function delete($id)
    {
        Skill::findOrFail($id)->delete();
        session()->flash('message', 'Skill deleted successfully!');
    }

    public function render()
    {
        $skills = Skill::paginate(10);
        return view('livewire.pages.skills.index', compact('skills'));
    }
}
