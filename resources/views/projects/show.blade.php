@extends('common.template')

@section('heading')
    View Project : {{ $project->name }}
@stop

@section('content')

    <div class="text-right">
        <a href="{{ route('projects.edit', [$project->id]) }}">Edit</a>
    </div>

    <table class="table table-bordered table-responsive">
        <tbody>
            <tr>
                <th>Name</th>
                <td>{{ $project->name }}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{{ $project->description }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $project->email ?? '–' }}</td>
            </tr>
            <tr>
                <th>Created at</th>
                <td>{{ $project->created_at }}</td>
            </tr>
            <tr>
                <th>Updated at</th>
                <td>{{ $project->updated_at }}</td>
            </tr>
            <tr>
                <th>Files</th>
                <td>
                    <form method="POST" action="{{ route('project-files.store') }}" class="row" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <input type="hidden" name="project_id" value="{{ $project->id }}" />

                        <div class="col-sm-4">
                            <input type="file" name="file" class="form-control" />
                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-default">Upload</button>
                        </div>
                    </form>

                    <hr />

                    <ul>
                        @foreach ($project->files as $file)
                            <li>
                                <a href="{{ route('project-files.show', [$file->id]) }}" target="_blank">
                                    {{ $file->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </td>
            </tr>
        </tbody>
    </table>

@stop
