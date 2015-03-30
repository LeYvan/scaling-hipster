<?php
require_once('utils.php');

class RessourceUrgenceSeeder extends FfSeeder {

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Eloquent::unguard();

    $nbRessources = 15;

    $this->chargerRessources();

    DB::table('ressources')->delete();
    $this->log('Table ressources dropée!');
    $this->benchReset(false);

    $ressources = array();

    for ($i = 1; $i < $nbRessources; $i++)
    {
      $nom = "Expert en " . generateRandomString(7) . ".";
      $email = "expert@categorie.com";
      $telephone = "1-800-888-8888";
      $url = "http://www.expert.com/desastre/";
      $categorie_id = $this->rndCategorie()->id;
      $description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus rhoncus ligula nisl, quis hendrerit justo sodales vitae.';

      $ressources[] = Ressource::create(array('nom'=>$nom,
                                              'email'=>$email,
                                              'telephone'=>$telephone,
                                              'url'=>$url,
                                              'description' => $description,
                                              'categorie_id' => $categorie_id
                                              ));
    }

    $this->log('Table ressources germée! (' . $i . ' insertions) en ',true);
  }

}
