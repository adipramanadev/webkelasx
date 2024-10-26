<?php

// Memuat data JSON dari file
$jsonData = file_get_contents('messages.json');
$messages = json_decode($jsonData, true);

// Variabel untuk menyimpan data analisis
$totalSentMessages = 0;
$totalReceivedMessages = 0;
$totalSentCharacters = 0;
$totalReceivedCharacters = 0;
$wordCount = [];

// Memproses setiap pesan
foreach ($messages as $message) {
    $type = $message['type'];
    $content = $message['message'];
    $contentLength = strlen($content);

    // Memisahkan kata-kata dan menghitung frekuensi untuk pesan terkirim
    if ($type === 'sent') {
        $totalSentMessages++;
        $totalSentCharacters += $contentLength;

        $words = str_word_count(strtolower($content), 1);
        foreach ($words as $word) {
            if (isset($wordCount[$word])) {
                $wordCount[$word]++;
            } else {
                $wordCount[$word] = 1;
            }
        }
    } elseif ($type === 'received') {
        $totalReceivedMessages++;
        $totalReceivedCharacters += $contentLength;
    }
}

// Menghitung rata-rata panjang karakter
$averageSentLength = $totalSentMessages > 0 ? round($totalSentCharacters / $totalSentMessages) : 0;
$averageReceivedLength = $totalReceivedMessages > 0 ? round($totalReceivedCharacters / $totalReceivedMessages) : 0;

// Mengurutkan kata yang paling sering muncul dalam pesan terkirim
arsort($wordCount);
$topWords = array_slice($wordCount, 0, 5);

// Menampilkan hasil
echo "<h2>Chat Analytics</h2>";
echo "<ul>";
echo "<li><strong>Top 5 sent words:</strong>";
echo "<ul>";
foreach ($topWords as $word => $count) {
    echo "<li>$word ($count x)</li>";
}
echo "</ul></li>";
echo "<li>Total messages sent: $totalSentMessages</li>";
echo "<li>Total messages received: $totalReceivedMessages</li>";
echo "<li>Average characters length sent: $averageSentLength</li>";
echo "<li>Average characters length received: $averageReceivedLength</li>";
echo "</ul>";
