<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use App\Models\Film;
use App\Models\Actor;

echo "Checking tables...\n";
if (Schema::hasTable('actors_films')) {
    echo "SUCCESS: Table 'actors_films' exists.\n";
} else {
    echo "ERROR: Table 'actors_films' does NOT exist.\n";
}

if (Schema::hasTable('film_actor')) {
    echo "ERROR: Table 'film_actor' still exists.\n";
} else {
    echo "SUCCESS: Table 'film_actor' no longer exists.\n";
}

echo "\nChecking Film relationships...\n";
$film = Film::first();
if ($film) {
    echo "Film: " . $film->name . "\n";
    $actors = $film->actors;
    echo "Actors count: " . $actors->count() . "\n";
    foreach ($actors as $actor) {
        echo "- " . $actor->name . " " . $actor->surname . "\n";
    }
} else {
    echo "No films found in database.\n";
}

echo "\nChecking Actor relationships...\n";
$actor = Actor::first();
if ($actor) {
    echo "Actor: " . $actor->name . " " . $actor->surname . "\n";
    $films = $actor->films;
    echo "Films count: " . $films->count() . "\n";
    foreach ($films as $f) {
        echo "- " . $f->name . "\n";
    }
} else {
    echo "No actors found in database.\n";
}
