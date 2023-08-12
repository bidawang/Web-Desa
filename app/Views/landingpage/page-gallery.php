<?= $this->extend('templates_lp/main'); ?>

<?= $this->section('content'); ?>



<!-- Store Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h1 class="display-6">
                <?= $title ?>
            </h1>
        </div>
        <div class="row g-4">
            <?php foreach ($gallery as $gallery): ?>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="store-item position-relative text-center">
                        <img class="img-fluid" src="/uploads/<?= $gallery['nama_foto'] ?>" alt="" width="300" height="200">
                        <div class="p-4">
                            <h4 class="mb-3 text-primary">
                                <?= $gallery['judul_foto'] ?>
                            </h4>
                            <p>
                                <?= $gallery['deskripsi'] ?>
                            </p>
                            <!-- format hari bulan tahun -->
                            <p><small class="text-muted">Created at :
                                    <?= date('d F Y', strtotime($gallery['created_at'])); ?>
                                </small></p>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Store End -->



<?= $this->endSection(); ?>