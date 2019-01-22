<?php

use Illuminate\Database\Seeder;
use App\Article;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = array("Vêtement", "Matériel informatique", "Accessoire", "Autre");

        $faker = \Faker\Factory::create('fr_FR');

        
        for ($i = 0; $i < 20; $i++) {
            Article::create([
                'Nom' => $faker->name,
                'Description' => $faker->paragraph,
                'Prix' => $faker->randomFloat(2, 1, 100) ,
                'Stock' => $faker->numberBetween(0, 150),
                'Image' => "image_site/boutique/image_1.gif",
                'Vendu' => $faker->numberBetween(0, 15),
                'Categorie' => $categories[$faker->numberBetween(0, sizeof($categories)-1)],
            ]);
        }
        

       
    }
}
