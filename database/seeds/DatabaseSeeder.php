<?php

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
        app('db')->table('tools')->truncate();
        factory(Tool::class)->times(5)->create();
    }
}
