<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ActorFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('actors')->insert([
                'name' => $faker->name(),
                'surname' => $faker->word(),
                'birthdate' => $faker->date(),
                'country' => substr($faker->country(), 0, 3), // Limitar a 3 caracteres
                'img_url' => $faker->imageUrl(640, 480, 'actors', true),
            ]);
        }
    }
}
