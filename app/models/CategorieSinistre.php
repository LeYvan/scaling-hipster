<?php

class CategorieSinistre extends Eloquent {
  protected $table = 'categories_sinistres';

  public function sinistres()
  {
    return $this->hasMany('Sinistre');
  }
}

?>