<?= $this->extend('templates_lp/main'); ?>

<?= $this->section('content'); ?>

<!-- News Start -->
<div class="container-fluid product py-5 my-5">
    <div class="container py-5">
        <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="fs-5 fw-medium fst-italic text-primary">Berita Unggulan</p>
            <h1 class="display-6">Berita Terbaru Seputar Kawasan <?= $pengaturan['nama_desa']; ?></h1>
        </div>
        <div class="owl-carousel product-carousel wow fadeInUp" data-wow-delay="0.5s">
            <?php foreach ($berita as $b) : ?>
                <a href="<?= base_url('page-news/' . $b['slug']); ?>" class="d-block product-item rounded">
                    <img src="<?= base_url('uploads/' . $b['foto']); ?>" alt="<?= $b['judul_berita']; ?>">
                    <div class="bg-white shadow-sm text-center p-4 position-relative mt-n5 mx-4">
                        <p><strong><?= $b['judul_berita']; ?></strong></p>
                        <span class="text-body" id="news-content">
                            <?= $b['isi']; ?> Selengkapnya...
                        </span>
                        <span class="view-more" style="display: none;"></span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- News End -->

<?= $this->endSection(); ?>