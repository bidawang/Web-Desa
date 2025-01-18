<?= $this->extend('templates_lp/main'); ?>

<?= $this->section('content'); ?>

<!-- Produk Start -->
<div class="container-fluid product py-5">
    <div class="container py-5">
        <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h1 class="display-6" style="margin-top: -80px;">Produk Unggulan <?= $pengaturan['nama_desa']; ?></h1>
        </div>

        <!-- Form Pencarian -->
        <form method="get" class="mb-4 wow fadeInUp" data-wow-delay="0.1s">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari produk..." value="<?= esc($search) ?>">
                <button class="btn btn-primary" type="submit">Cari</button>
            </div>
        </form>

        <div class="row">
            <?php if (count($produk) > 0): ?>
                <?php foreach ($produk as $p): ?>
                    <div class="col-md-4 mb-4 wow fadeInUp" data-wow-delay="0.1s">
                        <a href="<?= base_url('page-produk/' . $p['nama_produk']); ?>" class="d-block product-item rounded">
                            <img src="<?= base_url('uploads/' . $p['foto']); ?>" alt="<?= $p['nama_produk']; ?>" class="img-fluid" style="max-width: 500px; max-height: 300px;">
                            <div class="bg-white shadow-sm p-4 position-relative mt-n5 mx-4" style="height: 300px;">
                                <h4 class="text-primary text-center"><strong><?= $p['nama_produk']; ?></strong></h4>
                                <p class="text-center"><strong>Pemilik Produk: <?= $p['pemilik_produk']; ?></strong></p>
                                <div class="text-body" id="news-content" style="text-align: justify; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 5; -webkit-box-orient: vertical;">
                                    <?= $p['deskripsi']; ?>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p>Produk tidak ditemukan.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            <?= $pager->links('produk', 'bootstrap_pagination') ?>
        </div>
    </div>
</div>
<!-- Produk End -->

<?= $this->endSection(); ?>
