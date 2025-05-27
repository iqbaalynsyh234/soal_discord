<?php

// ==================== SOAL 1: TOKEN GENERATOR & VERIFIER =====================  //
class TokenManager {
    private static $tokens = [];
    public static function generateToken($user) {
        if (!isset(self::$tokens[$user])) {
            self::$tokens[$user] = [];
        }
        $token = bin2hex(random_bytes(4));
        array_push(self::$tokens[$user], $token);
        if (count(self::$tokens[$user]) > 10) {
            array_shift(self::$tokens[$user]);
        }
        
        return $token;
    }
    
    public static function verifyToken($user, $token) {
        if (!isset(self::$tokens[$user])) {
            return false;
        }
        
        $key = array_search($token, self::$tokens[$user]);
        if ($key !== false) {
            unset(self::$tokens[$user][$key]);
            self::$tokens[$user] = array_values(self::$tokens[$user]);
            return true;
        }
        
        return false;
    }
    
    public static function showTokens() {
        return self::$tokens;
    }
}

// tampil data soal no 1 //
echo "========== SOAL 1: TOKEN MANAGER ==========\n";
$token1 = TokenManager::generateToken("user1");
$token2 = TokenManager::generateToken("user1");
$token3 = TokenManager::generateToken("user2");

echo "Token user1 #1: $token1\n";
echo "Token user1 #2: $token2\n";
echo "Token user2 #1: $token3\n";

echo "Verify token1 user1: " . (TokenManager::verifyToken("user1", $token1) ? "true" : "false") . "\n";
echo "Verify token1 user1 lagi: " . (TokenManager::verifyToken("user1", $token1) ? "true" : "false") . "\n";

print_r(TokenManager::showTokens());

// ==================== SOAL 2: CLASS SISWA & NILAI ====================
class Nilai {
    public $mapel;
    public $nilai;
    
    public function __construct($mapel, $nilai) {
        $this->mapel = $mapel;
        $this->nilai = $nilai;
    }
}

class Siswa {
    public $nrp;
    public $nama;
    public $daftarNilai;
    
    public function __construct($nrp, $nama) {
        $this->nrp = $nrp;
        $this->nama = $nama;
        $this->daftarNilai = array_fill(0, 3, null); // Array dengan panjang 3
    }
    
    public function setNilai($index, $mapel, $nilai) {
        if ($index >= 0 && $index < 3) {
            $this->daftarNilai[$index] = new Nilai($mapel, $nilai);
        }
    }
}

