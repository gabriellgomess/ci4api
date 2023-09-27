<?php
// Path: app/Controllers/Produtos.php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use Exception;

class Produtos extends ResourceController
{
    private $produtoModel;
    private $token = '123456789';

    public function __construct()
    {
        $this->produtoModel = new \App\Models\ProdutosModel();
    }

    private function _validaToken()
    {
        return $this->request->getHeaderLine('token') === $this->token;
    }

    public function index()
    {
        $data = $this->produtoModel->findAll();
        // Se for vazio
        if (empty($data)) {
            return $this->failNotFound('Nenhum produto encontrado');
        }
        return $this->respond($data);
    }

    public function create()
    {
        if (!$this->_validaToken()) {
            return $this->failUnauthorized();
        }

        $newProduto = $this->request->getPost();

        if (!$this->produtoModel->save($newProduto)) {
            return $this->fail($this->produtoModel->errors());
        }

        return $this->respondCreated(['message' => 'Produto criado com sucesso']);
    }
}
