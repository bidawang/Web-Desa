<?= $this->extend('templates_lp/main'); ?>

<?= $this->section('content'); ?>

<!-- Video Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="fs-5 fw-medium fst-italic text-primary"><?= $pengaturan['nama_desa']; ?></p>
            <h1 class="display-6">Galeri Video <br> <?= $pengaturan['nama_desa']; ?></h1>
        </div>

        <!-- Form Pencarian -->
        <form method="get" class="mb-4 wow fadeInUp" data-wow-delay="0.1s">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan judul..." value="<?= esc($search) ?>">
                <button class="btn btn-primary" type="submit">Cari</button>
            </div>
        </form>

        <div class="row g-4">
            <?php if (count($video) > 0): ?>
                <?php foreach ($video as $row): ?>
                    <div class="col-lg-4 col-md-12 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="store-item position-relative text-center">
                            <iframe width="100%" height="250px" src="<?= $row['link']; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                            <div class="p-4">
                                <h4 class="mb-3"><?= $row['judul_video']; ?></h4>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p>Video tidak ditemukan.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            <?= $pager->links('video', 'bootstrap_pagination') ?>
        </div>
    </div>
</div>
<!-- Video End -->

<?= $this->endSection(); ?>
