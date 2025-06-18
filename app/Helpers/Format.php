<?php

namespace App\Helpers;

class Format
{
    public static function rupiah($angka)
    {
        if ($angka >= 1_000_000) {
            return 'Rp ' . number_format($angka / 1_000_000, 1, ',', '.') . ' jt';
        } elseif ($angka >= 1_000) {
            return 'Rp ' . number_format($angka / 1_000, 1, ',', '.') . ' rb';
        }
        return 'Rp ' . number_format($angka, 0, ',', '.');
    }

    public static function tanggalIndo($tanggal, $denganHari = false)
    {
        if (!$tanggal || !strtotime($tanggal)) return '-';

        $bulan = [
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        $hari = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        ];

        $timestamp = strtotime($tanggal);
        $tgl = date('j', $timestamp);
        $bln = $bulan[(int)date('m', $timestamp)];
        $thn = date('Y', $timestamp);
        $namaHari = $hari[date('l', $timestamp)];

        return $denganHari ? "$namaHari, $tgl $bln $thn" : "$tgl $bln $thn";
    }

    public static function waktu($waktu)
    {
        return date('H:i', strtotime($waktu)) . ' WIB';
    }

    public static function tanggalDanWaktu($datetime)
    {
        return self::tanggalIndo($datetime) . ' - ' . self::waktu($datetime);
    }

    public static function durasi($menit)
    {
        $jam = floor($menit / 60);
        $sisaMenit = $menit % 60;

        if ($jam > 0 && $sisaMenit > 0) {
            return "$jam jam $sisaMenit menit";
        } elseif ($jam > 0) {
            return "$jam jam";
        }
        return "$sisaMenit menit";
    }

    public static function relatif($datetime)
    {
        $timestamp = strtotime($datetime);
        $selisih = time() - $timestamp;

        if ($selisih < 60) return 'baru saja';
        if ($selisih < 3600) return floor($selisih / 60) . ' menit yang lalu';
        if ($selisih < 86400) return floor($selisih / 3600) . ' jam yang lalu';
        if ($selisih < 604800) return floor($selisih / 86400) . ' hari yang lalu';
        if ($selisih < 2592000) return floor($selisih / 604800) . ' minggu yang lalu';
        if ($selisih < 31536000) return floor($selisih / 2592000) . ' bulan yang lalu';
        return floor($selisih / 31536000) . ' tahun yang lalu';
    }
}

//