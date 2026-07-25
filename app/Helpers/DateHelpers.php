<?php
namespace App\Helpers;
class DateHelpers
{
    private static $months = ['Muharram', 'Safar', "Rabi'ul Awal", "Rabi'ul akhir", 'Jumadil Awal', 'Jumadil Akhir', 'Rajab', "Sya'ban", 'Ramadhan', 'Syawal', 'Dzulqaidah', 'Dzulhijjah'];
    public static function tgl_indo($tanggal)
    {
        $tgl = date('Y-m-d',strtotime($tanggal));
        $bulan = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];
        $pecahkan = explode('-', $tgl);

        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun

        return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
    }

    public static function gregorianToJulian($year, $month, $day)
    {
        if ($month < 3) {
            $year--;
            $month += 12;
        }

        $a = floor($year / 100.0);
        $b = $year === 1582 && ($month > 10 || ($month === 10 && $day > 4)) ? -10 : ($year === 1582 && $month === 10 ? 0 : ($year < 1583 ? 0 : 2 - $a + floor($a / 4.0)));

        return floor(365.25 * ($year + 4716)) + floor(30.6001 * ($month + 1)) + $day + $b - 1524;
    }
    public static function julianToHijri($julianDay)
    {
        $y = 10631.0 / 30.0;
        $epochAstro = 1948084;
        $shift1 = 8.01 / 60.0;
        $z = $julianDay - $epochAstro;
        $cyc = floor($z / 10631.0);
        $z = $z - 10631 * $cyc;
        $j = floor(($z - $shift1) / $y);
        $z = $z - floor($j * $y + $shift1);
        $year = 30 * $cyc + $j;
        $month = (int) floor(($z + 28.5001) / 29.5);
        if ($month === 13) {
            $month = 12;
        }
        $day = $z - floor(29.5001 * $month - 29);

        return ['year' => (int) $year, 'month' => (int) $month, 'day' => (int) $day];
    }
    public static function gregorianToHijri($year, $month, $day)
    {
        $jd = self::gregorianToJulian($year, $month, $day);

        return self::julianToHijri($jd);
    }
    public static function tgl_hijriah()
    {
        [$Y, $n, $j] = explode('/', date('Y/n/j'));
        // hijri
        $hijri = self::gregorianToHijri($Y,$n,$j);
        $n = $hijri['month'];
        $Y = $hijri['year'];
        $j = $hijri['day'];
        $F = self::$months[$n-1];
        $hijri_date = $j . ' ' . $F . ' ' . $Y.' H';
        return $hijri_date;
    }

}
