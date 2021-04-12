<?php
require('./vendor/autoload.php');

use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'phpgraphql-db',
    'database'  => 'phpgraphql',
    'username'  => 'root',
    'password'  => 'admin.root',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->setAsGlobal();

$capsule->bootEloquent();

require('./graphql/boot.php');