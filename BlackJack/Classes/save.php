<?php

require_once('bank.php');

class saveMyGame{

    public $deck;
    public $player;
    public $bank;

    public function __construct(){
        $this->bank = new Bank();
        $this->deck = new Deck();
        $this->player = new Player();
        $this->deck->shuffle();
    }
}

