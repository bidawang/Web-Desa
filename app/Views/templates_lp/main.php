<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $title; ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="<?= base_url('assets-landingpage/'); ?>img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= base_url('assets-landingpage/'); ?>lib/animate/animate.min.css" rel="stylesheet">
    <link href="<?= base_url('assets-landingpage/'); ?>lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= base_url('assets-landingpage/'); ?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?= base_url('assets-landingpage/'); ?>css/style1.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>

    <style>
        .carousel-inner img {
            width: 100%;
            /* Lebar gambar 100% dari container */
            height: 600px;
            /* Tetapkan tinggi gambar */
            object-fit: cover;
            /* Gambar akan mengisi area dengan mempertahankan rasio aspek */
        }

        .product-item img {
    width: 100%;
    height: 300px; /* Sesuaikan dengan ukuran yang kamu inginkan */
    object-fit: cover; /* Memastikan gambar akan di-crop agar sesuai dengan kontainer */
    object-position: center; /* Gambar akan terpusat */
}


.news-box {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 200px; /* Sesuaikan tinggi box sesuai kebutuhan */
}

.news-title {
    font-size: 1rem;
    line-height: 1.5em; /* Tinggi per baris teks */
    max-height: calc(1.5em * 3); /* Maksimal 3 baris teks */
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 3; /* Batasi hingga 3 baris */
    -webkit-box-orient: vertical;
}

/* Tooltip efek */
.news-title:hover {
    cursor: pointer;
    position: relative;
}

/* Tooltip konten */
.news-title:hover::after {
    content: attr(title); /* Ambil teks dari atribut title */
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
    background-color: rgba(0, 0, 0, 0.75);
    color: #fff;
    padding: 5px 10px;
    font-size: 0.9rem;
    border-radius: 4px;
    white-space: nowrap;
    z-index: 100;
    margin-top: 5px;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s ease, visibility 0.3s ease;
}

/* Tooltip terlihat saat hover */
.news-title:hover::after {
    opacity: 1;
    visibility: visible;
}




    </style>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <?= $this->include('templates_lp/navbar'); ?>
    <!-- Navbar End -->

    <!-- Content Wrapper. Contains page content -->
    <?= $this->renderSection('content'); ?>
    <!-- /.content-wrapper -->

    <!-- Footer Start -->
    <?= $this->include('templates_lp/footer'); ?>
    <!-- Footer End -->



    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets-landingpage/'); ?>lib/wow/wow.min.js"></script>
    <script src="<?= base_url('assets-landingpage/'); ?>lib/easing/easing.min.js"></script>
    <script src="<?= base_url('assets-landingpage/'); ?>lib/waypoints/waypoints.min.js"></script>
    <script src="<?= base_url('assets-landingpage/'); ?>lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="<?= base_url('assets-landingpage/'); ?>js/main.js"></script>
</body>

</html>