<?php

$postData = $_POST;

// Validation des données
if(empty($_POST['titre']) || empty($_POST['artiste']) || empty($_POST['image']) || empty($_POST['description'])
    || strlen($_POST['description']) < 3
    || !filter_var($_POST['image'], FILTER_VALIDATE_URL)
) {
    header('Location: ajouter.php');
} else {
    // Si les données sont valides, on les place dans des variables
    $titre = trim(strip_tags($postData['titre']));
    $artiste = trim(strip_tags($postData['artiste']));
    $image = trim(strip_tags($postData['image']));
    $description = trim(strip_tags($postData['description']));

    // Insertion en base de données
    require_once(__DIR__ . '/bdd.php');
    $bdd = connexion();
    $insertOeuvre = $bdd->prepare('INSERT INTO oeuvres(titre, artiste, image, description) VALUES (:titre, :artiste, :image, :description)');
    $insertOeuvre->execute([
        'titre' => $titre,
        'artiste' => $artiste,
        'image' => $image,
        'description' => $description,
    ]);

    header('Location: oeuvre.php?id=' . $bdd->lastInsertId());
}

?>