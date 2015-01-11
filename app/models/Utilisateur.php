<?php

class Utilisateur extends Eloquent {

  public function sinistres()
  {
    return $this->hasMany('Sinistre');
  }

}

?>