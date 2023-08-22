<?php

class Game
{
    private $creatures;
    private $player;
    private $treasureLocation;

    public function __construct($creatureCount)
    {
        // Initialize creatures, player, and treasure
        // ...
    }

    public function movePlayer($keyPress)
    {
        
        switch ($keyPress) {
        case 'up':
        echo "le joueur se dirige en haut";
        break;
        case 'down':
        echo "le joueur se dirige en bas";
        break;
        case 'left':
        echo "le joueur se dirige à gauche";
        break;
        case 'right':
        echo "le joueur se dirige à droite";
        break;
        default:
        echo "la partie recommence";
        break;
        }
        
       

    }

    public function resetGame()
    {
        // Reset the game to its initial state
        // Random position des creatures + Trésor
        // Reset position à 1:1
    }
}

// Create a game map with a random number of creatures between 10 and 50
$creatureCount = rand(10, 50);
$gameMap = new Game($creatureCount);

// Handle user input and update the game state
// ...


// Handle user input and update the game state
if (isset($_POST['direction'])) {
    $direction = $_POST['direction'];
    $gameMap->movePlayer($direction);
}

// Reset the game

if (isset($_POST['action'])) {



    // Return updated game state or messages as JSON response
    echo json_encode(['status' => 'success', 'message' => 'Action completed successfully']);
    exit;

    if ($_POST['action'] === 'move') {
        $direction = $_POST['direction'];
        $gameMap->movePlayer($direction);
    } elseif ($_POST['action'] === 'reset') {
        $gameMap->resetGame();
    }
}