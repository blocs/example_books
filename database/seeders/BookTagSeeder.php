<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Book;
use App\Models\BookTag;
use Illuminate\Database\Seeder;

class BookTagSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 全件削除.
        BookTag::truncate();

        for ($bookId = 1; $bookId <= 4; $bookId++) {
            for ($i = 0; $i < 3; $i++) {
                BookTag::factory()->create([ 'book_id' => $bookId ]);
            }
        }

    }
}
