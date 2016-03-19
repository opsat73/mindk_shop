<?php
return array(
    'db'           => array(
        'class'           => '\PDO',
        'init_parameters' => array(
            "mysql:host=172.17.0.1;dbname=mindk_shop;",
            "root",
            "root"
        )
    ),
    'router'           => array(
        'class'           => 'core\Router',
        'init_parameters' => BASE_DIR.DS.'config'.DS.'routing.php'
    )
);