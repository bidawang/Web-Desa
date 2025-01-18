<?= $this->extend('templates/main'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Persyaratan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Persyaratan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Persyaratan untuk Pelayanan: <?= $pelayanan['judul_pelayanan']; ?></h3>
                        </div>
                        <div class="card-body">
                            <a href="<?= base_url('/pelayanan'); ?>" class="btn btn-secondary mb-3">Kembali</a>
                            <?php if (session('success')) : ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <?= session('success'); ?>
                                </div>
                            <?php endif; ?>

                            <?php if (session('error')) : ?>
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <?= session('error'); ?>
                                </div>
                            <?php endif; ?>

                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Persyaratan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($persyaratan as $syarat) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td>
                                                <?php
                                                // Pecah string ID menjadi array
                                                $syaratIds = explode(',', $syarat['persyaratan']);
                                                foreach ($syaratIds as $id) {
                                                    // Cari nama detail syarat berdasarkan ID
                                                    foreach ($detailsyarat as $detail) {
                                                        if ($detail['id_detail_syarat'] == $id) {
                                                            echo '- ' . $detail['syarat'] . '<br>';
                                                        }
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <form action="<?= base_url('/pelayanan/hapus_syarat/' . $syarat['id_syarat']); ?>" method="post" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus persyaratan ini?')">
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Persyaratan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>

                            <h4 class="mt-4">Tambah Persyaratan Baru</h4>
                            <div>
                            <form action="<?= base_url('/pelayanan/tambah_syarat/' . $pelayanan['id_pelayanan']); ?>" method="post">
    <?= csrf_field(); ?>
    <div class="form-group">
        <label for="syarat"><strong>Pilih Persyaratan</strong></label>
        <div>
            <?php
            // Urutkan data berdasarkan nama persyaratan ASCENDING atau DESCENDING
            usort($detailsyarat, function ($a, $b) {
                return strcmp($a['syarat'], $b['syarat']); // ASCENDING (A-Z)
                // Untuk DESCENDING, gunakan: return strcmp($b['syarat'], $a['syarat']);
            });

            // Loop semua detail syarat dan tampilkan checkbox
            foreach ($detailsyarat as $detail) :
            ?>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="syarat[]" value="<?= $detail['id_detail_syarat']; ?>" id="syarat<?= $detail['id_detail_syarat']; ?>">
                    <label class="form-check-label" for="syarat<?= $detail['id_detail_syarat']; ?>">
                        <?= esc($detail['syarat']); ?>
                    </label>
                </div>
            <?php endforeach; ?>
        </div>
        <?php if (session('errors.syarat')) : ?>
            <div class="invalid-feedback d-block">
                <?= session('errors.syarat'); ?>
            </div>
        <?php endif; ?>
    </div>
    <button type="submit" class="btn btn-primary mt-2">Tambah Persyaratan</button>
</form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>
