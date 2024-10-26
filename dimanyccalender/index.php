<?php
// Fungsi untuk membangun kalender
function build_calendar($month, $year) {
    $daysOfWeek = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year); // Hari pertama dalam bulan
    $numberDays = date('t', $firstDayOfMonth); // Mendapatkan jumlah hari dalam bulan
    $dateComponents = getdate($firstDayOfMonth); // Mendapatkan informasi tanggal
    $monthName = $dateComponents['month']; // Nama bulan
    $dayOfWeek = $dateComponents['wday']; // Hari dalam seminggu

    // Tanggal hari ini untuk menyoroti
    $todayDate = date('j');
    $todayMonth = date('n');
    $todayYear = date('Y');
    
    // Header kalender
    $calendar = "<table class='calendar'>";
    $calendar .= "<caption>$monthName $year</caption>";
    $calendar .= "<tr>";

    // Membuat header hari dalam seminggu
    foreach ($daysOfWeek as $day) {
        $calendar .= "<th class='header'>$day</th>";
    }

    $calendar .= "</tr><tr>";

    // Jika bulan tidak mulai pada hari Minggu, kita mengisi dengan sel kosong
    if ($dayOfWeek > 0) {
        for ($k = 0; $k < $dayOfWeek; $k++) {
            $calendar .= "<td class='empty'></td>";
        }
    }

    // Menampilkan hari-hari dalam bulan
    $currentDay = 1;
    while ($currentDay <= $numberDays) {
        // Jika hari dalam minggu adalah 7 (akhir minggu), mulai baris baru
        if ($dayOfWeek == 7) {
            $dayOfWeek = 0;
            $calendar .= "</tr><tr>";
        }

        // Sorot tanggal hari ini
        if ($currentDay == $todayDate && $month == $todayMonth && $year == $todayYear) {
            $calendar .= "<td class='today'>$currentDay</td>";
        } else {
            $calendar .= "<td class='day'>$currentDay</td>";
        }

        $currentDay++;
        $dayOfWeek++;
    }

    // Jika bulan berakhir sebelum akhir minggu, tambahkan sel kosong untuk melengkapi baris
    if ($dayOfWeek != 7) {
        $remainingDays = 7 - $dayOfWeek;
        for ($i = 0; $i < $remainingDays; $i++) {
            $calendar .= "<td class='empty'></td>";
        }
    }

    $calendar .= "</tr>";
    $calendar .= "</table>";
    return $calendar;
}

// Mengatur bulan dan tahun
if (isset($_GET['month']) && isset($_GET['year'])) {
    $month = $_GET['month'];
    $year = $_GET['year'];
} else {
    $month = date('m');
    $year = date('Y');
}

// Fungsi untuk memundurkan dan memajukan bulan
$prev_month = $month - 1;
$prev_year = $year;
if ($prev_month == 0) {
    $prev_month = 12;
    $prev_year--;
}

$next_month = $month + 1;
$next_year = $year;
if ($next_month == 13) {
    $next_month = 1;
    $next_year++;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Calendar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="calendar-container">
    <div class="nav">
        <a href="?month=<?= $prev_month; ?>&year=<?= $prev_year; ?>" class="arrow">&larr;</a>
        <h2><?= date('F', mktime(0, 0, 0, $month, 1, $year)); ?> <?= $year; ?></h2>
        <a href="?month=<?= $next_month; ?>&year=<?= $next_year; ?>" class="arrow">&rarr;</a>
    </div>
    
    <div class="calendar-body">
        <?= build_calendar($month, $year); ?>
    </div>
</div>

</body>
</html>
