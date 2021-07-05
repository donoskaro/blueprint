<?php namespace App\Repositories;

use App\Interfaces\ProjectFileEloquentInterface;
use App\Models\ProjectFile;

class ProjectFileEloquentRepository extends BaseEloquentRepository implements ProjectFileEloquentInterface
{
    protected $modelName = ProjectFile::class;
}
