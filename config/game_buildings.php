<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Buildings
    |--------------------------------------------------------------------------
    |
    | name
    |   Nome do edifício.
    |
    | description
    |   Breve descrição sobre o edifício.
    |
    | min_level
    |   Nível mínimo que um edifício pode ter.
    |
    | max_level
    |   Nível máximo que um edifício pode chegar.
    |
    | wood / clay / iron
    |   Quantidade base de recursos necessários para construção do edifício.
    |
    | wood_factor / clay_factor / iron_factor
    |   Taxa para o cálculo do aumento do valor de recursos necessários para cada nível.
    |   Seguindo a fórmula: VB * VT
    |   VB (valor_base), VT (valor_taxa)
    |   Exemplo:
    |   Main 1, wood 90,               wood_factor 1.26
    |   Main 2, wood 113 (90  * 1.26), wood_factor 1.26
    |   Main 3, wood 142 (113 * 1.26), wood_factor 1.26
    |
    | pop
    |   Quantidade base de população disponível para construção do edifício.
    |
    | pop_factor
    |   Taxa para o cálculo do aumento da quantidade de população necessária para cada nível.
    |   Segue a mesma fórmula: VB * VT
    |
    | build_time
    |   Quantidade base de tempo, em segundos, que leva para o edifício ser construído.
    |
    | build_time_factor
    |   Taxa para o cálculo de aumento do tempo que leva a construção do edifício.
    |   Segue a mesmo fórmula: VB * VT
    |
    | points
    |   Quantidade base de pontos que o jogador recebe por construir um nível do edifício.
    |
    | points_factor
    |   Taxa para o cálculo de aumento da pontuação que o jogador recebe a cada nível que constrir.
    |   Segue a mesma fórmula: VB * VT
    |
    | time
    |   Porcentagem do tempo que o edifício ou tropa levará para ser concluída, baseado no tempo original.
    |
    | time_factor
    |   Taxa para o cálculo de redução do tempo de construção/recrutamento/produção.
    |   Seguindo a fórmula: VB + (VB * VT)
    |
    | required
    |   Construções (e seus nível), necessárias para liberar a construção do edifício.
    |
    | influence / range
    |   Quantidade base de campos no alcance da influência da Igreja ou no alcance da Torre de vigia.
    |
    | influence_factor
    |   Taxa para o cálculo de aumento do alcance da Igreja.
    |   Segue a fórmula: VB * VT
    |
    | range_factor
    |   Taxa para o cálculo de aumento do alcance da Torre de vigia.
    |   Segue a fórmula: VB + VT
    |
    | coins
    |   Quantidade base de recursos necessário para cunhar uma moeda.
    |   Para recrutar nobres, são necessárias moedas.
    |
    | merchants
    |   Quantidade base de mercadores que realizam as transações no Mercado.
    |
    | merchants_factor
    |   Taxa para o cálculo de aumento de quantidade de mercadores disponíveis para transações.
    |
    | production
    |   Quantidade base de produção de recursos por hora.
    |
    | production_factor
    |   Taxa para o cálculo de aumento de produção dos recursos.
    |
    | max_pop
    |   Quantidade base de população que a Fazenda suporta.
    |
    | max_pop_factor
    |   Taxa para o cálculo de aumento de população.
    |
    | capacity
    |   Quantidade base de disponível de armazenamento dos recursos.
    |
    | capacity_factor
    |   Taxa para o cálculo de aumento da capacidade de armazenamento.
    |
    | defense
    |   Quantidade base de defesa bônus, em porcentagem, que a Muralha concede.
    |
    | defense_factor
    |   Taxa para o cálculo de aumento do bõnus de defesa da Muralha.
    |
    */

    /**
     * Edifício principal
     */
    "main"       => [
        "key"               => "main",
        "name"              => "Edifício principal",
        "description"       => "No edifício principal você pode construir ou melhorar outros edifícios. Quanto maior o nível, mais rápida será a construção de edifícios.",

        "min_level"         => 1,
        "max_level"         => 30,
        "wood"              => 90,
        "wood_factor"       => 1.26,
        "clay"              => 80,
        "clay_factor"       => 1.275,
        "iron"              => 70,
        "iron_factor"       => 1.26,
        "pop"               => 5,
        "pop_factor"        => 1.17,
        "build_time"        => 563,
        "build_time_factor" => 1.2,

        "points"            => 10,
        "points_factor"     => 1.2,

        "time"              => 95,
        "time_factor"       => -0.049,

        "required"          => [],
    ],

    /**
     * Quartel
     *
     * Recruta infantaria:
     * spear  / lanceiro
     * sword  / espadachim
     * axe    / bárbaro
     * archer / arqueiro
     */
    "barracks"   => [
        "key"               => "barracks",
        "name"              => "Quartel",
        "description"       => "No Quartel você pode recrutar sua infantaria. Quanto maior o seu nível, mais rapidamente poderão ser recrutadas novas tropas.",

        "min_level"         => 0,
        "max_level"         => 25,
        "wood"              => 200,
        "wood_factor"       => 1.26,
        "clay"              => 170,
        "clay_factor"       => 1.28,
        "iron"              => 90,
        "iron_factor"       => 1.26,
        "pop"               => 7,
        "pop_factor"        => 1.17,
        "build_time"        => 1125,
        "build_time_factor" => 1.2,

        "points"            => 16,
        "points_factor"     => 1.2,

        "time"              => 63,
        "time_factor"       => -0.057,

        "required"          => [
            "main" => 3,
        ],
    ],

    /**
     * Estábulo
     *
     * Recruta cavalaria:
     * spy     / Espião / Explorador
     * light   / Cavalaria leve
     * heavy   / Cavalaria pesada
     * marcher / Arqueiro a cavalo
     */
    "stable"     => [
        "key"               => "stable",
        "name"              => "Estábulo",
        "description"       => "No Estábulo você pode formar novos cavaleiros. Quanto maior o seu nível, mais rapidamente poderão ser recrutadas novas tropas.",

        "min_level"         => 0,
        "max_level"         => 20,
        "wood"              => 270,
        "wood_factor"       => 1.26,
        "clay"              => 240,
        "clay_factor"       => 1.28,
        "iron"              => 260,
        "iron_factor"       => 1.26,
        "pop"               => 8,
        "pop_factor"        => 1.17,
        "build_time"        => 3750,
        "build_time_factor" => 1.2,

        "points"            => 20,
        "points_factor"     => 1.2,

        "time"              => 63,
        "time_factor"       => -0.057,

        "required"          => [
            "main"     => 3,
            "smithy"   => 5,
            "barracks" => 5,
        ],
    ],

    /**
     * Oficina / workshop / garage
     *
     * Produz armas de cerco:
     * ram      / aríete
     * catapult / catapulta
     */
    "workshop"   => [
        "key"               => "workshop",
        "name"              => "Oficina",
        "description"       => "Na Oficina podem ser produzidas máquinas de guerra. Quanto maior for o nível da Oficina, mais rápido serão produzidas novas máquinas.",

        "min_level"         => 0,
        "max_level"         => 15,
        "wood"              => 300,
        "wood_factor"       => 1.26,
        "clay"              => 240,
        "clay_factor"       => 1.28,
        "iron"              => 260,
        "iron_factor"       => 1.26,
        "pop"               => 8,
        "pop_factor"        => 1.17,
        "build_time"        => 3750,
        "build_time_factor" => 1.2,

        "points"            => 24,
        "points_factor"     => 1.2,

        "time"              => 63,
        "time_factor"       => -0.057,

        "required"          => [
            "main"   => 10,
            "smithy" => 10,
        ],
    ],

    /**
     * Igreja
     */
    "church"     => [
        "key"               => "church",
        "name"              => "Igreja",
        "description"       => "A igreja faz com que as tropas das suas aldeias dentro do raio de influência lutem com toda força. Se a sua aldeia não estiver dentro do raio de influência, as tropas dessa aldeia irão lutar com apenas 50% do poder de combate.",

        "min_level"         => 0,
        "max_level"         => 3,
        "wood"              => 16000,
        "wood_factor"       => 1.26,
        "clay"              => 20000,
        "clay_factor"       => 1.28,
        "iron"              => 5000,
        "iron_factor"       => 1.26,
        "pop"               => 5000,
        "pop_factor"        => 1.55,
        "build_time"        => 115613,
        "build_time_factor" => 1.2,

        "points"            => 10,
        "points_factor"     => 1.2,

        "influence"         => 4,
        "influence_factor"  => 1.4,

        "required"          => [
            "main" => 5,
            "farm" => 5,
        ],
    ],

    /**
     * Academia / academy / snob
     *
     * Recruta:
     * noble / nobre
     */
    "academy"    => [
        "key"               => "academy",
        "name"              => "Academia",
        "description"       => "Você pode formar nobres na academia. Nobres permitem que você conquiste outras aldeias reduzindo a lealdade delas.",

        "min_level"         => 0,
        "max_level"         => 3,
        "wood"              => 15000,
        "wood_factor"       => 2,
        "clay"              => 25000,
        "clay_factor"       => 2,
        "iron"              => 10000,
        "iron_factor"       => 2,
        "pop"               => 80,
        "pop_factor"        => 1.17,
        "build_time"        => 366750,
        "build_time_factor" => 1.2,

        "points"            => 512,
        "points_factor"     => 1.2,

        "time"              => 63,
        "time_factor"       => -0.07,

        "coins"             => [
            "wood" => 28000,
            "clay" => 30000,
            "iron" => 25000,
        ],

        "required"          => [
            "main"   => 20,
            "smithy" => 20,
            "market" => 10,
        ],
    ],

    /**
     * Ferreiro - Forja / smith - smithy
     *
     * Pesquisa de melhorias:
     * Infataria
     * Cavalaria
     * Armas de cerco
     */
    "smithy"     => [
        "key"               => "smithy",
        "name"              => "Forja",
        "description"       => "No ferreiro você pode pesquisar e melhorar suas armas. Quanto maior o nível do Ferreiro melhores serão as armas que você poderá pesquisar e menores serão as durações de tais pesquisas.",

        "min_level"         => 0,
        "max_level"         => 20,
        "wood"              => 220,
        "wood_factor"       => 1.26,
        "clay"              => 180,
        "clay_factor"       => 1.275,
        "iron"              => 240,
        "iron_factor"       => 1.26,
        "pop"               => 20,
        "pop_factor"        => 1.17,
        "build_time"        => 3750,
        "build_time_factor" => 1.2,

        "points"            => 19,
        "points_factor"     => 1.2,

        "time"              => 91,
        "time_factor"       => -0.09,

        "required"          => [
            "main"     => 5,
            "barracks" => 1,
        ],
    ],

    /**
     * Praça de reunião
     */
    "place"      => [
        "key"               => "place",
        "name"              => "Praça de reunião",
        "description"       => "Na Praça de Reuniões encontram-se seus guerreiros antes da batalha. Aqui você poderá comandar ataques e mover suas tropas.",

        "min_level"         => 0,
        "max_level"         => 1,
        "wood"              => 10,
        "wood_factor"       => 1.26,
        "clay"              => 40,
        "clay_factor"       => 1.275,
        "iron"              => 30,
        "iron_factor"       => 1.26,
        "pop"               => 0,
        "pop_factor"        => 1.17,
        "build_time"        => 6788,
        "build_time_factor" => 1.2,

        "points"            => 0,
        "points_factor"     => 0,

        "required"          => [],
    ],

    /**
     * Estátua
     *
     * Recruta:
     * paladin / paladino
     */
    "statue"     => [
        "key"               => "statue",
        "name"              => "Estátua",
        "description"       => "Você pode recrutar um paladino na estátua caso você ainda não tenha um nesta aldeia. Conquiste mais aldeias para obter mais paladinos.",

        "min_level"         => 0,
        "max_level"         => 1,
        "wood"              => 220,
        "wood_factor"       => 1.26,
        "clay"              => 220,
        "clay_factor"       => 1.275,
        "iron"              => 220,
        "iron_factor"       => 1.26,
        "pop"               => 10,
        "pop_factor"        => 1.17,
        "build_time"        => 938,
        "build_time_factor" => 1.2,

        "points"            => 24,
        "points_factor"     => 1.2,

        "required"          => [],
    ],

    /**
     * Mercado
     */
    "market"     => [
        "key"               => "market",
        "name"              => "Mercado",
        "description"       => "No mercado, você pode trocar recursos com outros jogadores.",

        "min_level"         => 0,
        "max_level"         => 25,
        "wood"              => 100,
        "wood_factor"       => 1.26,
        "clay"              => 100,
        "clay_factor"       => 1.275,
        "iron"              => 100,
        "iron_factor"       => 1.26,
        "pop"               => 20,
        "pop_factor"        => 1.17,
        "build_time"        => 1688,
        "build_time_factor" => 1.2,

        "points"            => 10,
        "points_factor"     => 1.2,

        "merchants"         => 3,
        "merchants_factor"  => 1.2,

        "required"          => [
            "main"      => 3,
            "warehouse" => 2,
        ],
    ],

    /**
     * Bosque
     */
    "wood"       => [
        "key"               => "wood",
        "name"              => "Madeireira",
        "description"       => "Os lenhadores cortam madeira dos bosques que rodeiam as aldeias. Tal madeira é necessária para o desenvolvimento da própria aldeia, assim como para o fortalecimento do exército. Quanto mais alto o nível dos lenhadores, mais madeira será produzida.",

        "min_level"         => 0,
        "max_level"         => 30,
        "wood"              => 50,
        "wood_factor"       => 1.25,
        "clay"              => 60,
        "clay_factor"       => 1.275,
        "iron"              => 40,
        "iron_factor"       => 1.245,
        "pop"               => 5,
        "pop_factor"        => 1.155,
        "build_time"        => 563,
        "build_time_factor" => 1.2,

        "points"            => 6,
        "points_factor"     => 1.2,

        "production"        => 30,
        "production_factor" => 1.165,

        "required"          => [],
    ],

    /**
     * Poço de barro
     */
    "clay"       => [
        "key"               => "clay",
        "name"              => "Poço de barro",
        "description"       => "No poço de argila trabalham muitos de seus homens afim de prover sua aldeia com a importante argila. Quanto maior for o seu nível, maior será sua capacidade de produção.",

        "min_level"         => 0,
        "max_level"         => 30,
        "wood"              => 65,
        "wood_factor"       => 1.27,
        "clay"              => 50,
        "clay_factor"       => 1.265,
        "iron"              => 40,
        "iron_factor"       => 1.24,
        "pop"               => 10,
        "pop_factor"        => 1.14,
        "build_time"        => 563,
        "build_time_factor" => 1.2,

        "points"            => 6,
        "points_factor"     => 1.2,

        "production"        => 30,
        "production_factor" => 1.165,

        "required"          => [],
    ],

    /**
     * Mina de ferro
     */
    "iron"       => [
        "key"               => "iron",
        "name"              => "Mina de ferro",
        "description"       => "Da mina de ferro é extraído o material chave para as batalhas. Quanto maior for o seu nível, maior será sua capacidade de produção.",

        "min_level"         => 0,
        "max_level"         => 30,
        "wood"              => 75,
        "wood_factor"       => 1.252,
        "clay"              => 65,
        "clay_factor"       => 1.275,
        "iron"              => 70,
        "iron_factor"       => 1.24,
        "pop"               => 10,
        "pop_factor"        => 1.17,
        "build_time"        => 675,
        "build_time_factor" => 1.2,

        "points"            => 6,
        "points_factor"     => 1.2,

        "production"        => 30,
        "production_factor" => 1.165,

        "required"          => [],
    ],

    /**
     * Fazenda
     *
     * Recruta:
     * militia / milícia
     */
    "farm"       => [
        "key"               => "farm",
        "name"              => "Fazenda",
        "description"       => "A Fazenda provê sustento à seus trabalhadores e tropas. Sem o desenvolvimento da Fazenda a sua aldeia não crescerá. Quanto maior o nível da Fazenda, mais habitantes estarão à sua disposição.",

        "min_level"         => 1,
        "max_level"         => 30,
        "wood"              => 45,
        "wood_factor"       => 1.3,
        "clay"              => 40,
        "clay_factor"       => 1.32,
        "iron"              => 30,
        "iron_factor"       => 1.29,
        "pop"               => 0,
        "pop_factor"        => 1,
        "build_time"        => 750,
        "build_time_factor" => 1.2,

        "points"            => 5,
        "points_factor"     => 1.2,

        "max_pop"           => 240,
        "max_pop_factor"    => 1.1812,

        "required"          => [],
    ],

    /**
     * Armazém / warehouse / storage
     */
    "warehouse"  => [
        "key"               => "warehouse",
        "name"              => "Armazém",
        "description"       => "No Armazém são estocados os recursos produzidos pela aldeia. Quanto maior for o nível do Armazém, maior será a sua capacidade de armazenamento.",

        "min_level"         => 1,
        "max_level"         => 30,
        "wood"              => 60,
        "wood_factor"       => 1.265,
        "clay"              => 50,
        "clay_factor"       => 1.27,
        "iron"              => 40,
        "iron_factor"       => 1.245,
        "pop"               => 0,
        "pop_factor"        => 1.15,
        "build_time"        => 638,
        "build_time_factor" => 1.2,

        "points"            => 6,
        "points_factor"     => 1.2,

        "capacity"          => 1000,
        "capacity_factor"   => 1.24,

        "required"          => [],
    ],

    /**
     * Esconderijo
     */
    "hide"       => [
        "key"               => "hide",
        "name"              => "Esconderijo",
        "description"       => "Os recursos no esconderijo não podem ser saqueados. Quanto maior for o nível, mais recursos podem ser escondidos. Os espiões inimigos também não podem descobrir quantos recursos estão guardados no esconderijo.",

        "min_level"         => 0,
        "max_level"         => 10,
        "wood"              => 50,
        "wood_factor"       => 1.25,
        "clay"              => 60,
        "clay_factor"       => 1.25,
        "iron"              => 50,
        "iron_factor"       => 1.25,
        "pop"               => 2,
        "pop_factor"        => 1.17,
        "build_time"        => 1125,
        "build_time_factor" => 1.2,

        "points"            => 5,
        "points_factor"     => 1.2,

        "capacity"          => 150,
        "capacity_factor"   => 1.39,

        "required"          => [],
    ],

    /**
     * Muralha
     */
    "wall"       => [
        "key"               => "wall",
        "name"              => "Muralha",
        "description"       => "A muralha defende a sua aldeia contra as tropas dos seus inimigos. Quanto maior o nível, melhor a defesa básica da sua aldeia. Também aumenta a força defensiva das tropas que estiverem na aldeia.",

        "min_level"         => 0,
        "max_level"         => 20,
        "wood"              => 50,
        "wood_factor"       => 1.26,
        "clay"              => 100,
        "clay_factor"       => 1.275,
        "iron"              => 20,
        "iron_factor"       => 1.26,
        "pop"               => 5,
        "pop_factor"        => 1.17,
        "build_time"        => 2250,
        "build_time_factor" => 1.2,

        "points"            => 8,
        "points_factor"     => 1.2,

        "defense"           => 4,
        "defense_factor"    => 1.188,

        "required"          => [
            "barracks" => 1,
        ],
    ],

    /**
     * Torre de vigia
     *
     * * Cálculo do alcance é valor range + range_factor a cada nível
     */
    "watchtower" => [
        "key"               => "watchtower",
        "name"              => "Torre de vigia",
        "description"       => "A torre de vigia analisa os arredores de sua aldeia para detectar ataques a caminho. Quando o ataque estiver dentro do alcance da torre, você será capaz de ver a unidade mais lenta neste ataque, independente de seu destino final.",

        "min_level"         => 0,
        "max_level"         => 20,
        "wood"              => 12000,
        "wood_factor"       => 1.17,
        "clay"              => 14000,
        "clay_factor"       => 1.17,
        "iron"              => 10000,
        "iron_factor"       => 1.18,
        "pop"               => 500,
        "pop_factor"        => 1.05,
        "build_time"        => 8250,
        "build_time_factor" => 1.2,

        "points"            => 42,
        "points_factor"     => 1.2,

        "range"             => 2,
        "range_factor"      => 1.107,

        "required"          => [
            "main" => 5,
            "farm" => 5,
        ],
    ],

];
