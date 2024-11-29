<!-- resources/views/emails/sendmail.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Pengajuan Cuti</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        h1 {
            color: #007BFF;
        }
        p {
            margin: 8px 0;
        }
        .highlight {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Kepegawaian FTI ITERA</h1>
    <p>Dear {{ $data['nama'] }},</p>

    <p>This is an automated email to notify you that the following leave form request is waiting for your approval:</p>
    
    <p><span class="highlight">Nama:</span> "{{ $data['nama'] }}"</p>
    <p><span class="highlight">Prodi:</span> "{{ $data['prodi'] }}"</p>
    <p><span class="highlight">Jenis Cuti:</span> "{{ $data['tipe_cuti'] }} - {{ $data['hari'] }}"</p>
    <p><span class="highlight">Alasan:</span> "{{ $data['alasan'] }}"</p>

    <p>Please click the link below to respond:</p>
    <p><a href="http://192.168.31.204:8000" style="color: #007BFF; text-decoration: none;">Respond to Leave Request</a></p>

    <p>If you encounter any issues, please contact us at:</p>
    <ul>
        <li>yudhahamdi@gmail.com</li>
        <li>kepegawaian@fti.itera.ac.id</li>
    </ul>
</body>
</html>
