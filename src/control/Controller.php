<?php

require_once("view/View.php");
require_once("model/Animal.php");
require_once("model/AnimalStorage.php");
require_once("model/AnimalBuilder.php");

class Controller {

    private View $view;
    private AnimalStorage $animalStorage;

    function __construct(View $view, AnimalStorage $animalStorage) {
        $this->view = $view;
        $this->animalStorage = $animalStorage;
    }

    public function showInformation(String $id=""):void {
        $animal = $this->animalStorage->read($id);
        if($animal !== null) {
            $this->view->prepareAnimalPage($animal->getNom(), $animal->getEspece(), $animal->getAge());
        } else {
            $this->view->prepareUnknowAnimalPage();
        }
        $this->view->render();
    }

    public function showList(): void {
        $this->view->prepareListPage($this->animalStorage->readAll());
        $this->view->render();
    }

    public function showAccueil(): void {
        $this->view->prepareAccueilPage();
        $this->view->render();
    }

    public function createNewAnimal() {
        $data = array("nom" => '""', "espece" => '""', "age" => '""');
        $this->view->prepareAnimalCreationPage(new AnimalBuilder($data));
        $this->view->render();
    }

    public function saveNewAnimal(array $data) {
        $animalBuilder = new AnimalBuilder($data);
        $animal = $animalBuilder->createAnimal();
        if ($animalBuilder->isValid()) {
            $id = $this->animalStorage->create($animal);
            $animal = $this->animalStorage->read($id);
            $this->view->prepareAnimalPage($animal->getNom(), $animal->getEspece(), $animal->getAge());
        } else {
            $this->view->prepareAnimalCreationPage($animalBuilder);
        }
        $this->view->render();
    }

}

?>