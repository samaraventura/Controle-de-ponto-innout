<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/WorkingHours.php';

Database::executeSQL('DELETE FROM working_hours');
Database::executeSQL('DELETE FROM users WHERE id > 5');

function getDayTemplateByOdds($regularRate, $extraRate, $lazyRate)
{
    $regularDayTemplate = [
        'time1' => '08:00:00',
        'time2' => '12:00:00',
        'time3' => '13:00:00',
        'time4' => '17:00:00',
        'worked_time' => DAILY_TIME // 8 horas
    ];

    $extraHourDayTemplate = [
        'time1' => '08:00:00',
        'time2' => '12:00:00',
        'time3' => '13:00:00',
        'time4' => '18:00:00', // 1 hora extra no final do expediente
        'worked_time' => DAILY_TIME + 3600 // 9 horas
    ];

    $lazyDayTemplate = [
        'time1' => '08:30:00', // Começa 30 minutos mais tarde
        'time2' => '12:00:00',
        'time3' => '13:00:00',
        'time4' => '17:00:00',
        'worked_time' => DAILY_TIME - 1800 // 7 horas e 30 minutos
    ];

    $value = rand(0, 100);
    if ($value <=  $regularRate) {
        return $regularDayTemplate;
    
    } else if ($value <= $regularRate + $extraRate) {
        return $extraHourDayTemplate;
    
    } else {
        return $lazyDayTemplate;
    }
}


function populateWorkingHours($userId, $initialDate, $regularRate, $extraRate, $lazyRate)
{
    // converte string para DateTime
    if (is_string($initialDate)) {
        $currentDate = new DateTime($initialDate);
    } else {
        $currentDate = clone $initialDate; // se já for DateTime, copia
    }
    
    $yesterday = new DateTime();
    $yesterday->modify('-1 day');

    while (isBefore($currentDate, $yesterday)) {
        if(!isWeekend($currentDate)) {
            $template  = getDayTemplateByOdds($regularRate, $extraRate, $lazyRate);
            $columns = [
                'user_id' => $userId,
                'work_date' => $currentDate->format('Y-m-d')
            ];

            $columns = array_merge($columns, $template);
            $workingHours = new WorkingHours($columns);
            $workingHours->insert();
        }
        $currentDate = getNextDay($currentDate);
    }
}


$lastMonth = strtotime('first day of last month');
populateWorkingHours(1, date('Y-m-1'), 70, 20, 10);
populateWorkingHours(3, date('Y-m-1', $lastMonth), 20, 75, 5);
populateWorkingHours(4, date('Y-m-1', $lastMonth), 20, 10, 70);

echo "tudo ok";
