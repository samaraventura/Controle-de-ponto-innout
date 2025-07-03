<?php
require_once __DIR__ . '/../helpers/MessageHelper.php';

requireValidSession(true);


$exception = null;

if (isset($_GET['delete'])) {
    try {
        UserModel::deleteById($_GET['delete']);
        addSuccessMsg('Usuário excluído com sucesso.');
   
    } catch (Exception $e) {
        
        if (stripos($e->getMessage(), 'FOREIGN KEY')) {
            addErrorMsg('Não é possível excluir o usuário com registros de ponto.');
       
        } else {
            $exception = $e;
        }
    }
}

$users = UserModel::get();
foreach ($users as $user) {
    $user->start_date = (new DateTime($user->start_date))->format('d/m/Y');
    if ($user->end_date) {
        $user->end_date = (new DateTime($user->end_date))->format('d/m/Y');
    }
}

loadTemplateView('UsersView', ['users' => $users, 'exception' => $exception]);
