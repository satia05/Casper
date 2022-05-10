<?php
session_start();
require 'Functions/bdd.php';
require 'Functions/functions.php';

$template = "login_register";
$title = "LOGIN";
$login = true;
if (isset($_POST['mail'], $_POST['psw'])) {
    $requete = $pdo->prepare("select * from customer where email = :mail;");
    $requete->bindValue(':mail', htmlspecialchars($_POST['mail']));
    $requete->execute();
    $ress = $requete->fetchAll(PDO::FETCH_ASSOC);
    foreach ($ress as $res) {
        if (verifyPassword(htmlspecialchars($_POST['psw']), $res['password'])) {
            $signIn = true;
            $_SESSION['signIn'] = true;
            $_SESSION['email'] = $res['email'];
        } else {
            $signIn = false;
        }
    }
} else if (isset($_GET['mdp_oublie']) && $_GET['mdp_oublie'] === 'true') {
    $login = false;
    if (isset($_POST['umail'], $_POST['npsw'], $_POST['npswc'])) {
        if ($_POST['npsw'] === $_POST['npswc']) {
            $requete = $pdo->prepare("update customer set password = :psw where email = :mail");
            $requete->bindValue(':psw', hashPassword(htmlspecialchars($_POST['npsw'])));
            $requete->bindValue(':mail', htmlspecialchars($_POST['umail']));
            $requete->execute();
            $mdp_m = true;
        } else {
            $mdp_m = false;
        }
    }
}
include 'index.phtml';
