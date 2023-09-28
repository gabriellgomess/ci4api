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

    public function show($id = null)
    {
        if (!$this->_validaToken()) {
            return $this->failUnauthorized();
        }

        try {
            $produto = $this->produtoModel->find($id);
            if (empty($produto)) {
                throw new Exception('Produto não encontrado');
            }
            return $this->respond($produto);
        } catch (Exception $e) {
            return $this->failNotFound($e->getMessage());
        }
    }

    public function update($id = null)
    {
        if (!$this->_validaToken()) {
            return $this->failUnauthorized();
        }

        try {
            $produto = $this->produtoModel->find($id);
            if (empty($produto)) {
                throw new Exception('Produto não encontrado');
            }

            $data = json_decode($this->request->getBody(), true);  // Adicionado JSON decode
            if (json_last_error() !== JSON_ERROR_NONE) {           // Verificar se há erro no JSON
                throw new Exception('Erro na decodificação do JSON: ' . json_last_error_msg());
            }

            $data['id'] = $id;

            if (!$this->produtoModel->save($data)) {
                return $this->fail($this->produtoModel->errors());
            }

            return $this->respondUpdated(['message' => 'Produto atualizado com sucesso']);
        } catch (Exception $e) {
            return $this->failNotFound($e->getMessage());
        }
    }

    public function delete($id = null)
    {
        if (!$this->_validaToken()) {
            return $this->failUnauthorized();
        }

        try {
            $produto = $this->produtoModel->find($id);
            if (empty($produto)) {
                throw new Exception('Produto não encontrado');
            }

            if (!$this->produtoModel->delete($id)) {
                return $this->fail($this->produtoModel->errors());
            }

            return $this->respondDeleted(['message' => 'Produto deletado com sucesso']);
        } catch (Exception $e) {
            return $this->failNotFound($e->getMessage());
        }
    }

}
