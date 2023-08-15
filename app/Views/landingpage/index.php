<?= $this->extend('templates_lp/main'); ?>

<?= $this->section('content'); ?>
<!-- Carousel Start -->
<div class="container-fluid px-0 mb-5">
    <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php foreach ($gallery as $index => $image): ?>
                        <div class="carousel-item <?= ($index == 1) ? 'active' : ''; ?>">
                            <img class="w-100" src="/uploads/<?= $image['nama_foto']; ?>" alt="Image">
                            <div class="carousel-caption">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-7 text-center">
                                            <p class="fs-4 text-white animated zoomIn">Selamat Datang di <strong class="text-dark text-bold" >Wesbsite</strong> Resmi</p>
                                            <h1 class="display-1 text-dark mb-4 animated zoomIn">
                                            <?= $pengaturan['nama_desa']?>
                                            </h1>
                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>


                <!-- Tombol navigasi carousel -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!-- Carousel End -->


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
                            <?= $b['isi']; ?>
                        </span>
                        <span class="view-more" style="display: none;"></span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- News End -->


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


<!-- Video Modal Start -->
<div class="modal modal-video fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Youtube Video</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- 16:9 aspect ratio -->
                <div class="ratio ratio-16x9">
                    <iframe class="embed-responsive-item" src="" id="video" allowfullscreen allowscriptaccess="always"
                        allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Video Modal End -->



<!-- Contact Start -->
<div class="container-xxl contact py-5">
    <div class="container">
        <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="fs-5 fw-medium fst-italic text-primary">Kontak Kami</p>
            <h1 class="display-6"></h1>
        </div>
        <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.1s">
            <div class="col-lg-8">
                <p class="text-center mb-5">
                <?= $kontak['deskripsi'] ?>   
                </p>
                <div class="row g-5">
                    <div class="col-md-4 text-center wow fadeInUp" data-wow-delay="0.3s">
                        <div class="btn-square mx-auto mb-3">
                            <i class="fa fa-envelope fa-2x text-white"></i>
                        </div>
                        <p class="mb-2"><?= $kontak['email'] ?></p>
                        <p class="mb-0"><?= $kontak['email'] ?></p>
                    </div>
                    <div class="col-md-4 text-center wow fadeInUp" data-wow-delay="0.4s">
                        <div class="btn-square mx-auto mb-3">
                            <i class="fa fa-phone fa-2x text-white"></i>
                        </div>
                        <p class="mb-2"><?= $kontak['no_telp'] ?></p>
                        <p class="mb-0"><?= $kontak['no_telp'] ?></p>
                    </div>
                    <div class="col-md-4 text-center wow fadeInUp" data-wow-delay="0.5s">
                        <div class="btn-square mx-auto mb-3">
                            <i class="fa fa-map-marker-alt fa-2x text-white"></i>
                        </div>
                        <p class="mb-2"><?= $kontak['alamat'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact Start -->

<?= $this->endSection(); ?>