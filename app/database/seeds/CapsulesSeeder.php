<?php
require_once('utils.php');

class CapsulesSeeder extends FfSeeder {
  
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Eloquent::unguard();

    $nbAlertes = 50;
    $nbNouvelles = 50;
    $nbCapsules = 100;

    $this->chargerRessources();

    DB::table('capsules')->delete();
    $this->log('Table capsules dropée!');
    $this->benchReset(false);

    $capsules = array();

    for ($i = 1; $i < $nbCapsules; $i++)
    {
      $user_id = $this->rndUtilisateur()->id;
      $categorie_id = $this->rndCategorie()->id;
      $titre = 'Vivamus rhoncus ligula nisl';
      $contenu = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus rhoncus ligula nisl, quis hendrerit justo sodales vitae. Nullam fermentum lobortis sapien vel convallis.';
      
      $capsules[] = Capsule::create(array('utilisateur_id'=>$user_id,
                                          'categorie_id'=>$categorie_id,
                                          'titre' => $titre,
                                          'contenu'=>$contenu));
    }
    
    $this->log('Table capsules germée! (' . $i . ' insertions) en ',true);
  }

}
