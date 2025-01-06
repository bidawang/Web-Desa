<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Keterangan Domisili</title>
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
            width: 210mm;
            height: auto;
            max-width: 100%;
            padding: 20mm;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
            text-transform: uppercase;
        }
        .header p {
            font-size: 14px;
            margin: 0;
            color: #555;
        }
        .content {
            margin-top: 20px;
            font-size: 14px;
        }
        .content table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .content td {
            padding: 5px 10px;
            vertical-align: top;
            border-bottom: 1px solid #ddd;
        }
        .content td:first-child {
            width: 25%;
            font-weight: bold;
        }
        .content td:last-child {
            width: 75%;
        }
        .content p {
            margin: 8px 0;
        }
        .signature {
            margin-top: 40px;
            text-align: right;
            font-size: 14px;
        }
        .signature p {
            margin: 10px 0;
        }
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
        @media screen and (max-width: 768px) {
            body {
                font-size: 10px;
            }
            .card {
                width: 90%;
                padding: 15mm;
                font-size: 12px;
            }
            .header h1 {
                font-size: 16px;
            }
            .footer button {
                font-size: 14px;
                padding: 10px 20px;
                width: 100%;
            }
            .content table {
                font-size: 12px;
            }
            .content td {
                padding: 5px 8px;
            }
        }
        @media print {
            body {
                margin: 0;
                padding: 0;
                background: none;
                box-shadow: none;
            }
            .card {
                width: 100%;
                height: auto;
                padding: 10mm;
                box-shadow: none;
                border-radius: 0;
            }
            .no-print {
                display: none;
            }
        }
    </style>
    <script>
        window.onload = function() {
            window.print();
        };

        window.onafterprint = function() {
            history.back();
        };

        function printDocument() {
            window.print();
        }
    </script>
</head>
<body>
    <div class="card">
        <div class="header">
            <img src="<?= base_url('public/fotokop.png'); ?>" alt="Kop Surat">
        </div>
        <center>
            <h2 style="margin-bottom: -10px; margin-top: 10px;">SURAT KETERANGAN KELAHIRAN</h2>
            <h3>Nomor: <?= $surat['nomor_surat']; ?></h3>
        </center>
        <div class="content">
            <p>Yang bertanda tangan di bawah ini, Kepala Desa <?= $alamat['kelurahan']; ?>, <?= $alamat['kecamatan']; ?>, Kabupaten <?= $alamat['kota']; ?>, Provinsi <?= $alamat['provinsi']; ?>, menerangkan dengan sebenarnya bahwa pada:</p>
            <table>
                <?php
                $datetime = new \DateTime($surat['datetime_kelahiran']);

                $hariFormatter = new \IntlDateFormatter('id_ID', \IntlDateFormatter::FULL, \IntlDateFormatter::NONE);
                $hari = $hariFormatter->format($datetime);

                $tanggalFormatter = new \IntlDateFormatter('id_ID', \IntlDateFormatter::LONG, \IntlDateFormatter::NONE);
                $tanggal = $tanggalFormatter->format($datetime);

                $waktu = $datetime->format('H:i');
                ?>

                <tr><td>1. Hari</td><td>:</td><td><?= $hari; ?></td></tr>
                <tr><td>2. Pukul</td><td>:</td><td><?= $waktu; ?></td></tr>
                <tr><td>3. Tempat</td><td>:</td><td><?= $surat['tempat_lahir_anak']; ?></td></tr>
                <tr><td>4. Telah lahir seorang anak</td><td>:</td><td><?= $surat['kelamin_anak']; ?> bernama <?= $surat['nama_anak']; ?></td></tr>
                <tr><td colspan="3">6. Dari seorang ibu:</td></tr>
                <tr><td>Nama Lengkap</td><td>:</td><td><?= $ibu['nama_lengkap']; ?></td></tr>
                <tr><td>NIK / No KTP</td><td>:</td><td><?= $ibu['nik']; ?></td></tr>
                <tr><td>Umur</td><td>:</td><td><?= $umurIbu; ?> Tahun</td></tr>
                <tr><td>Pekerjaan</td><td>:</td><td><?= $ibu['pekerjaan']; ?></td></tr>
                <tr><td>Alamat</td><td>:</td><td><?= $alamat['alamat_lengkap']; ?>, <?= $alamat['kelurahan']; ?>, <?= $alamat['kecamatan']; ?>, <?= $alamat['kota']; ?></td></tr>
                <tr><td colspan="3">7. Istri dari:</td></tr>
                <tr><td>Nama Lengkap</td><td>:</td><td><?= $ayah['nama_lengkap']; ?></td></tr>
                <tr><td>NIK / No KTP</td><td>:</td><td><?= $ayah['nik']; ?></td></tr>
                <tr><td>Umur</td><td>:</td><td><?= $umurAyah; ?> Tahun</td></tr>
                <tr><td>Pekerjaan</td><td>:</td><td><?= $ayah['pekerjaan']; ?></td></tr>
                <tr><td>Alamat</td><td>:</td><td><?= $alamat['alamat_lengkap']; ?>, <?= $alamat['kelurahan']; ?>, <?= $alamat['kecamatan']; ?>, <?= $alamat['kota']; ?></td></tr>
                <tr><td colspan="3">8. Surat keterangan ini dibuat berdasarkan keterangan pelapor:</td></tr>
                <tr><td>Nama Lengkap</td><td>:</td><td><?= $anggotaKK['nama_lengkap']; ?></td></tr>
                <tr><td>NIK</td><td>:</td><td><?= $anggotaKK['nik']; ?></td></tr>
                <tr><td>Umur</td><td>:</td><td><?= $umurPelapor; ?></td></tr>
                <tr><td>Pekerjaan</td><td>:</td><td><?= $anggotaKK['pekerjaan']; ?></td></tr>
                <tr><td>Alamat</td><td>:</td><td><?= $alamat['alamat_lengkap']; ?>, <?= $alamat['kelurahan']; ?>, <?= $alamat['kota']; ?> Provinsi <?= $alamat['provinsi']; ?></td></tr>
                <tr><td>Hubungan pelapor dengan bayi</td><td>:</td><td><?= $surat['hubungan_dengan_bayi']; ?></td></tr>
            </table>
            <p>Demikian surat keterangan ini dibuat dengan sebenarnya, untuk dipergunakan sebagaimana mestinya.</p>
        </div>
        <div class="signature">
            <?php
            $formatter = new \IntlDateFormatter('id_ID', \IntlDateFormatter::LONG, \IntlDateFormatter::NONE);
            $tanggal = $formatter->format(new \DateTime($surat['updated_at']));
            ?>
            <p><?= $alamat['kota']; ?>, <?= $tanggal; ?></p>
            <br><br><br><br><br>
            <p><?= $kades['nama_lengkap']; ?></p>
            <p><?= $kades['nik']; ?></p>
        </div>
    </div>
    <div class="footer no-print">
        <button onclick="window.history.back()" class="back-btn">Kembali</button>
        <button onclick="printDocument()">Print Surat</button>
    </div>
</body>
</html>
