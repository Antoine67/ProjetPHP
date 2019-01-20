<?php

use Illuminate\Database\Seeder;

use App\Activite;

class ActivitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('fr_FR');

        Activite::create([
            'Titre' => 'Football',
            'Prix' => 2,
            'Image' => 'image_site/activites/1/foot.png' ,
            'Description' => "Le football /futbol/ (dans la langue orale, par apocope, le foot), ou soccer /sɔkœʁ/ (en Amérique du Nord), est un sport collectif qui se joue principalement au pied avec un ballon sphérique. Il oppose deux équipes de onze joueurs dans un stade, que ce soit sur un terrain gazonné ou sur un plancher. L'objectif de chaque camp est de mettre le ballon dans le but adverse, sans utiliser les bras, et de le faire plus souvent que l'autre équipe.
                    Codifié par les écossais Britanniques2, à la fin du XIXe siècle, le football s'est doté en 1904 d'une fédération internationale, la FIFA. Pratiqué en 2006 par environ 264 millions de joueurs à travers le monde, le football possède le statut de sport numéro un dans la majorité des pays. Certains continents, comme l'Afrique, l'Amérique du Sud et l'Europe, sont même presque entièrement dominés par cette discipline. La simplicité du jeu et le peu de moyens nécessaires à sa pratique expliquent en partie ce succès.",
            'Date_realisation' => date("Y-m-d H:i:s"),
            'Date_creation' => date("Y-m-d H:i:s"),
            'ID_Utilisateurs' => 1,
        ]);

        Activite::create([
            'Titre' => 'Basketball',
            'Prix' => 0,
            'Image' => 'image_site/activites/2/basket.jpg' ,
            'Description' => "Le basket-ball ou basketball3, fréquemment désigné en français par son abréviation basket, est un sport collectif opposant deux équipes de cinq joueurs sur un terrain rectangulaire. L'objectif de chaque équipe est de faire passer un ballon au sein d'un arceau de 46 cm de diamètre, fixé à un panneau et placé à 3,05 m du sol : le panier. Chaque panier inscrit rapporte deux points à son équipe, à l'exception des tirs effectués au-delà de la ligne des trois points qui rapportent trois points et des lancers francs accordés à la suite d'une faute qui rapportent un point. L'équipe avec le nombre de points le plus important remporte la partie. ",
            'Date_realisation' => date("Y-m-d H:i:s"),
            'Date_creation' => date("Y-m-d H:i:s"),
            'ID_Utilisateurs' => 4,
        ]);

    }
}
