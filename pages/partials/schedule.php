<?php
date_default_timezone_set('Asia/Jakarta');

$jadwalSiklus = [
    ['Ilham Ramadhana', 'Fakih Helmi'],
    ['Dicco Linge', 'Lisvindanu'],
    ['Aldi Pradana', 'Hedi Sukur'],
];

$tanggalCari = $_GET['tanggal'] ?? date('Y-m-d');

// Hitung hari dalam siklus
$tanggalAwalSiklus = '2023-11-29';
$selisihHari = strtotime($tanggalCari) - strtotime($tanggalAwalSiklus);
$hariDalamSiklus = count($jadwalSiklus);
$hariKe = ($selisihHari % $hariDalamSiklus + $hariDalamSiklus) % $hariDalamSiklus;

// Jadwal Pencarian
$jadwalPencarian = $jadwalSiklus[$hariKe] ?? [];

// Jadwal Hari Ini
$hariKeHariIni = $hariKe;
$jadwalHariIni = $jadwalSiklus[$hariKeHariIni] ?? [];

// Jadwal Besok
$hariKeBesok = ($hariKe + 1) % $hariDalamSiklus;
$jadwalBesok = $jadwalSiklus[$hariKeBesok] ?? [];

// Jadwal Lusa
$hariKeLusa = ($hariKe + 2) % $hariDalamSiklus;
$jadwalLusa = $jadwalSiklus[$hariKeLusa] ?? [];

// Jadwal 3 Hari Ke Depan
$hariKeDepan1 = ($hariKe + 3) % $hariDalamSiklus;
$hariKeDepan2 = ($hariKe + 4) % $hariDalamSiklus;
$hariKeDepan3 = ($hariKe + 5) % $hariDalamSiklus;
$jadwalDepan1 = $jadwalSiklus[$hariKeDepan1] ?? [];
$jadwalDepan2 = $jadwalSiklus[$hariKeDepan2] ?? [];
$jadwalDepan3 = $jadwalSiklus[$hariKeDepan3] ?? [];

$hasil = [
    'pencarian' => implode(' & ', $jadwalPencarian),
    'hari_ini' => implode(' & ', $jadwalHariIni),
    'besok' => implode(' & ', $jadwalBesok),
    'lusa' => implode(' & ', $jadwalLusa),
    'depan1' => implode(' & ', $jadwalDepan1),
    'depan2' => implode(' & ', $jadwalDepan2),
    'depan3' => implode(' & ', $jadwalDepan3),
];

echo json_encode($hasil);
