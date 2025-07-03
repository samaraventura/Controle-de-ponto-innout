<?php 
require_once __DIR__ . '/../helpers/MessageHelper.php';

function requireValidSession($requiresAdmin = false) {
  $user = $_SESSION['user'];
  if (!isset($user)) {
    header('Location: LoginController.php');
    exit();
  } elseif ($requiresAdmin && !$user->is_admin) {
    addErrorMsg('Acesso negado!');
    header('Location: DayRecordsController.php');
    exit(); // <- Adicione isso aqui
  }
}
