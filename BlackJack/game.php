<?php

session_start();
require_once('Classes/bank.php');
require_once('Classes/save.php');
require_once('index.php');

if(isset($_POST['reset'])){
    unset($_SESSION['saveMe']);
}

if(!isset($_SESSION['saveMe'])){
    $saveMe = new saveMyGame();
    $_SESSION['deck'] = serialize($saveMe);
} else{
    $saveMe = unserialize($_SESSION['saveMe']);
}

if(isset($_POST['choice'])){
    $saveMe->bank->take($saveMe->deck->deal(2));
    $saveMe->player->take($saveMe->deck->deal(2));
    if($saveMe->bank->getHandValue() > 21){
        echo "The Bank lost with => " . $saveMe->bank->getHandValue();
    } else {
        echo "The Bank have => " . $saveMe->bank->getHandValue();
    }
    if($saveMe->player->getHandValue() > 21){
        echo "<br>You have lost with => " . $saveMe->player->getHandValue();
    } else {
        echo "<br>You have have => " . $saveMe->player->getHandValue();
    }
}

if(isset($_POST['drawCard'])){
    if($saveMe->player->getHandValue() < 21){
        echo('<br>You draw a card:');
        $saveMe->player->take($saveMe->deck->deal(1));

        if($saveMe->player->getHandValue() <=21){
            echo "<br>The Bank have => " . $saveMe->bank->getHandValue() . "<br> You have now => " . $saveMe->player->getHandValue();
        } else {
            echo "<br>The Bank have =>" . $saveMe->bank->getHandValue() . "<br> You have lost with => " . $saveMe->player->getHandValue() . "<br>Make a new game by clicking on the RESET button";
        }
    }
}

if(isset($_POST['stop'])){
    while($saveMe->bank->getHandValue() < 17){
        $saveMe->bank->take($saveMe->deck->deal(1));
    }

    if($saveMe->bank->getHandValue() <= 21) {
        echo "<br>The bank have now => " . $saveMe->bank->getHandValue() . "<br>You have => " . $saveMe->player->getHandValue();
    } else {
        echo "<br>The bank have lost with => " . $saveMe->bank->getHandValue() . "<br>You have => " . $saveMe->player->getHandValue() . "<br> You won !<br>Make a new game by clicking on the RESET button";
    }

    if($saveMe->bank->getHandValue() <= 21 && $saveMe->player->getHandValue() <= 21){
        if($saveMe->bank->getHandValue() < $saveMe->player->getHandValue()){
            echo "<br>You have won ! Congrats ! <br>Make a new game by clicking on the RESET button";
        } elseif($saveMe->bank->getHandValue() === $saveMe->player->getHandValue()){
            echo "<br> Draw between you and the Bank !";
        } else {
            echo "<br>The Bank have won, sorry... <br>Make a new game by clicking on the RESET button";
        }
    }

}

$_SESSION['saveMe']=serialize($saveMe);