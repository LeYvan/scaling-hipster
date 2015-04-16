<?php

class PlanFamilial extends Eloquent {
  use SoftDeletingTrait;

  protected $table = 'planFamilials';

  public function utilisateur()
  {
    return $this->hasOne('Utilisateur');
  }

}

?>
