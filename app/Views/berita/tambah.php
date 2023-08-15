<?= $this->extend('templates/main'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Berita</h1>
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
                            <h3 class="card-title">Tambah Data Berita</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- form start -->
                            <form action="<?= base_url('/news/save'); ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="judul_berita">Judul Berita</label>
                                        <input type="text" class="form-control <?= (session('errors.judul_berita')) ? 'is-invalid' : ''; ?>" id="judul_berita" name="judul_berita" placeholder="Judul Berita" value="<?= old('judul_berita'); ?>">
                                        <?php if (session('errors.judul_berita')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.judul_berita'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="isi">Isi</label>
                                        <textarea class="form-control <?= (session('errors.isi')) ? 'is-invalid' : ''; ?>" id="isi" name="isi" placeholder="Isi Berita"><?= old('isi'); ?></textarea>
                                        <?php if (session('errors.isi')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.isi'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="kategori_berita">Kategori Berita</label>
                                        <input type="text" class="form-control <?= (session('errors.kategori_berita')) ? 'is-invalid' : ''; ?>" id="kategori_berita" name="kategori_berita" placeholder="Kategori Berita" value="<?= old('kategori_berita'); ?>">
                                        <?php if (session('errors.kategori_berita')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.kategori_berita'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="foto">Foto</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input <?= (session('errors.foto')) ? 'is-invalid' : ''; ?>" id="foto" name="foto" onchange="previewImage(this);">
                                                <label class="custom-file-label" for="foto">Choose file</label>
                                                <?php if (session('errors.foto')) : ?>
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.foto'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 mt-3">
                                            <img id="image-preview" src="<?= base_url('uploads/avatar.PNG'); ?>" alt="Selected Image" width="100" class="rounded-circle">
                                        </div>
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