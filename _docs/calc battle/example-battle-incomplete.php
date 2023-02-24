<?php
// Enter your code here, enjoy!

//player 1 troops
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
$player1_losses = array("archers" => 0, "spearmen" => 0, "cavalry" => 0);
$player2_losses = array("archers" => 0, "spearmen" => 0, "cavalry" => 0);

foreach ( $player1_troops as $player1_troop )
{
    foreach ( $player2_troops as $player2_troop )
    {
        // determine damage dealt based on troop attributes
        // p1
        if ( $player1_troop[ "type" ] === "archers" )
        {
            $player1_damage = ( $player1_troop[ "attack" ] * $player1_troop[ "count" ] ) - ( $player2_troop[ "archer_defense"  ] * $player2_troop[ "count" ] );
        }
        else if ( $player1_troop[ "type" ] === "cavalry" )
        {
            $player1_damage = ( $player1_troop[ "attack" ] * $player1_troop[ "count" ] ) - ( $player2_troop[ "cavalry_defense" ] * $player2_troop[ "count" ] );
        } else
        {
            $player1_damage = ( $player1_troop[ "attack" ] * $player1_troop[ "count" ] ) - ( $player2_troop[ "defense"         ] * $player2_troop[ "count" ] );
        }

        // p2
        if ( $player2_troop[ "type" ] === "archers" )
        {
            $player2_damage = ( $player2_troop[ "attack" ] * $player2_troop[ "count" ] ) - ( $player1_troop[ "archer_defense"  ] * $player1_troop[ "count" ] );
        }
        else if ( $player2_troop[ "type" ] === "cavalry" )
        {
            $player2_damage = ( $player2_troop[ "attack" ] * $player2_troop[ "count" ] ) - ( $player1_troop[ "cavalry_defense" ] * $player1_troop[ "count" ] );
        } else
        {
            $player2_damage = ( $player2_troop[ "attack" ] * $player2_troop[ "count" ] ) - ( $player1_troop[ "defense"         ] * $player1_troop[ "count" ] );
        }
    }
}






// ============================================================================================================================

// Define a function to simulate a battle between two players' troops
function simulate_battle($player1_troops, $player2_troops) {
    // Loop through each player's troops
    for ($i = 0; $i < count($player1_troops); $i++) {
        $player1_troop = $player1_troops[$i];
        $player2_troop = $player2_troops[$i];

        // Calculate the damage done by each player's troop to the other player's troop
        $player1_damage = $player1_troop['count'] * $player1_troop['attack'] * (1 - ($player2_troop['defense'] / 100));
        $player2_damage = $player2_troop['count'] * $player2_troop['attack'] * (1 - ($player1_troop['defense'] / 100));

        // Subtract the damage done from each player's troop count
        $player1_troops[$i]['count'] -= round($player2_damage / $player1_troop['cavalry_defense']);
        $player2_troops[$i]['count'] -= round($player1_damage / $player2_troop['cavalry_defense']);
    }

    // Return the resulting troop counts for each player
    return array($player1_troops, $player2_troops);
}

// Define the initial troop counts for each player
$player1_troops = array(
    array("type" => "archers", "count" => 50, "attack" => 15, "defense" => 10, "cavalry_defense" => 5, "archer_defense" => 20),
    array("type" => "spearmen", "count" => 40, "attack" => 10, "defense" => 20, "cavalry_defense" => 15, "archer_defense" => 5),
    array("type" => "cavalry", "count" => 30, "attack" => 20, "defense" => 15, "cavalry_defense" => 10, "archer_defense" => 5)
);

$player2_troops = array(
    array("type" => "archers", "count" => 60, "attack" => 12, "defense" => 8, "cavalry_defense" => 3, "archer_defense" => 18),
    array("type" => "spearmen", "count" => 50, "attack" => 8, "defense" => 15, "cavalry_defense" => 12, "archer_defense" => 3),
    array("type" => "cavalry", "count" => 40, "attack" => 15, "defense" => 10, "cavalry_defense" => 8, "archer_defense" => 5)
);

// Simulate the battle
$final_troops = simulate_battle($player1_troops, $player2_troops);


?>
