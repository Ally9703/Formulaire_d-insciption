<?php

    try{
        $bdd = new PDO('mysql:hot=localhost;dbname=poo;chartset=utf8', 'root', '');
    }
    catch(Exception $e) {
        die('Erreur : '.$e->getMessage());
    }
?>