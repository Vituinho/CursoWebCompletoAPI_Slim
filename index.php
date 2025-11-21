<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

$app = new \Slim\App(
    ['settings' => ['displayErrorDetails' => true]]
);

/* Container dependency injection */
class Servico {

}

/* Container Pimple */
$container = $app->getContainer();
$container['servico'] = function() {
    return new Servico;
};

$app->get('/servico', function(Request $request, Response $response) {

    $servico = $this->get('servico');
    var_dump($servico);
});

/* Controllers como serviço */
$container = $app->getContainer();
$container['Home'] = function() {
    return new MyApp\controllers\Home( new MyApp\View );
};
$app->get('/usuario', 'Home:index' );

$app->run();

/*

$app->get('/postagens', function(Request $request, Response $response){

    $response->getBody()->write('Listagem de postagens');

    return $response;
});

$app->post('/usuarios/adiciona', function(Request $request, Response $response){

    //Recupera post ($_POST)
    $post = $request->getParsedBody();
    $nome = $post['nome'];
    $email = $post['email'];    

    //Insere no banco de dados

    return $response->getBody()->write($nome . " - " . $email);

});

$app->put('/usuarios/atualiza', function(Request $request, Response $response){

    //Recupera post ($_POST)
    $post = $request->getParsedBody();
    $id = $post['id'];
    $nome = $post['nome'];
    $email = $post['email'];    

    //Atualiza no banco de dados

    return $response->getBody()->write("Sucesso ao atualizar: " . $id);

});

$app->delete('/usuarios/remove/{id}', function(Request $request, Response $response){

    $id = $request->getAttribute('id'); 

    //deleta no banco de dados

    return $response->getBody()->write("Sucesso ao deletar: " . $id);

});

/*

$app->get('/postagens2', function(){

    echo 'Listagem de postagens';

});

$app->get('/usuarios[/{id}]', function($request, $response){
    $id = $request->getAttribute('id');
    echo 'Listagem de usuarios ou ID: ' . $id;

});

$app->get('/postagens[/{ano}[/{mes}]]', function($request, $response){
    $ano = $request->getAttribute('ano');
    $mes = $request->getAttribute('mes');

    echo 'Listagem de postagens ano: ' . $ano . " mes: " . $mes;

});

$app->get('/lista/{itens:.*}', function($request, $response){
    $itens = $request->getAttribute('itens');

    var_dump(explode('/', $itens));

});

$app->get('/blog/postagens/{id}', function($request, $response){
    echo "Listar postagem para um ID ";
})->setName("blog");

$app->get('/meusite', function($request, $response){
    
    $retorno = $this->get("router")->pathFor("blog", ["id" => "10"] );

    echo $retorno;

});

$app->group('/v5', function(){
    
    $this->get('/usuarios', function(){
        echo 'Listagem de usuarios';
    });

    $this->get('/postagens', function(){
        echo 'Listagem de postagens';
    });

});
*/