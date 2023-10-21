@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-fluid transparent-card text-white text-center py-5">
    <div class="container">
        <h1 class="display-4">Ciao, sono Ivano Pisaniello</h1>
        <p class="lead">Benvenuto nel mio portfolio di progetti</p>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-light btn-lg">Esplora i Progetti</a>
    </div>
</div>


@endsection
