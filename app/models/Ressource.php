<?php

class Ressource extends Eloquent {

    public function categorie() {
        return $this->hasOne('CategorieSinistre');
    }

}
