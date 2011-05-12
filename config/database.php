<?php

/**
 * Usually a database environment is desired, so we simply define the configurations here,
 * and then initialize the databases in /config/loaders/my_db_loader.php
 */
 
/**
  * This goes hand in hand with /lib/karui/loader.php, which loads your classes out of
  * /app/models with Loader::model("MyModel");
  */
define('MODEL_NAMESPACE', 'MyModelNamespace');

switch (APP_ENV) {
    case 'development':
        $database_connection = array(
            'dbname'    => 'karui_test',
            'user'      => 'karui',
            'password'  => 'karui',
            'host'      => '127.0.0.1',
            'driver'    => 'pdo_mysql',
        );
        break;
    case 'test':
        $database_connection = array(
            'dbname'    => 'karui_test',
            'user'      => 'karui',
            'password'  => 'karui',
            'host'      => '127.0.0.1',
            'driver'    => 'pdo_mysql',
        );
        break;
    case 'production':
        $database_connection = array(
            'dbname'    => 'karui_prod',
            'user'      => 'karui',
            'password'  => 'karui',
            'host'      => '127.0.0.1',
            'driver'    => 'pdo_mysql',
        );
        break;
}

?>
