<?php
// index.php

require 'config.php'; // Connexion à la bdd 

// Affiliation et affichage des données de la table 'carte'
$query = $pdo->query("SELECT * FROM carte ORDER BY position_x, position_y");
$cells = $query->fetchAll();

$map = [];
foreach ($cells as $cell) {
    $map[$cell['position_x']][$cell['position_y']] = $cell;
}

echo "<table border='1'>";
for ($x = 1; $x <= 10; $x++) {
    echo "<tr>";
    for ($y = 1; $y <= 10; $y++) {
        echo "<td>";
        
        $cell = $map[$x][$y];
        switch ($cell['type']) {
            case 'vide':
                echo "🟦"; // CASES VIDES
                break;
            case 'créature':
                echo "👹"; // CREATURES
                break;
            case 'trésor':
                echo "💰";
                break;
            case 'joueur':
                echo "🚶"; // JOUEUR
                break;
        }

        echo "</td>";
    }
    echo "</tr>";
}
echo "</table>";
?>
