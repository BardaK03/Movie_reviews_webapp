<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('movies')->insert([
            [
                'name' => 'Inception',
                'production' => 'Warner Bros.',
                'genre' => 'Science Fiction',
                'description' => 'A mind-bending thriller that dives into the dream world.',
                'poster_url' => 'https://example.com/inception.jpg',
                'duration' => 148,
            ],
            [
                'name' => 'The Godfather',
                'production' => 'Paramount Pictures',
                'genre' => 'Crime',
                'description' => 'The aging patriarch of an organized crime dynasty transfers control of his empire to his reluctant son.',
                'poster_url' => 'https://example.com/godfather.jpg',
                'duration' => 175,
            ],
            [
                'name' => 'The Dark Knight',
                'production' => 'Warner Bros.',
                'genre' => 'Action',
                'description' => 'Batman faces the Joker in a battle for Gotham City.',
                'poster_url' => 'https://example.com/dark_knight.jpg',
                'duration' => 152,
            ],
            [
                'name' => 'Forrest Gump',
                'production' => 'Paramount Pictures',
                'genre' => 'Drama',
                'description' => 'The presidencies of Kennedy and Johnson, the Vietnam War, and more are seen through the eyes of a man with an IQ of 75.',
                'poster_url' => 'https://example.com/forrest_gump.jpg',
                'duration' => 142,
            ],
            [
                'name' => 'Avengers: Endgame',
                'production' => 'Marvel Studios',
                'genre' => 'Action/Adventure',
                'description' => 'The Avengers assemble one final time to undo the havoc caused by Thanos.',
                'poster_url' => 'https://example.com/avengers_endgame.jpg',
                'duration' => 181,
            ],
        ]);
    }
}
