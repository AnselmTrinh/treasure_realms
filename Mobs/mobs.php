<?php
// Génération aléatoire des positions des monstres
$monsters = array(
    array('x' => 100, 'y' => 150),
    array('x' => 200, 'y' => 250),
    // ... ajoutez plus de monstres ici
);

// Convertir le tableau des monstres en JSON pour l'envoyer au client
echo json_encode($monsters);
