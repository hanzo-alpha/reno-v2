<?php

declare(strict_types=1);

use App\Supports\Helpers;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

if ( ! function_exists('date_format')) {
    function date_format($date, $format): string
    {
        return Carbon::createFromFormat('Y-m-d', $date)->format($format);
    }
}

if ( ! function_exists('tanggal_ke_kalimat')) {
    function tanggal_ke_kalimat($tanggal): string
    {
        // Validasi input
        if ( ! preg_match('/^\d{4}-\d{2}-\d{2}$/', $tanggal)) {
            return 'Format tanggal tidak valid!';
        }

        // Pecah tanggal menjadi bagian tahun, bulan, dan hari
        [$tahun, $bulan, $hari] = explode('-', $tanggal);

        // Konversi bulan ke dalam format teks
        $bulan_kalimat = match ($bulan) {
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
            default => '',
        };

        //        dd((int) $hari, (int) $bulan, (int) $tahun);

        // Konversi hari ke dalam format teks
        $hari_kalimat = terbilang((int) $hari);

        // Konversi tahun ke dalam format teks
        $tahun_kalimat = terbilang((int) $tahun);

        // Gabungkan bagian-bagian tanggal menjadi kalimat
        return $hari_kalimat . ' ' . $bulan_kalimat . ' Tahun ' . $tahun_kalimat;
    }
}

if ( ! function_exists('terbilang')) {
    function terbilang($angka): string
    {
        // Validasi input
        if ( ! is_numeric($angka)) {
            return 'Masukan harus berupa angka!';
        }

        if ($angka < 0 || $angka > 999999999999999) {
            return 'Angka harus di antara 0 dan 999.999.999.999.999!';
        }

        // Sanitasi input
        $angka = abs($angka); // mengubah angka agar menjadi bernilai positif
        $angka = floor($angka); // mengubah angka agar menjadi bilangan bulat

        $angka_huruf = [
            '', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas',
        ];

        if ($angka < 12) {
            return $angka_huruf[$angka];
        }
        if ($angka < 20) {
            return terbilang($angka - 10) . ' Belas';
        }
        if ($angka < 100) {
            return terbilang($angka / 10) . ' Puluh ' . terbilang($angka % 10);
        }
        if ($angka < 200) {
            return 'Seratus ' . terbilang($angka - 100);
        }
        if ($angka < 1000) {
            return terbilang($angka / 100) . ' Ratus ' . terbilang($angka % 100);
        }
        if ($angka < 2000) {
            return 'Seribu ' . terbilang($angka - 1000);
        }
        if ($angka < 1000000) {
            return terbilang($angka / 1000) . ' Ribu ' . terbilang($angka % 1000);
        }
        if ($angka < 1000000000) {
            return terbilang($angka / 1000000) . ' Juta ' . terbilang($angka % 1000000);
        }
        if ($angka < 1000000000000) {
            return terbilang($angka / 1000000000) . ' Miliar ' . terbilang($angka % 1000000000);
        }

        return terbilang($angka / 1000000000000) . ' Triliun ' . terbilang($angka % 1000000000000);
    }
}

if ( ! function_exists('replace_nama_file_excel')) {
    function replace_nama_file_excel($namafile): string
    {
        return str_replace(['/', '\\', ':', '*', '?', '«', '<', '>', '|'], '-', $namafile);
    }
}

if ( ! function_exists('superadmin_admin_roles')) {
    function superadmin_admin_roles(): array | Collection
    {
        $admin = Helpers::getAdminRoles();
        $sadmin = ['super_admin'];

        return array_merge($sadmin, $admin);
    }
}

if ( ! function_exists('cek_batas_input')) {
    function cek_batas_input($date): ?bool
    {
        $date = $date instanceof Carbon ? $date : Carbon::parse($date);
        return $date->isSameDay(now());

        //        return strtotime($date) <= strtotime(now()->format('Y-m-d'));
    }
}

if ( ! function_exists('hitung_umur')) {
    function hitung_umur($date, $format = false): string | int
    {
        $date = $date instanceof Carbon ? $date->format('Y-m-d') : Carbon::parse($date)->format('Y-m-d');

        $age = Carbon::parse($date)->age;

        if ($format) {
            $age = Carbon::parse($date)->diff(Carbon::now())->format('%y tahun, %m bulan and %d hari');
        }

        return $age;
    }
}

if ( ! function_exists('list_tahun')) {
    function list_tahun(): array
    {
        $year_range = range(date('Y'), date('Y') - 3);

        return array_combine($year_range, $year_range);
    }
}

