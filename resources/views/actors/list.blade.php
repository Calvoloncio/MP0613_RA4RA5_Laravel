@extends('layouts.webmaster')

@section('title', 'Listado de Actores')

@section('content')

<h1>{{$title}}</h1>

<div align="center" style="margin-bottom: 20px;">
    <form action="{{ route('listActorsByDecade') }}" method="GET" style="display: inline-block; background: #fff; padding: 15px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
        <label for="decade" style="font-weight: 600;">Filtrar por Década:</label>
        <select name="decade" id="decade" style="padding: 5px; border-radius: 5px; border: 1px solid #ccc;">
            <option value="1980">1980 - 1989</option>
            <option value="1990">1990 - 1999</option>
            <option value="2000">2000 - 2009</option>
            <option value="2010">2010 - 2019</option>
            <option value="2020">2020 - 2029</option>
        </select>
        <button type="submit" class="btn btn-primary" style="margin-left: 10px;">Filtrar</button>
        <a href="{{ route('listActors') }}" class="btn btn-secondary" style="margin-left: 10px; background-color: #6c757d; color: white; padding: 6px 12px; border-radius: 5px; text-decoration: none; font-size: 14px;">Ver Todos</a>
        <a href="/" class="btn btn-dark" style="margin-left: 10px; background-color: #343a40; color: white; padding: 6px 12px; border-radius: 5px; text-decoration: none; font-size: 14px;">Volver al Inicio</a>
    </form>
</div>

@if($actors->isEmpty())
    <div class="alert alert-warning text-center" role="alert">
        No se ha encontrado ningún actor
    </div>
@else
    <div class="actor-grid">
        @foreach($actors as $actor)
            <div class="actor-card" id="actor-{{$actor->id}}">
                <div class="actor-image-container">
                    @if($actor->img_url)
                        <img src="{{$actor->img_url}}" alt="{{$actor->name}}" class="actor-img" />
                    @else
                        <div class="no-image">No imagen</div>
                    @endif
                    
                    <button class="btn-delete floating-delete" onclick="deleteActor({{$actor->id}})" title="Eliminar Actor">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                    </button>
                </div>
                <div class="actor-details">
                    <h3>{{$actor->name}} {{$actor->surname}}</h3>
                    <div class="actor-meta">
                        <p><strong>Nacimiento:</strong> {{$actor->birthdate}}</p>
                        <p class="country-tag"><strong>País:</strong> {{$actor->country}}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

<style>
/* ====== Estilos Generales ====== */
body {
    font-family: 'Inter', 'Segoe UI', sans-serif;
    background-color: #f0f2f5;
    color: #1c1e21;
    margin: 0;
    padding: 20px;
}

h1 {
    color: #1a202c;
    text-align: center;
    margin-bottom: 40px;
    font-weight: 700;
    font-size: 2.5rem;
}

/* ====== Grid de Actores ====== */
.actor-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 30px;
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

/* ====== Tarjeta de Actor ====== */
.actor-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.3);
    position: relative;
    display: flex;
    flex-direction: column;
}

.actor-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
}

.actor-image-container {
    position: relative;
    width: 100%;
    aspect-ratio: 2/3;
    overflow: hidden;
}

.actor-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.actor-card:hover .actor-img {
    transform: scale(1.05);
}

.no-image {
    width: 100%;
    height: 100%;
    background: #e4e6eb;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #65676b;
    font-style: italic;
}

/* ====== Detalles del Actor ====== */
.actor-details {
    padding: 20px;
    text-align: center;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.actor-details h3 {
    margin: 0 0 10px 0;
    font-size: 1.25rem;
    color: #2d3436;
    font-weight: 600;
}

.actor-meta p {
    margin: 5px 0;
}

.country-tag {
    display: inline-block;
    background: #e9ecef;
    padding: 2px 10px;
    border-radius: 20px;
    font-size: 0.85rem;
    color: #495057;
    margin-top: 8px !important;
}

/* ====== Botón de Eliminar ====== */
.floating-delete {
    position: absolute;
    top: 15px;
    right: 15px;
    background-color: rgba(231, 76, 60, 0.9);
    color: white;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.2s, opacity 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    opacity: 0; /* Hidden by default, shown on hover */
}

.actor-card:hover .floating-delete {
    opacity: 1;
}

.floating-delete:hover {
    background-color: #c0392b;
    transform: scale(1.1);
}

/* ====== Responsive ====== */
@media (max-width: 600px) {
    .actor-grid {
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
    }
}
</style>

<script>
async function deleteActor(id) {
    if (!confirm('¿Estás seguro de que deseas eliminar este actor?')) {
        return;
    }

    try {
        const response = await fetch(`/api/actors/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        });

        const data = await response.json();

        if (data.status) {
            const card = document.getElementById(`actor-${id}`);
            card.style.transform = 'scale(0.8)';
            card.style.opacity = '0';
            card.style.transition = 'all 0.5s ease';
            setTimeout(() => {
                card.remove();
            }, 500);
        } else {
            alert('Error al eliminar el actor');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Ocurrió un error inesperado');
    }
}
</script>

@endsection
