<?php

require_once('game.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My BlackJack</title>
</head>
<body>

<form method="POST">
    <input type="submit" name="choice" value="START">
</form>

<form method="POST">
    <input type="submit" name="drawCard" value="Draw a card">
    <input type="submit" name="stop" value="STOP">
</form>

<form method="POST">
    <input type="submit" name="reset"value="RESET">
</form>

<p>Click on the reset button before starting any game(include the first game you will play)</p>

</body>
</html>