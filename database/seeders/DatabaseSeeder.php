<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Category::factory(10)->create()->each(function($category) {
            Post::factory(rand(1,4))->create([
                'category_id' => $category->id
            ])->each(function($post) {
                Comment::factory(rand(1,4))->create([
                    'post_id' => $post->id
                ]);
            });
        });

    }
}
