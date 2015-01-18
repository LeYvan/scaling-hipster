<?php

class Sinistre extends Eloquent {
  use SoftDeletingTrait;

  public function categorie()
  {
    return CategorieSinistre::findOrFail($this->categorie_id);
  }

  public function utilisateur()
  {
    $utilisateur = Utilisateur::find($this->utilisateur_id);
    if (!is_null($utilisateur)) {
      return $utilisateur;
    }
    $utilisateur = new Utilisateur(); 
    $utilisateur->nom ="Manquant";
    return $utilisateur;
  }

  public function elements()
  {
    return ElementSinistre::where('sinistre_id','=',$this->id)->get(); 
  }
}

?>