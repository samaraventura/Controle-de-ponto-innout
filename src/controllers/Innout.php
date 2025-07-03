<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

requireValidSession();


try {
    $user = $_SESSION['user'];
    $today = date('Y-m-d');
    $currentTime = (new DateTime())->format('H:i:s');
    if ($_POST['forcedTime']) {
        $currentTime = $_POST['forcedTime'];
    }
    $record = WorkingHours::loadFromUserAndDate($user->id, $today);
    
    $message = $record->innout($currentTime);
    // ✅ Salva mensagem de sucesso
    $_SESSION['message'] = [
        'type' => 'success',
        'message' => $message
    ];
    

    header('Location: DayRecordsController.php');
    exit;
} catch (AppException $e) {
    $_SESSION['message'] = [
        'type' => 'danger',
        'message' => $e->getMessage()
    ];

    header('Location: DayRecordsController.php');
    exit;
}
