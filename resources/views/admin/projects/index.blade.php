
<?php

use Illuminate\Support\Str;

?>

@extends('layouts.app')


@section('content')
<div class="container pt-5">
    <h1 class="fw-bold text-center text-uppercase text-white">I miei Progetti</h1>

    <a href="{{ route('admin.projects.create') }}" class="btn btn-light my-3">
        <i class="fas fa-plus"></i></a>
    

    <div class="row row-cols-1 row-cols-md-3">
        @foreach ($projects as $project)
        <div class="col mb-4">
            <div class="card index-card border-white bg-transparent text-white">
                <a href="{{ route('admin.projects.show', $project->slug) }}" class="text-decoration-none">
                    <img src="{{ asset('storage/' . $project->image) }}" class="card-img-top" alt="image not found">
                    <div class="card-body">
                        <h5 class="card-title text-white">{{ $project->title }}</h5>
                        <p class="card-text custom-text-color">{{ str::limit($project->description, $limit = 70, $end = '...') }}</p>
                        <p class="badge mb-4 mt-3"> Tipologia Progetto:
                            @if ($project->type)
                                {{ $project->type->name }} 
                            @else
                               <p>Il campo è null</p>
                            @endif
                        </p>
                     
                        <p class="card-text custom-text-color">Linguaggi utilizzati:
                            @if(is_array($project->languages_used))
                            {{ implode(', ', $project->languages_used) }}
                            @else
                            {{ $project->languages_used }}
                            @endif
                        </p>
                        <div>
                            @foreach ($project->technologies as $technology)
                                <div class="badge" style="background-color: rgb({{ $technology->color }})">{{ $technology->name }}</div>
                            @endforeach
                          </div>
                    </div>
                    <div class="card-footer bg-transparent">
                        <a href="{{ $project->github_url }}" class="btn btn-light btn-sm rounded-pill" target="_blank">
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

