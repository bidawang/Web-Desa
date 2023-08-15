<?= $this->extend('templates/main'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Desa</h1>
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

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
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
                            <!-- form start -->
                            <form action="settings/update" method="post">
                                <?= csrf_field(); ?>
                                <div class="card-body">
                                    <!-- Input fields for editing -->
                                    <div class="form-group">
                                        <label for="nama_desa">Nama Desa</label>
                                        <input type="text" class="form-control <?= (session('errors.nama_desa')) ? 'is-invalid' : ''; ?>" id="nama_desa" name="nama_desa" value="<?= $pengaturan['nama_desa']; ?>">
                                        <?php if (session('errors.nama_desa')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.nama_desa'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="sejarah_desa">Sejarah Desa</label>
                                        <textarea class="form-control <?= (session('errors.sejarah_desa')) ? 'is-invalid' : ''; ?>" id="sejarah_desa" name="sejarah_desa"><?= $pengaturan['sejarah_desa']; ?></textarea>
                                        <?php if (session('errors.sejarah_desa')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.sejarah_desa'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="kalimat_ucapan">Kalimat Ucapan</label>
                                        <textarea class="form-control <?= (session('errors.kalimat_ucapan')) ? 'is-invalid' : ''; ?>" id="kalimat_ucapan" name="kalimat_ucapan"><?= $pengaturan['kalimat_ucapan']; ?></textarea>
                                        <?php if (session('errors.kalimat_ucapan')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.kalimat_ucapan'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="visi">Visi</label>
                                        <textarea class="form-control <?= (session('errors.visi')) ? 'is-invalid' : ''; ?>" id="visi" name="visi"><?= $pengaturan['visi']; ?></textarea>
                                        <?php if (session('errors.visi')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.visi'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="misi">Misi</label>
                                        <textarea class="form-control <?= (session('errors.misi')) ? 'is-invalid' : ''; ?>" id="misi" name="misi"><?= $pengaturan['misi']; ?></textarea>
                                        <?php if (session('errors.misi')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.misi'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="titik_koordinator">Titik Koordinat</label>
                                        <input type="text" class="form-control <?= (session('errors.titik_koordinator')) ? 'is-invalid' : ''; ?>" id="titik_koordinator" name="titik_koordinator" value="<?= $pengaturan['titik_koordinator']; ?>">
                                        <?php if (session('errors.titik_koordinator')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.titik_koordinator'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah_rt">Jumlah RT</label>
                                        <input type="text" class="form-control <?= (session('errors.jumlah_rt')) ? 'is-invalid' : ''; ?>" id="jumlah_rt" name="jumlah_rt" value="<?= $pengaturan['jumlah_rt']; ?>">
                                        <?php if (session('errors.jumlah_rt')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.jumlah_rt'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah_penduduk">Jumlah Penduduk</label>
                                        <input type="text" class="form-control <?= (session('errors.jumlah_penduduk')) ? 'is-invalid' : ''; ?>" id="jumlah_penduduk" name="jumlah_penduduk" value="<?= $pengaturan['jumlah_penduduk']; ?>">
                                        <?php if (session('errors.jumlah_penduduk')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.jumlah_penduduk'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="hari">Hari</label>
                                        <input type="text" class="form-control <?= (session('errors.hari')) ? 'is-invalid' : ''; ?>" id="hari" name="hari" value="<?= $pengaturan['hari']; ?>">
                                        <?php if (session('errors.hari')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.hari'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="waktu_bisnis">Waktu Bisnis</label>
                                        <input type="text" class="form-control <?= (session('errors.waktu_bisnis')) ? 'is-invalid' : ''; ?>" id="waktu_bisnis" name="waktu_bisnis" value="<?= $pengaturan['waktu_bisnis']; ?>">
                                        <?php if (session('errors.waktu_bisnis')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.waktu_bisnis'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="/" class="btn btn-secondary">Back</a>
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
</div>

<?= $this->endSection(); ?>