<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Post;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for($i = 0; $i < 10; $i++){
            $post = new Post();

            $post->title = $faker->sentence(3);
            $post->content = $faker->text(500);
            $post->slug = Str::slug($post->title, '-');

            $post->save();
        }
    }
}
