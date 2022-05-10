<?php
require 'Functions/bdd.php';
require 'Functions/functions.php';
session_start();

$title = "GRSRG";
$template = "project_edit";
$register = true;

// Verifie si projet existe, if exist return 1 projet (lien en ba a gauche quand on survole les bouton)

$verif_projet = $pdo->prepare("SELECT * FROM projet where num_projet=:num_projet");
$verif_projet->execute(array('num_projet' => $_GET['num_projet']));

$get_projet = $verif_projet->fetch(PDO::FETCH_ASSOC);

include 'index.phtml';
