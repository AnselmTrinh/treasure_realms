<!DOCTYPE html>
<html>

<head>
    <title>Déplacement du Joueur avec Limites</title>
    <style>
        #game-container {
            position: relative;
            width: 1350px;
            height: 300px;
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

        .monster {
            position: absolute;
            width: 20px;
            height: 20px;
            background-color: red;
            border-radius: 50%;
            /* Pour un look circulaire */
        }
    </style>
</head>

<body>
    <h1>Déplacement du Joueur avec Limites</h1>
    <div id="game-container">
        <div id="player"></div>
        <div class="monster"></div>
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
        // Fonction du combat

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
        // Fonction pour générer un nombre aléatoire dans une plage donnée
        function getRandomNumber(min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }

        // Fonction pour générer des monstres aléatoirement
        function generateMonsters(numMonsters) {
            for (let i = 0; i < numMonsters; i++) {
                const monster = document.createElement('div');
                monster.classList.add('monster');

                // Position aléatoire pour le monstre
                const monsterX = getRandomNumber(0, gameWidth - monster.clientWidth);
                const monsterY = getRandomNumber(0, gameHeight - monster.clientHeight);
                monster.style.left = monsterX + 'px';
                monster.style.top = monsterY + 'px';

                gameContainer.appendChild(monster);
            }
        }

        // Appelez la fonction pour générer les monstres (par exemple, 5 monstres)
        generateMonsters(15);
        // Fonction pour vérifier la collision entre le joueur et les monstres
        function checkCollisions() {
            const monsters = document.querySelectorAll('.monster');

            monsters.forEach(monster => {
                const monsterRect = monster.getBoundingClientRect();
                const playerRect = player.getBoundingClientRect();

                if (
                    monsterRect.left < playerRect.right &&
                    monsterRect.right > playerRect.left &&
                    monsterRect.top < playerRect.bottom &&
                    monsterRect.bottom > playerRect.top
                ) {
                    alert('Combat avec un monstre !');
                }
            });
        }

        // Appel de la fonction pour vérifier les collisions à chaque mouvement du joueur
        document.addEventListener('keydown', (event) => {
            // ... (votre code actuel pour le déplacement du joueur)

            updatePlayerPosition();
            checkCollisions();
        });
        // Disparition des mob
        if (
            monsterRect.left < playerRect.right &&
            monsterRect.right > playerRect.left &&
            monsterRect.top < playerRect.bottom &&
            monsterRect.bottom > playerRect.top
        ) {
            monster.remove(); // Supprimer le monstre
            alert('Combat avec un monstre !');
        }
        // fonction pour checker les collisions et fait dispaitre le monstre
        function checkCollisions() {
            const monsters = document.querySelectorAll('.monster');

            monsters.forEach(monster => {
                const monsterRect = monster.getBoundingClientRect();
                const playerRect = player.getBoundingClientRect();

                if (
                    monsterRect.left < playerRect.right &&
                    monsterRect.right > playerRect.left &&
                    monsterRect.top < playerRect.bottom &&
                    monsterRect.bottom > playerRect.top
                ) {
                    monster.remove(); // Supprimer le monstre
                    alert('Combat avec un monstre !');
                }
            });
        }
    </script>
</body>

</html>