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
                            <h3 class="card-title">Data SK Kematian</h3>
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
                                        <th>Pelapor</th>
                                        <th>NIK Yang Meninggal</th>
                                        <th>Tanggal Kejadian</th>
                                        <th>Lokasi Kejadian</th>
                                        <th>Penyebab Kematian</th>
                                        <th>Hubungan Dengan Almarhum/Almarhumah</th>
                                        <th>Detail</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($surat as $p) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $p['nomor_surat']; ?></td>
                                            <td><?= $p['nik_pengaju']; ?><br><?= $pengaju['nama_lengkap'] ?></td>
                                            <td><?= $p['nik_kematian']; ?><br><?= $kematian['nama_lengkap'] ?></td>
                                            <td><?= $p['datetime_kematian']; ?></td>
                                            <td><?= $p['lokasi_kematian']; ?></td>
                                            <td><?= $p['penyebab_kematian']; ?></td>
                                            <td><?= $p['hubungan']; ?></td>

                                            <td>
                                                <!-- Button to trigger modal -->
                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#detailModal<?= $p['id_sk_kematian']; ?>">Lihat Detail</button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="detailModal<?= $p['id_sk_kematian']; ?>" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel<?= $p['id_sk_kematian']; ?>" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="detailModalLabel<?= $p['id_sk_kematian']; ?>">Detail SK Kematian</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- Detail Information -->
                                                                <div class="text-center">
                                                                    <h6 class="font-weight-bold mb-3"><?= $pengaju['nama_lengkap'] ?? 'Tidak Ditemukan'; ?></h6>
                                                                    <h6 class="font-weight-bold mb-3">No HP: <?= $no_hp['no_hp'] ?? 'Tidak Ditemukan'; ?></h6>
                                                                </div>

                                                                <!-- Foto Section -->
                                                                <?php if (!empty($p['bukti'])): ?>
                                                                    <div class="row">
                                                                        <?php foreach ($p['bukti'] as $dokumen): ?>
                                                                            <div class="col-md-6 mb-3 text-center">
                                                                                <label class="d-block"><?= htmlspecialchars($dokumen['jenis_dokumen'], ENT_QUOTES, 'UTF-8'); ?></label>
                                                                                <img 
                                                                                    src="<?= base_url('bukti_dokumen/' . htmlspecialchars($dokumen['nama_file'], ENT_QUOTES, 'UTF-8')); ?>" 
                                                                                    alt="Foto" 
                                                                                    class="img-fluid rounded border"
                                                                                    style="max-height: 300px; object-fit: cover;">
                                                                            </div>
                                                                        <?php endforeach; ?>
                                                                    </div>
                                                                <?php else: ?>
                                                                    <p class="text-muted">Tidak ada foto yang tersedia.</p>
                                                                <?php endif; ?>

                                                                <!-- Print Link -->
                                                                <div class="text-center m-4">
                                                                    <a class="btn btn-success btn-sm text-center" href="<?= base_url('kitaprint_surat/1/' . $p['id_sk_kematian']); ?>" target="_blank">
                                                                        <?= esc($p['nomor_surat']); ?>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <form action="<?= base_url('/pelayanan/update_status/' . $p['id_sk_kematian']); ?>" method="post" class="status-form" style="display:inline;">
                                                    <?= csrf_field(); ?>
                                                    <select class="form-control form-control-sm status-dropdown" name="status" data-id="<?= $p['id_pelayanan']; ?>">
                                                        <option value="pending" <?= $p['status'] === 'pending' ? 'selected' : ''; ?>>Proses</option>
                                                        <option value="acc" <?= $p['status'] === 'acc' ? 'selected' : ''; ?>>Selesai</option>
                                                        <option value="tolak" <?= $p['status'] === 'tolak' ? 'selected' : ''; ?>>Ditolak</option>
                                                    </select>
                                                    <input type="hidden" name="id_pelayanan" value="<?= $p['id_pelayanan']; ?>">
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
