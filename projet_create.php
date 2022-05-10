<?php
require 'Functions/bdd.php';
require 'Functions/functions.php';
session_start();

$template = "project";
$register = true;

$req = $pdo->prepare("INSERT INTO projet VALUES (:num_projet, :nom, :lien, :description)");
$req->bindValue(':num_projet', $_POST['num_projet']);
$req->bindValue(':nom', $_POST['nom']);
$req->bindValue(':lien', $_POST['lien']);
$req->bindValue(':description', $_POST['description']);

$req->execute();

echo "L'insertion nouvelle a était réalisé sur le projet " . $_POST['num_projet'];
header("Location: adminer.php");
