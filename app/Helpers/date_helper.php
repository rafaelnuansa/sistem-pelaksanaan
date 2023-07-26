<?php

if (!function_exists('format_date_id')) {
    function format_date_id($date, $format = 'd F Y')
    {
        // Daftar nama bulan dalam bahasa Indonesia
        $nama_bulan = [
            'January'   => 'Januari',
            'February'  => 'Februari',
            'March'     => 'Maret',
            'April'     => 'April',
            'May'       => 'Mei',
            'June'      => 'Juni',
            'July'      => 'Juli',
            'August'    => 'Agustus',
            'September' => 'September',
            'October'   => 'Oktober',
            'November'  => 'November',
            'December'  => 'Desember',
        ];

        // Convert date string to a DateTime object
        $dateTime = DateTime::createFromFormat('Y-m-d', $date);

        // Format the date using the specified format
        $formattedDate = $dateTime->format($format);

        // Ganti nama bulan dalam bahasa Inggris dengan nama bulan dalam bahasa Indonesia
        $formattedDate = strtr($formattedDate, $nama_bulan);

        return $formattedDate;
    }
}

// app/Helpers/date_helper.php

if (!function_exists('format_digit_to_words')) {
    function format_digit_to_words($number)
    {
        $words = [
            0 => 'Nol',
            1 => 'Satu',
            2 => 'Dua',
            3 => 'Tiga',
            4 => 'Empat',
            5 => 'Lima',
            6 => 'Enam',
            7 => 'Tujuh',
            8 => 'Delapan',
            9 => 'Sembilan',
        ];

        return $words[$number] ?? '';
    }
}

if (!function_exists('format_date_id_year')) {
    function format_date_id_year($date)
    {
        $bulan = [
            'January'   => 'Januari',
            'February'  => 'Februari',
            'March'     => 'Maret',
            'April'     => 'April',
            'May'       => 'Mei',
            'June'      => 'Juni',
            'July'      => 'Juli',
            'August'    => 'Agustus',
            'September' => 'September',
            'October'   => 'Oktober',
            'November'  => 'November',
            'December'  => 'Desember',
        ];

        $dateTime = new DateTime($date);
        $yearNumber = intval($dateTime->format('Y'));
        $year = '';

        if ($yearNumber >= 2000 && $yearNumber <= 9999) {
            $yearNumber = strval($yearNumber);

            if (strlen($yearNumber) === 4) {
                if ($yearNumber[0] !== '0') {
                    $year .= ucwords(format_digit_to_words(intval($yearNumber[0]))) . ' Ribu ';
                }
            }

            if (strlen($yearNumber) >= 3) {
                if ($yearNumber[strlen($yearNumber) - 3] !== '0') {
                    $year .= ucwords(format_digit_to_words(intval($yearNumber[strlen($yearNumber) - 3]))) . ' Ratus ';
                }
            }

            if (strlen($yearNumber) >= 2) {
                if ($yearNumber[strlen($yearNumber) - 2] !== '0') {
                    $year .= ucwords(format_digit_to_words(intval($yearNumber[strlen($yearNumber) - 2]))) . ' Puluh ';
                }
            }

            if (strlen($yearNumber) >= 1 && $yearNumber[strlen($yearNumber) - 1] !== '0') {
                $year .= ucwords(format_digit_to_words(intval($yearNumber[strlen($yearNumber) - 1])));
            }
        } else {
            $year = 'Tidak Valid';
        }

        return $year;
    }
}
if (!function_exists('date_format_id')) {
    function date_format_id(DateTime $dateTime)
    {
        // Daftar nama bulan dalam bahasa Indonesia
        $nama_bulan = [
            'January'   => 'Januari',
            'February'  => 'Februari',
            'March'     => 'Maret',
            'April'     => 'April',
            'May'       => 'Mei',
            'June'      => 'Juni',
            'July'      => 'Juli',
            'August'    => 'Agustus',
            'September' => 'September',
            'October'   => 'Oktober',
            'November'  => 'November',
            'December'  => 'Desember',
        ];

        // Format the date to "24 Juli 2023"
        $formattedDate = $dateTime->format('d F Y');

        // Ganti nama bulan dalam bahasa Inggris dengan nama bulan dalam bahasa Indonesia
        $formattedDate = strtr($formattedDate, $nama_bulan);

        return $formattedDate;
    }
}

if (!function_exists('format_date_id_month')) {
    function format_date_id_month($dateTimeString)
    {
        // Convert date string to a DateTime object
        $dateTime = new DateTime($dateTimeString);

        // Daftar nama bulan dalam bahasa Indonesia
        $nama_bulan = [
            'January'   => 'Januari',
            'February'  => 'Februari',
            'March'     => 'Maret',
            'April'     => 'April',
            'May'       => 'Mei',
            'June'      => 'Juni',
            'July'      => 'Juli',
            'August'    => 'Agustus',
            'September' => 'September',
            'October'   => 'Oktober',
            'November'  => 'November',
            'December'  => 'Desember',
        ];

        // Get the month part of the date and use it to get the month name in Indonesian
        $month = $dateTime->format('F');
        $formattedDate = $nama_bulan[$month];

        return $formattedDate;
    }
}
