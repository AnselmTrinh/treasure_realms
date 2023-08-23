<!DOCTYPE html>
<html>

<head>
    <title>Game Map</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="game-map">
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
        ?>
        <script>
            let PlayerX = <?php echo $playerX; ?>;
            let PlayerY = <?php echo $playerY; ?>;
            const step = 1;

            // function updatePlayerPosition() {
            //     const playerCell = document.querySelector(`.grid-cell[data-x='${playerX}'][data-y='${playerY}']`);
            //     playerCell.textContent = "🚶";
            // }

            document.addEventListener('keydown', (event) => {
                let newPlayerX = playerX;
                let newPlayerY = playerY;

                switch (event.key) {
                    case 'ArrowUp':
                        newPlayerX = Math.max(1, playerX - step);
                        break;
                    case 'ArrowDown':
                        newPlayerX = Math.min(10, playerX + step);
                        break;
                    case 'ArrowLeft':
                        newPlayerY = Math.max(1, playerY - step);
                        break;
                    case 'ArrowRight':
                        newPlayerY = Math.min(10, playerY + step);
                        break;
                }
            });

            updatePlayerPosition();
        </script>
    </div>
</body>

</html>