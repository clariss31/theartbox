<?php
function connexion() {
    try
    {
        return new PDO('mysql:host=localhost;dbname=artbox;charset=utf8', 'root', '');
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
}