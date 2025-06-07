<?php

class Animal {

    private String $nom;
    private String $espece;
    private int $age;

    function __construct(String $nom, String $espece, int $age) {
        $this->nom = $nom;
        $this->espece = $espece;
        $this->age = $age;
    }

    public function getNom(): String {
        return $this->nom;
    }

    public function getEspece(): String {
        return $this->espece;
    }

    public function getAge(): int {
        return $this->age;
    }

}

?>