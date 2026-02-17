<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilmActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run()
{
    $films = DB::table('films')->pluck('id');
    $actors = DB::table('actors')->pluck('id');

    foreach ($films as $film) {
        $numActors = rand(1,3);
        $selectedActors = $actors->random($numActors);

        foreach ($selectedActors as $actor) {
            DB::table('film_actor')->insert([
                'film_id' => $film,
                'actor_id' => $actor,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
}