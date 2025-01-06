<?= $this->extend('templates_lp/main'); ?>

<?= $this->section('content'); ?>

<!-- News Start -->
<div class="container-fluid product">
    <div class="container py-5">
        <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="fs-5 fw-medium fst-italic text-primary">Berita Unggulan</p>
            <h1 class="display-6">Berita Terbaru Seputar Kawasan <?= $pengaturan['nama_desa']; ?></h1>
        </div>

        <div class="row wow fadeInUp" data-wow-delay="0.5s">
            <!-- Sisi Kiri (Berita Terbaru - Terpengaruh Pagination) -->
            <div class="col-lg-8 col-md-12">
                <?php 
                // Menampilkan berita terbaru sesuai dengan halaman (pagination)
                $counter = 0; 
                foreach ($berita as $b): 
                    if ($counter >= 3) break; // Batasi hanya 3 berita pertama pada halaman ini
                ?>
                    <a href="<?= base_url('page-news/' . $b['slug']); ?>" class="d-block product-item rounded mb-4">
                        <div class="bg-white shadow-sm text-center p-4 mt-2">
                            <img src="<?= base_url('uploads/' . $b['foto']); ?>" alt="<?= $b['judul_berita']; ?>" class="img-fluid mb-3">
                            <h5 class="fw-bold"><?= $b['judul_berita']; ?></h5>
                            <p class="text-body"><?= substr(strip_tags($b['isi']), 0, 150); ?>...</p>
                        </div>
                    </a>
                <?php $counter++; endforeach; ?>
            </div>

            <!-- Sisi Kanan (Berita Populer - Data dari tabel populer) -->
            <div class="card col-lg-4 col-md-12 mt-4 mt-lg-0">
                <div class="text-center mx-auto wow fadeInUp mt-3" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1>Berita Populer</h1>
                </div>
                <?php 
                foreach ($populerBerita as $b): 
                ?>
                    <a href="<?= base_url('page-news/' . $b['slug']); ?>" class="d-block product-item rounded mb-3">
                        <div class="bg-white shadow-sm text-center p-3">
                            <img src="<?= base_url('uploads/' . $b['foto']); ?>" alt="<?= $b['judul_berita']; ?>" class="img-fluid mb-2">
                            <h6 class="fw-bold"><?= $b['judul_berita']; ?></h6>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Pagination Links untuk berita terbaru -->
        <div class="d-flex justify-content-center mt-4">
            <?= $pager->links('berita', 'bootstrap_pagination'); ?>
        </div>
    </div>
</div>
<!-- News End -->

<?= $this->endSection(); ?>
