<?php
// Path: app/Config/Routes.php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Produtos Rest
$routes->resource('produtos');
