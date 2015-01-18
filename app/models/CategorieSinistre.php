<?php

class CategorieSinistre extends Eloquent {
  use SoftDeletingTrait;
  protected $table = 'categories_sinistres';

  public function sinistres()
  {
    return $this->hasMany('Sinistre');
  }
}

?>