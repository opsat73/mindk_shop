<?php
return array(
    'db'     => array(
        'class'           => '\PDO',
        'init_parameters' => array(
            "mysql:host=172.17.0.1;dbname=mindk_shop;",
            "root",
            "root"
        )
    ),
    'router' => array(
        'class'           => 'core\Router',
        'init_parameters' => BASE_DIR.DS.'config'.DS.'routing.php'
    ),
    'mailer' => array(
        'class'           => 'core\Mailer',
        'init_parameters' => array(
            "smtp.gmail.com",
            "vkorovay@mindk.com",
            "rw4ohV0xvT9j",
            true,
            'tls',
            587
        )
    )
);