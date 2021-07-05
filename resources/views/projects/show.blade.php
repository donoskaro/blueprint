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
        </tbody>
    </table>

@stop
