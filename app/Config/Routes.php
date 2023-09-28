<?php
// Path: app/Config/Routes.php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


// busca todos os produtos
/**
 * @OA\Schema(
 *     schema="Produtos",
 *     type="array",
 *     @OA\Items(ref="#/components/schemas/Produto")
 * )
 *
 * @OA\Schema(
 *     schema="Produto",
 *     type="object",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="nome", type="string"),
 *     @OA\Property(property="valor", type="number", format="float")
 * )
 */
/**
 * @OA\Get(
 *     path="/produtos",
 *     summary="Lista todos os produtos",
 *     tags={"Produtos"},
 *     @OA\Response(
 *         response=200,
 *         description="Sucesso",
 *         @OA\JsonContent(ref="#/components/schemas/Produtos")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Produtos não encontrados",
 *         @OA\JsonContent(ref="#/components/schemas/Error")
 *     )
 * )
 */
$routes->get('produtos', 'Produtos::index');

// busca por id

/**
 * @OA\Get(
 *     path="/produtos/{id}",
 *     summary="Busca um produto pelo ID",
 *     tags={"Produtos"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Sucesso",
 *         @OA\JsonContent(ref="#/components/schemas/Produto")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Produto não encontrado",
 *         @OA\JsonContent(ref="#/components/schemas/Error")
 *     )
 * )
 */
$routes->get('produtos/(:num)', 'Produtos::show/$1');

// cria um novo produto
/**
 * @OA\Schema(
 *     schema="NewProduto",
 *     type="object",
 *     required={"nome", "valor"},
 *     @OA\Property(property="nome", type="string"),
 *     @OA\Property(property="valor", type="number", format="float")
 * )
 */
/**
 * @OA\Post(
 *     path="/produtos",
 *     summary="Cria um novo produto",
 *     tags={"Produtos"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/NewProduto")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Produto criado com sucesso",
 *         @OA\JsonContent(ref="#/components/schemas/Produto")
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Erro na criação do produto",
 *         @OA\JsonContent(ref="#/components/schemas/Error")
 *     )
 * )
 */
$routes->post('produtos', 'Produtos::create');

// atualiza um produto
/**
 * @OA\Schema(
 *     schema="UpdateProduto",
 *     type="object",
 *     @OA\Property(property="nome", type="string"),
 *     @OA\Property(property="valor", type="number", format="float")
 * )
 */

/**
 * @OA\Put(
 *     path="/produtos/{id}",
 *     summary="Atualiza um produto pelo ID",
 *     tags={"Produtos"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateProduto")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Produto atualizado com sucesso",
 *         @OA\JsonContent(ref="#/components/schemas/Produto")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Produto não encontrado",
 *         @OA\JsonContent(ref="#/components/schemas/Error")
 *     )
 * )
 */
$routes->put('produtos/(:num)', 'Produtos::update/$1');

// deleta um produto
/**
 * @OA\Delete(
 *     path="/produtos/{id}",
 *     summary="Deleta um produto pelo ID",
 *     tags={"Produtos"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Produto deletado com sucesso",
 *         @OA\JsonContent(ref="#/components/schemas/Message")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Produto não encontrado",
 *         @OA\JsonContent(ref="#/components/schemas/Error")
 *     )
 * )
 */
$routes->delete('produtos/(:num)', 'Produtos::delete/$1');
