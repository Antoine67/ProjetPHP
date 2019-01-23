<?php

use Illuminate\Database\Seeder;
use App\Categorie;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = array("Vêtement", "Matériel informatique", "Accessoire", "Autre");

        
        foreach ($categories as $cat) {
            Categorie::create([
                'Nom' => $cat,
            ]);
        }
    }
}
