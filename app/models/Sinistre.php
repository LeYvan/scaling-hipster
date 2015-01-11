<?php

class Sinistre extends Eloquent {

  public function categorie()
  {
    return CategorieSinistre::findOrFail($this->categorie_id);
  }

  public function utilisateur()
  {
    return Utilisateur::findOrFail($this->utilisateur_id);
  }

  public function elements()
  {
    return $this->hasMany('ElementSinistre');
  }

}

?>