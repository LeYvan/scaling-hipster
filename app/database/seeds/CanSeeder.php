<?php
require_once('utils.php');

class AlertesSeeder extends Seeder {

  private function log($message)
  {
    $this->command->info($message);
  }

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

    $utilisateurs = Utilisateur::All();
    $utiCount = $utilisateurs->count() - 1;

    $conseillers = Utilisateur::where('niveau','>',1)->get();
    $conCount = $conseillers->count() - 1;

    $categories = CategorieSinistre::All();
    $catCount = $categories->count() - 1;

    $benchStart = microtime(true);

    /* 
    ============================================
    Table Alertes
    ============================================
    */
    DB::table('alertes')->delete();
    $this->log('Table alertes dropée!');

    $alertes = array();

    for ($i = 1; $i < $nbAlertes; $i++)
    {
      $user_id = $utilisateurs[mt_rand(1,$utiCount)]->id;
      $categorie_id = $categories[mt_rand(1,$catCount)]->id;
      $lat =  float_rand(46.752605,46.843091);
      $long = float_rand(-71.384887,-71.196231);
      $contenu = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus rhoncus ligula nisl, quis hendrerit justo sodales vitae. Nullam fermentum lobortis sapien vel convallis.';
      
      $alertes[] = Alerte::create(array('utilisateur_id'=>$user_id,
                                        'categorie_id'=>$categorie_id,
                                        'lat' => $lat,
                                        'long' => $long,
                                        'contenu'=>$contenu));
    }

    $this->log('Table alertes germée! (' . $i . ')');
    $benchTime = microtime(true) - $benchStart;
    $this->log('  Temps d\'exécution: ' . $benchTime . ' micro secondes');

    /* 
    ============================================
    Table Nouvelles
    ============================================
    */
    DB::table('nouvelles')->delete();
    $this->log('Table nouvelles dropée!');

    $nouvelles = array();

    for ($i = 1; $i < $nbNouvelles; $i++)
    {
      $user_id = $conseillers[mt_rand(1,$conCount)]->id;
      $titre = 'Vivamus rhoncus ligula nisl'.
      $contenu = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus rhoncus ligula nisl, quis hendrerit justo sodales vitae. Nullam fermentum lobortis sapien vel convallis.';
      
      $nouvelles[] = Nouvelle::create(array('utilisateur_id'=>$user_id,
                                            'titre' => $titre,
                                            'contenu'=>$contenu));
    }
    
    $this->log('Table nouvelles germée! (' . $i . ')');
    $benchTime = microtime(true) - $benchStart;
    $this->log('  Temps d\'exécution: ' . $benchTime . ' micro secondes');

    /* 
    ============================================
    Table Capsules
    ============================================
    */
    DB::table('capsules')->delete();
    $this->log('Table capsules dropée!');

    $capsules = array();

    for ($i = 1; $i < $nbCapsules; $i++)
    {
      $user_id = $conseillers[mt_rand(1,$conCount)]->id;
      $categorie_id = $categories[mt_rand(1,$catCount)]->id;
      $titre = 'Vivamus rhoncus ligula nisl'.
      $contenu = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus rhoncus ligula nisl, quis hendrerit justo sodales vitae. Nullam fermentum lobortis sapien vel convallis.';
      
      $capsules[] = Capsule::create(array('utilisateur_id'=>$user_id,
                                          'titre' => $titre,
                                          'contenu'=>$contenu));
    }
    
    $this->log('Table capsules germée! (' . $i . ')');
    $benchTime = microtime(true) - $benchStart;
    $this->log('  Temps d\'exécution: ' . $benchTime . ' micro secondes');
  }

}
