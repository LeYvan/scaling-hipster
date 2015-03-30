<?php

class PlanFamillial extends Eloquent {
  use SoftDeletingTrait;

  protected $table = 'planFamillials';

  public function utilisateur()
  {
    return $this->hasOne('Utilisateur');
  }

}

?>
