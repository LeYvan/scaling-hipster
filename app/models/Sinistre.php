<?php

class Sinistre extends Eloquent {

  public function categorie()
  {
    return $this->hasOne('CategorieSinistre');
    //return CategorieSinistre::findOrFail($this->categorie);
  }

  public function utilisateur()
  {
    return $this->hasOne('Utilisateur');
    //return Utilisateur::findOrFail($this->getAttribute('id-createur'));
  }

  public function elements()
  {
    return $this->hasMany('ElementSinistre');
  }

}

?>