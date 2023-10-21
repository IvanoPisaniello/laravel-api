@extends('layouts.app')

@section('content')
    <div class="container edit-page">
        <h1 class="fw-bold py-3 text-uppercase text-white">Inserisci i nuovi dati del tuo progetto</h1>

        <form action="{{ route('admin.projects.update', $project->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf()

            @method('put')

            <div class="mb-3">
                <label class="form-labal">Titolo</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                    value="{{ old('title', $project->title) }}">
                @error('title')
                    <div class="alert text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-labal">Descrizione</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description', $project->description) }}</textarea>
                @error('description')
                    <div class="alert text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-labal">Carica Immagine</label>
                <input type="file" class="form-control @error('thumb') is-invalid @enderror" name="image" accept="image/*">
                @error('image')
                    <div class="alert text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-labal">Linguaggi usati</label>
                <input type="text" class="form-control @error('languages_used') is-invalid @enderror" name="languages_used"
    value="{{ old('languages_used', is_array($project->languages_used) ? implode(', ', $project->languages_used) : $project->languages_used) }}">

                @error('languages_used')
                    <div class="alert text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-labal">Link GitHub del progetto</label>
                <input type="text" class="form-control @error('price') is-invalid @enderror" name="github_url"
                    value="{{ old('github_url', $project->github_url) }}">
                @error('github_url')
                    <div class="alert text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Tipologia progetto</label>
                <select class="form-select" name="type">
                    @foreach ( $types as $type )
                    <option value="{{ $type->id }}">{{$type->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-check form-switch">
                @foreach ($technologies as $technology)
                <div class="form-check-inline">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheck{{$technology->id}}" name="technologies[]" value="{{$technology->id}}" {{ $project->technologies?->contains($technology) ? 'checked' : '' }}>
                    <label class="form-check-label me-5" for="flexSwitchCheck{{$technology->id}}">{{$technology->name}}</label>
                </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary">Salva</button>
        </form>
    </div>
@endsection