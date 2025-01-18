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
                    <div class="row">
                        <div class="col">
                            <div class="card mb-3" style="max-width: 540px;">
                                <div class="row no-gutters">
                                    <div class="col-md-4">
                                        <img src="/uploads/<?= $gallery['nama_foto'] ?>" class="card-img"
                                            alt="<?= $gallery['nama_foto'] ?>">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title mb-2">
                                                <?= $gallery['judul_foto'] ?>
                                            </h5>
                                            <p class="card-text"><b>Description:
                                                    <?= $gallery['deskripsi'] ?>
                                                </b></p>
                                            <p class="card-text"><small class="text-muted">Created at :
                                                    <?= $gallery['created_at'] ?>
                                                </small></p>
                                            <br>
                                            <a href="/photo"><i class="fas fa-arrow-left"></i> Back</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
    </section>
    <!-- /.content -->
</div>
<?= $this->endSection(); ?>