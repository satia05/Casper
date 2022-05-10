<?php
// Pour hacher un mot de passe aléatoirement.
function hashPassword($password) // permet de crypter le mot de passe 
{
    $salt = '$2y$11$' . substr(bin2hex(openssl_random_pseudo_bytes(32)), 0, 22);

    return crypt($password, $salt);
};

// Pour vérifier le mot de passe hacher.
function verifyPassword($password, $hashedPassword)
{
    return crypt($password, $hashedPassword) == $hashedPassword;
}

function recuperationArticle($article)
{
    $res = [];
    $res['nomArticle'] = $article['nom'];
    $res['prixArticle'] = $article['prix'];
    $res['descriptionArticle'] = $article['description'];
    $res['stock'] = $article['stock'];
    $res['imagesArticle'] = explode(',', $article['img']);
    return $res;
}

function recuperationProjet($projet)
{
    $res = [];
    $res['num_projet'] = $projet['num_projet'];
    $res['nom'] = $projet['nom'];
    $res['description'] = $projet['description'];
    $res['img'] = explode(',', $projet['lien']);
    return $res;
}

function estActive($page, $actuel)
{
    if ($page == $actuel) {
        return '<li class="est-actif">';
    } else {
        return "<li>";
    }
}

function prixTotal($cart)
{
    $total = 0;
    foreach ($cart as $k => $v) {
        $total += $v['prixArticle'];
    }
    return $total;
}
