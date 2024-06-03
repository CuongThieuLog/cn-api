<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('movie')->insert([
            [
                'name' => 'Inception',
                'national' => 'USA',
                'released_at' => '2010-07-16',
                'language_movie' => 'English',
                'duration' => 148,
                'limit_age' => 13,
                'brief_movie' => 'A thief who enters the subconscious of others to steal their secrets.',
                'trailer_movie' => 'https://www.youtube.com/watch?v=YoHD9XEInc0',
                'movie_type_id' => 4, // Khoa học viễn tưởng
                'movie_format_id' => 2, // 3D
                'ticket_price' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'The Dark Knight',
                'national' => 'USA',
                'released_at' => '2008-07-18',
                'language_movie' => 'English',
                'duration' => 152,
                'limit_age' => 13,
                'brief_movie' => 'Batman faces the Joker in a battle for Gotham City.',
                'trailer_movie' => 'https://www.youtube.com/watch?v=EXeTwQWrcwY',
                'movie_type_id' => 2, // Hành động
                'movie_format_id' => 1, // 2D
                'ticket_price' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Titanic',
                'national' => 'USA',
                'released_at' => '1997-12-19',
                'language_movie' => 'English',
                'duration' => 195,
                'limit_age' => 13,
                'brief_movie' => 'A romance set against the backdrop of the ill-fated maiden voyage of the R.M.S. Titanic.',
                'trailer_movie' => 'https://www.youtube.com/watch?v=2e-eXJ6HgkQ',
                'movie_type_id' => 3, // Ngôn tình, lãng mạn
                'movie_format_id' => 1, // 2D
                'ticket_price' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Avengers: Endgame',
                'national' => 'USA',
                'released_at' => '2019-04-26',
                'language_movie' => 'English',
                'duration' => 181,
                'limit_age' => 13,
                'brief_movie' => 'The Avengers take one final stand against Thanos.',
                'trailer_movie' => 'https://www.youtube.com/watch?v=TcMBFSGVi1c',
                'movie_type_id' => 2, // Hành động
                'movie_format_id' => 2, // 3D
                'ticket_price' => 18,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'The Matrix',
                'national' => 'USA',
                'released_at' => '1999-03-31',
                'language_movie' => 'English',
                'duration' => 136,
                'limit_age' => 13,
                'brief_movie' => 'A computer hacker learns about the true nature of reality and his role in the war against its controllers.',
                'trailer_movie' => 'https://www.youtube.com/watch?v=vKQi3bBA1y8',
                'movie_type_id' => 4, // Khoa học viễn tưởng
                'movie_format_id' => 1, // 2D
                'ticket_price' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'The Shawshank Redemption',
                'national' => 'USA',
                'released_at' => '1994-09-23',
                'language_movie' => 'English',
                'duration' => 142,
                'limit_age' => 16,
                'brief_movie' => 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.',
                'trailer_movie' => 'https://www.youtube.com/watch?v=6hB3S9bIaco',
                'movie_type_id' => 5, // Kinh dị
                'movie_format_id' => 1, // 2D
                'ticket_price' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Avatar',
                'national' => 'USA',
                'released_at' => '2009-12-18',
                'language_movie' => 'English',
                'duration' => 162,
                'limit_age' => 13,
                'brief_movie' => 'A paraplegic Marine dispatched to the moon Pandora on a unique mission becomes torn between following his orders and protecting the world he feels is his home.',
                'trailer_movie' => 'https://www.youtube.com/watch?v=5PSNL1qE6VY',
                'movie_type_id' => 4, // Khoa học viễn tưởng
                'movie_format_id' => 2, // 3D
                'ticket_price' => 14,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Interstellar',
                'national' => 'USA',
                'released_at' => '2014-11-07',
                'language_movie' => 'English',
                'duration' => 169,
                'limit_age' => 13,
                'brief_movie' => 'A team of explorers travel through a wormhole in space in an attempt to ensure humanity\'s survival.',
                'trailer_movie' => 'https://www.youtube.com/watch?v=zSWdZVtXT7E',
                'movie_type_id' => 4, // Khoa học viễn tưởng
                'movie_format_id' => 1, // 2D
                'ticket_price' => 16,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}