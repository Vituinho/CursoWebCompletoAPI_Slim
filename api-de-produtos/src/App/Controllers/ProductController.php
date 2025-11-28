<?php

namespace App\Controllers;

use App\Models\Produto;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class ProductController
{
    public function getAll(Request $request, Response $response)
    {
        $produtos = Produto::all();
        return $response->withJson($produtos);
    }

    public function getOne(Request $request, Response $response, $args)
    {
        $produto = Produto::find($args['id']);

        if (!$produto) {
            return $response->withJson(['erro' => 'Produto não encontrado'], 404);
        }

        return $response->withJson($produto);
    }

    public function create(Request $request, Response $response)
    {
        $data = $request->getParsedBody();

        $produto = Produto::create($data);

        return $response->withJson($produto, 201);
    }

    public function update(Request $request, Response $response, $args)
    {
        $produto = Produto::find($args['id']);

        if (!$produto) {
            return $response->withJson(['erro' => 'Produto não encontrado'], 404);
        }

        $data = $request->getParsedBody();
        $produto->update($data);

        return $response->withJson($produto);
    }

    public function delete(Request $request, Response $response, $args)
    {
        $produto = Produto::find($args['id']);

        if (!$produto) {
            return $response->withJson(['erro' => 'Produto não encontrado'], 404);
        }

        $produto->delete();

        return $response->withJson(['msg' => 'Produto removido']);
    }
}
