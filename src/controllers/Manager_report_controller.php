<?php
requireValidSession(true);

$activeUsersCount = UserModel::getActiveUserCount();
$absentUsers = WorkingHours::getAbsentUsers();

$yearAndMonth = (new DateTime())->format('Y-m');
$seconds = WorkingHours::getWorkedTimeInMonth($yearAndMonth);
$hoursInMonth =  explode(':', getTimeStringFromSeconds($seconds))[0];

loadTemplateView('Manager_report_view', [
    'activeUsersCount' => $activeUsersCount,
    'absentUsers' => $absentUsers,
    'hoursInMonth' => $hoursInMonth,
]);
