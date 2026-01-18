<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
class FilmController extends Controller
{

    /**
     * Read films from storage
     */
    public static function readFilms(): array {
        $films = Storage::json('/public/films.json');
        return $films;
    }
    /**
     * List films older than input year 
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listOldFilms($year = null)
    {        
        $old_films = [];
        if (is_null($year))
        $year = 2000;
    
        $title = "Listado de Pelis Antiguas (Antes de $year)";    
        $films = FilmController::readFilms();

        foreach ($films as $film) {
        //foreach ($this->datasource as $film) {
            if ($film['year'] < $year)
                $old_films[] = $film;
        }
        return view('films.list', ["films" => $old_films, "title" => $title]);
    }
    /**
     * List films younger than input year
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listNewFilms($year = null)
    {
        $new_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Nuevas (Después de $year)";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if ($film['year'] >= $year)
                $new_films[] = $film;
        }
        return view('films.list', ["films" => $new_films, "title" => $title]);
    }



    public function listFilmsByGenre($genre = null)
    {
        $filtered_films = [];

        $films = FilmController::readFilms();

        if (is_null($genre)) {
            return view('films.list', [
                "films" => $films,
                "title" => "Listado de Películas por género: (Ninguno informado)"
            ]);
        }

        $title = "Listado de Películas del género: " . ucfirst($genre);    
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if (isset($film['genre']) && strtolower($film['genre']) === strtolower($genre)) {
                $filtered_films[] = $film;
            }
        }

        return view('films.list', [
            "films" => $filtered_films,
            "title" => $title
        ]);
    }


    public function listFilmsByYear($year = null)
    {
        $filtered_films = [];
        $films = FilmController::readFilms();

        if (is_null($year)) {
                return view('films.list', [
                "films" => $films,
                "title" => "Listado de Películas por género: (Ninguno informado)"
            ]);
        }

        $title = "Listado de Películas del año: " . $year;
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if (isset($film['year']) && intval($film['year']) === intval($year)) {
                $filtered_films[] = $film;
            }
        }

        return view('films.list', [
            "films" => $filtered_films,
            "title" => $title
        ]);
    }


    // create a new route 'sortFilms' to list all films sorted by year descending, from newest to oldest.
    public function sortFilms()
    {
        $title = "Listado de Películas ordenadas por año (de más nuevas a más antiguas)";
        $films = FilmController::readFilms();

        usort($films, function ($a, $b) {
            return $b['year'] <=> $a['year'];
        });

        return view('films.list', [
            "films" => $films,
            "title" => $title
        ]);
    }


    public static function isFilm($film)
    {
        // comprueba si el nombre de la peli ya existe
        $films = FilmController::readFilms();
        for ($i = 0; $i < count($films); $i++) {
            if ($films[$i]['name'] == $film['name']) {
                return true;
            }
        }
        return false;
    }












    /**
     * Lista TODAS las películas o filtra x año o categoría.
     */
    // public function listFilms($year = null, $genre = null)
    // {
    //     $films_filtered = [];

    //     $title = "Listado de todas las pelis";
    //     $films = FilmController::readFilms();

    //     //if year and genre are null
    //     if (is_null($year) && is_null($genre))
    //         return view('films.list', ["films" => $films, "title" => $title]);

    //     //list based on year or genre informed
    //     foreach ($films as $film) {
    //         if ((!is_null($year) && is_null($genre)) && $film['year'] == $year){
    //             $title = "Listado de todas las pelis filtrado x año";
    //             $films_filtered[] = $film;
    //         }else if((is_null($year) && !is_null($genre)) && strtolower($film['genre']) == strtolower($genre)){
    //             $title = "Listado de todas las pelis filtrado x categoria";
    //             $films_filtered[] = $film;
    //         }else if(!is_null($year) && !is_null($genre) && strtolower($film['genre']) == strtolower($genre) && $film['year'] == $year){
    //             $title = "Listado de todas las pelis filtrado x categoria y año";
    //             $films_filtered[] = $film;
    //         }
    //     }
    //     return view("films.list", ["films" => $films_filtered, "title" => $title]);
    // }

    /**
     * Store a new film in storage
     */
    public function store()
    {
        $films = FilmController::readFilms();
        
        $newFilm = [
            'name' => request('name'),
            'year' => request('year'),
            'genre' => request('genre'),
            'country' => request('country'),
            'duration' => request('duration'),
            'image' => request('image')
        ];
        
        $films[] = $newFilm;
        
        Storage::put('/public/films.json', json_encode($films, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        
        return redirect('/')->with('success', 'Película añadida exitosamente');
    }

    public function listFilms()
    {
        $title = "Listado de todas las pelis";
        $films = FilmController::readFilms();
        return view("films.list", ["films" => $films, "title" => $title]);
    }
 
    public function createFilm(Request $request)
    {
        $film = $request->only(['name', 'year', 'genre', 'duration', 'country', 'img_url']);
 
        if (FilmController::isFilm($film)) {
            return view('welcome', ['error' => 'This film already exists']);
        }
 
        $films = FilmController::readFilms();
        $films[] = $film;
 
        $saved = Storage::put('public/films.json', json_encode($films, JSON_PRETTY_PRINT));
 
        if (!$saved) {
            return view('welcome', ['error' => 'Error saving the film list']);
        }
 
        return $this->listFilms();
    }
}