<?php

class Alerte extends Eloquent {
  use SoftDeletingTrait;

  public function categorie()
  {
    //return CategorieSinistre::findOrFail($this->categorie_id);
    $categorie = CategorieSinistre::find($this->categorie_id);
    if (!is_null($categorie)) {
      return $categorie;
    }
    $categorie = new CategorieSinistre(); 
    $categorie->etiquette ="Manquante";
    return $categorie;
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
}

?>