<?php

class ElementSinistre extends Eloquent {
  protected $table = 'elements_sinistres';

  public function sinistre()
  {
    return $this->hasOne('Sinistre');
  }
}

?>