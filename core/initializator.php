<?php

use \core\ServiceLocator;

define(DS, DIRECTORY_SEPARATOR);
define(BASE_DIR, $_SERVER[DOCUMENT_ROOT]);

function loadClass($identificator) {
    $fragments = explode('\\', $identificator);
    $classPath = implode(DS, $fragments);
    $classPath = BASE_DIR.DS.$classPath.'.php';
    require_once($classPath);
}

spl_autoload_register(loadClass);

$app = ServiceLocator::get('core:Application');

