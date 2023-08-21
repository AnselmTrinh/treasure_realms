<!DOCTYPE html>
<html>

<head>
    <title>Déplacement du Joueur avec Limites</title>
    <style>
        #game-container {
            position: relative;
            width: 400px;
            height: 400px;
            border: 1px solid black;
        }

        #player {
            position: absolute;
            width: 20px;
            height: 20px;
            background-color: blue;
        }

        #movement-log {
            margin-top: 20px;
            border: 1px solid #ccc;
            padding: 10px;
        }
    </style>
</head>

<body>
    <h1>Déplacement du Joueur avec Limites</h1>
    <div id="game-container">
        <div id="player"></div>
    </div>

    <div id="movement-log"></div>

    <script>
        const gameContainer = document.getElementById('game-container');
        const player = document.getElementById('player');
        const movementLog = document.getElementById('movement-log');
        const maxLogItems = 4; // Nombre maximum d'éléments dans le journal
        let playerX = 0;
        let playerY = 0;
        const step = 10;
        const gameWidth = gameContainer.clientWidth;
        const gameHeight = gameContainer.clientHeight;

        // Fonction de mise à jour de la position du joueur
        function updatePlayerPosition() {
            // Vérifier les limites horizontales
            playerX = Math.max(0, Math.min(playerX, gameWidth - player.clientWidth));
            // Vérifier les limites verticales
            playerY = Math.max(0, Math.min(playerY, gameHeight - player.clientHeight));

            player.style.left = playerX + 'px';
            player.style.top = playerY + 'px';
        }

        // Fonction pour ajouter un message au journal de mouvements
        function logMovement(direction) {
            const movement = document.createElement('p');
            movement.textContent = `Déplacement: ${direction}`;

            // Limiter le nombre d'éléments dans le journal
            if (movementLog.childElementCount >= maxLogItems) {
                movementLog.removeChild(movementLog.firstChild);
            }

            movementLog.appendChild(movement);
        }

        // Gestion des événements de touche
        document.addEventListener('keydown', (event) => {
            switch (event.key) {
                case 'ArrowUp':
                    playerY -= step;
                    logMovement('Haut');
                    break;
                case 'ArrowDown':
                    playerY += step;
                    logMovement('Bas');
                    break;
                case 'ArrowLeft':
                    playerX -= step;
                    logMovement('Gauche');
                    break;
                case 'ArrowRight':
                    playerX += step;
                    logMovement('Droite');
                    break;
            }

            updatePlayerPosition();
        });

        // Initialisation de la position du joueur
        updatePlayerPosition();
    </script>
</body>

</html>