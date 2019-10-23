<?php
$arUrlRewrite = [
    [
        'CONDITION' => '#^/catalog/#',
        'RULE' => '',
        'ID' => 'bitrix:catalog',
        'PATH' => '/catalog/index.php',
        'SORT' => 100,
    ],
    [
        'CONDITION' => '#^/articles/#',
        'RULE' => '',
        'ID' => 'bitrix:news',
        'PATH' => '/articles/index.php',
        'SORT' => 200,
    ]
];
