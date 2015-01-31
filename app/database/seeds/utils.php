<?php
/**
 * Generate Float Random Number
 *
 * @param float $Min Minimal value
 * @param float $Max Maximal value
 * @param int $round The optional number of decimal digits to round to. default 0 means not round
 * @return float Random float value
 */
function float_rand($Min, $Max, $round=0){
    //validate input
    if ($Min>$Max) { $Min=$Max; $max=$Min; }
        else { $Min=$Min; $max=$Max; }
    $randomfloat = $Min + mt_rand() / mt_getrandmax() * ($max - $Min);
    if($round>0)
        $randomfloat = round($randomfloat,$round);
 
    return $randomfloat;
}

function generateRandomString($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

class FfSeeder extends Seeder {

    // Bench
    private $benchStart;
    private $benchTime;

    // Utilisateurs
    public $utilisateurs;
    public $utiCount;

    // Conseillers
    public $conseillers;
    public $conCount;

    // Catégories
    public $categories;
    public $catCount;

    // ==========================================
    public function log($message,$bench=false)
    {
        if ($bench)
        {
            $this->benchStats(false);
            $this->command->info($message . "(" . $this->benchTime . "ms)");
        }
        else
        {
            $this->command->info($message);
        }
    }

    // ==========================================
    public function benchReset($print=true)
    {
        $this->benchStart = microtime(true);
        if ($print)
        {
            $this->log('Bench stats: reset.');
        }
    }

    // ==========================================
    public function benchStats($print=true)
    {
        $this->benchTime = microtime(true) - $this->benchStart;
        if ($print)
        {
            $this->log('Bench stats: ' . $this->benchTime . ' micro secondes');
        }
    }

    // ==========================================
    public function chargerRessources()
    {
        $this->benchReset(false);
        //$this->log('Chargement des utilisateurs...');

        $this->utilisateurs = Utilisateur::All();
        $this->utiCount = $this->utilisateurs->count() - 1;

        //$this->log('Chargement des conseillers...');
        $this->conseillers = Utilisateur::where('niveau','>',1)->get();
        $this->conCount = $this->conseillers->count() - 1;

        //$this->log('Chargement des catégories...');
        $this->categories = CategorieSinistre::All();
        $this->catCount = $this->categories->count() - 1;

        //$this->log('Fait!',true);
    }

    public function rndUtilisateur()
    {
        return $this->utilisateurs[mt_rand(1,$this->utiCount)];
    }

    public function rndCategorie()
    {
        return $this->categories[mt_rand(1,$this->catCount)];
    }
}

?>