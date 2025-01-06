<?= $this->extend('templates/main'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pelayanan</h1>
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
                            <h3 class="card-title">Tambah Data Pelayanan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- form start -->
                            <form action="<?= base_url('/pelayanan/store'); ?>" method="post">
                                <?= csrf_field(); ?>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="judul_pelayanan">Judul Pelayanan</label>
                                        <input type="text" class="form-control <?= (session('errors.judul_pelayanan')) ? 'is-invalid' : ''; ?>" id="judul_pelayanan" name="judul_pelayanan" placeholder="Judul Pelayanan" value="<?= old('judul_pelayanan'); ?>">
                                        <?php if (session('errors.judul_pelayanan')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.judul_pelayanan'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="deskripsi_pelayanan">Deskripsi Pelayanan</label>
                                        <textarea class="form-control <?= (session('errors.deskripsi_pelayanan')) ? 'is-invalid' : ''; ?>" id="deskripsi_pelayanan" name="deskripsi_pelayanan" placeholder="Deskripsi Singkat"><?= old('deskripsi_pelayanan'); ?></textarea>
                                        <?php if (session('errors.deskripsi_pelayanan')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.deskripsi_pelayanan'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="/news" class="btn btn-secondary">Kembali</a>
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
    </section>
</div>
<!-- /.container-fluid -->
<?= $this->endSection(); ?>