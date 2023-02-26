<?php

// Define a class for a troop type
class TroopType {
    public $name;
    public $attack;
    public $defense;
    public $cavalry_defense;
    public $archer_defense;

    public function __construct($name, $attack, $defense, $cavalry_defense, $archer_defense) {
        $this->name = $name;
        $this->attack = $attack;
        $this->defense = $defense;
        $this->cavalry_defense = $cavalry_defense;
        $this->archer_defense = $archer_defense;
    }
}

// Define a class for a troop
class Troop {
    public $type;
    public $count;

    public function __construct($type, $count) {
        $this->type = $type;
        $this->count = $count;
    }
}

// Define a class for a player's troops
class PlayerTroops {
    public $troops;

    public function __construct($troop_types, $counts) {
        $this->troops = array();
        foreach ($troop_types as $i => $troop_type) {
            $this->troops[] = new Troop($troop_type, $counts[$i]);
        }
    }

    public function get_troop_counts() {
        $counts = array();
        foreach ($this->troops as $troop) {
            $counts[] = $troop->count;
        }
        return $counts;
    }

    public function set_troop_counts($counts) {
        foreach ($this->troops as $i => $troop) {
            $this->troops[$i]->count = $counts[$i];
        }
    }

    public function get_troop_type($type_name) {
        foreach ($this->troops as $troop) {
            if ($troop->type->name == $type_name) {
                return $troop;
            }
        }
        return null;
    }

    public function get_total_count() {
        $total = 0;
        foreach ($this->troops as $troop) {
            $total += $troop->count;
        }
        return $total;
    }
}

class BattleSimulator {

    public static function simulate(PlayerTroops $player1_troops, PlayerTroops $player2_troops) {
        // Loop through each player's troops
        for ($i = 0; $i < count($player1_troops->troops); $i++) {
            $player1_troop = $player1_troops->troops[$i];
            $player2_troop = $player2_troops->troops[$i];

            // Calculate the damage done by each player's troop to the other player's troop
            $player1_damage = $player1_troop->count * $player1_troop->type->attack * (1 - ($player2_troop->type->defense / 100));
            $player2_damage = $player2_troop->count * $player2_troop->type->attack * (1 - ($player1_troop->type->defense / 100));

            // Subtract the damage done from each player's troop count
            $player1_troops->troops[$i]->count -= round($player2_damage / $player1_troop->type->defense);
            $player2_troops->troops[$i]->count -= round($player1_damage / $player2_troop->type->defense);

            // Ensure troop counts are not negative
            if ($player1_troops->troops[$i]->count < 0) {
                $player1_troops->troops[$i]->count = 0;
            }
            if ($player2_troops->troops[$i]->count < 0) {
                $player2_troops->troops[$i]->count = 0;
            }
        }

        // Determine the winner of the battle
        if ($player1_troops->get_total_count() > $player2_troops->get_total_count()) {
            return 1;
        } elseif ($player2_troops->get_total_count() > $player1_troops->get_total_count()) {
            return 2;
        } else {
            return 0;
        }
    }
}

?>
