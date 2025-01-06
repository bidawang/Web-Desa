<?= $this->extend('templates/main'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Produk</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
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
                            <h3 class="card-title">Data Produk</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="/produk/create" class="btn btn-primary">Tambah Data +</a>
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
                                        <th>Image</th>
                                        <th>Nama Produk</th>
                                        <th>Deskripsi</th>
                                        <th>Pemilik Produk</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($produk as $p) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><img src="<?= base_url('/uploads/') . $p['foto']; ?>" alt="Foto" width="50" height="50"></td>
                                            <td><?= $p['nama_produk']; ?></td>
                                            <td><?= $p['deskripsi']; ?></td>
                                            <td><?= $p['pemilik_produk']; ?></td>
                                            <td><?= $p['created_at']; ?></td>
                                            <td>
                                                <a href="<?= base_url('/produk/edit/' . $p['id']); ?>" class="btn btn-sm btn-warning">Ubah</a>
                                                <a href="<?= base_url('/produk/delete/' . $p['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Berita Ini?')">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Image</th>
                                        <th>Nama Produk</th>
                                        <th>Deskripsi</th>
                                        <th>Pemilik Produk</th>
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