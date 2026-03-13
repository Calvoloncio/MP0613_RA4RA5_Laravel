@extends('layouts.webmaster')

@section('title', 'Contador de Actores')

@section('content')

<div class="container text-center mt-5">
    <h1 class="mb-4">{{ $title }}</h1>
    
    <div class="card mx-auto" style="max-width: 400px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
        <div class="card-body">
            <h2 class="display-3 font-weight-bold text-primary">{{ $count }}</h2>
            <p class="text-muted">Actores registrados en el sistema</p>
            <hr>
            <a href="{{ route('listActors') }}" class="btn btn-primary btn-block">Ver Lista de Actores</a>
            <a href="/" class="btn btn-outline-secondary btn-block mt-2">Volver al Inicio</a>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .card {
        background-color: white;
    }
    .display-3 {
        color: #2980b9;
    }
    .btn-primary {
        background-color: #2980b9;
        border: none;
        transition: background-color 0.3s;
    }
    .btn-primary:hover {
        background-color: #1abc9c;
    }
</style>

@endsection
