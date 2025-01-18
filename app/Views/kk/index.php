<?= $this->extend('templates/main'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kartu Keluarga</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <!-- <li class="breadcrumb-item active"><?= $title; ?></li> -->
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Kartu Keluarga</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="/kk/create" class="btn btn-primary">Tambah Data KK +</a>
                            <?php if (session('success')) : ?>
                                <div class="alert alert-success alert-dismissible mt-3">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <?= session('success'); ?>
                                </div>
                            <?php endif; ?>

                            <?php if (session('error')) : ?>
                                <div class="alert alert-danger alert-dismissible mt-3">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <?= session('error'); ?>
                                </div>
                            <?php endif; ?>

                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor KK</th>
                                        <th>Nama Kepala Keluarga</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($kk as $k) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $k['nomor_kk']; ?></td>
                                            <td><?= $k['nama_lengkap']?></td>
                                            <td><?= $k['tanggal_dibuat']; ?></td>
                                            <td>
    <a href="<?= base_url('/kk/edit/' . $k['id_kk']); ?>" class="btn btn-sm btn-warning">Ubah</a>
    <a href="<?= base_url('/anggota-keluarga/' . $k['id_kk']); ?>" class="btn btn-sm btn-primary">Anggota Keluarga</a>
    <form action="<?= base_url('/kk/delete/' . $k['id_kk']); ?>" method="post" style="display: inline;" onsubmit="return confirm('Apakah Anda Yakin Ingin Menghapus Kartu Keluarga Ini?')">
        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
    </form>
</td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor KK</th>
                                        <th>Nama Kepala Keluarga</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
</div>

<?= $this->endSection(); ?>
