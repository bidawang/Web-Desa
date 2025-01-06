<?= $this->extend('templates/main'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        <?= $title ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">
                            <?= $title ?>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- tabel menggunakan data table -->

            <div class="card">

                <div class="card-body">
                    <?php if (session()->getFlashdata('pesan')): ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('pesan') ?>
                        </div>
                    <?php endif; ?>


                    <form action="<?= base_url('/photo/save') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col">
                                <input type="text"
                                    class="form-control <?= (session('errors.judul_foto')) ? 'is-invalid' : '' ?>"
                                    placeholder="Title Photo" name="judul_foto" value="<?= old('judul_foto') ?>">
                                <?php if (session('errors.judul_foto')): ?>
                                    <div class="invalid-feedback">
                                        <?= session('errors.judul_foto') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col">
                                <input type="file" name="nama_foto"
                                    class="form-control <?= (session('errors.nama_foto')) ? 'is-invalid' : '' ?>">
                                <!-- tulisan max size di sebelah kiri  -->
                                <small class="text-muted mt-2">Max Size 2MB</small>
                                <?php if (session('errors.nama_foto')): ?>
                                    <div class="invalid-feedback">
                                        <?= session('errors.nama_foto') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">
                                <textarea name="deskripsi"
                                    class="form-control <?= (session('errors.deskripsi')) ? 'is-invalid' : '' ?>"
                                    placeholder="Description"><?= old('deskripsi') ?></textarea>
                                <?php if (session('errors.deskripsi')): ?>
                                    <div class="invalid-feedback">
                                        <?= session('errors.deskripsi') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        </div>
                    </form>
                    <!-- /.card-body -->
                </div>
    </section>
    <!-- /.content -->
</div>
<?= $this->endSection(); ?>