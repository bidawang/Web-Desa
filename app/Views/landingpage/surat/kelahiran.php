<?= $this->extend('templates_lp/main'); ?>

<?= $this->section('content'); ?>

<!-- Detail Pelayanan Masyarakat Start -->
<div class="container-xxl py-2">
    <div class="container">
        <div class="section-title">
            <h1 class="display-6"><?= $pelayanan['judul_pelayanan']; ?></h1>
            <span><?= $pelayanan['deskripsi_pelayanan']; ?></span>
        </div>
        <div class="row justify-content-around">
        
        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <ul class="mb-4">
                    <strong>Dokumen Persyaratan Yang Wajib Diupload:</strong>
                    <?php if (!empty($syarat)) : ?>
                        <form action="/surat-create-kelahiran/<?= $pelayanan['id_pelayanan']; ?>" method="post" enctype="multipart/form-data" id="syaratForm">   
                        <?= csrf_field(); ?> <!-- Make sure to include CSRF token for form submission -->
                            <?php foreach ($syarat as $item) : ?>
                                <?php if (!empty($item['id_pelayanan'])) : ?>
                                    <?php foreach (explode(',', $item['persyaratan']) as $dokumen) : ?>
                                        <?php 
                                            $detail = array_filter($detailsyarat, function($d) use ($dokumen) {
                                                return $d['id_detail_syarat'] == $dokumen;
                                            });
                                            $detail = reset($detail); // Ensure we get the first (and only) matching element
                                        ?>
                                        <div style="margin-bottom: 10px;">
                                            <label for="dokumen_<?= esc($detail['id_detail_syarat']); ?>">
                                                <?= esc($detail['syarat']); ?>
                                            </label>
                                            <!-- Hidden input to store the document type -->
                                            <input type="hidden" name="jenis_dokumen[]" value="<?= esc($detail['syarat']); ?>" id="">
                                            <!-- File input for the user to upload the document -->
                                            <input type="file" name="dokumen_files[]" id="dokumen_<?= esc($detail['id_detail_syarat']); ?>" class="form-control" required>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <p>Tidak ada dokumen persyaratan.</p>
                                <?php endif; ?>
                            <?php endforeach; ?>
                    <?php else : ?>
                        <p>Tidak ada syarat untuk pelayanan ini.</p>
                    <?php endif; ?>
                </ul>
            </div>
<div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
<div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Form Pengisian Surat Keterangan Kelahiran</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
        <label for="nama_anak" class="form-label">Nama Anak</label>
        <input type="text" class="form-control" name="nama_anak" id="nama_anak" placeholder="Masukkan nama anak" required>
    </div>
    <div class="mb-3">
        <label for="anak_ke" class="form-label">Anak Ke Berapa</label>
        <input type="text" class="form-control" name="anak_ke" id="anak_ke" required>
    </div>
    <div class="row">
    <div class="mb-3 col-6">
    <label for="date_kelahiran" class="form-label">Tanggal Kelahiran</label>
    <input type="date" class="form-control" name="date_kelahiran" id="date_kelahiran" required>
</div>
<div class="mb-3 col-6">
    <label for="time_kelahiran" class="form-label">Waktu Kelahiran</label>
    <input type="time" class="form-control" name="time_kelahiran" id="time_kelahiran" required>
</div>
</div>
    <div class="mb-3">
        <label for="kelamin_anak" class="form-label">Jenis Kelamin Anak</label>
        <select class="form-control" name="kelamin_anak" id="kelamin_anak" required>
            <option value="">Pilih Jenis Kelamin</option>
            <option value="laki">Laki-laki</option>
            <option value="bini">Perempuan</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="tempat_lahir_anak" class="form-label">Tempat Lahir Anak</label>
        <textarea class="form-control" name="tempat_lahir_anak" id="tempat_lahir_anak" required></textarea>
    </div>
    <div class="d-grid">
        <button type="submit" id="submitButton" class="btn btn-primary">Kirim</button>
    </div>
</form>

                </div>
                
            </div>
</div>
</div>
<script>
            const checkboxes = document.querySelectorAll('.dokumen-checkbox');
            const submitButton = document.getElementById('submitButton');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', () => {
                    submitButton.disabled = !Array.from(checkboxes).every(cb => cb.checked);
                });
            });
        </script>
    </div>
</div>
<!-- Detail Pelayanan Masyarakat End -->

<?= $this->endSection(); ?>