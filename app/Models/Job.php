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
        'title', 'description', 'experience', 'salary', 'location', 'extra_info', 'company_name', 'company_logo'
    ];

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'job_skill'); // Specify the pivot table
    }
    

    public function extra()
    {
        return $this->hasMany(Extra::class);
    }
}
