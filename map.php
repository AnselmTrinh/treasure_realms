<?php
// map.php

require 'config.php'; // Connexion à la bdd

$query = $pdo->query("SELECT * FROM carte ORDER BY position_x, position_y");
$cells = $query->fetchAll();

$map = [];
foreach ($cells as $cell) {
    $map[$cell['position_x']][$cell['position_y']] = $cell;
}

for ($x = 1; $x <= 10; $x++) {
    for ($y = 1; $y <= 10; $y++) {
        echo "<div class='grid-cell' data-x='$x' data-y='$y'>";
        
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

        echo "</div>";
    }
}
?>
