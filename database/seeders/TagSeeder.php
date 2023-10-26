<?php

namespace Database\Seeders;


use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::create(['name' => 'Design']);
        Tag::create(['name' => 'Development']);
        Tag::create(['name' => 'Marketing']);
        Tag::create(['name' => 'SEO']);
        Tag::create(['name' => 'Writing']);
        Tag::create(['name' => 'Consulting']);
    }
}
