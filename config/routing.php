<?php
return array(array (
     'front_product' => array(
         'path' => '\/front\/product\/([\d]+)',
         'action' => 'ShowProductFront',
         'controller' => 'com:products.controller.Products',
         'is_front'   => true
     ),
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
    'products' => array(
        'path' => '\/([\d]+)\/(ASC|DESC)\/([\d]+)',
        'action' => 'ShowList',
        'controller' => 'com:products.controller.Products'
    ),
    'bucket_add' => array(
        'path' => '\/add',
        'action' => 'AddProduct',
        'controller' => 'com:bucket.controller.Buckets',
        'method'     => 'POST'
    ),
    'ordered' => array(
        'path' => '\/bucket\/(.*)',
        'action' => 'ShowOrdered',
        'controller' => 'com:bucket.controller.Buckets',
        'method'     => 'GET',
        'is_front'   => true
    ),
    'bucket' => array(
        'path' => '\/bucket',
        'action' => 'ShowBucket',
        'controller' => 'com:bucket.controller.Buckets',
        'method'     => 'GET',
        'is_front'   => true
    ),
    'order' => array(
        'path' => '\/bucket',
        'action' => 'Order',
        'controller' => 'com:bucket.controller.Buckets',
        'method'     => 'POST'
    ),
    'category' => array(
        'path' => '\/category\/([\d+])',
        'action' => 'Show',
        'controller' => 'com:products.controller.Categories'
    ),
    'home' => array(
        'path' => '\/',
        'action' => 'ShowAll',
        'controller' => 'com:products.controller.Products',
        'is_front'   => true
    ),
));