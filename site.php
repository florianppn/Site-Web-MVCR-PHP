<?php

set_include_path("./src");
require_once("PathInfoRouter.php");
require_once("model/AnimalStorageStub.php");
require_once("model/AnimalStorageSession.php");

session_start();
$animalStorage = new AnimalStorageSession();

$router = new PathInfoRouter();
$router->main($animalStorage);

?>