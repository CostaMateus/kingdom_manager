<?php
// player 1 troops
$player1_troops = array(
    array("type" => "archers", "count" => 50, "attack" => 15, "defense" => 10, "cavalry_defense" => 5, "archer_defense" => 20),
    array("type" => "spearmen", "count" => 40, "attack" => 10, "defense" => 20, "cavalry_defense" => 15, "archer_defense" => 5),
    array("type" => "cavalry", "count" => 30, "attack" => 20, "defense" => 15, "cavalry_defense" => 10, "archer_defense" => 5)
);

// player 2 troops
$player2_troops = array(
    array("type" => "archers", "count" => 60, "attack" => 12, "defense" => 8, "cavalry_defense" => 3, "archer_defense" => 18),
    array("type" => "spearmen", "count" => 50, "attack" => 8, "defense" => 15, "cavalry_defense" => 12, "archer_defense" => 3),
    array("type" => "cavalry", "count" => 40, "attack" => 18, "defense" => 12, "cavalry_defense" => 8, "archer_defense" => 3)
);

// simulate battle
$player1_losses = 0;
$player2_losses = 0;

foreach ($player1_troops as $player1_troop) {
    foreach ($player2_troops as $player2_troop) {
        // determine damage dealt based on troop attributes
        $player1_damage = ($player1_troop["attack"] * $player1_troop["count"]) - ($player2_troop["defense"] * $player2_troop["count"]);
        $player2_damage = ($player2_troop["attack"] * $player2_troop["count"]) - ($player1_troop["defense"] * $player1_troop["count"]);

        // determine losses based on damage dealt
        $player1_losses += ($player1_damage / $player1_troop["count"]);
        $player2_losses += ($player2_damage / $player2_troop["count"]);
    }
}

// determine winner
if ($player1_losses > $player2_losses) {
    echo "Player 2 wins!\n";
} else {
    echo "Player 1 wins!\n";
}

// output final losses
echo "Player 1 losses: " . $player1_losses . "\n";
echo "Player 2 losses: " . $player2_losses . "\n";
?>