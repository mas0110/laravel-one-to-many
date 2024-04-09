<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories  = [
            'Frontend',
            'Backend',
            'ui',
            'Fullstack',
            'Vue',
            'Laravel',
        ];

        foreach($categories as $element){
            $new_category = new Category();

            $new_category->name = $element;
            $new_category->slug = Str::slug
            ($new_category->name);


            $new_category->save();
        }
    }
}
