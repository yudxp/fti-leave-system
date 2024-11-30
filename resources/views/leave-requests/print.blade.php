<?php
// Set the timezone to Jakarta, Indonesia
date_default_timezone_set('Asia/Jakarta');

// Get today's date
$today = new DateTime();

// Define arrays for Indonesian day and month names
$weekdays = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
$months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

// Get the day, month, and year
$dayOfWeek = $weekdays[$today->format('w')];  // Day of the week (0-6)
$dayOfMonth = $today->format('j');            // Day of the month
$month = $months[$today->format('n') - 1];    // Month (1-12)
$year = $today->format('Y');                   // Full year

// Format the date as "Day, Date Month Year" in Indonesian (e.g., "Kamis, 9 November 2024")
$formattedDate = "{$dayOfWeek}, {$dayOfMonth} {$month} {$year}";

// Check if $record and its properties are set before accessing them
$employeeName = isset($record->employee->user->name) ? $record->employee->user->name : 'N/A';
$employeeNip = isset($record->employee->nip) ? $record->employee->nip : 'N/A';
$employeePosition = isset($record->employee->position) ? $record->employee->position : 'N/A';
$employeeDepartment = isset($record->employee->department) ? $record->employee->department : 'N/A';
$leaveTypeName = isset($record->leaveType->name) ? $record->leaveType->name : 'N/A';
$reason = isset($record->reason) ? $record->reason : '';
$startDate = isset($record->start_date) ? new DateTime($record->start_date) : null;
$endDate = isset($record->end_date) ? new DateTime($record->end_date) : null;
$telepon = isset($record->telepon) ? $record->telepon : 'N/A';
$alamatCuti = isset($record->alamat_cuti) ? $record->alamat_cuti : '';

// Display the date
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Request Form</title>
    <style>
        body { 
            font-family: "Times New Roman", DejaVu Sans Mono; 
            font-size: 9px;
        }
        .form-table {
            width: 100%;
            max-width: 800px; 
            border-collapse: collapse;
            margin-bottom: 20px;
            page-break-inside: avoid;
        }
        .form-table td, .form-table th, .form-table tr {
            border: 1px solid #000;
            padding: 8px;
        }
        .header {
            text-align: center;
            font-weight: bold;
        }
        .kop-surat {
            display: flex;
            font-family: "Times New Roman";
            transform: scale(1.2);
            flex-direction: column;
            border-bottom: 2px solid #000;
            margin-left: 10%;
            margin-right: 10%;
            margin-bottom: 30px;
        }

        .logo-itera {
            position: absolute;
        }
        .kop-text {
            text-align: center;
        }
        .tujuan-surat {
            width: 95%;
            margin-bottom: 120px;
        }
    </style>
</head>
<body>
    
<div class="kop-surat"> 
    <div class="logo-itera">
        <img src="{{ public_path('images/logo_itera.png') }}" style="height: 2.2cm; width: 2.4cm; object-fit: contain;" />
    </div>
    <div class="kop-text">
        <p style="margin: 0; font-size: 15">KEMENTRIAN PENDIDIKAN TINGGI, SAINS, <br/> DAN TEKNOLOGI</p>
        <p style="margin: 0; font-weight: bold; font-size: 14">INSTITUT TEKNOLOGI SUMATERA</p>
        <p style="margin: 0">Jalan Terusan Ryacudu Way Hui, Kecamatan Jati Agung, Lampung Selatan 35365</p>
        <p style="margin: 0">Telepon: (0721) 8030188</p>
        <p style="margin-top: 0">Email: <u>pusat@itera.ac.id</u>, Website : <u>http://itera.ac.id</u></p>
    </div>
</div>

<div class="tujuan-surat">
    <div style="float: right;">
        <p style="margin: 0"> Lampung Selatan, <?php echo $formattedDate; ?></p>
        <p style="margin: 0"> Kepada Yth. Kepala Biro Akademik, Perencanaan, dan Umum </p>
        <p style="margin: 0"> Institut Teknologi Sumatera </p>
        <p style="margin: 0"> di </p>
        <p style="padding-left: 40px; margin: 0"> Lampung Selatan </p>
    </div>
</div>

<h3 class="header" style="text-align: center;">FORMULIR PERMINTAAN DAN PEMBERIAN CUTI</h3>

