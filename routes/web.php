<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response) {
    $response->getBody()->write("Hello world!");
    return $response;
});

$app->get('/friends/all', function (Request $request, Response $response) {
    $sql = "SELECT * FROM posteos";
    try {
        // genero la conexion a la base de datos
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $friends = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;

        $response->getBody()->write(json_encode($friends));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    } catch (PDOException $e) {
        echo '{"error": {"text": ' . $e->getMessage() . '}';
    }
});

$app->get('/friends/{id}', function (Request $request, Response $response, $args) {
    $sql = "SELECT * FROM posteos WHERE id = $args[id]";
    try {
        // genero la conexion a la base de datos
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $friends = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;

        $response->getBody()->write(json_encode($friends));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    } catch (PDOException $e) {
        echo '{"error": {"text": ' . $e->getMessage() . '}';
    }
});

$app->post('/friends/add', function (Request $request, Response $response, array $args) {
    $data = $request->getHeader('Accept') ?? ["titulo" => "titulo", "texto" => "texto"];
    // $data = [];
    $response->getBody()->write(json_encode($data));
    return  $response;
    // $texto = $request->getParam("texto");
    // $fecha_alta = date("Y-m-d H:i:s");

    // $sql = "INSERT INTO posteos (titulo, texto, fecha_alta) VALUES (:titulo, :texto, :fecha)";
    // try {
    //     // genero la conexion a la base de datos
    //     $db = new db();
    //     // Connect
    //     $db = $db->connect();

    //     $stmt = $db->prepare($sql);
    //     $stmt->bindParam(':titulo', $titulo);
    //     $stmt->bindParam(':texto', $texto);
    //     $stmt->bindParam(':fecha', $fecha_alta);

    //     $result = $stmt->execute();

    //     $db = null;

    //     $response->getBody()->write(json_encode($result));
    //     return $response
    //         ->withHeader('Content-Type', 'application/json')
    //         ->withStatus(200);
    // } catch (PDOException $e) {
    //     echo '{"error": {"text": ' . $e->getMessage() . '}';
    // }
});
