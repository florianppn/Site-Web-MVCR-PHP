<?php

require_once("model/Animal.php");

class AnimalBuilder {

    private array $data;
    private array $error;
    public const NAME_REF = "nom";
    public const SPECIES_REF = "espece";
    public const AGE_REF = "age";

    function __construct(array $data) {
        $this->data = $data;
        $this->error = array(self::NAME_REF => "", self::SPECIES_REF => "", self::AGE_REF => "");
    }

    public function getData() {
        return $this->data;
    }

    public function getError() {
        return $this->error;
    }

    public function createAnimal() {
        $animal = new Animal(htmlspecialchars($this->data[self::NAME_REF]), htmlspecialchars($this->data[self::SPECIES_REF]), intval($this->data[self::AGE_REF]));
        return $animal;
    }

    public function isValid() {
        if ($this->data[self::NAME_REF] === "") {
            $this->error[self::NAME_REF] = "Erreur : champ vide";
        }
        if ($this->data[self::SPECIES_REF] === "") {
            $this->error[self::SPECIES_REF] = "Erreur : champ vide";
        }
        if (is_numeric($this->data[self::AGE_REF]) && filter_var($this->data[self::AGE_REF], FILTER_VALIDATE_INT) !== false) {
            if ($this->data[self::AGE_REF] < 0) {
                $this->error[self::AGE_REF] = "Erreur : Age positif requis";
            }
        } else {
            $this->error[self::AGE_REF] = "Erreur : entier uniquement";
        }
        $compteur_erreur = count(array_filter($this->error));
        return true ? $compteur_erreur === 0 : false;
    }

}

?>