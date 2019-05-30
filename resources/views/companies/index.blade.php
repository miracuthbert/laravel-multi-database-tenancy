@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Companies</h4>

                        <div class="card-subtitle">A list of companies you own or are part of.</div>
                    </div>
                    <div class="list-group list-group-flush">
                        @forelse($companies as $company)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="{{ route('tenant.switch', $company) }}">
                                    {{ $company->name }}
                                </a>

                                <aside>
                                    <a href="{{ route('companies.destroy', $company) }}"
                                       class="btn btn-outline-danger" role="button"
                                       onclick="event.preventDefault(); document.getElementById('delete-company-{{ $company->id }}').submit()">
                                        Delete
                                    </a>

                                    {{-- Delete Form --}}
                                    <form action="{{ route('companies.destroy', $company) }}" method="POST"
                                          id="delete-company-{{ $company->id }}" style="display: none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </aside>
                            </div>
                        @empty
                            <div class="list-group-item">No companies found.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
