<?php
use core\ServiceLocator;
    require_once __DIR__.'/core/initializator.php';

//routing
$router = ServiceLocator::get('serv:router');
$command = $router->processRequest();

$app = ServiceLocator::get('core:Application');
$app->process($command, true);
//processing
//rendering
//output
?>
