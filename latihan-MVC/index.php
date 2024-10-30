<?php
require_once 'App/Controllers/userControllers.php';

$controller = new UserController();  // Tidak ada argumen yang diberikan di sini

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

switch ($action) {
    case 'index':
        $controller->index();
        break;
    case 'detail':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id) {
            $controller->detail($id);
        } else {
            echo "ID tidak ditemukan!";
        }
        break;
    default:
        echo "Aksi tidak valid!";
        break;
}
?>
