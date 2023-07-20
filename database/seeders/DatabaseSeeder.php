<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
         \App\Models\Location::factory(10)->create();
         \App\Models\Tag::factory(10)->create();
         \App\Models\User::factory(1)->create();

       
         \App\Models\Location::factory()->create([
            'name' => 'welcome',
            'slug' => 'welcome',
            'id' => 0,
        ]);
    }
}