if ( ! function_exists('getModelList')) {
    function getModelList(): array
    {
        $modelList = [];
        $path = app_path() . '/Models';
        $results = scandir($path);

        foreach ($results as $result) {
            if ('.' === $result || '..' === $result) {
                continue;
            }
            $filename = $result;

            if (is_dir($filename)) {
                $modelList = array_merge($modelList, getModelList($filename));
            } else {
                $modelList[] = mb_substr($filename, 0, -4);
            }
        }

        return $modelList;
    }
}

if ( ! function_exists('convertNameBasedOnModelName')) {
    function convertNameBasedOnModelName(Stringable | string $name): Stringable | string
    {
        return Str::of($name)->prepend('Bantuan')->camel()->ucfirst();
    }
}

if ( ! function_exists('list_bulan')) {
    function list_bulan($short = false): array
    {
        if ($short) {
            return [
                1 => 'JAN',
                2 => 'FEB',
                3 => 'MAR',
                4 => 'APR',
                5 => 'MEI',
                6 => 'JUN',
                7 => 'JUL',
                8 => 'AGS',
                9 => 'SEP',
                10 => 'OKT',
                11 => 'NOV',
                12 => 'DES',
            ];
        }

        return [
            1 => 'JANUARI',
            2 => 'FEBRUARI',
            3 => 'MARET',
            4 => 'APRIL',
            5 => 'MEI',
            6 => 'JUNI',
            7 => 'JULI',
            8 => 'AGUSTUS',
            9 => 'SEPTEMBER',
            10 => 'OKTOBER',
            11 => 'NOVEMBER',
            12 => 'DESEMBER',
        ];
    }
}

if ( ! function_exists('bulan_to_integer')) {
    function bulan_to_integer($bulan, $short = false): ?string
    {
        $bulan = Str::upper($bulan);

        if ($short) {
            return match ($bulan) {
                'JAN' => 1,
                'FEB' => 2,
                'MAR' => 3,
                'APR' => 4,
                'MEI' => 5,
                'JUN' => 6,
                'JUL' => 7,
                'AGS' => 8,
                'SEP' => 9,
                'OKT' => 10,
                'NOV' => 11,
                'DES' => 12,
                default => null,
            };
        }

        return match ($bulan) {
            'JANUARI' => 1,
            'FEBRUARI' => 2,
            'MARET' => 3,
            'APRIL' => 4,
            'MEI' => 5,
            'JUNI' => 6,
            'JULI' => 7,
            'AGUSTUS' => 8,
            'SEPTEMBER' => 9,
            'OKTOBER' => 10,
            'NOVEMBER' => 11,
            'DESEMBER' => 12,
            default => null,
        };
    }
}

if ( ! function_exists('bulan_to_string')) {
    function bulan_to_string(int | string $bulan, $short = false): string
    {
        $bulan = is_int($bulan) ? $bulan : (int) $bulan;

        if ($short) {
            return match ($bulan) {
                1 => 'JAN',
                2 => 'FEB',
                3 => 'MAR',
                4 => 'APR',
                5 => 'MEI',
                6 => 'JUN',
                7 => 'JUL',
                8 => 'AGS',
                9 => 'SEP',
                10 => 'OKT',
                11 => 'NOV',
                12 => 'DES',
            };
        }

        return match ($bulan) {
            1 => 'JANUARI',
            2 => 'FEBRUARI',
            3 => 'MARET',
            4 => 'APRIL',
            5 => 'MEI',
            6 => 'JUNI',
            7 => 'JULI',
            8 => 'AGUSTUS',
            9 => 'SEPTEMBER',
            10 => 'OKTOBER',
            11 => 'NOVEMBER',
            12 => 'DESEMBER',
        };
    }

    if ( ! function_exists('convertToRoman')) {
        function convertToRoman($integer): string
        {
            // Convert the integer into an integer (just to make sure)
            $integer = (int) $integer;
            $result = '';

            // Create a lookup array that contains all of the Roman numerals.
            $lookup = [
                'M' => 1000,
                'CM' => 900,
                'D' => 500,
                'CD' => 400,
                'C' => 100,
                'XC' => 90,
                'L' => 50,
                'XL' => 40,
                'X' => 10,
                'IX' => 9,
                'V' => 5,
                'IV' => 4,
                'I' => 1,
            ];

            foreach ($lookup as $roman => $value) {
                // Determine the number of matches
                $matches = (int) ($integer / $value);

                // Add the same number of characters to the string
                $result .= str_repeat($roman, $matches);

                // Set the integer to be the remainder of the integer and the value
                $integer %= $value;
            }

            // The Roman numeral should be built, return it
            return $result;
        }
    }
}
