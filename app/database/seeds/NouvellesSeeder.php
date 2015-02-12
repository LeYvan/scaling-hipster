<?php
require_once('utils.php');

class NouvellesSeeder extends FfSeeder {

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

    DB::table('nouvelles')->delete();
    $this->log('Table nouvelles dropée!');
    $this->benchReset(false);

    $nouvelles = array();

    for ($i = 1; $i < $nbNouvelles; $i++)
    {
      $user_id = $this->rndUtilisateur()->id;
      $titre = 'Vivamus rhoncus ligula nisl';
      $contenu = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus rhoncus ligula nisl, quis hendrerit justo sodales vitae. Nullam fermentum lobortis sapien vel convallis.';
      
      $nouvelles[] = Nouvelle::create(array('utilisateur_id'=>$user_id,
                                            'titre' => $titre,
                                            'contenu'=>$contenu));
    }
    
    $this->log('Table nouvelles germée! (' . $i . ' insertions) en ',true);
  }

}
