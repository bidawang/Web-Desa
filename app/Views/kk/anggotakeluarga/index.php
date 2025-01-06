<?= $this->extend('templates/main'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Anggota Keluarga - <?= $kk['nomor_kk']; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Anggota Keluarga</h3>
                        </div>
                        <div class="card-body">
                            <a href="/kk" class="btn btn-danger">Kembali</a>
                            <a href="<?= base_url('/anggota-keluarga/create/' . $kk['id_kk']); ?>" class="btn btn-primary">Tambah Anggota +</a>
                            <?php if (session('message')) : ?>
                                <div class="alert alert-success alert-dismissible mt-3">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <?= session('message'); ?>
                                </div>
                            <?php endif; ?>

                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Hubungan</th>
                                        <th>Aksi</th>
                                        <th>Akun</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($anggota as $a) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $a['nama_lengkap']; ?></td>
                                            <td><?= $a['nik']; ?></td>
                                            <td><?= $a['id_kelahiran']; ?></td>
                                            <td><?= $a['hubungan_keluarga']; ?></td>
                                            <td>

                                            <div class="row">
                                                <a href="<?= base_url('/anggota-keluarga/edit/' . $a['id_anggota']); ?>" class="btn btn-sm btn-warning">Ubah</a>
                                                <form action="<?= base_url('/anggota-keluarga/delete/' . $a['id_anggota']); ?>" method="post" onsubmit="return confirm('Yakin ingin menghapus anggota ini?')">
                                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                </form>
                                                </div>
                                                </td>
                                                <td>
    <?php
    // Cek apakah id_anggota_keluarga ada di tb_user_masyarakat
    $db = \Config\Database::connect();

    $userMasyarakat = $db->table('tb_user_masyarakat')
                         ->where('id_anggota_keluarga', $a['id_anggota'])
                         ->get()
                         ->getRow();

    if (!$userMasyarakat) : // Jika tidak ada data di tb_user_masyarakat
    ?>
        <a href="<?= base_url('/user-masyarakat/create/' . $a['id_anggota']); ?>" class="btn btn-sm btn-success">Buat Akun</a>
    <?php else : // Jika sudah ada data di tb_user_masyarakat ?>
        <a href="<?= base_url('/user-masyarakat/view/' . $userMasyarakat->id_user_masyarakat); ?>" class="btn btn-sm btn-info">Lihat Detail</a>
        <a href="<?= base_url('/user-masyarakat/edit/' . $userMasyarakat->id_user_masyarakat); ?>" class="btn btn-sm btn-warning">Edit Akun</a>
    <?php endif; ?>
</td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Hubungan</th>
                                        <th>Aksi</th>
                                        <th>Akun</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>
