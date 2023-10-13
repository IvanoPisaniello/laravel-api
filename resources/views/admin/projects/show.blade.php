@extends('layouts.app')

@section('content')
    <div class="container show-page">
        <div class="card transparent-card">
            <img src="{{ asset('storage/' . $project->image) }}" class="card-img-top" alt="Image not found">
            <div class="card-body text-white">
                <h1 class="card-title fw-bold text-uppercase text-white">{{ $project->title }}</h1>
                <p class="card-text">{{ $project->description }}</p>
                <p class="badge mb-4 mt-3">Tipologia Progetto:
                    @if ($project->type)
                        {{ $project->type->name }} ({{ $project->type->description }})
                    @else
                        Il campo è null
                    @endif
                </p>
                {{-- <p class="card-text">Linguaggi utilizzati:
                    @if(is_array($project->languages_used))
                        {{ implode(', ', $project->languages_used) }}
                    @else
                        {{ $project->languages_used }}
                    @endif
                </p> --}}

                <div>
                    @foreach ($project->technologies as $technology)
                        <div class="badge" style="background-color: {{ $technology->color }}; border-radius: 10px; padding: 5px; margin-right: 5px;">
                            {{ $technology->name }}
                        </div>
                    @endforeach
                </div>
                <div class="mt-3">
                    <a href="{{ $project->github_url }}" class="btn btn-primary btn-rounded">
                        <i class="fa-brands fa-github"></i>
                    </a>

                    <a href="{{ route('admin.projects.edit', $project->slug) }}" class="btn btn-success btn-rounded">
                        <i class="fa fa-edit"></i>
                    </a>

                    <form action="{{ route('admin.projects.destroy', $project->slug) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-danger btn-rounded">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
