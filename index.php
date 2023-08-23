<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Treasure Realms</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <?php
    // index.php
    
    require 'config.php'; // Connexion à la bdd 
    
    try {

        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Enable error reporting
            PDO::ATTR_EMULATE_PREPARES => false // Disable prepared statement emulation
        ];

        $pdo = new PDO($dsn, $user, $password, $options);

        echo 'Statut : Online';
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }



// Définir le nombre maximal de cellules "trésor" à mettre à jour

$pdo->exec("UPDATE carte SET type = 'joueur' WHERE cellule_id = 1" );


// Compter le nombre de cellules avec le type "trésor"
$query = $pdo->query("SELECT COUNT(*) FROM carte WHERE type = 'trésor'");
$count = $query->fetchColumn();

// Mettre à jour les cellules "trésor" uniquement si le nombre actuel est inférieur au maximum
//if ($count==1) {
  //  $pdo->exec("UPDATE carte SET type = 'trésor' WHERE position_y = FLOOR(RAND() * (10 - 2 + 1)) + 2 AND position_x = FLOOR(RAND() * (10 - 2 + 1)) + 2 and cellule_id=2");
//}



    // Affiliation et affichage des données de la table 'carte'
// Convertir une cellule "créature" en "vide" de manière aléatoire



// Convertir une cellule "créature" en "vide" de manière aléatoire
$pdo->exec("UPDATE carte SET type = 'vide' WHERE type = 'créature' AND RAND() < 0.3");


// Convertir une cellule "vide" en "créature" de manière aléatoire
$pdo->exec("UPDATE carte SET type = 'créature' WHERE type = 'vide' AND RAND() < 0.2");

// Compter le nombre de cellules vides
$countQuery = $pdo->query("SELECT COUNT(*) FROM carte WHERE type = 'vide'");
$totalEmptyCells = $countQuery->fetchColumn();

if ($countQuery ==1){
// Générer un nombre aléatoire entre 1 et le nombre total de cellules vides
$randomCellCount = rand(2, 10);

// Sélectionner l'ID de la cellule vide correspondant au nombre aléatoire
$randomEmptyCellQuery = $pdo->prepare("SELECT cellule_id FROM carte WHERE type = 'vide' LIMIT $randomCellCount, 1");
$randomEmptyCellQuery->execute();
$randomEmptyCell = $randomEmptyCellQuery->fetchColumn();

// Mettre à jour la cellule sélectionnée en tant que trésor
$pdo->exec("UPDATE carte SET type = 'trésor' WHERE cellule_id = $randomEmptyCell AND cellule_id<>1");
}



//$pdo->exec("UPDATE carte SET type = 'vide' WHERE type = 'trésor' AND RAND() < 0.3");


// Sélectionner toutes les cellules de la table "carte" après les mises à jour
$query = $pdo->query("SELECT * FROM carte ORDER BY position_x, position_y");
$cells = $query->fetchAll(PDO::FETCH_ASSOC);
    
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

    <div class="controls">
        <button type="button" name="direction" value="up">&#8593;</button>
        <button type="button" name="direction" value="down">&#8595;</button>
        <button type="button" name="direction" value="left">&#8592;</button>
        <button type="button" name="direction" value="right">&#8594;</button>
        <button type="button" name="direction" value="reset">Reset Game</button>
    </div>
    <div class="action-log">
            <!-- Display user actions and their consequences -->
    </div>



    <script>
        // let playerX = 1;
        // let playerY = 1;

        // document.addEventListener("keydown", (event) => {
        //     switch (event.key) {
        //         case "ArrowUp":
        //             movePlayer(playerX, playerY - 1);
        //             break;
        //         case "ArrowDown":
        //             movePlayer(playerX, playerY + 1);
        //             break;
        //         case "ArrowLeft":
        //             movePlayer(playerX - 1, playerY);
        //             break;
        //         case "ArrowRight":
        //             movePlayer(playerX + 1, playerY);
        //             break;
        //     }
        // });

        // function movePlayer(newX, newY) {
        //     const cell = document.querySelector(`[data-x="${newX}"][data-y="${newY}"]`);
        //     if (cell) {
        //         document.querySelector(`[data-x="${playerX}"][data-y="${playerY}"]`).textContent = "";
        //         playerX = newX;
        //         playerY = newY;
        //         cell.textContent = "🚶";
        //     }
        // }

        // JavaScript code to handle button clicks and update the UI using AJAX
        document.addEventListener('DOMContentLoaded', function () {
            const controls = document.querySelector('.controls');
            const actionLog = document.querySelector('.action-log');

            controls.addEventListener('click', function (event) {
                if (event.target.name === 'direction') {
                    const direction = event.target.value;
                    const action = (direction === 'reset') ? 'btn' : 'move';
                    sendAction(action, direction);
                }
            });

            function sendAction(action, direction) {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'game.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);
                        if (response.status === 'success') {
                            // Update the action log or other parts of the UI if needed
                            actionLog.innerHTML = response.message;
                        }
                    }
                };
                xhr.send(`action=${action}&direction=${direction}`);
                console.log(action, direction)
            }
        });


    </script>
</body>

</html>