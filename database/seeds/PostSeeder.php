<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Post;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            $new_post = new Post();

            $new_post->title = $faker->sentence(rand(2,6));
            $new_post->content = $faker->text(rand(100,200));
            
            // Generare uno slug
            $slug = Str::slug($new_post->title, '-');
            $slug_base = $slug;
            // Verifico che lo slug non esista nel db
            $post_presente = Post::where('slug', $slug)->first(); //Select * from posts where slug = $slug
            $contatore = 1;

            while($post_presente) {
                $slug = $slug_base . '-' . $contatore;
                $contatore++;
                $post_presente = Post::where('slug', $slug)->first();
            }

            $new_post->slug = $slug;

            $new_post->user_id = 1;

            $new_post->save();
        }
    }
}
