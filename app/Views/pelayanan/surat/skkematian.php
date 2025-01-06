<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Keterangan Kematian</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            font-size: 12px;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f4f4f4;
        }
        .card {
            background: #ffffff;
            width: 210mm;
            height: auto;
            max-width: 100%;
            padding: 20mm;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 22px;
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
            padding: 8px 15px;
            vertical-align: top;
            border-bottom: 1px solid #ddd;
        }
        .content td:first-child {
            width: 30%;
            font-weight: bold;
        }
        .content td:last-child {
            width: 70%;
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
                font-size: 18px;
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
            <h1>KOP SURAT DESA</h1>
            <p>Kecamatan <?= $alamat['kecamatan']; ?>, Kabupaten <?= $alamat['kota']; ?></p>
            <p>Provinsi <?= $alamat['provinsi']; ?></p>
        </div>
        <center>
            <h2 style="margin-bottom: -10px; margin-top: 10px;">SURAT KETERANGAN KEMATIAN</h2>
            <h3>Kode Surat Menyurat</h3>
        </center>
        <div class="content">
            <p>Yang bertanda tangan di bawah ini Kepala Desa <?= $alamat['kelurahan']; ?> Kecamatan <?= $alamat['kecamatan']; ?> Kabupaten <?= $alamat['kota']; ?> Provinsi <?= $alamat['provinsi']; ?> menerangkan dengan sebenarnya bahwa:</p>
            <table>
                <tr>
                    <td>1. Nama Almarhum/Almarhumah</td>
                    <td>:</td>
                    <td><?= $anggotaKK['nama_lengkap']; ?></td>
                </tr>
                <tr>
                    <td>2. NIK / No KTP</td>
                    <td>:</td>
                    <td><?= $surat['nik_kematian']; ?></td>
                </tr>
                <tr>
                    <td>3. Tempat/Tanggal Lahir</td>
                    <td>:</td>
                    <td><?= $kelahiran['tempat_lahir']; ?>, <?= $kelahiran['tanggal_lahir']; ?></td>
                </tr>
                <tr>
                    <td>4. Jenis Kelamin</td>
                    <td>:</td>
                    <td><?= $anggotaKK['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan'; ?></td>
                </tr>
                <tr>
                    <td>5. Agama</td>
                    <td>:</td>
                    <td><?= $anggotaKK['agama']; ?></td>
                </tr>
                <tr>
                    <td>6. Alamat</td>
                    <td>:</td>
                    <td><?= $alamat['alamat_lengkap']; ?>, RT <?= $alamat['rt']; ?> RW <?= $alamat['rw']; ?>, Kecamatan <?= $alamat['kecamatan']; ?>, Kabupaten <?= $alamat['kota']; ?></td>
                </tr>
                <tr>
                    <td>7. Penyebab Kematian</td>
                    <td>:</td>
                    <td><?= $surat['penyebab_kematian']; ?></td>
                </tr>
                <tr>
                    <td>8. Tanggal Kematian</td>
                    <td>:</td>
                    <td><?= $surat['datetime_kematian']; ?></td>
                </tr>
            </table>
            <p>Demikian surat keterangan ini dibuat dengan sebenar-benarnya untuk dipergunakan sebagaimana mestinya.</p>
        </div>
        <div class="signature">
            <?php
            $formatter = new \IntlDateFormatter(
                'id_ID',
                \IntlDateFormatter::LONG,
                \IntlDateFormatter::NONE
            );

            // Format tanggal
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
