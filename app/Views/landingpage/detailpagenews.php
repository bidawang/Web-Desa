<?= $this->extend('templates_lp/main'); ?>

<?= $this->section('content'); ?>

<!-- Article Start -->

<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="back-page-news">
                <a href="/page-news" class="btn btn-primary rounded-pill py-3 px-5">Kembali</a>
            </div>
            <div class="col-lg-5 wow fadeIn" data-wow-delay="0.1s">
                <img class="img-fluid" src="<?= base_url('uploads/' . $berita['foto']); ?>" alt="">
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="section-title">
                    <h1 class="display-6"><?= $berita['judul_berita']; ?></h1>
                    <span><?= $formatted_date; ?></span>
                </div>
                <p class="mb-4"><?= $berita['isi']; ?></p>
            </div>
        </div>
    </div>
</div>
<!-- Article End -->

<?= $this->endSection(); ?>