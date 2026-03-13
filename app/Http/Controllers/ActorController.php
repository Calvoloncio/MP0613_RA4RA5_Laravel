<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    /**
     * Display a listing of the actors.
     */
    public function listActors()
    {
        $title = "Listado de todos los Actores";
        $actors = Actor::all();

        return view('actors.list', compact('actors', 'title'));
    }

    /**
     * Display a listing of actors born in a specific decade.
     */
    public function listActorsByDecade(Request $request)
    {
        $decade = $request->input('decade');
        $endDecade = $decade + 9;

        $title = "Listado de Actores nacidos entre $decade y $endDecade";
        
        $actors = Actor::whereBetween('birthdate', ["$decade-01-01", "$endDecade-12-31"])->get();

        return view('actors.list', compact('actors', 'title'));
    }
}
