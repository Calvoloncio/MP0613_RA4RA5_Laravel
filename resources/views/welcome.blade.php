@extends('layouts.webmaster')

@section('title', 'Inicio')

@section('content')

<h1 class="mt-4">Lista de Peliculas</h1>

<ul>
    <li><a href="/filmout/oldFilms">Pelis antiguas</a></li>
    <li><a href="/filmout/newFilms">Pelis nuevas</a></li>
    <li><a href="/filmout/films">Pelis</a></li>
    <li><a href="/filmout/filmsGenre">Pelis por Genero</a></li>
    <li><a href="/filmout/filmsYear">Pelis por Año</a></li>
</ul>

<h1 class="mt-4">Lista de Actores</h1>
<ul>
    <li><a href="/actorout/actors">Actores</a></li>
</ul>

<h2 class="mt-4">Añadir Pelicula</h2>

 
@if(isset($error) || session('error'))
    <div class="alert alert-danger">
        {{ $error ?? session('error') }}
    </div>
@endif

 
<form action="{{ route('film') }}" method="POST">
    @csrf

    <label>Nombre</label><br>
    <input type="text" name="name"><br><br>

    <label>Año</label><br>
    <input type="number" name="year"><br><br>

    <label>Genero</label><br>
    <input type="text" name="genre"><br><br>

    <label>Duración</label><br>
    <input type="text" name="duration"><br><br>

    <label>País</label><br>
    <input type="text" name="country"><br><br>

    <label>Imagen URL</label><br>
    <input type="text" name="img_url"><br><br>

    <button type="submit" class="btn btn-primary">Enviar</button>
</form>

@endsection

<style>
    /* ====== Estilos Generales ====== */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f5f5f5;
    color: #333;
    margin: 0;
    padding: 20px;
}

h1, h2 {
    color: #2c3e50;
    margin-bottom: 15px;
}

h1 {
    font-size: 2em;
}

h2 {
    font-size: 1.5em;
}

/* ====== Lista de Películas ====== */
ul {
    list-style: none;
    padding: 0;
    margin-bottom: 30px;
}

ul li {
    margin: 10px 0;
}

ul li a {
    text-decoration: none;
    color: #2980b9;
    font-weight: 500;
    transition: color 0.3s;
}

ul li a:hover {
    color: #1abc9c;
}

/* ====== Formulario ====== */
form {
    background-color: #fff;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    max-width: 500px;
}

form label {
    font-weight: 600;
    display: block;
    margin-bottom: 5px;
}

form input {
    width: 100%;
    padding: 8px 12px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    transition: border 0.3s, box-shadow 0.3s;
}

form input:focus {
    border-color: #2980b9;
    box-shadow: 0 0 5px rgba(41, 128, 185, 0.3);
    outline: none;
}

button.btn-primary {
    background-color: #2980b9;
    color: #fff;
    padding: 10px 18px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: 600;
    transition: background-color 0.3s;
}

button.btn-primary:hover {
    background-color: #1abc9c;
}

/* ====== Alertas ====== */
.alert {
    padding: 15px 20px;
    border-radius: 5px;
    margin-bottom: 20px;
    font-weight: 500;
}

.alert-danger {
    background-color: #e74c3c;
    color: #fff;
}

/* ====== Espaciado y Responsive ====== */
.mt-4 {
    margin-top: 1.5rem !important;
}

@media (max-width: 600px) {
    form {
        padding: 20px;
    }

    h1 {
        font-size: 1.5em;
    }

    h2 {
        font-size: 1.2em;
    }
}

</style>