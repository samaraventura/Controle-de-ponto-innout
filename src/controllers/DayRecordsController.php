<?php
requireValidSession();


$date = new DateTime();

$user = $_SESSION['user'];

$formatter = new IntlDateFormatter(
  'pt_BR',
  IntlDateFormatter::LONG,
  IntlDateFormatter::NONE,
  'America/Sao_Paulo',
  IntlDateFormatter::GREGORIAN,
  "dd 'de' MMMM 'de' yyyy"
);

$today = $formatter->format($date);

$user = $_SESSION['user'];
$userRecords = WorkingHours::loadFromUserAndDate($user->id, date('Y-m-d'));

loadTemplateView(
  'DayRecordsView',
  [
    'today' => $today,
    'userRecords' => $userRecords
  ]
);
