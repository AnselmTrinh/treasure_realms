<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Game Map</title>
</head>

<body>
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
        }

        .map {
            width: 400px;
            height: 400px;
            border: 2px solid #000;
            position: relative;
        }

        .player {
            width: 20px;
            height: 20px;
            background-color: #00f;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>

    <div class="map">
        <div id="player" class="player"></div>
    </div>
</body>

</html>