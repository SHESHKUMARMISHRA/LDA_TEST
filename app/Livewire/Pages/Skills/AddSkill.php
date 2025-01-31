<?php

namespace App\Livewire\Pages\Skills;

use App\Models\Skill;
use Livewire\Component;

class AddSkill extends Component
{
    public $name;

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function save()
    {
        $this->validate();
    
        Skill::create([
            'name' => $this->name,
        ]);
    
        session()->flash('message', 'Skill added successfully!');
        $this->reset('name');
    }
    

    public function render()
    {
        return view('livewire.pages.skills.add-skill');
    }
}
