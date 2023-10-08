@extends('layouts.app')

@section('content')
<div class="container pt-5">
    <h1 class="fw-bold text-center text-uppercase">I miei Progetti</h1>

    <a href="{{ route('admin.projects.create') }}" class="btn btn-warning my-3">Aggiungi progetto</a>

    <div class="row row-cols-1 row-cols-md-3">
        @foreach ($projects as $project)
        <div class="col mb-4">
            <div class="card h-100">
                <a href="{{ route('admin.projects.show', $project->slug) }}" class="text-decoration-none">
                    <img src="{{ asset($project->image) }}" class="card-img-top" alt="image not found">
                    <div class="card-body">
                        <h5 class="card-title">{{ $project->title }}</h5>
                        <p class="card-text">{{ $project->description }}</p>
                        <small class="card-text">Linguaggi utilizzati:
                            @if(is_array($project->languages_used))
                            {{ implode(', ', $project->languages_used) }}
                            @else
                            {{ $project->languages_used }}
                            @endif
                        </small>
                    </div>
                    <div class="card-footer">
                        <a href="{{ $project->github_url }}" class="btn btn-primary btn-sm rounded-pill" target="_blank">
                            <i class="fa-brands fa-github"></i> Vai su GitHub
                        </a>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
