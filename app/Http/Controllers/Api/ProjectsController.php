<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use App\Http\Resources\Project;
use App\Http\Controllers\Controller;
use App\Interfaces\ProjectEloquentInterface;

class ProjectsController extends Controller
{
    /**
     * @var ProjectEloquentInterface
     */
    protected $projects;

    /**
     * ProjectsController constructor.
     *
     * @param ProjectEloquentInterface $projects
     */
    public function __construct(ProjectEloquentInterface $projects)
    {
        $this->projects = $projects;
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $project = $this->projects->find($id, ['files']);

        return response()->json(new Project($project));
    }
}
