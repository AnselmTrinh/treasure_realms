<?php
class GameMap {
    private $creatures;
    private $player;
    private $treasureLocation;

    public function __construct($creatureCount) {
        // Initialize creatures, player, and treasure
        // ...
    }

    public function movePlayer($direction) {
        // Move the player
        // Check for encounters and update player's health and experience
        // ...
    }

    public function resetGame() {
        // Reset the game to its initial state
        // ...
    }
}

// Create a game map with a random number of creatures between 10 and 50
$creatureCount = rand(10, 50);
$gameMap = new GameMap($creatureCount);

// Handle user input and update the game state
// ...


// Handle user input and update the game state
if (isset($_POST['direction'])) {
    $direction = $_POST['direction'];
    $gameMap->movePlayer($direction);
}

// Reset the game

if (isset($_POST['action'])) {
    if ($_POST['action'] === 'move') {
        $direction = $_POST['direction'];
        $gameMap->movePlayer($direction);
    } elseif ($_POST['action'] === 'reset') {
        $gameMap->resetGame();
    }

    // Return updated game state or messages as JSON response
    echo json_encode(['status' => 'success', 'message' => 'Action completed successfully']);
    exit;
}