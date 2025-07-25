<?php

require_once("AnimalStorage.php");
require_once("Animal.php");

class AnimalStorageStub implements AnimalStorage {

    private Array $animalStorage;

    function __construct() {
        $this->animalStorage = array(
            'medor' => new Animal('Médor', 'chien', 2),
            'felix' => new Animal('Félix', 'chat', 7),
            'denver' => new Animal('Denver', 'dinosaure', 40),
        );
    }

    public function read($id) {
        if (key_exists($id, $this->animalStorage)) {
            return $this->animalStorage[$id];
        }
        return null;
    }

    public function readAll() {
        return $this->animalStorage;
    }

    public function create(Animal $a) {
        throw new Exception("Impossible d'utiliser create.");
    }

    public function delete($id) {
        throw new Exception("Impossible d'utiliser delete.");
    }

    public function update ($id, Animal $a) {
        throw new Exception("Impossible d'utiliser update.");
    }

}

?>