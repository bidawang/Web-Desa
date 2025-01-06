<?= $this->extend('templates_lp/main'); ?>

<?= $this->section('content'); ?>

<!-- konten setelah login -->
<div class="container-xxl py-3 mt-2">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-12 wow fadeIn" data-wow-delay="0.5s">
                <div class="text-center">
                    <div class="section-title-vh">
                        <p class="fs-5 fw-medium fst-italic text-primary" style="margin-bottom: -1px;">Pelayanan</p>
                        <h1 class="display-6">Pilihan Pelayanan Kami</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row for cards -->
        <div class="row justify-content-center g-4 mt-4">
        <?php foreach ($pelayanan as $item) : ?>
        <div class="col-sm-6 col-lg-3">
            <div class="card h-100 border-primary shadow">
                <div class="card-body text-center">
                    <h5 class="card-title text-primary"><?= $item['judul_pelayanan']; ?></h5>
                    <p class="card-text"><?= $item['deskripsi_pelayanan']; ?></p>
                    <form action="<?= base_url('/pelayanan-masyarakat/detail'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="id_pelayanan" value="<?= $item['id_pelayanan']; ?>">
                        <button type="submit" class="btn btn-primary">Selengkapnya</button>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>