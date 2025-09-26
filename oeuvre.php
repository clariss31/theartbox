<?php
    require 'header.php';
    require 'bdd.php';
    $bdd = connexion();

// Si l'URL ne contient pas d'id, on redirige sur la page d'accueil
if(!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit;
}

// On récupère l'oeuvre
$retrieveOeuvreStatement = $bdd->prepare('SELECT * FROM oeuvres WHERE id = :id');
$retrieveOeuvreStatement->execute(['id' => (int)$_GET['id']]);
$oeuvre = $retrieveOeuvreStatement->fetch();

// Si l'oeuvre n'existe pas, on redirige sur la page d'accueil
if (!$oeuvre) {
    header('Location: index.php');
    exit;
}

// On prépare les données de l'oeuvre pour l'affichage
$oeuvre = [
    'id' => $oeuvre['id'],
    'titre' => $oeuvre['titre'],
    'description' => $oeuvre['description'],
    'artiste' => $oeuvre['artiste'],
    'image' => $oeuvre['image'],
];

?>

<?php // Affichage de l'oeuvre ?>
<article id="detail-oeuvre">
    <div id="img-oeuvre">
        <img src="<?= $oeuvre['image'] ?>" alt="<?= $oeuvre['titre'] ?>">
    </div>
    <div id="contenu-oeuvre">
        <h1><?= $oeuvre['titre'] ?></h1>
        <p class="description"><?= $oeuvre['artiste'] ?></p>
        <p class="description-complete">
             <?= $oeuvre['description'] ?>
        </p>
    </div>
</article>

<?php require 'footer.php'; ?>