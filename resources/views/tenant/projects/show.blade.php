@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">{{ $project->name }}</h4>

                        <form method="POST" action="{{ route('projects.files.store', $project) }}"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                                <label for="file" class="control-label">Upload a file</label>

                                <input id="file" type="file"
                                       class="form-control{{ $errors->has('file') ? ' is-invalid' : '' }}"
                                       name="file"
                                       value="{{ old('file') }}" required autofocus>

                                @if ($errors->has('file'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Upload
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="list-group list-group-flush">
                        @forelse($project->files as $file)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="{{ route('projects.files.show', [$project, $file]) }}">
                                    {{ $file->name }}
                                </a>

                                <aside>
                                    <a href="{{ route('projects.files.destroy', [$project, $file]) }}"
                                       class="btn btn-outline-danger" role="button"
                                       onclick="event.preventDefault(); document.getElementById('delete-file-{{ $file->id }}').submit()">
                                        Delete
                                    </a>

                                    {{-- Delete Form --}}
                                    <form action="{{ route('projects.files.destroy', [$project, $file]) }}" method="POST"
                                          id="delete-file-{{ $file->id }}" style="display: none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </aside>
                            </div>
                        @empty
                            <div class="list-group-item">No files found.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
