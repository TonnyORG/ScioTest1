<?php
return [
    'propel' => [
        'database' => [
            'connections' => [
                'scio1' => [
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
            'defaultConnection' => 'scio1',
            'connections' => ['scio1']
        ],
        'generator' => [
            'defaultConnection' => 'scio1',
            'connections' => ['scio1']
        ]
    ]
];
?>