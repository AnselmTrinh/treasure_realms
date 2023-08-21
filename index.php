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

        echo 'Connexion réussie';
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

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