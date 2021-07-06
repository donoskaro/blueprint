<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ProjectFileRequest;
use App\Interfaces\ProjectEloquentInterface;
use App\Interfaces\ProjectFileEloquentInterface;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectFilesController extends Controller
{
    /**
     * @var ProjectEloquentInterface
     */
    protected $projects;

    /**
     * @var ProjectFileEloquentInterface
     */
    protected $files;

    /**
     * ProjectFilesController constructor.
     *
     * @param ProjectEloquentInterface $projects
     * @param ProjectFileEloquentInterface $files
     */
    public function __construct(
        ProjectEloquentInterface $projects,
        ProjectFileEloquentInterface $files
    ) {
        $this->projects = $projects;
        $this->files    = $files;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProjectFileRequest $request
     * @return RedirectResponse
     */
    public function store(ProjectFileRequest $request, string $projectId): RedirectResponse
    {
        $file = $request->file('file');

        do {
            $location = Str::random(32);
        } while (Storage::exists("project-uploads/$location"));

        $file->move(storage_path('app/project-uploads'), $location);

        $project = $this->projects->find($projectId);

        $project->files()->create([
            'name'       => $file->getClientOriginalName(),
            'location'   => $location,
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $fileId)
    {
        $file = $this->files->find($fileId);

        return response()->download(storage_path("app/project-uploads/{$file->location}"), $file->name);
    }
}
