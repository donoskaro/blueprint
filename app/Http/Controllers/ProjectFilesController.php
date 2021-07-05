<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ProjectFileRequest;
use App\Interfaces\ProjectFileEloquentInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectFilesController extends Controller
{
    /**
     * @var ProjectFileEloquentInterface
     */
    protected $projectFiles;

    /**
     * ProjectFilesController constructor.
     *
     * @param ProjectFileEloquentInterface $projectFiles
     */
    public function __construct(ProjectFileEloquentInterface $projectFiles)
    {
        $this->projectFiles = $projectFiles;
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

        $this->projectFiles->store([
            'project_id' => $projectId,
            'name'       => $file->getClientOriginalName(),
            'location'   => $location,
        ]);

        return redirect()->back();
    }
}
