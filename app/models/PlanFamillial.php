<?php

class PlanFamillial extends Eloquent {
  use SoftDeletingTrait;

  public function utilisateur()
  {
    return $this->hasOne('Utilisateur');
  }

}

?>