<!-- I. DATA PEGAWAI -->
<table class="form-table">
    <tbody>
        <tr>
            <th colspan="4" style="text-align: left">I. DATA PEGAWAI</th>
        </tr>
        <tr>
            <td style="width: 15%;">Nama</td>
            <td style="width: 35%;"><?= $employeeName ?></td>
            <td style="width: 15%;">NIP/NRK</td>
            <td style="width: 60%; border-right: 1px solid #000;"><?= $employeeNip ?></td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td><?= $employeePosition ?></td>
            <td>Masa Kerja</td>
            <td style="border-right: 1px solid #000;">
                <?php
                if (isset($record->employee->start_working)) {
                    $startDate = new DateTime($record->employee->start_working);
                    $currentDate = new DateTime();
                    $interval = $startDate->diff($currentDate);
                    echo $interval->y . ' tahun ';
                } else {
                    echo 'N/A';
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>Unit Kerja</td>
            <td><?= $employeeDepartment ?></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>

<!-- II. JENIS CUTI YANG DIAMBIL -->
<table class="form-table">
    <tr>
        <th colspan="4" style="text-align: left;">II. JENIS CUTI YANG DIAMBIL</th>
    </tr>
    <tr>
        <td style="white-space: nowrap;">1. Cuti Tahunan</td>
        <td style="text-align: center;">
            @if ($leaveTypeName == "Annual Leave")
                ✔
            @endif
        </td>
        <td style="white-space: nowrap;">2. Cuti Besar</td>
        <td style="text-align: center;">
            @if ($leaveTypeName == "Long Leave")
                ✔
            @endif
        </td>
    </tr>
    <tr>
        <td style="white-space: nowrap;">3. Cuti Sakit</td>
        <td style="text-align: center;">
            @if ($leaveTypeName == "Sick Leave")
                ✔
            @endif
        </td>
        <td style="white-space: nowrap;">4. Cuti Melahirkan</td>
        <td style="text-align: center;">
            @if ($leaveTypeName == "Maternity Leave")
                ✔
            @endif
        </td>
    </tr>
    <tr>
        <td style="white-space: nowrap;">5. Cuti Karena Alasan Penting</td>
        <td style="text-align: center;">
            @if ($leaveTypeName == "Important Leave")
                ✔
            @endif
        </td>
        <td style="white-space: nowrap;">6. Cuti di Luar Tanggungan Negara</td>
        <td style="text-align: center;">
            @if ($leaveTypeName == "Without State Expenses")
                ✔
            @endif
        </td>
    </tr>
</table>

<!-- III. ALASAN CUTI -->
<table class="form-table">
    <tr>
        <th colspan="4" style="text-align: left;">III. ALASAN CUTI</th>
    </tr>
    <tr>
        <td colspan="4" style="text-align: left;">
            <textarea name="alasan_cuti" rows="4" style="width:100%; border: none;" required><?= $reason ?></textarea>
        </td>
    </tr>
</table>

<!-- IV. LAMANYA CUTI -->
<table class="form-table">
    <tr>
        <th colspan="6" style="text-align: left;">IV. LAMANYA CUTI</th>
    </tr>
    <tr>
        <td>Selama</td>
        <td>
        <?php
            if ($startDate && $endDate) {
                $interval = $startDate->diff($endDate);
                echo $interval->d . ' hari ';
            } else {
                echo 'N/A';
            }
        ?>
        </td>
        <td>Mulai Tanggal</td>
        <td><?= $startDate ? $startDate->format('d-m-Y') : 'N/A' ?></td>
        <td>s/d</td>
        <td><?= $endDate ? $endDate->format('d-m-Y') : 'N/A' ?></td>
    </tr>
</table>

<!-- V. CATATAN CUTI -->
<table class="form-table">
    <tr>
        <th colspan="5" style="text-align: left;">V. CATATAN CUTI</th>
    </tr>
    <tr>
        <td colspan="3" style="width: 30%;">1. CUTI TAHUNAN</td>
        <td>2. CUTI BESAR</td>
        <td style="width: 10%;"></td>
    </tr>
    <tr>
        <td style="width: 10%;">Tahun</td>
        <td style="width: 10%;">Sisa</td>
        <td style="width: 20%;">Keterangan</td>
        <td>CUTI SAKIT</td>
        <td style="width: 10%;"></td>
    </tr>
    <tr>
        <td>N-2</td>
        <td style="width: 10%;"></td>
        <td style="width: 5%;"></td>
        <td>CUTI MELAHIRKAN</td>
        <td style="width: 10%;"></td>
    </tr>
    <tr>
        <td>N-1</td>
        <td style="width: 10%;"></td>
        <td style="width: 5%;"></td>
        <td>CUTI KARENA ALASAN PENTING</td>
        <td style="width: 10%;"></td>
    </tr>
    <tr>
        <td>N</td>
        <td style="width: 10%;"></td>
        <td style="width: 5%;"></td>
        <td>CUTI DI LUAR TANGGUNGAN NEGARA</td>
        <td style="width: 10%;"></td>
    </tr>
</table>

<!-- VI. ALAMAT SELAMA MENJALANKAN CUTI -->
<table class="form-table" style="border-collapse: collapse; width: 100%;">
    <tr>
        <th colspan="3" style="text-align: left; border: 1px solid #000;">VI. ALAMAT SELAMA MENJALANKAN CUTI</th>
    </tr>
    <tr>
        <td style="width: 60%; border: 1px solid #000;"></td>
        <td style="width: 10%; border: 1px solid #000;">TELP</td>
        <td style="width: 30%; border: 1px solid #000;"><?= $telepon ?></td>
    </tr>
    <tr>
        <td style="border: 1px solid #000;">
            <div style="text-align: left; vertical-align: top;"><?= $alamatCuti ?></div>
        </td>
        <td colspan="2" style="text-align: right; border: 1px solid #000;">
            Hormat saya,
            <br>
            <?php
            $signaturePath = isset(auth()->user()->custom_fields['signature']) ? auth()->user()->custom_fields['signature'] : 'default-signature.png';
            ?>
            <img src="storage/{{ $signaturePath }}" alt="Employee Signature" class="signature-img" style="width: 3.15cm; height: 2.81cm; object-fit: contain;">
            <p style="text-align: right; margin: 0;"><?= $employeeName ?></p> <!-- Signature from auth -->
            <p style="text-align: right; margin: 0;">NIP. <?= $employeeNip ?></p> <!-- NIP from the database -->
        </td>
    </tr>
</table>

<!-- SIGNATURE ATASAN LANGSUNG -->
<table class="form-table">
    <tr>
        <th colspan="4" style="text-align: left;">VII. PERTIMBANGAN ATASAN LANGSUNG</th>
    </tr>
    <tr>
        <td>DISETUJUI</td>
        <td>PERUBAHAN</td>
        <td>DITANGGUHKAN</td>
        <td>TIDAK DISETUJUI</td>
    </tr>
    <tr>
        <td style="width: 100px; height: 25px;"></td>
        <td style="width: 100px; height: 25px;"></td>
        <td style="width: 100px; height: 25px;"></td>
        <td style="width: 100px; height: 25px;"></td>
    </tr>
    <tr>
        <td style="border: none;"></td>
        <td style="border: none;"></td>
        <td style="border: none;"></td>
        <td style="text-align: center;" >
            Ketua Kelompok Keilmuan
            <br>
            <p style="margin: 0;">Sistem Instrumentasi Cerdas dan Automasi</p>
            <br>
            <img src="storage/signatures/01JDGFCCJZ3VTG2B0A5K3ZZXFT.png" alt="Employee Signature" class="signature-img" style="width: 3.15cm; height: 2.81cm; object-fit: contain;">
            <p style="text-align: center; margin: 0;">(Sabar, M.Si)</p>
            <p style="text-align: center; margin: 0;">NIP. <?= $employeeNip ?></p>
        </td>
    </tr>
    <tr>
        <th colspan="4" style="text-align: left;">VIII. KEPUTUSAN PEJABAT YANG BERWENANG MEMBERIKAN CUTI</th>
    </tr>
    <tr>
        <td>DISETUJUI</td>
        <td>PERUBAHAN</td>
        <td>DITANGGUHKAN</td>
        <td>TIDAK DISETUJUI</td>
    </tr>
    <tr>
        <td style="width: 100px; height: 25px;"></td>
        <td style="width: 100px; height: 25px;"></td>
        <td style="width: 100px; height: 25px;"></td>
        <td style="width: 100px; height: 25px;"></td>
    </tr>
    <tr>
        <td style="border: none;"></td>
        <td style="border: none;"></td>
        <td style="border: none;"></td>
        <td style="text-align: center;" >
            Dekan
            <br>
            <img src="storage/signatures/01JDGBCQ123HGEY866MNJJM7GB.png" alt="Employee Signature" class="signature-img" style="width: 3.15cm; height: 2.81cm; object-fit: contain;">
            <p style="text-align: center; margin: 0;">(Hadi Teguh Yudistira, S.T., Ph.D.)</p>
            <p style="text-align: center; margin: 0;">NIP. <?= $employeeNip ?></p>
        </td>
    </tr>
</table>

</body>
</html>