<?php
loadModel('LoginModel');
session_start();
$exception = null;

if (count($_POST) > 0) {
    $login = new Login($_POST);

    try {
        $user = $login->checkLogin(); // pode lançar exceção
        $_SESSION['user'] = $user;
        header("Location: DayRecordsController.php");
    } catch (AppException $e) {
        $exception = $e; // agora será passada para a view
    }
}

loadView('LoginViews', $_POST + ['exception' => $exception]);