function generateRandomString($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

// Test Soal 2
echo "\n========== SOAL 2: CLASS SISWA & NILAI ==========\n";
$siswa1 = new Siswa("001", "John Doe");
$siswa1->setNilai(0, "inggris", 100);

echo "Siswa: {$siswa1->nama}, NRP: {$siswa1->nrp}\n";
echo "Nilai: {$siswa1->daftarNilai[0]->mapel} = {$siswa1->daftarNilai[0]->nilai}\n\n";

// Generate 10 siswa random
$daftarSiswa = [];
$mapelOptions = ['inggris', 'indonesia', 'jepang'];

for ($i = 1; $i <= 10; $i++) {
    $nrp = str_pad($i, 3, "0", STR_PAD_LEFT);
    $nama = generateRandomString(10);
    $siswa = new Siswa($nrp, $nama);
    
    for ($j = 0; $j < 3; $j++) {
        $mapel = $mapelOptions[array_rand($mapelOptions)];
        $nilai = rand(0, 100);
        $siswa->setNilai($j, $mapel, $nilai);
    }
    
    $daftarSiswa[] = $siswa;
    
    echo "Siswa $i: {$siswa->nama} (NRP: {$siswa->nrp})\n";
    for ($j = 0; $j < 3; $j++) {
        if ($siswa->daftarNilai[$j]) {
            echo "  - {$siswa->daftarNilai[$j]->mapel}: {$siswa->daftarNilai[$j]->nilai}\n";
        }
    }
}

// ==================== SOAL 3: TRAFFIC LIGHT FUNCTION ====================
class TrafficLight {
    private static $colors = ['merah', 'kuning', 'hijau'];
    private static $currentIndex = -1;
    
    public static function getNextColor() {
        self::$currentIndex = (self::$currentIndex + 1) % 3;
        return self::$colors[self::$currentIndex];
    }
    
    public static function reset() {
        self::$currentIndex = -1;
    }
}

// Test Soal 3
echo "\n========== SOAL 3: TRAFFIC LIGHT ==========\n";
TrafficLight::reset();
for ($i = 1; $i <= 7; $i++) {
    echo "Panggilan ke-$i: " . TrafficLight::getNextColor() . "\n";
}

// ==================== SOAL 4: NILAI TERBESAR KEDUA ====================
function getNilaiTerbesarKedua($array) {
    if (count($array) < 2) {
        return null;
    }
    
    $uniqueValues = array_unique($array);
    rsort($uniqueValues);
    
    return isset($uniqueValues[1]) ? $uniqueValues[1] : null;
}

// Test Soal 4
echo "\n========== SOAL 4: NILAI TERBESAR KEDUA ==========\n";
$randomIntegers = [];
for ($i = 0; $i < 5; $i++) {
    $randomIntegers[] = rand(1, 100);
}

echo "Array: " . implode(", ", $randomIntegers) . "\n";
echo "Nilai terbesar kedua: " . getNilaiTerbesarKedua($randomIntegers) . "\n";

// ==================== SOAL 5: KARAKTER TERBANYAK ====================
function getKarakterTerbanyak($kata) {
    $karakterCount = [];
    
    // Hitung kemunculan setiap karakter
    for ($i = 0; $i < strlen($kata); $i++) {
        $char = $kata[$i];
        if (!isset($karakterCount[$char])) {
            $karakterCount[$char] = 0;
        }
        $karakterCount[$char]++;
    }

    $maxCount = 0;
    $maxChar = '';
    
    foreach ($karakterCount as $char => $count) {
        if ($count > $maxCount) {
            $maxCount = $count;
            $maxChar = $char;
        }
    }
    
    return "$maxChar {$maxCount}x";
}

// Test Soal 5
echo "\n========== SOAL 5: KARAKTER TERBANYAK ==========\n";
$testWords = ['wellcome', 'strawberry', 'programming'];

foreach ($testWords as $word) {
    echo "Input: '$word' -> Output: '" . getKarakterTerbanyak($word) . "'\n";
}

// ==================== SOAL 6: REPORT SYSTEM ====================
class ReportSystem {
    private $transactions = [];
    
    public function __construct() {
        $this->transactions = [
            ['id' => 'A', 'incoming' => 1000, 'outgoing' => 0, 'diff' => 1000, 'created' => '2025-04-22 23:59:20', 'updated' => '2025-04-23 12:01:01'],
            ['id' => 'B', 'incoming' => 1000, 'outgoing' => 0, 'diff' => 1000, 'created' => '2025-04-23 12:01:45', 'updated' => '2025-04-23 12:03:10'],
            ['id' => 'C', 'incoming' => 1000, 'outgoing' => 0, 'diff' => 1000, 'created' => '2025-04-23 12:03:00', 'updated' => null],
            ['id' => 'D', 'incoming' => 1000, 'outgoing' => 3000, 'diff' => -2000, 'created' => '2025-04-23 12:10:00', 'updated' => '2025-04-23 12:14:55'],
            ['id' => 'E', 'incoming' => 2000, 'outgoing' => 500, 'diff' => 1500, 'created' => '2025-04-23 00:15:50', 'updated' => '2025-04-23 00:16:20'],
            ['id' => 'F', 'incoming' => 2000, 'outgoing' => 2000, 'diff' => 0, 'created' => '2025-04-23 00:19:00', 'updated' => '2025-04-23 00:32:18'],
            ['id' => 'G', 'incoming' => 2000, 'outgoing' => 5000, 'diff' => -3000, 'created' => '2025-04-23 00:22:11', 'updated' => '2025-04-23 00:23:55'],
            ['id' => 'H', 'incoming' => 2000, 'outgoing' => 0, 'diff' => 2000, 'created' => '2025-04-23 00:28:00', 'updated' => null],
            ['id' => 'I', 'incoming' => 2000, 'outgoing' => 5000, 'diff' => -3000, 'created' => '2025-04-23 00:30:17', 'updated' => '2025-04-23 00:30:22'],
            ['id' => 'J', 'incoming' => 2000, 'outgoing' => 0, 'diff' => 2000, 'created' => '2025-04-23 00:35:15', 'updated' => null],
        ];
    }
    
    public function generateReport($snapshotTime) {
        $reportStartTime = $this->getRoundedTime($snapshotTime, -15); // 15 menit sebelumnya
        $reportEndTime = $snapshotTime;
        
        $reportData = [];
        $totalIncoming = 0;
        $totalOutgoing = 0;
        
        foreach ($this->transactions as $trx) {
            // Gunakan updated time jika ada, kalau tidak pakai created time
            $effectiveTime = $trx['updated'] ? $trx['updated'] : $trx['created'];
            
            // Cek apakah transaksi masuk dalam interval report
            if ($effectiveTime >= $reportStartTime && $effectiveTime <= $reportEndTime) {
                $reportData[] = [
                    'id' => $trx['id'],
                    'start_interval' => $reportStartTime,
                    'end_interval' => $reportEndTime,
                    'incoming' => $trx['incoming'],
                    'outgoing' => $trx['outgoing'],
                    'diff' => $trx['diff']
                ];
                
                $totalIncoming += $trx['incoming'];
                $totalOutgoing += $trx['outgoing'];
            }
        }
        
        return [
            'snapshot_time' => $snapshotTime,
            'start_interval' => $reportStartTime,
            'end_interval' => $reportEndTime,
            'data' => $reportData,
            'total_incoming' => $totalIncoming,
            'total_outgoing' => $totalOutgoing,
            'total_diff' => $totalIncoming - $totalOutgoing
        ];
    }
    
    private function getRoundedTime($time, $minuteOffset = 0) {
        $timestamp = strtotime($time);
        $minutes = date('i', $timestamp);
        $roundedMinutes = floor($minutes / 15) * 15 + $minuteOffset;
        
        if ($roundedMinutes < 0) {
            $roundedMinutes = 45;
            $timestamp -= 3600; // kurangi 1 jam
        }
        
        return date('Y-m-d H:' . str_pad($roundedMinutes, 2, '0', STR_PAD_LEFT) . ':00', $timestamp);
    }
    
    public function printReport($report) {
        echo "Snapshot: " . date('d-m-Y H:i:s', strtotime($report['snapshot_time'])) . "\n";
        echo "Interval: {$report['start_interval']} to {$report['end_interval']}\n";
        echo str_repeat("-", 70) . "\n";
        printf("%-5s %-12s %-12s %-8s\n", "ID", "Incoming", "Outgoing", "Diff");
        echo str_repeat("-", 70) . "\n";
        
        foreach ($report['data'] as $row) {
            printf("%-5s %-12s %-12s %-8s\n", 
                $row['id'], 
                number_format($row['incoming']), 
                number_format($row['outgoing']), 
                number_format($row['diff'])
            );
        }
        
        echo str_repeat("-", 70) . "\n";
        printf("SUM   %-12s %-12s %-8s\n", 
            number_format($report['total_incoming']), 
            number_format($report['total_outgoing']), 
            number_format($report['total_diff'])
        );
        echo "\n";
    }
}

// Test Soal 6
echo "\n========== SOAL 6: REPORT SYSTEM ==========\n";
$reportSystem = new ReportSystem();

// generate report by system time
$snapshotTimes = [
    '2025-04-23 00:15:00',
    '2025-04-23 00:30:00', 
    '2025-04-23 00:45:00'
];

foreach ($snapshotTimes as $snapshotTime) {
    $report = $reportSystem->generateReport($snapshotTime);
    $reportSystem->printReport($report);
}

?>