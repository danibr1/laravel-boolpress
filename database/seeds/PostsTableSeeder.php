<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 5; $i++) {
            $new_post = new Post();

            $new_post->title = 'Post title' . ($i+1);
            $new_post->slug = Str::slug($new_post->title,'-');
            $new_post->content ='Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore veniam nobis magnam dicta minima fugit animi autem aliquid ab debitis doloremque quaerat non sit a sint beatae porro, rerum ipsa!';

            $new_post->save();
        }
    }
}
