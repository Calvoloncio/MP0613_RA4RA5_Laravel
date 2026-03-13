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
}
