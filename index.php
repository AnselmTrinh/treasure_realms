<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];


    if ($action === 'jouer') {
        // Redirection vers la page de jeu (ou traitement de la logique du jeu)
        header("Location: game.php");
        exit();
    } elseif ($action === 'quitter') {
        // Action de quitter (peut nécessiter un traitement spécifique)
        exit('Application quittée.');
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Menu d'Accueil</title>
</head>
<body>
    <h1>Menu d'Accueil</h1>
    <form method="post" action="/Game/game.php">
        <button type="submit" name="action" value="jouer">Jouer</button>
        <button type="submit" name="action" value="quitter">Quitter</button>
    </form>
</body>
</html>
