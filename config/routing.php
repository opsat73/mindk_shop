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
    'bucket_test' => array(
        'path' => '\/add',
        'action' => 'AddProduct',
        'controller' => 'com:bucket.controller.Buckets',
        'method'     => 'POST'
    ),
    'ordered' => array(
        'path' => '\/bucket\/(.*)',
        'action' => 'ShowOrdered',
        'controller' => 'com:bucket.controller.Buckets',
        'method'     => 'GET'
    ),
    'bucket' => array(
        'path' => '\/bucket',
        'action' => 'ShowBucket',
        'controller' => 'com:bucket.controller.Buckets',
        'method'     => 'GET'
    ),
    'order' => array(
        'path' => '\/bucket',
        'action' => 'Order',
        'controller' => 'com:bucket.controller.Buckets',
        'method'     => 'POST'
    ),
    'home' => array(
        'path' => '\/',
        'action' => 'ShowList',
        'controller' => 'com:products.controller.Products'
    ),
));