<?php

use Illuminate\Database\Seeder;
use App\Topic;
use App\Comment;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Topic::class, 50)
        ->create()
        ->each(function ($topic) {
            $comments = factory(App\Comment::class, 2)->make();
            $topic->comments()->saveMany($comments);
        });
    }
}
