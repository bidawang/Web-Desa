<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Keterangan Kematian</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f2f2f2;
        }
        .card {
            background: #ffffff;
            width: 100%;
            max-width: 210mm;
            padding: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
            border-radius: 8px;
            margin: 10px;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            position: relative;
        }
        .header img {
            position: absolute;
            left: 10px;
            top: 10px;
            width: 40px;
        }
        .header h1 {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
            text-transform: uppercase;
        }
        .header p {
            font-size: 12px;
            margin: 0;
            color: #555;
        }
        .content {
            margin-top: 10px;
            font-size: 12px;
        }
        .content table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .content td {
            padding: 1px;
            vertical-align: top;
        }
        .content td:first-child {
            width: 30%;
            font-weight: bold;
        }
        .content td:last-child {
            width: 70%;
        }
        .content p {
            margin: 5px 0;
        }

        /* Signature styling */
        .signature {
    display: flex;
    flex-direction: column;
    justify-content: flex-end; /* Menjaga konten tetap di bagian bawah */
    align-items: end; /* Menyusun teks secara horisontal di tengah */
    text-align: end; /* Mengatur agar teks terpusat */
    margin-top: 200px;
    margin-right: 20px;
}

.signature-content {
    display: flex;
    flex-direction: column;
    align-items: center; /* Mengatur teks supaya berada di sebelah kanan */
}

.signature p {
    margin: 5px 0;
}

        /* Button styling */
        .footer {
            text-align: center;
            margin-top: 30px;
        }
        .footer button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 24px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 200px;
            max-width: 100%;
            margin: 0 10px;
            display: inline-block;
        }
        .footer button:hover {
            background-color: #45a049;
        }
        .footer .back-btn {
            background-color: #f44336;
        }

        @media print {
            body {
                background: none;
                margin: 0;
            }
            .card {
                width: 100%;
                padding: 10px;
                box-shadow: none;
                border-radius: 0;
                page-break-inside: avoid;
            }
            .footer {
                display: none;
            }
        }

        @media screen and (max-width: 768px) {
            .header img {
                width: 20px;
                left: 2px;
                top: 2px;
                font-size: 7px;
            }
            .header h1 {
                font-size: 8px;
            }
            h2 {
                font-size: 7px;
            }
            h3 {
                font-size: 6px;
            }
            .header p {
                font-size: 5px;
            }
            .content {
                font-size: 5px;
            }
            .signature {
                font-size: 5px;
            }
        }
    </style>
    <script>
        function printDocument() {
            window.print();
        }
    </script>
</head>
<body>
    <div class="card">
        <div class="header">
            <img src="<?= base_url('Logo Tanah Laut.png'); ?>" alt="Kop Surat">
            <h1>PEMERINTAH DESA <?= $alamat['kelurahan']; ?></h1>
            <p>Kecamatan <?= $alamat['kecamatan']; ?>, Kabupaten <?= $alamat['kota']; ?></p>
            <p>Provinsi <?= $alamat['provinsi']; ?></p>
        </div>
        <center>
            <h2 style="margin-bottom: -10px; margin-top: 10px;">SURAT KETERANGAN KEMATIAN</h2>
            <h3>Nomor: <?= $surat['nomor_surat']; ?></h3>
        </center>
        <div class="content">
            <p>Yang bertanda tangan di bawah ini, Kepala Desa <?= $alamat['kelurahan']; ?>, <?= $alamat['kecamatan']; ?>, Kabupaten <?= $alamat['kota']; ?>, Provinsi <?= $alamat['provinsi']; ?>, menerangkan dengan sebenarnya bahwa:</p>
            <table>
                <tr><td>1. Nama Almarhum/Almarhumah</td><td>:</td><td><?= $anggotaKK['nama_lengkap']; ?></td></tr>
                <tr><td>2. NIK / No KTP</td><td>:</td><td><?= $surat['nik_kematian']; ?></td></tr>
                <tr><td>3. Tempat/Tanggal Lahir</td><td>:</td><td><?= $kelahiran['tempat_lahir']; ?>, <?= $kelahiran['tanggal_lahir']; ?></td></tr>
                <tr><td>4. Jenis Kelamin</td><td>:</td><td><?= $anggotaKK['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan'; ?></td></tr>
                <tr><td>5. Agama</td><td>:</td><td><?= $anggotaKK['agama']; ?></td></tr>
                <tr><td>6. Alamat</td><td>:</td><td><?= $alamat['alamat_lengkap']; ?>, RT <?= $alamat['rt']; ?> RW <?= $alamat['rw']; ?>, Kecamatan <?= $alamat['kecamatan']; ?>, Kabupaten <?= $alamat['kota']; ?></td></tr>
                <tr><td>7. Penyebab Kematian</td><td>:</td><td><?= $surat['penyebab_kematian']; ?></td></tr>
                <tr><td>8. Tanggal Kematian</td><td>:</td><td><?= $surat['datetime_kematian']; ?></td></tr>
                
            </table>
            <p>Demikian surat keterangan ini dibuat dengan sebenar-benarnya untuk dipergunakan sebagaimana mestinya.</p>
        </div>
        <div class="signature">
    <?php
    $formatter = new \IntlDateFormatter('id_ID', \IntlDateFormatter::LONG, \IntlDateFormatter::NONE);
    $tanggal = $formatter->format(new \DateTime($surat['updated_at']));
    ?>
    <div class="signature-content">
        <p style="margin-bottom: 100px;"><?= $alamat['kota']; ?>, <?= $tanggal; ?></p>
        <p><?= $kades['nama_lengkap']; ?></p>
        <p><?= $kades['nik']; ?></p>
    </div>
</div>
    </div>
    <!-- <div class="footer">
        <button onclick="printDocument()">Print Surat</button>
    </div> -->
</body>
</html>
