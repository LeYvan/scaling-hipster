<?php

class ElementSinistre extends Eloquent {
  use SoftDeletingTrait;
  protected $table = 'elements_sinistres';

  public function sinistre()
  {
    return $this->hasOne('Sinistre');
  }
}

?>