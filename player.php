<?php
class Player
{
    private $x;
    private $y;

    public function __construct($maxX, $maxY)
    {
        $this->x = rand(0, $maxX - 1);
        $this->y = rand(0, $maxY - 1);
    }

    public function getX()
    {
        return $this->x;
    }

    public function getY()
    {
        return $this->y;
    }
}
?>
<script>
    let playerX = <?php echo $playerX; ?>;
    let playerY = <?php echo $playerY; ?>;
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

        const newCell = document.querySelector(`.grid-cell[data-x='${newPlayerX}'][data-y='${newPlayerY}']`);
        const oldCell = document.querySelector(`.grid-cell[data-x='${playerX}'][data-y='${playerY}']`);

        if (newCell && newCell.textContent === "") {
            oldCell.textContent = "";
            newCell.textContent = "🚶";
            playerX = newPlayerX;
            playerY = newPlayerY;
        }
    });

    updatePlayerPosition();
</script>