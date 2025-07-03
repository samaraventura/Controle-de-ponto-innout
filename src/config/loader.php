<?php 

require_once(realpath(dirname(__FILE__) . '/config.php'));


function loadModel($modelName) {
   require_once(MODEL_PATH) . "/{$modelName}.php";
}

function loadView($viewName, $params = array()) {

    if(count($params) > 0 ) {
        foreach($params as $key => $value) {
          if(strlen($key) > 0) {
            ${$key} = $value;
          }
        }
    }
    require_once(VIEW_PATH) . "/{$viewName}.php";

}
function loadTemplateView($viewName, $params = array()) {

    if(count($params) > 0 ) {
        foreach($params as $key => $value) {
          if(strlen($key) > 0) {
            ${$key} = $value;
          }
        }
    }

    $user = $_SESSION['user'];
    $workingHours = WorkingHours::loadFromUserAndDate($user->id, date('Y-m-d'));
    $workedInterval = $workingHours->getWorkedInterval()->format('%H:%I:%S');
    $exitTime = $workingHours->getExitTime()->format('H:i:s');
    $activeClock = $workingHours->getActiveClock();

    require_once(TEMPLATE_PATH) . "/Header.php";
    require_once(TEMPLATE_PATH) . "/Left.php";
    require_once(VIEW_PATH) . "/{$viewName}.php";
    require_once(TEMPLATE_PATH) . "/Footer.php";

}

function renderTitle($title, $Subtitle, $icon = null) {
  require_once(TEMPLATE_PATH . "/Title.php");
}
 