<?php

require_once("control/Controller.php");
require_once("view/View.php");

class PathInfoRouter {

    public function getAnimalURL(String $id) {
        return "/site.php/" . $id;   
    }

    public function getAnimalCreationURL() {
        return "/site.php/nouveau";
    }

    public function getAnimalSaveURL() {
        return "/site.php/sauverNouveau";
    }

    public function main(AnimalStorage $animalStorage) {
        $view = new View($this);
        $controller = new Controller($view, $animalStorage);
        if(key_exists("PATH_INFO", $_SERVER)) {
            $pathInfo = ltrim($_SERVER["PATH_INFO"], '/');
            if($pathInfo === "liste") {
                $controller->showList();
            } else if ($pathInfo === "accueil") {
                $controller->showAccueil();
            } else if ($pathInfo === "nouveau") {
                $controller->createNewAnimal();
            } else if ($pathInfo === "sauverNouveau") {
                $controller->saveNewAnimal($_POST);
            } else {
                $controller->showInformation($pathInfo);
            }
        } else {
            $controller->showAccueil();
        }
    }

}

?>