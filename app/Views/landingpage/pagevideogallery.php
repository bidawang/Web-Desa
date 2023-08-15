<?= $this->extend('templates_lp/main'); ?>

<?= $this->section('content'); ?>

<!-- Video Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="fs-5 fw-medium fst-italic text-primary"><?= $pengaturan['nama_desa']; ?></p>
            <h1 class="display-6">Galeri Video <br> <?= $pengaturan['nama_desa']; ?></h1>
        </div>
        <div class="row g-4">
            <?php foreach ($video as $row) : ?>
                <div class="col-lg-4 col-md-12 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="store-item position-relative text-center">
                        <iframe width="360" height="300" src="<?= $row['link']; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        <div class="p-4">
                            <h4 class="mb-3"><?= $row['judul_video']; ?></h4>
                            <!-- <p>Untuk Deskripsi</p> -->
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Video End -->


<?= $this->endSection(); ?>