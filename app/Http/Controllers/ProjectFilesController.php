<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use App\Http\Requests\ProjectFileRequest;
use App\Interfaces\ProjectEloquentInterface;
use App\Interfaces\ProjectFileEloquentInterface;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response
    {
        $files = $this->files->paginate('name');

        return response()
            ->view('project-files.index', compact('files'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProjectFileRequest $request
     * @return RedirectResponse
     */
    public function store(ProjectFileRequest $request): RedirectResponse
    {
        $file = $request->file('file');

        do {
            $location = Str::random(32);
        } while (Storage::exists("project-uploads/$location"));

        $file->move(storage_path('app/project-uploads'), $location);

        $project = $this->projects->find($request->get('project_id'));

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
     * @return BinaryFileResponse
     */
    public function show(string $id): BinaryFileResponse
    {
        $file = $this->files->find($id);

        return response()->download(storage_path("app/project-uploads/{$file->location}"), $file->name);
    }
}
