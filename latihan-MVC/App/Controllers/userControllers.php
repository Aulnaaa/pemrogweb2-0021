<?php
require_once 'App/Models/User.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function index() {
        $users = $this->userModel->getAllUsers();
        require 'App/Views/userView.php';
    }

    public function detail($id) {
        $user = $this->userModel->getUserById($id);
        require 'App/Views/userDetail.php';
    }

    public function edit($id) {
        $user = $this->userModel->getUserById($id);
        require 'App/Views/userEditView.php';
    }

    public function update($id, $name, $email) {
        $this->userModel->updateUser($id, $name, $email);
        header("Location: index.php?action=index");
    }

    public function delete($id) {
        $user = $this->userModel->getUserById($id);
        require 'App/Views/userDeleteView.php';
    }

    public function destroy($id) {
        $this->userModel->deleteUser($id);
        header("Location: index.php?action=index");
    }
}
?>
