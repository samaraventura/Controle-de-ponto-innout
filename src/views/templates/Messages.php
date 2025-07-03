<?php
$message = null;
$errors = [];

if (isset($exception)) {
    $message = [
        'type' => 'error',
        'message' => $exception->getMessage()
    ];

    if (get_class($exception) === 'ValidationException') {
        $errors = $exception->getErrors();
    }
}

$alertType = 'success';
if (is_array($message) && ($message['type'] ?? null) === 'error') {
    $alertType = 'danger';
}

if ($message) {
    echo '<div class="my-3 alert alert-' . $alertType . '">';
    echo $message['message'];
    echo '</div>';
}

if (isset($_SESSION['message'])) {
    $type = $_SESSION['message']['type'] ?? 'info';
    $msg = $_SESSION['message']['message'] ?? '';
    echo '<div class="alert alert-' . $type . '">';
    echo $msg;
    echo '</div>';
    unset($_SESSION['message']);
}

if (!empty($_SESSION['success_message'])) {
    echo '<div class="alert alert-success" role="alert">';
    echo $_SESSION['success_message'];
    echo '</div>';
    unset($_SESSION['success_message']);
}

if (!empty($_SESSION['error_message'])) {
    echo '<div class="alert alert-danger" role="alert">';
    echo $_SESSION['error_message'];
    echo '</div>';
    unset($_SESSION['error_message']);
}

?>
