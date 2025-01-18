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
                        <form action="/surat-create-kematian/<?= $pelayanan['id_pelayanan']; ?>" method="post" enctype="multipart/form-data" id="syaratForm">
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
                    <h4>Form Pengisian Surat Keterangan Kematian</h4>
                </div>
                <div class="card-body">
                    <form action="/surat-create-kematian/<?= $pelayanan['id_pelayanan']; ?>" method="post">
                    <div class="mb-3">
        <label for="nik_kematian" class="form-label">NIK Almarhum/Almarhumah</label>
        <input type="text" class="form-control" name="nik_kematian" id="nik_kematian" placeholder="Masukkan nama anak" required>
    </div>
    
    <div class="mb-3">
        <label for="datetime_kematian" class="form-label">Tanggal dan Waktu Kematian</label>
        <input type="datetime-local" class="form-control" name="datetime_kematian" id="datetime_kematian" required>
    </div>

    <div class="mb-3">
        <label for="penyebab_kematian" class="form-label">Penyebab Meninggalnya Almarhum/Almarhumah</label>
        <input type="text" class="form-control" name="penyebab_kematian" id="penyebab_kematian"  required>
    </div>
    <div class="mb-3">
        <label for="hubungan" class="form-label">Hubungan Dengan Almarhum/Almarhumah</label>
        <input type="text" class="form-control" name="hubungan" id="hubungan" placeholder="Contoh: Ayah, Ibu, dll." required>
    </div>
    <div class="mb-3">
        <label for="lokasi_kematian" class="form-label">Tempat Kematian</label>
        <textarea class="form-control" name="lokasi_kematian" id="lokasi_kematian" required></textarea>
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