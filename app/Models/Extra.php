<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
    public function jobs()
    {
        return $this->belongsToMany(Job::class); // Many-to-many relationship
    }
}
