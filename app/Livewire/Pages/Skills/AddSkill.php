<?php

namespace App\Livewire\Pages\Skills;

use App\Models\Skill;
use Livewire\Component;
use Illuminate\Support\Str;

class AddSkill extends Component
{
    public $name, $skill_id;
    public $isEditing = false;
    protected $listeners = ['editSkill' => 'edit'];

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function save()
    {
        $this->validate();

        if ($this->isEditing) {
            $skill = Skill::findOrFail($this->skill_id);
            $skill->update([
                'name' => $this->name,
                'slug' => Str::slug($this->name),
            ]);
            session()->flash('message', 'Skill updated successfully!');
        } else {
            Skill::create([
                'name' => $this->name,
                'slug' => Str::slug($this->name),
            ]);
            session()->flash('message', 'Skill added successfully!');
        }

        $this->dispatch('skillUpdated'); // Notify Index component to refresh
        $this->resetInput();
    }

    public function edit($id)
    {
        $skill = Skill::findOrFail($id);
        $this->skill_id = $skill->id;
        $this->name = $skill->name;
        $this->isEditing = true;
    }

    public function cancelEdit()
    {
        $this->resetInput();
    }

    private function resetInput()
    {
        $this->reset(['name', 'skill_id', 'isEditing']);
    }

    public function render()
    {
        return view('livewire.pages.skills.add-skill');
    }
}
