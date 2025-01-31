<?php

namespace App\Livewire\Pages\Skills;

use Livewire\Component;
use App\Models\Skill;

class Index extends Component
{
    public function render()
    {
         
        $skills = Skill::paginate(10);
       
        return view('livewire.pages.skills.index', compact('skills'));
        
    }
}
