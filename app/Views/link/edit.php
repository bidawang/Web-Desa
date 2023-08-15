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
                            <h3 class="card-title">Ubah Data Quick Link</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- form start -->
                            <form action="<?= base_url('/link/update/' . $link['id']); ?>" method="post">
                                <?= csrf_field(); ?>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nama">Judul Video</label>
                                        <input type="text" class="form-control <?= (session('errors.nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" placeholder="Tambahkan Judul Video" value="<?= $link['nama']; ?>">
                                        <?php if (session('errors.nama')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.nama'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="link">Link Video</label>
                                        <input type="text" class="form-control <?= (session('errors.link')) ? 'is-invalid' : ''; ?>" id="link" name="link" placeholder="Tambahkan Link Video yang Bersala Dari Youtube" value="<?= $link['link']; ?>">
                                        <?php if (session('errors.link')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.link'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <a class="btn btn-warning" href="/link">Kembali</a>
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