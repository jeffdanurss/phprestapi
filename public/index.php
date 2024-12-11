<?php
// public/index.php

header("Content-Type: application/json");
include_once('../config/database.php');
include_once('../src/Controller/UserController.php');

// Obtener la solicitud HTTP
$request_method = $_SERVER["REQUEST_METHOD"];

// Obtener los parámetros de la URL
$request_uri = explode('/', $_SERVER['REQUEST_URI']);
$resource = $request_uri[3] ?? '';  // Por ejemplo, "users"
$id = $request_uri[4] ?? '';  // Si es una solicitud de un solo recurso, por ejemplo, "users/1"

// Inicializar el controlador
$userController = new UserController($pdo);

switch ($request_method) {
    case 'GET':
        if ($resource == 'users' && $id) {
            $userController->getUser($id);
        } elseif ($resource == 'users') {
            $userController->getUsers();
        } else {
            echo json_encode(["message" => "Invalid endpoint"]);
        }
        break;
    case 'POST':
        if ($resource == 'users') {
            $userController->createUser();
        }
        break;
    case 'PUT':
        if ($resource == 'users' && $id) {
            $userController->updateUser($id);
        }
        break;
    case 'DELETE':
        if ($resource == 'users' && $id) {
            $userController->deleteUser($id);
        }
        break;
    default:
        echo json_encode(["message" => "Invalid request method"]);
        break;
}
?>
