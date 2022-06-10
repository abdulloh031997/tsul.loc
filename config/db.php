<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=192.168.200.122;port=6432;dbname=tsul_akl',
    'username' => 'postgres',
    'password' => 'tandir@123',
    'charset' => 'utf8',
    'emulatePrepare' => true,

    // Schema cache options (for production environment)
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 3600,
    'schemaCache' => 'cache',
];