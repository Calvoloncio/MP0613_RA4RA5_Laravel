@extends('layouts.webmaster')

@section('title', 'Listado de Actores')

@section('content')

<h1>{{$title}}</h1>

@if($actors->isEmpty())
    <FONT COLOR="red">No se ha encontrado ningún actor</FONT>
@else
    <div align="center">
    <table border="1">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Fecha de Nacimiento</th>
                <th>País</th>
                <th>Imagen</th>
            </tr>
        </thead>
        <tbody>
            @foreach($actors as $actor)
                <tr>
                    <td>{{$actor->name}}</td>
                    <td>{{$actor->surname}}</td>
                    <td>{{$actor->birthdate}}</td>
                    <td>{{$actor->country}}</td>
                    <td>
                        @if($actor->img_url)
                            <img src="{{$actor->img_url}}" alt="{{$actor->name}}" style="width: 100px; height: 120px;" />
                        @else
                            No imagen
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

<style>
/* ====== Estilos Generales ====== */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f9f9f9;
    color: #333;
    margin: 0;
    padding: 20px;
}

h1 {
    color: #2c3e50;
    text-align: center;
    margin-bottom: 30px;
    font-size: 2em;
}

/* ====== Mensaje de error ====== */
font[color="red"] {
    font-weight: bold;
    font-size: 1.2em;
    display: block;
    text-align: center;
    margin-bottom: 20px;
}

/* ====== Tabla de Actores ====== */
div[align="center"] {
    overflow-x: auto;
}

table {
    width: 100%;
    max-width: 900px;
    margin: 0 auto 30px auto;
    border-collapse: collapse;
    background-color: #fff;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    border-radius: 8px;
    overflow: hidden;
}

th, td {
    padding: 12px 15px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #2c3e50; /* Slightly different color for variety, or keep #2980b9 for consistency */
    color: #fff;
    font-weight: 600;
    text-transform: uppercase;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #d1ecf1;
    transition: background-color 0.3s;
}

/* ====== Imágenes de Actores ====== */
td img {
    width: 100px;
    height: 120px;
    object-fit: cover;
    border-radius: 5px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
}

/* ====== Responsive ====== */
@media (max-width: 700px) {
    th, td {
        padding: 8px 10px;
    }

    td img {
        width: 70px;
        height: 90px;
    }

    h1 {
        font-size: 1.5em;
    }
}
</style>
@endsection
