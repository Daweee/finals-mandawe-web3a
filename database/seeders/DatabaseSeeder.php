<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\ActorSeeder;
use Database\Seeders\MovieSeeder;
use Database\Seeders\GenresSeeder;
use Database\Seeders\RatingSeeder;
use Database\Seeders\DirectorSeeder;
use Database\Seeders\ReviewerSeeder;
use Database\Seeders\MovieCastSeeder;
use Database\Seeders\MovieGenresSeeder;
use Database\Seeders\MovieDirectionSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            MovieSeeder::class,
            MovieCastSeeder::class,
            MovieDirectionSeeder::class,
            MovieGenresSeeder::class,
            RatingSeeder::class,
            ActorSeeder::class,
            DirectorSeeder::class,
            GenresSeeder::class,
            ReviewerSeeder::class,
        ]);
    }
}
