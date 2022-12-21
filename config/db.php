<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=secret_server',
    'username' => 'root',
    'password' => '',
    'attributes' => [PDO::ATTR_CASE => PDO::CASE_LOWER],
    'charset' => 'utf8',
];