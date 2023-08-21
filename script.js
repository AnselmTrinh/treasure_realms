// script.js
let playerX = 1;
let playerY = 1;

document.addEventListener("keydown", (event) => {
    switch (event.key) {
        case "ArrowUp":
            movePlayer(playerX, playerY - 1);
            break;
        case "ArrowDown":
            movePlayer(playerX, playerY + 1);
            break;
        case "ArrowLeft":
            movePlayer(playerX - 1, playerY);
            break;
        case "ArrowRight":
            movePlayer(playerX + 1, playerY);
            break;
    }
});

function movePlayer(newX, newY) {
    const cell = document.querySelector(`[data-x="${newX}"][data-y="${newY}"]`);
    if (cell) {
        document.querySelector(`[data-x="${playerX}"][data-y="${playerY}"]`).textContent = "";
        newX = newX;
        newX = newX;
        cell.textContent = "🚶";
    }console.log(playerX,playerY)
}
