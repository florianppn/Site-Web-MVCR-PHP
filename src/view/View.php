<?php

require_once("PathInfoRouter.php");
require_once("model/AnimalBuilder.php");

class View {

    private String $title;
    private String $content;
    private Array $menu;
    private PathInfoRouter $router;

    function __construct(PathInfoRouter $router) {
        $this->title = "";
        $this->content = "";
        $this->menu = array(
            "/site.php" => "accueil",
            "/site.php/liste" => "animaux",
            "/site.php/nouveau" => "créer animal"
        );
        $this->router = $router;
    }

    public function render() {
        include_once("squelette.html");
    }

    public function prepareTestPage() {
        $this->title = "Test";
        $this->content = "Page de test";
    }

    public function prepareAccueilPage() {
        $this->title = "Accueil";
        $this->content = "<h2>Page d'accueil</h2><br><p>Bienvenue sur le site ZooLand !</p>";
        $this->content .= "<p>Le but est de comprendre le fonctionnement des sessions et de l'architecture MVCR.</p>";
    }

    public function prepareAnimalPage(String $name, String $species, int $age) {
        $this->title = $name;
        $this->content = "<h2> Les infos de " . $name . "</h2>";
        $this->content .= "« " . $name . " est un animal de l'espèce " . $species . " qui a " . $age . " ans ».";
    }

    public function prepareUnknowAnimalPage() {
        $this->title = "Erreur d'identifiant";
        $this->content = "Cette indentifiant n'existe pas";
    }

    public function prepareListPage(array $animalTab) {
        $this->title = "Liste des animaux";
        $this->content = "<h2>Clique sur un animal pour plus d'infos</h2><table class=\"zoo-table\">";
        foreach($animalTab as $key => $animal) {
            $url = $this->router->getAnimalURL($key);
            $this->content .= "<tr><td><a href=\"" . $url . "\">" . $animal->getNom() . "</a></td></tr>";
        }
        $this->content .= "</table>";
    }

    public function prepareDebugPage($variable) {
        $this->title = "Debug";
        $this->content = "<pre>".htmlspecialchars(var_export($variable, true)) . "</pre>";
    }

    public function prepareAnimalCreationPage(AnimalBuilder $animalBuilder) {
        $this->title = "Formulaire";
        $this->content = "<h2>Remplis le formulaire</h2>";
        include_once("formulaire.html");
    }

}

?>