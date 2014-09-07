<?php

return [
    'propel' => [
        'database' => [
            'connections' => [
                'propel_scio1' => [
                    'adapter'    => 'mysql',
                    'classname'  => 'Propel\Runtime\Connection\ConnectionWrapper',
                    'dsn'        => 'mysql:host=localhost;dbname=propel_scio1',
                    'user'       => 'root',
                    'password'   => '',
                    'attributes' => []
                ]
            ]
        ],
        'runtime' => [
            'defaultConnection' => 'propel_scio1',
            'connections' => ['propel_scio1']
        ],
        'generator' => [
            'defaultConnection' => 'propel_scio1',
            'connections' => ['propel_scio1']
        ]
    ]
];