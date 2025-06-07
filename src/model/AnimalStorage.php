<?php

require_once("Animal.php");

interface AnimalStorage {

    public function read($id);
    public function readAll();
    public function create(Animal $a);
    public function delete($id);
    public function update($id, Animal $a);

}

?>