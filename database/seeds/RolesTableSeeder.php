<?php

use Illuminate\Database\Seeder;

use App\Role;


    //Header
    define('HEADER_CLASSIQUE', '0'); 
    define('HEADER_SALARIE', '1'); //Accès aux boutons : Notifier les membres du BDE, et dl toutes les photos postées

    //Boutique
    define('BOUTIQUE_CLASSIQUE', '0'); //Accès au panier
    define('BOUTIQUE_MODIF', '1'); //Peut ajouter/supprimer/modifier des articles

    //Activites
    define('ACTIVITES_CLASSIQUE', '0');//S'inscrire à des activités
    define('ACTIVITES_MODIF', '1');//Créer /modifer des activités

    //Idees
    define('IDEES_CLASSIQUE', '0');//Peut voir et poster des idées
    define('IDEES_MODIF', '1');// Peut modifer, valider, supprimer des idées

class RolesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Role::create([
            'ID' => 1,
            'Denomination' => 'Etudiant',
            'Perm_boutique' => BOUTIQUE_CLASSIQUE,
            'Perm_idees' => IDEES_CLASSIQUE,
            'Perm_activites' => ACTIVITES_CLASSIQUE,
            'Perm_header' => HEADER_CLASSIQUE,
        ]);

        Role::create([
            'ID' => 2,
            'Denomination' => 'Membre BDE',
            'Perm_boutique' => BOUTIQUE_MODIF,
            'Perm_idees' => IDEES_MODIF,
            'Perm_activites' => ACTIVITES_MODIF,
            'Perm_header' => HEADER_CLASSIQUE,
        ]);

        Role::create([
            'ID' => 3,
            'Denomination' => 'Salarié CESI',
            'Perm_boutique' => BOUTIQUE_CLASSIQUE,
            'Perm_idees' => IDEES_CLASSIQUE,
            'Perm_activites' => ACTIVITES_CLASSIQUE,
            'Perm_header' => HEADER_SALARIE,
        ]);
        

        
    }
}
