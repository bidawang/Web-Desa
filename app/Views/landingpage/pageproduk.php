<?= $this->extend('templates_lp/main'); ?>

<?= $this->section('content'); ?>

<!-- News Start -->
<div class="container-fluid product py-5">
    <div class="container py-5">
        <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <!-- <p class="fs-5 fw-medium fst-italic text-primary">Produk Unggulan</p> -->
            <h1 class="display-6" style="margin-top: -80px;">Produk Unggulan <?= $pengaturan['nama_desa']; ?></h1>
        </div>
        <div class="owl-carousel product-carousel wow fadeInUp" data-wow-delay="0.5s">
            <?php foreach ($produk as $p) : ?>
                <a href="<?= base_url('page-produk/'.$p['nama_produk']);?>" class="d-block product-item rounded">
                    <img src="<?= base_url('uploads/' . $p['foto']); ?>" alt="<?= $p['nama_produk']; ?>" class="img-fluid" style="max-width: 500px; max-height: 300px;">
                    <div class="bg-white shadow-sm p-4 position-relative mt-n5 mx-4" style="height: 300px;">
                        <h4 class="text-primary text-center"><strong><?= $p['nama_produk']; ?></strong></h4>
                        <p class="text-center"><strong>Pemilik Produk : <?= $p['pemilik_produk']; ?></strong></p>
                        <div class="text-body" id="news-content" style="text-align: justify; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 5; -webkit-box-orient: vertical;">
                            <?= $p['deskripsi']; ?>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- News End -->

<?= $this->endSection(); ?>
