<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Request Form</title>
    <style>
        body { 
            font-family: Arial, sans-serif, DejaVu Sans Mono; 
            font-size: 9px;
        }
        .form-table {
            width: 100%;
            max-width: 800px; /* Adjust for A4 width */
            border-collapse: collapse;
            margin-bottom: 20px;
            page-break-inside: avoid;
        }
        .form-table td, .form-table th {
            border: 1px solid #000;
            padding: 8px;
        }
        .header {
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h3 class="header">FORMULIR PERMINTAAN DAN PEMBERIAN CUTI</h3>

<!-- <form action="process_leave.php" method="post"> -->
<!-- I. DATA PEGAWAI -->
<table class="form-table">
    <tr>
        <th colspan="4" style="text-align: left;" style="width: 100%;">I. DATA PEGAWAI</th>
    </tr>
    <tr>
        <td style="width: 15%;">Nama</td>
        <td style="width: 35%;">{{ $record->employee->name }}</td>
        <td style="width: 15%;">NIP/NRK</td>
        <td style="width: 60%;"> {{ $record->employee->nip }}</td>
    </tr>
    <tr>
        <td>Jabatan</td>
        <td>{{ $record->employee->position }}</td>
        <td>Masa Kerja</td>
        <td>
            <?php
            $startDate = new DateTime($record->employee->start_working);
            $currentDate = new DateTime();
            $interval = $startDate->diff($currentDate);
            echo $interval->y . ' tahun ';
            ?>
        </td>
    </tr>
    <tr>
        <td>Unit Kerja</td>
        <td colspan="4">{{ $record->employee->department }}</td>
    </tr>
</table>

<!-- II. JENIS CUTI YANG DIAMBIL -->
<table class="form-table">
    <tr>
        <th colspan="4" style="text-align: left;">II. JENIS CUTI YANG DIAMBIL</th>
    </tr>
    <tr>
        <td style="white-space: nowrap;">1. Cuti Tahunan</td>
        <td style="text-align: center;">
            @if ($record->leaveType->name == "Annual Leave")
                ✔
            @endif
        </td>
        <td style="white-space: nowrap;">2. Cuti Besar</td>
        <td style="text-align: center;">
            @if ($record->leaveType->name == "Long Leave")
                ✔
            @endif
        </td>
    </tr>
    <tr>
        <td style="white-space: nowrap;">3. Cuti Sakit</td>
        <td style="text-align: center;">
            @if ($record->leaveType->name == "Sick Leave")
                ✔
            @endif
        </td>
        <td style="white-space: nowrap;">4. Cuti Melahirkan</td>
        <td style="text-align: center;">
            @if ($record->leaveType->name == "Maternity Leave")
                ✔
            @endif
        </td>
    </tr>
    <tr>
        <td style="white-space: nowrap;">5. Cuti Karena Alasan Penting</td>
        <td style="text-align: center;">
            @if ($record->leaveType->name == "Important Leave")
                ✔
            @endif
        </td>
        <td style="white-space: nowrap;">6. Cuti di Luar Tanggungan Negara</td>
        <td style="text-align: center;">
            @if ($record->leaveType->name == "Without State Expenses")
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
            <textarea name="alasan_cuti" rows="4" style="width:100%; border: none;" required>{{ $record->reason }}</textarea>
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
            $startDate = new DateTime($record->start_date);
            $endDate = new DateTime($record->end_date);
            $interval = $startDate->diff($endDate);
            echo $interval->d . ' hari ';
        ?>
        </td>
        <td>Mulai Tanggal</td>
        <td>{{$record->start_date}}</td>
        <td>s/d</td>
        <td>{{$record->end_date}}</td>
    </tr>
</table>

<!-- V. CATATAN CUTI -->
<table class="form-table">
    <tr>
        <th colspan="5" style="text-align: left;">V. CATATAN CUTI</th>
    </tr>
    <tr>
        <td colspan="3">1. CUTI TAHUNAN</td>
        <td>2. CUTI BESAR</td>
        <td></td>
    </tr>
    <tr>
        <td>Tahun</td>
        <td>Sisa</td>
        <td>Keterangan</td>
        <td>CUTI SAKIT</td>
        <td></td>
    </tr>
    <tr>
        <td>N-2</td>
        <td></td>
        <td></td>
        <td>CUTI MELAHIRKAN</td>
        <td></td>
    </tr>
    <tr>
        <td>N-1</td>
        <td></td>
        <td></td>
        <td>CUTI KARENA ALASAN PENTING</td>
        <td></td>
    </tr>
    <tr>
        <td>N</td>
        <td></td>
        <td></td>
        <td>CUTI DI LUAR TANGGUNGAN NEGARA</td>
        <td></td>
    </tr>
</table>

<!-- VI. ALAMAT SELAMA MENJALANKAN CUTI -->
<table class="form-table">
    <tr>
        <th colspan="3" style="text-align: left;" style="width: 100%;">VI. ALAMAT SELAMA MENJALANKAN CUTI</th>
    </tr>
    <tr>
        <td style="width: 60%;"></td>
        <td style="width: 10%;">TELP</td>
        <td style="width: 30%;">*your number</td>
    </tr>
    <tr>
        <td>
            <textarea name="alasan_cuti" rows="4" style="width:50%; border: none;" required></textarea>
        </td>
        <td colspan="4" style="text-align: right;" >
            Hormat saya,
            <br>
            <img src="{{ $record->employee->signature }}" alt="Employee Signature" class="signature-img" style="width: 3.15cm; height: 2.81cm; object-fit: contain;">
            <p style="text-align: right;">{{ $record->employee->name }}</p> <!-- Signature from the database -->
            <p style="text-align: right;">NIP. {{ $record->employee->nip}}</p> <!-- NIP from the database -->
        </td>
    </tr>
</table>

<!-- SIGNATURE -->
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
            Sistem Instrumentasi Cerdas dan Automasi
            <br>
            <img src="{{ $record->employee->signature }}" alt="Employee Signature" class="signature-img" style="width: 3.15cm; height: 2.81cm; object-fit: contain;">
            <p style="text-align: center;">{{ $record->employee->name }}</p>
            <p style="text-align: center;">NIP. {{ $record->employee->nip}}</p>
        </td>
    </tr>
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
            Dekan
            <br>
            <img src="{{ $record->employee->signature }}" alt="Employee Signature" class="signature-img" style="width: 3.15cm; height: 2.81cm; object-fit: contain;">
            <p style="text-align: center;">{{ $record->employee->name }}</p>
            <p style="text-align: center;">NIP. {{ $record->employee->nip}}</p>
        </td>
    </tr>
</table>

</body>
</html>