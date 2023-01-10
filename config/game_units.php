<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Units
    |--------------------------------------------------------------------------
    |
    | name
    |   Nome da unidade/tropa.
    |
    | description
    |   Breve descrição sobre a unidade/tropa.
    |
    | build_time
    |   Tempo, em segundos, que leva para a unidade/tropa ser recrutada/construída.
    |
    | pop
    |   População necessária para recrutar/construir a unidade/tropa.
    |
    | speed
    |   Tempo, em segundos, com que a unidade/tropa leva para atravessar um campo do mapa.
    |
    | carry
    |   Quantidade de recursos que uma unidade/tropa consegue transportar.
    |
    | min_level
    |   Nível mínimo que uma unidade pode ter.
    |
    | max_level
    |   Nível máximo que uma unidade pode chegar.
    |
    | attack / defense / defense_cavalry / defense_archer
    |   Valores de força da unidade/tropa.
    |
    | wood / clay / iron
    |   Recursos necessários para recrutamento/construção da unidade/tropa.
    |
    | research_wood / research_clay / research_iron
    |   Quantidade base de recursos necessários para pesquisa de melhoria da unidade/tropa.
    |
    | required
    |   Construções (e seus nível), necessárias para liberar o recrutamento/construção/pesquisa do edifício.
    |
    | research_factor
    |   Taxa para o cálculo do aumento do valor de recursos necessários para cada nível de pesquisa.
    |   Seguindo a fórmula: VB * VT
    |   VB (valor_base), VT (valor_taxa)
    |   Exemplo:
    |   Spear 1, research_wood 2560,              research_factor 4
    |   Spear 2, research_wood 10240 (2560  * 4), research_factor 4
    |   Spear 3, research_wood 40960 (10240 * 4), research_factor 4
    |
    | atk_def_factor
    |   Taxa para o cálculo do aumento do valor de ataque, defesa, defesa contra cavalaria e defesa contra arqueiro, para cada nível pesquisado.
    |   Segue a fórmula: VB * VT
    |
    */

    "research_factor" => 4,
    "atk_def_factor"  => 1.25,

    "units"           => [
        /**
         * Lanceiro
         *
         * Recrutado no Quartel/Barracks
         */
        "spear"    => [
            "key"               => "spear",
            "name"              => "Lanceiro",
            "description"       => "O lanceiro é a unidade mais básica. É bom para se defender da cavalaria e para começar a saquear outras aldeias.",

            "build_time"        => 638,
            "pop"               => 1,
            "speed"             => 18,
            "carry"             => 25,
            "min_level"         => 1,
            "max_level"         => 3,

            "attack"            => 10,
            "defense"           => 15,
            "defense_cavalry"   => 45,
            "defense_archer"    => 20,

            "wood"              => 50,
            "clay"              => 30,
            "iron"              => 10,

            "research_wood"     => 2560,
            "research_clay"     => 2240,
            "research_iron"     => 2960,

            "required"          => [],
        ],

        /**
         * Espadachim
         *
         * Recrutado no Quartel/Barracks
         */
        "sword"    => [
            "key"               => "sword",
            "name"              => "Espadachim",
            "description"       => "O espadachim é uma unidade relativamente lenta, eficaz como defesa, especialmente contra a infantaria.",

            "build_time"        => 938,
            "pop"               => 1,
            "speed"             => 22,
            "carry"             => 15,
            "min_level"         => 1,
            "max_level"         => 3,

            "attack"            => 25,
            "defense"           => 50,
            "defense_cavalry"   => 15,
            "defense_archer"    => 40,

            "wood"              => 30,
            "clay"              => 30,
            "iron"              => 70,

            "research_wood"     => 3600,
            "research_clay"     => 3200,
            "research_iron"     => 3120,

            "required"          => [
                "smithy" => 1,
            ],
        ],

        /**
         * Bárbaro
         *
         * Recrutado no Quartel/Barracks
         */
        "axe"      => [
            "key"               => "axe",
            "name"              => "Bárbaro",
            "description"       => "O bárbaro é uma forte unidade ofensiva. Eles facilmente se esquecem de se proteger.",

            "build_time"        => 825,
            "pop"               => 1,
            "speed"             => 18,
            "carry"             => 10,
            "min_level"         => 0,
            "max_level"         => 3,

            "attack"            => 40,
            "defense"           => 10,
            "defense_cavalry"   => 5,
            "defense_archer"    => 10,

            "wood"              => 60,
            "clay"              => 30,
            "iron"              => 40,

            "research_wood"     => 700,
            "research_clay"     => 840,
            "research_iron"     => 820,

            "required"          => [
                "smithy" => 2,
            ],
        ],

        /**
         * Arqueiro
         *
         * Recrutado no Quartel/Barracks
         */
        "archer"   => [
            "key"               => "archer",
            "name"              => "Arqueiro",
            "description"       => "O arqueiro é uma unidade defensiva muito eficaz. Suas flechas destroem até a armadura mais dura.",

            "build_time"        => 1125,
            "pop"               => 1,
            "speed"             => 18,
            "carry"             => 10,
            "min_level"         => 0,
            "max_level"         => 3,

            "attack"            => 15,
            "defense"           => 50,
            "defense_cavalry"   => 40,
            "defense_archer"    => 5,

            "wood"              => 100,
            "clay"              => 30,
            "iron"              => 60,

            "research_wood"     => 640,
            "research_clay"     => 560,
            "research_iron"     => 740,

            "required"          => [
                "barracks" => 5,
                "smithy"   => 5,
            ],
        ],

        /**
         * Espião / explorador / spy / scout
         *
         * ? Pensar em uma unidade ou edifício contra espionagem
         *
         * Recrutado no Estábulo/Stable
         */
        "spy"      => [
            "key"               => "spy",
            "name"              => "Espião",
            "description"       => "O espião se infiltra nas aldeias de seus inimigos para obter informações valiosas.",

            "build_time"        => 562,
            "pop"               => 2,
            "speed"             => 9,
            "carry"             => 0,
            "min_level"         => 0,
            "max_level"         => 3,

            "attack"            => 0,
            "defense"           => 2,
            "defense_cavalry"   => 1,
            "defense_archer"    => 2,

            "wood"              => 50,
            "clay"              => 50,
            "iron"              => 20,

            "research_wood"     => 560,
            "research_clay"     => 480,
            "research_iron"     => 480,

            "required"          => [
                "stable" => 1,
            ],
        ],

        /**
         * Cavalaria leve
         *
         * Recrutado no Estábulo/Stable
         */
        "light"    => [
            "key"               => "light",
            "name"              => "Cavalaria leve",
            "description"       => "A cavalaria leve é uma boa unidade ofensiva. Uma de suas vantagens é a velocidade.",

            "build_time"        => 1125,
            "pop"               => 4,
            "speed"             => 10,
            "carry"             => 80,
            "min_level"         => 0,
            "max_level"         => 3,

            "attack"            => 130,
            "defense"           => 30,
            "defense_cavalry"   => 40,
            "defense_archer"    => 30,

            "wood"              => 125,
            "clay"              => 100,
            "iron"              => 250,

            "research_wood"     => 2200,
            "research_clay"     => 2400,
            "research_iron"     => 2000,

            "required"          => [
                "stable" => 3,
            ],
        ],

        /**
         * Arqueiro a cavalo (mounted archer)
         *
         * Recrutado no Estábulo/Stable
         */
        "marcher"  => [
            "key"               => "marcher",
            "name"              => "Arqueiro a cavalo",
            "description"       => "O arqueiro a cavalo é especialmente útil para desabilitar os arqueiros inimigos nas muralhas.",

            "build_time"        => 1688,
            "pop"               => 5,
            "speed"             => 10,
            "carry"             => 50,
            "min_level"         => 0,
            "max_level"         => 3,

            "attack"            => 120,
            "defense"           => 40,
            "defense_cavalry"   => 30,
            "defense_archer"    => 50,

            "wood"              => 250,
            "clay"              => 100,
            "iron"              => 150,

            "research_wood"     => 3000,
            "research_clay"     => 2400,
            "research_iron"     => 2000,

            "required"          => [
                "stable" => 5,
            ],
        ],

        /**
         * Cavalaria pesada
         *
         * Recrutado no Estábulo/Stable
         */
        "heavy"    => [
            "key"               => "heavy",
            "name"              => "Cavalaria pesada",
            "description"       => "A cavalaria pesada são suas tropas de elite. Os nobres cavaleiros têm armas endurecidas e armaduras fortes.",

            "build_time"        => 2250,
            "pop"               => 6,
            "speed"             => 11,
            "carry"             => 50,
            "min_level"         => 0,
            "max_level"         => 3,

            "attack"            => 150,
            "defense"           => 200,
            "defense_cavalry"   => 80,
            "defense_archer"    => 180,

            "wood"              => 200,
            "clay"              => 150,
            "iron"              => 600,

            "research_wood"     => 3000,
            "research_clay"     => 2400,
            "research_iron"     => 2000,

            "required"          => [
                "stable" => 10,
                "smithy" => 15,
            ],
        ],

        /**
         * Aríete
         *
         * Construído na Oficina/Workshop
         */
        "ram"      => [
            "key"               => "ram",
            "name"              => "Aríete",
            "description"       => "Aríete apóia suas tropas em seus ataques, pois danifica as muralhas de seus inimigos.",

            "build_time"        => 3000,
            "pop"               => 5,
            "speed"             => 30,
            "carry"             => 0,
            "min_level"         => 0,
            "max_level"         => 3,

            "attack"            => 2,
            "defense"           => 20,
            "defense_cavalry"   => 50,
            "defense_archer"    => 20,

            "wood"              => 300,
            "clay"              => 200,
            "iron"              => 200,

            "research_wood"     => 1200,
            "research_clay"     => 1600,
            "research_iron"     => 800,

            "required"          => [
                "workshop" => 1,
            ],
        ],

        /**
         * Catapulta
         *
         * Construído na Oficina/Workshop
         */
        "catapult" => [
            "key"               => "catapult",
            "name"              => "Catapulta",
            "description"       => "As catapultas são especialmente boas para destruir as construções de seus inimigos.",

            "build_time"        => 4500,
            "pop"               => 8,
            "speed"             => 30,
            "carry"             => 0,
            "min_level"         => 0,
            "max_level"         => 3,

            "attack"            => 100,
            "defense"           => 100,
            "defense_cavalry"   => 50,
            "defense_archer"    => 100,

            "wood"              => 320,
            "clay"              => 400,
            "iron"              => 100,

            "research_wood"     => 1600,
            "research_clay"     => 2000,
            "research_iron"     => 1200,

            "required"          => [
                "workshop" => 2,
                "smithy"   => 12,
            ],
        ],

        /**
         * Paladino
         *
         * Recrutado na Estátua/Statue
         */
        "paladin"  => [
            "key"               => "paladin",
            "name"              => "Paladino",
            "description"       => "O paladino protege suas aldeias e as de seus aliados dos ataques inimigos. Cada jogador só pode ter um paladino.",

            "build_time"        => 13500,
            "pop"               => 10,
            "speed"             => 10,
            "carry"             => 100,
            "min_level"         => 1,
            "max_level"         => 1,

            "attack"            => 150,
            "defense"           => 250,
            "defense_cavalry"   => 400,
            "defense_archer"    => 150,

            "wood"              => 200,
            "clay"              => 200,
            "iron"              => 400,

            "research_wood"     => 0,
            "research_clay"     => 0,
            "research_iron"     => 0,

            "required"          => [],
        ],

        /**
         * Nobre
         *
         * Recrutado na Academia/Academy
         */
        "noble"    => [
            "key"               => "noble",
            "name"              => "Nobre",
            "description"       => "Um nobre reduzirá a lealdade das aldeias de seus inimigos. Se sua lealdade for 0 ou menos, você conquista aquela aldeia.",

            "build_time"        => 11250,
            "pop"               => 100,
            "speed"             => 35,
            "carry"             => 0,
            "min_level"         => 1,
            "max_level"         => 1,

            "attack"            => 30,
            "defense"           => 100,
            "defense_cavalry"   => 50,
            "defense_archer"    => 100,

            "wood"              => 40000,
            "clay"              => 50000,
            "iron"              => 50000,

            "research_wood"     => 0,
            "research_clay"     => 0,
            "research_iron"     => 0,

            "required"          => [
                "headquarters" => 20,
                "academy"      => 1,
                "smithy"       => 20,
                "market"       => 10,
            ],
        ],

        /**
         * Milícia
         *
         * Recrutado na Fazenda/Farm
         */
        "militia"  => [
            "key"               => "militia",
            "name"              => "Milícia",
            "description"       => "Se você está esperando um ataque à sua aldeia, pode usar os trabalhadores para montar uma milícia que defenderá sua terra. As milícias só podem ser usadas para fins defensivos e não podem sair da aldeia.",

            "build_time"        => 1,
            "pop"               => 0,
            "speed"             => 0.02,
            "carry"             => 0,
            "min_level"         => 1,
            "max_level"         => 1,

            "attack"            => 0,
            "defense"           => 15,
            "defense_cavalry"   => 45,
            "defense_archer"    => 25,

            "wood"              => 0,
            "clay"              => 0,
            "iron"              => 0,

            "research_wood"     => 0,
            "research_clay"     => 0,
            "research_iron"     => 0,

            "required"          => [
                "farm" => 1,
            ],
        ],
    ],
];
