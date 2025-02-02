<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    
    // Specify the custom table name
    protected $table = 'jobs_';
    
    protected $fillable = [
        'title', 'description', 'experience', 'salary', 'location', 'extra_info', 'company_name', 'company_logo', 'skills'
    ];

    protected $casts = [
        'skills' => 'array', // Store skills as a JSON array
    ];

    public function getSkills()
    {
        return Skill::whereIn('id', $this->skills)->get();
    }
    
    public function extra()
    {
        return $this->hasMany(Extra::class);
    }
}
