<?php
// pizzeria-php/access_log.php

// Fungsi logging sederhana
function writeLog($level, $message, $context = []) {
    // Set zona waktu agar log akurat (WIB)
    date_default_timezone_set('Asia/Jakarta');
    
    $timestamp = date('Y-m-d H:i:s');
    $contextStr = !empty($context) ? json_encode($context) : '';
    
    // Format log: [Waktu] [Level] Pesan {Context}
    $logEntry = "[$timestamp] [$level] $message $contextStr" . PHP_EOL;
    
    // Simpan ke file app.log di root folder aplikasi container
    // Di Dockerfile kita set WORKDIR /var/www/html, jadi file akan ada di sana
    $logFile = '/var/www/html/app.log';
    
    // Tulis log (FILE_APPEND agar tidak menimpa log lama)
    file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);
}

// Simulasi Mencatat Aktivitas
// Log 1: Informasi halaman diakses
writeLog('INFO', 'Halaman access_log.php diakses oleh pengguna.', [
    'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
    'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown'
]);

// Tampilkan pesan ke layar browser
echo "<h1>Demo Logging Berhasil!</h1>";
echo "<p>Log aktivitas telah disimpan ke file <code>app.log</code> di dalam container.</p>";
echo "<hr>";
echo "<h3>Informasi Terkini:</h3>";
echo "Timestamp: " . date('Y-m-d H:i:s') . "<br>";
echo "IP Address: " . ($_SERVER['REMOTE_ADDR'] ?? 'unknown') . "<br>";
?>
