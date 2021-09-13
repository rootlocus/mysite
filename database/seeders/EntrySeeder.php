<?php

namespace Database\Seeders;

use App\Models\Journal\EntryCategory;
use Illuminate\Database\Seeder;

class EntrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EntryCategory::upsert([
            ['name' => 'Personal'],
            ['name' => 'Laravel'],
            ['name' => 'Games'],
            ['name' => 'Movies'],
            ['name' => 'Books'],
            ['name' => 'Anime'],
        ], ['name']);
    }
}
