<?= $this->extend('templates_lp/main'); ?>

<?= $this->section('content'); ?>

<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-12 wow fadeIn" data-wow-delay="0.5s">
                <div class="section-title-vh" style="text-align: center;">
                    <p class="fs-5 fw-medium fst-italic text-primary" style="margin-bottom: -1px;">Visi & Misi</p>
                    <h1 class="display-6"> <?= $pengaturan['nama_desa']; ?></h1>
                </div>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <h1>Visi</h1>
                        <?= $pengaturan['visi']; ?>
                    </div>
                    <div class="col-md-6">
                        <h1>Misi</h1>
                        <?= $pengaturan['misi']; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->

<?= $this->endSection(); ?>