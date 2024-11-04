<!-- <!DOCTYPE html>
<html>
<head>
    <title>Leave Request</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 30px; }
        .content { margin: 20px; }
        .row { margin: 10px 0; }
        .label { font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h3>FORMULIR PERMINTAAN DAN PEMBERIAN CUTI</h3>
    </div>
    
    <div class="content">
        <div class="row">
            <span class="label">Employee Name:</span> {{ $record->employee->name }}
        </div>
        <div class="row">
            <span class="label">Leave Type:</span> {{ $record->leaveType->name }}
        </div>
        <div class="row">
            <span class="label">Duration:</span> 
            {{ \Carbon\Carbon::parse($record->start_date)->format('M d, Y') }} to 
            {{ \Carbon\Carbon::parse($record->end_date)->format('M d, Y') }}
        </div>
        <div class="row">
            <span class="label">Reason:</span> {{ $record->reason }}
        </div>
        <div class="row">
            <span class="label">Status:</span> {{ ucfirst($record->status) }}
        </div>
        @if($record->admin_remarks)
        <div class="row">
            <span class="label">Admin Remarks:</span> {{ $record->admin_remarks }}
        </div>
        @endif
    </div>
</body>
</html> -->
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

<form action="process_leave.php" method="post">
<!-- <style>
    .form-table {
        margin-bottom: 20px; /* Adjust the value as needed */
    }
</style> -->
<!-- I. DATA PEGAWAI -->
<table class="form-table">
    <tr>
        <th colspan="4" style="text-align: left;">I. DATA PEGAWAI</th>
    </tr>
    <tr>
        <td>Nama</td>
        <td>{{ $record->employee->name }}</td>
        <td>NIP</td>
        <td>{{ $record->employee->nip }}</td>
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
        <th colspan="4" style="text-align: left;">IV. LAMANYA CUTI</th>
    </tr>
    <tr>
        <td>Selama</td>
        <td><input type="text" name="lama_cuti" placeholder="hari/bulan/tahun" required></td>
        <td>Mulai Tanggal</td>
        <td><input type="date" name="mulai_tanggal" required></td>
    </tr>
</table>

<!-- V. CATATAN CUTI -->
<table class="form-table">
    <tr>
        <th colspan="4" style="text-align: left;">V. CATATAN CUTI</th>
    </tr>
    <tr>
        <td colspan="4">
            (Specify any previous leave details here or additional notes)
        </td>
    </tr>
</table>

<!-- VI. ALAMAT SELAMA MENJALANKAN CUTI -->
<table class="form-table">
    <tr>
        <th colspan="4" style="text-align: left;">VI. ALAMAT SELAMA MENJALANKAN CUTI</th>
    </tr>
    <tr>
        <td>Alamat</td>
        <td colspan="3"><input type="text" name="alamat_cuti" style="width:100%;" required></td>
    </tr>
    <tr>
        <td>Telp</td>
        <td colspan="3"><input type="text" name="telp_cuti" style="width:100%;" required></td>
    </tr>
</table>

<!-- SIGNATURE -->
<table class="form-table">
    <tr>
        <td colspan="4" style="text-align: right;">
            Hormat Saya,<br><br>
            <input type="text" name="signature" placeholder="Nama Anda" required><br>
            NIP. <input type="text" name="nip_signature" required>
        </td>
    </tr>
</table>

    <h3 class="header">VII. PERTIMBANGAN ATASAN LANGSUNG</h3>
    <label><input type="checkbox" name="approval" value="disetujui"> Disetujui</label>
    <label><input type="checkbox" name="approval" value="perubahan"> Perubahan</label>
    <label><input type="checkbox" name="approval" value="ditangguhkan"> Ditangguhkan</label>
    <label><input type="checkbox" name="approval" value="tidak_disetujui"> Tidak Disetujui</label>

    <h3 class="header">VIII. KEPUTUSAN PEJABAT YANG BERWENANG MEMBERIKAN CUTI</h3>
    <label><input type="checkbox" name="decision" value="disetujui"> Disetujui</label>
    <label><input type="checkbox" name="decision" value="perubahan"> Perubahan</label>
    <label><input type="checkbox" name="decision" value="ditangguhkan"> Ditangguhkan</label>
    <label><input type="checkbox" name="decision" value="tidak_disetujui"> Tidak Disetujui</label>

    <button type="submit">Submit Form</button>
</form>

</body>
</html>