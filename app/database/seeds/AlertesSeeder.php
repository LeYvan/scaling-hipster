<?php
require_once('utils.php');

class AlertesSeeder extends FfSeeder {
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

    DB::table('alertes')->delete();
    $this->log('Table alertes dropée! Insertion...');
    $this->benchReset(false);

    $alertes = array();

    for ($i = 1; $i < $nbAlertes; $i++)
    {
      $user_id = $this->rndUtilisateur()->id;
      $categorie_id = $this->rndCategorie()->id;

      $lat =  float_rand(46.752605,46.843091);
      $long = float_rand(-71.384887,-71.196231);
      $contenu = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus rhoncus ligula nisl, quis hendrerit justo sodales vitae. Nullam fermentum lobortis sapien vel convallis.';
      
      $alertes[] = Alerte::create(array('utilisateur_id'=>$user_id,
                                        'categorie_id'=>$categorie_id,
                                        'lat' => $lat,
                                        'long' => $long,
                                        'contenu'=>$contenu));
    }

    $this->log('Table alertes germée! (' . $i . ' insertions)',true);
  }

}
