<?php

requireValidSession();

$currentDate = new DateTime();

$user = $_SESSION['user'];
$selectedUserId = $user->id;
$users = null;
if ($user->is_admin) {
    $users = UserModel::get();
    $selectedUserId = isset($_POST['user']) ? $_POST['user'] : $user->id;
}

$selectedPeriod = isset($_POST['period']) ? $_POST['period'] : $currentDate->format('Y-m');

$periods = [];
for ($yearDiff = 0; $yearDiff <= 2; $yearDiff++) {
    $year = date('Y') - $yearDiff;
    $formatter = new IntlDateFormatter(
        'pt_BR',                    // Localização (português do Brasil)
        IntlDateFormatter::NONE,    // Formato da data (nenhum padrão)
        IntlDateFormatter::NONE     // Formato da hora (nenhum padrão)
    );
    $formatter->setPattern('MMMM \'de\' yyyy');  // Ex: "janeiro de 2025"

    for ($month = 12; $month >= 1; $month--) {
        $date = new DateTime("{$year}-{$month}-1");
        $periods[$date->format('Y-m')] = $formatter->format($date);
    }
}

//Obtém os registros de horas trabalhadas do mês
$registries = WorkingHours::getMonthlyReport($selectedUserId, $selectedPeriod);

$report = [];
$workday = 0;
$sumOfWorkedTime = 0;
$lastday = getLastDayOffMonth($currentDate)->format('d');

for ($day = 1; $day <= $lastday; $day++) {
    $date = $currentDate->format('Y-m') . '-' . sprintf('%02d', $day);
    $registry = $registries[$date] ?? null;


    // Contador de dias úteis passados
    if (isPastWorkday($date)) $workday++;


    // Construção do relatório e soma do tempo trabalhado
    if ($registry) {
        $sumOfWorkedTime += $registry->worked_time;
        array_push($report, $registry);
    } else {
        array_push($report, new WorkingHours([
            'work_date' => $date,
            'worked_time' => 0
        ]));
    }
}



$expectedTime = $workday * DAILY_TIME;
$balance = getTimeStringFromSeconds(abs($sumOfWorkedTime - $expectedTime));
$sign = ($sumOfWorkedTime >= $expectedTime) ? '+' : '-';

loadTemplateView(
    'Monthly_report_view',
    [
        'report' => $report,
        'sumOfWorkedTime' => getTimeStringFromSeconds($sumOfWorkedTime),
        'selectedPeriod' => $selectedPeriod,
        'balance' => "{$sign}{$balance}",
        'periods' => $periods,
        'selectedUserId' => $selectedUserId,
        'users' => $users,
    ]
);
