<?php
// src/Controller/UserController.php
include_once('../config/database.php');
include_once('../src/Model/User.php');

class UserController {

    private $user;

    public function __construct($pdo) {
        $this->user = new User($pdo);
    }

    // Obtener todos los usuarios
    public function getUsers() {
        $users = $this->user->getAllUsers();
        echo json_encode($users);
    }

    // Obtener un usuario por ID
    public function getUser($id) {
        $user = $this->user->getUserById($id);
        echo json_encode($user);
    }

    // Crear un nuevo usuario
    public function createUser() {
        $data = json_decode(file_get_contents("php://input"));
        if ($this->user->createUser($data->name, $data->email)) {
            echo json_encode(["message" => "User created successfully"]);
        } else {
            echo json_encode(["message" => "Failed to create user"]);
        }
    }

    // Actualizar un usuario
    public function updateUser($id) {
        $data = json_decode(file_get_contents("php://input"));
        if ($this->user->updateUser($id, $data->name, $data->email)) {
            echo json_encode(["message" => "User updated successfully"]);
        } else {
            echo json_encode(["message" => "Failed to update user"]);
        }
    }

    // Eliminar un usuario
    public function deleteUser($id) {
        if ($this->user->deleteUser($id)) {
            echo json_encode(["message" => "User deleted successfully"]);
        } else {
            echo json_encode(["message" => "Failed to delete user"]);
        }
    }
}
?>
