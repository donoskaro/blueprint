<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Interfaces\ProjectEloquentInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response
    {
        $projects = $this->projects->paginate('name');

        return response()
            ->view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): Response
    {
        return response()->view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProjectRequest $request
     * @return RedirectResponse
     */
    public function store(ProjectRequest $request): RedirectResponse
    {
        $this->projects->store($request->all());

        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id): Response
    {
        $project = $this->projects->find($id, ['files']);

        return response()
            ->view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id): Response
    {
        $project = $this->projects->find($id);

        return response()
            ->view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProjectRequest $request
     * @param string $id
     * @return RedirectResponse
     */
    public function update(ProjectRequest $request, string $id): RedirectResponse
    {
        $this->projects->update($id, $request->all());

        return redirect()->route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id): Response
    {
        app()->abort(404, 'Not implemented');
    }
}
