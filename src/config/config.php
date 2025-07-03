<?php 
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_TIME, 'pt-BR', 'pt_BR.utf-8', 'portuguese');

// constante gerais
define('DAILY_TIME', 60 * 60 * 8);

// PASTAS
define('MODEL_PATH', realpath(dirname(__FILE__) . '/../models'));
define('VIEW_PATH', realpath(dirname(__FILE__) . '/../views'));
define('TEMPLATE_PATH', realpath(dirname(__FILE__) . '/../views/templates'));
define('CONTROLLER_PATH', realpath(dirname(__FILE__) . '/../controllers'));
define('EXCEPTION_PATH', realpath(dirname(__FILE__) . '/../exceptions'));

// arquivos
require_once(realpath(dirname(__FILE__) . '/database.php'));
require_once(realpath(dirname(__FILE__) . '/loader.php'));
require_once(realpath(dirname(__FILE__) . '/Session.php'));
require_once(realpath(dirname(__FILE__) . '/Date_utils.php'));
require_once(realpath(MODEL_PATH. '/BaseModel.php'));
require_once(realpath(MODEL_PATH. '/UserModel.php'));
require_once(realpath(MODEL_PATH. '/WorkingHours.php'));
require_once(realpath(EXCEPTION_PATH. '/AppExceptions.php'));
require_once(realpath(EXCEPTION_PATH. '/ValidationException.php'));