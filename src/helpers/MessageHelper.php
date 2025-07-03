<?php
function addSuccessMsg($msg) {
    $_SESSION['success_message'] = $msg;
}

function addErrorMsg($msg) {
    $_SESSION['error_message'] = $msg;
}
