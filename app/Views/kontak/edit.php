<?= $this->extend('templates/main'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Quick Link</h1>
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
                            <h3 class="card-title">Ubah Data Kontak</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- form start -->
                            <form action="<?= base_url('/kontak/update/' . $kontak['id']); ?>" method="post">
                                <?= csrf_field(); ?>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="deskripsi_kontak">Deskripsi</label>
                                        <input type="text" class="form-control <?= (session('errors.deskripsi_kontak')) ? 'is-invalid' : ''; ?>" id="deskripsi_kontak" name="deskripsi_kontak" placeholder="Tambahkan deskripsi" value="<?= $kontak['deskripsi_kontak']; ?>">
                                        <?php if (session('errors.deskripsi')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.deskripsi'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <!-- email -->
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control <?= (session('errors.email')) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="Tambahkan email" value="<?= $kontak['email']; ?>">
                                        <?php if (session('errors.email')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.email'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- no_telp -->
                                    <div class="form-group">
                                        <label for="no_telp">No Telepon</label>
                                        <input type="text" class="form-control <?= (session('errors.no_telp')) ? 'is-invalid' : ''; ?>" id="no_telp" name="no_telp" placeholder="Tambahkan no telepon" value="<?= $kontak['no_telp']; ?>">
                                        <?php if (session('errors.no_telp')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.no_telp'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- alamat -->
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control <?= (session('errors.alamat')) ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" placeholder="Tambahkan alamat" value="<?= $kontak['alamat']; ?>">
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
                                    <button type="submit" class="btn btn-primary">ubah</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
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