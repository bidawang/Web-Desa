<?= $this->extend('templates_lp/main'); ?>

<?= $this->section('content'); ?>

<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-12 wow fadeIn" data-wow-delay="0.5s">
                <div class="section-title-vh" style="text-align: center;">
                    <p class="fs-5 fw-medium fst-italic text-primary" style="margin-bottom: -1px;">Potensi Wilayah</p>
                    <h1 class="display-6"> <?= $pengaturan['nama_desa']; ?></h1>
                </div>
                <div class="row g-3 mb-4">
                    <div class="col-md-12">
                        <h1>Foto</h1>
                        <img src="<?= base_url('uploads/potensi-wilayah.jpg'); ?>?>" class="img-fluid" alt="Potensi Wilayah">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->

<?= $this->endSection(); ?>