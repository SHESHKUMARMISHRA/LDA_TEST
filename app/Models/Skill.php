<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug']; // Add 'slug' to the fillable fields

    protected static function booted()
    {
        static::creating(function ($skill) {
            $skill->slug = Str::slug($skill->name); // Generate slug from name
        });
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_skill');
    }

    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'job_skill'); // Specify the pivot table
    }
}
