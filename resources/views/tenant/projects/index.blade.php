@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-content-center">
                            <aside>
                                <h4 class="card-title">Projects</h4>
                                <div class="card-subtitle">A list of company projects.</div>
                            </aside>

                            <a href="{{ route('projects.create') }}" class="btn btn-link">Add new project</a>
                        </div>
                    </div>
                    <div class="list-group list-group-flush">
                        @forelse($projects as $project)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="{{ route('projects.show', $project) }}">
                                    {{ $project->name }}
                                </a>

                                <aside>
                                    <a href="{{ route('projects.destroy', $project) }}"
                                       class="btn btn-outline-danger" role="button"
                                       onclick="event.preventDefault(); document.getElementById('delete-project-{{ $project->id }}').submit()">
                                        Delete
                                    </a>

                                    {{-- Delete Form --}}
                                    <form action="{{ route('projects.destroy', $project) }}" method="POST"
                                          id="delete-project-{{ $project->id }}" style="display: none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </aside>
                            </div>
                        @empty
                            <div class="list-group-item">No projects found.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
