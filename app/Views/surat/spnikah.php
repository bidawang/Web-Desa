<?= $this->extend('templates/main'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pelayanan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pelayanan</li>
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
                            <h3 class="card-title">Data SK Domisili</h3>
                        </div>
                        <div class="card-body">
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
                                        <th>Nomor Surat</th>
                                        <th>Pengaju</th>
                                        <th>Calon Pasangan</th>
                                        <th>Pasangan Ke</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($surat as $p) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $p['nomor_surat']; ?></td>
                                            <td><?= $p['nik_pengaju']; ?>
                                            <br><?= $p['nik_pengaju']; ?> nama</br>
                                            <td><?= $p['nama_calon_pasangan']; ?>
                                            <br><?= $p['nik_pasangan']; ?>
                                            <br><?= $p['status_pasangan']; ?></td>
                                            <td><?= $p['pasangan_ke']; ?></td>
                                            <td>
                                                <form action="<?= base_url('/pelayanan/update_status/' . $p['id_pelayanan']); ?>" method="post" class="status-form" style="display:inline;">
                                                    <?= csrf_field(); ?>
                                                    <select class="form-control form-control-sm status-dropdown" name="status" data-id="<?= $p['id_pelayanan']; ?>">
                                                        <option value="pending" <?= $p['status'] === 'pending' ? 'selected' : ''; ?>>Proses</option>
                                                        <option value="acc" <?= $p['status'] === 'acc' ? 'selected' : ''; ?>>Selesai</option>
                                                        <option value="tolak" <?= $p['status'] === 'tolak' ? 'selected' : ''; ?>>Ditolak</option>
                                                    </select>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const statusDropdowns = document.querySelectorAll('.status-dropdown');

        statusDropdowns.forEach(dropdown => {
            dropdown.addEventListener('change', function () {
                const form = this.closest('.status-form');
                const selectedStatus = this.value;

                if (confirm(`Apakah Anda yakin ingin mengubah status menjadi "${selectedStatus}"?`)) {
                    form.submit();
                } else {
                    // Reset dropdown to its previous value if action is canceled
                    this.value = this.querySelector('option[selected]').value;
                }
            });
        });
    });
</script>

<?= $this->endSection(); ?>
