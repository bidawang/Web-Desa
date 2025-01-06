<!-- uri -->
<?php
$uri = service('uri');
?>
<div class="container-fluid bg-white sticky-top">
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0">
        <a href="/" class="navbar-brand fluid" style="width:fit-content; height:fit-content;">
        <!-- Logo Desa -->
        <img class="img pt-2 mt-2" src="<?= base_url('uploads/') . $pengaturan['logo_desa']; ?>" alt="Logo Desa" style="max-height: 50px;">
    </a>
            <button type="button" class="navbar-toggler ms-auto me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto">
                    <!-- get uri segement for beranda -->
                    <?php if ($uri->getSegment(1) == '') : ?>
                        <a href="/" class="nav-item nav-link active">Beranda</a>
                    <?php else : ?>
                        <a href="/" class="nav-item nav-link">Beranda</a>
                    <?php endif; ?>
                    <?php if ($uri->getSegment(1) == 'pelayanan-masyarakat') : ?>
                        <a href="/pelayanan-masyarakat" class="nav-item nav-link active">Pelayanan</a>
                    <?php else : ?>
                        <a href="/pelayanan-masyarakat" class="nav-item nav-link">Pelayanan</a>
                    <?php endif; ?>
                    <!-- uri segement for profil desa -->
                    <?php if ($uri->getSegment(1) == 'village-history' || $uri->getSegment(1) == 'vision-mission' || $uri->getSegment(1) == 'page-structure' || $uri->getSegment(1) == 'regional-potential') : ?>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Profil Desa</a>
                            <div class="dropdown-menu bg-light rounded-0 m-0">
                                <a href="/village-history" class="dropdown-item <?= $uri->getSegment(1) == 'village-history' ? 'active' : ''; ?>">Sejarah Desa</a>
                                <a href="/vision-mission" class="dropdown-item <?= $uri->getSegment(1) == 'vision-mission' ? 'active' : ''; ?>">Visi Misi</a>
                                <a href="/page-structure" class="dropdown-item <?= $uri->getSegment(1) == 'page-structure' ? 'active' : ''; ?>">Struktur Organisasi</a>
                                <a href="/regional-potential" class="dropdown-item <?= $uri->getSegment(1) == 'regional-potential' ? 'active' : ''; ?>">Potensi Wilayah</a>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Profil Desa</a>
                            <div class="dropdown-menu bg-light rounded-0 m-0">
                                <a href="/village-history" class="dropdown-item">Sejarah Desa</a>
                                <a href="/vision-mission" class="dropdown-item">Visi Misi</a>
                                <a href="/page-structure" class="dropdown-item">Struktur Organisasi</a>
                                <a href="/regional-potential" class="dropdown-item">Potensi Wilayah</a>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- uri segment for dropdown galeri  -->
                    <?php if ($uri->getSegment(1) == 'page-gallery' || $uri->getSegment(1) == 'page-video-gallery') : ?>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Galeri</a>
                            <div class="dropdown-menu bg-light rounded-0 m-0">
                                <a href="/page-gallery" class="dropdown-item <?= $uri->getSegment(1) == 'page-gallery' ? 'active' : ''; ?>">Galeri Foto</a>
                                <a href="/page-video-gallery" class="dropdown-item <?= $uri->getSegment(1) == 'page-video-gallery' ? 'active' : ''; ?>">Galeri Video</a>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Galeri</a>
                            <div class="dropdown-menu bg-light rounded-0 m-0">
                                <a href="/page-gallery" class="dropdown-item">Galeri Foto</a>
                                <a href="/page-video-gallery" class="dropdown-item">Galeri Video</a>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- uri segment for produk -->
                    
                    <?php if ($uri->getSegment(1) == 'page-produk') : ?>
                        <a href="/page-produk" class="nav-item nav-link active">Produk Unggulan</a>
                    <?php else : ?>
                        <a href="/page-produk" class="nav-item nav-link">Produk Unggulan</a>
                    <?php endif; ?>
                    <!-- uri segment for berita -->
                    <?php if ($uri->getSegment(1) == 'page-news') : ?>
                        <a href="/page-news" class="nav-item nav-link active">Berita</a>
                    <?php else : ?>
                        <a href="/page-news" class="nav-item nav-link">Berita</a>
                    <?php endif; ?>
                    <!-- uri segment for kontak -->
                    <?php if ($uri->getSegment(1) == 'page-kontak') : ?>
                        <a href="/page-kontak" class="nav-item nav-link active">Kontak</a>
                    <?php else : ?>
                        <a href="/page-kontak" class="nav-item nav-link">Kontak</a>
                    <?php endif; ?>
                    <?php if (session()->get('isLoggedIn') === true): ?>  
    <a href="/logoutmasyarakat" class="nav-item nav-link">Logout</a>  
<?php else: ?>  
    <a href="/login-masyarakat" class="nav-item nav-link <?= $uri->getSegment(1) == 'login-masyarakat' ? 'active' : '' ?>">Login</a>  
<?php endif; ?>  

                </div>
            </div>
        </nav>
    </div>
</div>