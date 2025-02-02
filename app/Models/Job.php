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
        'extra_info' => 'array', // This ensures 'extra_info' is automatically cast to an array
    ];

    public function getExtraInfoAttribute($value)
    {
        // Check if the value is an array with a single string
        $extraInfo = json_decode($value, true);
        if (is_array($extraInfo) && count($extraInfo) == 1) {
            // If it's a single string in the array, split by commas
            return explode(',', $extraInfo[0]);
        }
        return $extraInfo;
    }


    public function getSkills()
    {
        return Skill::whereIn('id', $this->skills)->get();
    }
   
}
