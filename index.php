<!DOCTYPE html>
<html>

<head>
    <title>Treasure Realms</title>
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
        $playerX = $player->getX();
        $playerY = $player->getY();
        $treasure = $gameMap->getTreasure();
        $monsters = $gameMap->getMonsters();

        for ($y = 1; $y <= 10; $y++) {
            for ($x = 1; $x <= 10; $x++) {
                $isPlayer = ($x == $playerX && $y == $playerY);
                $isTreasure = ($x == $treasure->gettreasureX() && $y == $treasure->gettreasureY());
                $isMonster = false;

                foreach ($monsters as $monster) {
                    if ($x == $monster->getmonsterX() && $y == $monster->getmonsterY()) {
                        $isMonster = true;
                        break;
                    }
                }

                echo '<div class="map-cell';

                if ($isPlayer) {
                    echo ' player';
                } else {
                    if ($isTreasure) {
                        echo ' treasure';
                    }
                    if ($isMonster) {
                        echo ' monster';
                    }
                }

                echo '"></div>';
            }
        }
        ?>
        <script>
        
            let playerX = <?php echo $playerX; ?>;
            let playerY = <?php echo $playerY; ?>;
       
            const step = 1;

            document.addEventListener('keydown', (event) => {
                switch (event.key) {
                    case 'ArrowUp':
                        if (playerY > 1) playerY -= step;
                        break;
                    case 'ArrowDown':
                        if (playerY < 10) playerY += step;
                        break;
                    case 'ArrowLeft':
                        if (playerX > 1) playerX -= step;
                        break;
                    case 'ArrowRight':
                        if (playerX < 10) playerX += step;
                        break;
                }

                updatePlayerPosition();
            });

            function updatePlayerPosition() {
                const playerCell = document.querySelector('.player');
                playerCell.style.gridRow = playerY;
                playerCell.style.gridColumn = playerX;
                console.log(playerX+'-'+playerY);
            }
     

            // Déplace les monstres et le trésor en dehors de la boucle
            updateOtherElements();

            function updateOtherElements() {
                const treasureCell = document.querySelector('.treasure');
                treasureCell.style.gridRow = <?php echo $treasure->gettreasureY(); ?>;
                treasureCell.style.gridColumn = <?php echo $treasure->gettreasureX(); ?>;

                const monsterCells = document.querySelectorAll('.monster');
                <?php foreach ($monsters as $index => $monster) { ?>
                    monsterCells[<?php echo $index; ?>].style.gridRow = <?php echo $monster->getmonsterY(); ?>;
                    monsterCells[<?php echo $index; ?>].style.gridColumn = <?php echo $monster->getmonsterX(); ?>;
                <?php } ?>
            }
        </script>
    </div>
</body>

</html>