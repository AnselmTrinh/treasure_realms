<!DOCTYPE html>
<html>

<head>
    <title>Game Map</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['function']) && $_GET['function'] === 'updatePlayerPosition') {
            updatePlayerPosition();
        }
    }

    function updatePlayerPosition()
    {

        // Mettez à jour la position du joueur ici avec $_GET['newPlayerX'] et $_GET['newPlayerY']

        $newPlayerX = isset($_GET['newPlayerX']) ? $_GET['newPlayerX'] : null;
        $newPlayerY = isset($_GET['newPlayerY']) ? $_GET['newPlayerY'] : null;

        // Générez le contenu HTML à afficher
        $htmlResponse = "<p>Le joueur s'est déplacé à la position X: $newPlayerX, Y: $newPlayerY.</p>";

        // Envoyez le contenu HTML comme réponse
        echo $htmlResponse;
    }
    ?>
    <div style="display:flex">
        <div class="game-map" id="game-map">
         <?php
            include '../poo_treasure/monster.php';
            include '../poo_treasure/treasure.php';
            include '../poo_treasure/player.php';
            include '../poo_treasure/map.php';

            $gameMap = new GameMap(10, 10);

            $player = $gameMap->getPlayer();
            $treasure = $gameMap->getTreasure();
            $monsters = $gameMap->getMonsters();

            for ($y = 0; $y < 10; $y++) {
                for ($x = 0; $x < 10; $x++) {
                    $isPlayer = ($x == $player->getX() && $y == $player->getY());
                    $isTreasure = ($x == $treasure->getX() && $y == $treasure->getY());
                    $isMonster = false;
                    foreach ($monsters as $monster) {
                        if ($x == $monster->getX() && $y == $monster->getY()) {
                            $isMonster = true;
                            break;
                        }
                    }

                    echo '<div class="map-cell';
                    if ($isPlayer) echo ' player';
                    if ($isTreasure) echo ' treasure';
                    if ($isMonster) echo ' monster';
                    echo '"></div>';
                }
            }

            $playerX =  $player->getX();
            $playerY =  $player->getY();
            $step = 1;

            echo $playerX;
            echo $playerY;
            ?>

        </div>
        <div id="responseContainer">
            <!-- La réponse du serveur sera affichée ici -->
        </div>
    </div>
    <script>
        let PlayerX = <?php echo $player->getX(); ?>;
        let PlayerY = <?php echo $player->getY(); ?>;
        const step = <?php echo $step; ?>;

        document.addEventListener('keydown', (event) => {
            let newPlayerX = PlayerX;
            let newPlayerY = PlayerY;

            switch (event.code) {
                case 'ArrowUp':
                    newPlayerX = Math.max(1, PlayerX - step);
                    console.log('up');
                    break;
                case 'ArrowDown':
                    newPlayerX = Math.min(10, PlayerX + step);
                    console.log('down');
                    break;
                case 'ArrowLeft':
                    newPlayerY = Math.max(1, PlayerY - step);
                    console.log('left');
                    break;
                case 'ArrowRight':
                    newPlayerY = Math.min(10, PlayerY + step);
                    console.log('right');
                    break;
            }


            const xhr = new XMLHttpRequest();
            xhr.open('get', 'index.php', true);
            // Définissez le type de contenu pour la requête
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Gérer la réponse du serveur ici si nécessaire
                    console.log(xhr.responseText);
                    // Afficher la réponse du serveur dans la div avec l'ID "responseContainer"
                    const responseContainer = document.getElementById('responseContainer');
                    responseContainer.innerHTML = ""
                    responseContainer.innerHTML = xhr.responseText;
                }
            };

            // Créez une chaîne de requête pour les données à envoyer
            const data = 'function=updatePlayerPosition&newPlayerX=' + newPlayerX + '&newPlayerY=' + newPlayerY;

            xhr.send(data);
        });
    </script>

</body>

</html>