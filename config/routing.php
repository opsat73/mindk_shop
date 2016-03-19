<?php
return array(array (
    'product' => array(
        'path' => '\/product\/([\d]+)',
        'action' => 'ShowProduct',
        'controller' => 'com:products.controller.Products'
    ),
    'products' => array(
        'path' => '\/([\d]+)\/(ASC|DESC)\/([\d]+)',
        'action' => 'ShowList',
        'controller' => 'com:products.controller.Products'
    ),

    'home' => array(
    'path' => '\/',
    'action' => 'ShowList',
    'controller' => 'com:products.controller.Products'
)
));