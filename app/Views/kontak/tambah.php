<?= $this->extend('templates/main'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kontak</h1>
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
                            <h3 class="card-title">Tambah Data Kontak</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- form start -->
                            <form action="/kontak/save" method="post">
                                <?= csrf_field(); ?>
                                <div class="card-body">
                                    <!-- deskripsi_kontak -->
                                    <div class="form-group">
                                        <label for="deskripsi_kontak">Deskripsi Kontak</label>
                                        <input type="text" class="form-control <?= (session('errors.deskripsi')) ? 'is-invalid' : ''; ?>" id="deskripsi_kontak" name="deskripsi_kontak" placeholder="Tambahkan Deskripsi" value="<?= old('deskripsi_kontak'); ?>">
                                        <?php if (session('errors.deskripsi_kontak')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.deskripsi_kontak'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                        
                                    <!-- email -->
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control <?= (session('errors.email')) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="Tambahkan Email" value="<?= old('email'); ?>">
                                        <?php if (session('errors.email')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.email'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- no hp -->
                                    <div class="form-group">
                                        <label for="no_telp">No HP</label>
                                        <input type="tel" class="form-control <?= (session('errors.no_telp')) ? 'is-invalid' : ''; ?>" id="no_telp" name="no_telp" placeholder="Tambahkan No HP" value="<?= old('no_telp'); ?>">
                                        <?php if (session('errors.no_telp')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.no_telp'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- alamat -->
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control <?= (session('errors.alamat')) ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" placeholder="Tambahkan Alamat" value="<?= old('alamat'); ?>">
                                        <?php if (session('errors.alamat')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.alamat'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <a class="btn btn-warning" href="/kontak">Kembali</a>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
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
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= $this->endSection(); ?>
