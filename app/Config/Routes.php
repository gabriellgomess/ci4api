<?php
// Path: app/Config/Routes.php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


// busca todos os produtos
$routes->get('produtos', 'Produtos::index');

// busca por id
$routes->get('produtos/(:num)', 'Produtos::show/$1');

// cria um novo produto
$routes->post('produtos', 'Produtos::create');

// atualiza um produto
$routes->put('produtos/(:num)', 'Produtos::update/$1');

// deleta um produto
$routes->delete('produtos/(:num)', 'Produtos::delete/$1');
