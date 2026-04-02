<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        Author::factory(5)
            ->create()
            ->each(function ($author) {
                Book::factory(3)->create([
                    'author_id' => $author->id,
                ]);
            });
    }
}