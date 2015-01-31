<?php

class Nouvelle extends Eloquent {
  use SoftDeletingTrait;

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