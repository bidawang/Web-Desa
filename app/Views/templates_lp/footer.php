<div class="container-fluid bg-dark footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <h4 class="text-primary mb-4">Kantor Desa</h4>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary me-3"></i><?= $kontak['alamat']; ?></p>
                <p class="mb-2"><i class="fa fa-phone-alt text-primary me-3"></i><?= $kontak['no_telp']; ?></p>
                <p class="mb-2"><i class="fa fa-envelope text-primary me-3"></i><?= $kontak['email']; ?></p>
                <div class="d-flex pt-3">
                    <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i class="fab fa-youtube"></i></a>
                    <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-primary mb-4">Tautan Terkait</h4>
                <?php foreach ($link as $row) : ?>
                    <a target="_blank" class="btn btn-link" href="<?= $row['link']; ?>"><?= $row['nama']; ?></a>
                <?php endforeach; ?>

            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-primary mb-4">Jam Kerja</h4>
                <p class="mb-1"><?= $pengaturan['hari']; ?></p>
                <h6 class="text-light"><?= $pengaturan['waktu_bisnis']; ?></h6>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-primary mb-4">Pemberitahuan</h4>
                <p>
                    <?= $kontak['deskripsi_kontak'] ?>
                </p>
            </div>
        </div>
    </div>
</div>