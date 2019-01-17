<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 50; $i++) {
            Article::create([
                'Nom' => 'Article n°' . $i,
                'Description' => $faker->paragraph,
                'Prix' => rand(5,60),
                'Stock' => rand(0,50),
                'Image' => $faker->sentence,
                'Vendu' => $faker->sentence,
                'VenduMois' => $faker->sentence,
                'ID_Paniers' => $faker->sentence,
            ]);
        }
    }
}