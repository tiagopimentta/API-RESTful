<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require 'vendor/autoload.php';

//Arquivo de configuração com o banco de dados
require 'config.php';

$app = new Slim\App(["settings" => $config]);

/*CONEXÃO COM BD*/
$container = $app->getContainer();
$container['db'] = function ($bd) {   
  try{
    $db = $bd['settings']['db'];
    $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC );
    $pdo = new PDO("mysql:host=" . $db['servername'] . ";dbname=" . $db['dbname'],
    $db['username'], $db['password'],$options);
    return $pdo;
  }catch(\Exception $ex){
    return $ex->getMessage();
  }   
};

/*Lista todos os repositórios*/
//endpoint aqui GET
$app->get('/lista', function (Request $request, Response $response) {  

  $con = $this->db;
  $query = "SELECT * FROM repositorios ";
  $Query  = $con->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
  $Query->execute();
  $result = $Query->fetchAll(PDO::FETCH_ASSOC);  
  return $response->withJson(array($result),200);   
 
});

/*Lista somente 1 repositorio*/

$app->get('/lista/{id}', function (Request $request, Response $response) {  

  $con = $this->db;
  $id = $request->getAttribute('id');
  $query = "SELECT * FROM repositorios where id = :id  ";
  $Query  = $con->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
  $values = array(
    ':id' => $id      
  );
  $Query->execute($values);    
  $result = $Query->fetch();  
  return $response->withJson(array($result),200); 
 
});

/*Cadastra repositorio*/
$app->post('/cadastra/{nome}', function (Request $request, Response $response) {
 
  $nomeRepositorio = $request->getAttribute('nome');
               
  $con = $this->db;

  $query = "INSERT INTO repositorios(nome) VALUES (:nome) ";

  $Query  = $con->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
  $values = array(
    ':nome' => $nomeRepositorio    
  );
  $Query->execute($values);
  $result = $this->db->lastInsertId();
  return $response->withJson(array($result),200); 

});

/*Deleta repositorio*/
$app->delete('/delete/{id}', function (Request $request, Response $response) {
 
  $idRepositorio = $request->getAttribute('id');
               
  $con = $this->db;

  $query = "DELETE FROM repositorios where id = :id ";

  $Query  = $con->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
  $values = array(
    ':id' => $idRepositorio    
  );
  if($Query->execute($values)){
    return $response->withJson(array(true),200); 
  }else{
    return $response->withJson(array(false),400); 
  }
});

/*Altera repositorio*/
$app->put('/altera/{id}/{nome}', function (Request $request, Response $response) {
 
  $idRepositorio = $request->getAttribute('id');
  $novoNome = $request->getAttribute('nome');
               
  $con = $this->db;

  $query = "UPDATE repositorios SET nome = :nome where id = :id ";

  $Query  = $con->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
  $values = array(
    ':id' => $idRepositorio,
    ':nome' => $novoNome
  );
  if($Query->execute($values)){
    return $response->withJson(array(true),200); 
  }else{
    return $response->withJson(array(false),400); 
  }
});

$app->run();