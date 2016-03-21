<?php
use core\ServiceLocator;
    require_once __DIR__.'/core/initializator.php';

//routing
$router = ServiceLocator::get('serv:router');
$command = $router->processRequest();
$need_front_controller = $command[need_front_controller];

$app = ServiceLocator::get('core:Application');
echo $app->process($command, $need_front_controller);
//processing
//rendering
//output
?>
