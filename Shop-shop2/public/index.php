<?php
session_start();
/* initialisation des fichiers TWIG */
require_once '../lib/vendor/autoload.php';
require_once '../src/controleur/_controleurs.php';
require_once '../config/routes.php';
require_once '../config/parametres.php';
require_once '../config/connexion.php';
require_once '../src/controleur/accueilControleur.php';
require_once '../src/modele/_classes.php';
$loader = new \Twig\Loader\FilesystemLoader('../src/vue/');
$twig = $twig = new \Twig\Environment($loader, []);
$twig->addGlobal('session', $_SESSION);
$db = connect($config);
$contenu = getPage($db);
$contenu($twig,$db);
?>
<!-- • L’instruction « require_once » permettra d’importer des
fichiers comportant du code que nous voudrions utiliser dans
nos pages.
• $loader = new \Twig\Loader\FilesystemLoader('../src/vue/');
cette ligne permet de mettre en mémoire le système TWIG et de
lui indiquer le répertoire où nous stockerons nos fichiers
comprenant notre HTML.
• $twig = new \Twig\Environment($loader, []); cette ligne
permet de mettre en mémoire l’environnement de travail de twig
est de le stocker dans la variable « $twig ». !-->