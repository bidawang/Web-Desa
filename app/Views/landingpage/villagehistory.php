<?= $this->extend('templates_lp/main'); ?>

<?= $this->section('content'); ?>

<!-- About Start -->
<div class="container-xxl py-5 mt-4">
    <div class="container">
        <div class="row g-5" style="text-align: center;">
            <div class="col-lg-12 wow fadeIn" data-wow-delay="0.5s">
                <div class="section-title-vh">
                    <p class="fs-5 fw-medium fst-italic text-primary" style="margin-bottom: -1px;">Sejarah</p>
                    <h1 class="display-6"> <?= $pengaturan['nama_desa']; ?></h1>
                </div>
                <div class="row g-3 mb-4">
                    <h5>Our tea is one of the most popular drinks in the world</h5>
                    <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->

<?= $this->endSection(); ?>