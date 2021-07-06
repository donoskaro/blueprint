<?php

namespace App\Models;

class Project extends BaseModel
{
    protected $fillable = [
        'name',
        'description',
        'email',
    ];

    public function files()
    {
        return $this->hasMany(ProjectFile::class);
    }
}
