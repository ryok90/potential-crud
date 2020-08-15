<?php
return [
    'api-tools-content-negotiation' => [
        'selectors' => [],
    ],
    'db' => [
        'adapters' => [],
    ],
    // Configuração pertencente ao local.php
    // Inserido no global.php apenas para intuito de demonstração
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => 'Doctrine\\DBAL\\Driver\\PDOMySql\\Driver',
                'params' => [
                    'host' => 'db',
                    'user' => 'crud',
                    'password' => 'crud',
                    'dbname' => 'crud',
                ],
            ],
        ],
    ],
];
