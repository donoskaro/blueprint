<?php

namespace App\Models;

class ProjectFile extends BaseModel
{
    /**
     * Disable the updated at timestamp as files are immutable.
     */
    const UPDATED_AT = null;

    protected $fillable = [
        'project_id',
        'name',
        'location',
    ];
}
