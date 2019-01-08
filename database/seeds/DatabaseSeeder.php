<?php

use App\Models\Tag;
use App\Models\Tool;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app('db')->table('tag_tool')->truncate();
        app('db')->table('tags')->truncate();
        app('db')->table('tools')->truncate();

        factory(Tag::class)->times(30)->create();
        factory(Tool::class)->times(5)->create()->each(function (Tool $tool) {
            $tool->tags()->attach(Tag::inRandomOrder()->take(8)->pluck('id'));
        });
    }
}
