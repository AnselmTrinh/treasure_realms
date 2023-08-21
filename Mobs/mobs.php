<script>
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