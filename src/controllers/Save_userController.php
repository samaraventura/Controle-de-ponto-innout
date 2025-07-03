<?php
require_once __DIR__ . '/../helpers/MessageHelper.php';

requireValidSession(true);

$exception = null;
$userData = [];

if (count($_POST) === 0 && isset($_GET['update'])) {

    $user = UserModel::getOne(['id' => $_GET['update']]);
    $userData = $user->getValues();
    $userData['password'] = null;
} elseif (count($_POST) > 0) {

    try {
        $dbUser = new UserModel($_POST);

        if ($dbUser->id) {
            $dbUser->updateUser();
            addSuccessMsg('Usuário alterado com sucesso');
            header('Location: usersController.php');
            exit();
        } else {
            $dbUser->insertUser();
            addSuccessMsg('Usuário cadastrado com sucesso');
             header('Location: usersController.php');
            exit();
        }

        $_POST = [];

    } catch (Exception $e) {
        $exception = $e;
    } finally {
        $userData = $_POST;
    }
}

loadTemplateView('Save_userView', $userData + ['exception' => $exception]);
