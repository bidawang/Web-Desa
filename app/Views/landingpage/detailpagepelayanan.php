<?= $this->extend('templates_lp/main'); ?>

<?= $this->section('content'); ?>

<!-- Detail Pelayanan Masyarakat Start -->
<div class="container-xxl">
    <div class="container">
        <div class="row g-5 justify-content-center">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="section-title">
                    <h1 class="display-6">Pelayanan: <?= $pelayanan['judul_pelayanan']; ?></h1>
                    <span><?= $pelayanan['deskripsi_pelayanan']; ?></span>
                </div>
                <ul class="mb-4">
                    <li><strong>Dokumen Persyaratan:</strong></li>
                    <?php if (!empty($syarat)) : ?>
                        <?php foreach ($syarat as $item) : ?>
                            <?php if (!empty($item['id_pelayanan'])) : ?>
                                <?php foreach (explode(',', $item['persyaratan']) as $dokumen) : ?>
                                    <?php 
                                        $detail = array_filter($detailsyarat, function($d) use ($dokumen) {
                                            return $d['id_detail_syarat'] == $dokumen;
                                        });
                                        $detail = reset($detail);
                                    ?>
                                    <li><?= esc($detail['syarat']); ?></li>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <li>Tidak ada dokumen persyaratan.</li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <li>Tidak ada syarat untuk pelayanan ini.</li>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="d-flex flex-column flex-lg-row gap-2">
                    <!-- Button for creating letter -->
                    <?php if ($pelayanan['id_pelayanan'] === '1') : ?>
                        <a href="<?= $isLoggedIn ? base_url('/pelayanan-masyarakat/surat/' . $pelayanan['id_pelayanan']) : 'javascript:void(0);' ?>" 
                           class="btn btn-secondary rounded-pill py-3 px-5"
                           <?= !$isLoggedIn ? 'onclick="alert(\'Daftarkan diri Anda, hubungi admin.\')"' : '' ?>>
                            Buat Surat Domisili
                        </a>
                    <?php elseif ($pelayanan['id_pelayanan'] === '2') : ?>
                        <a href="<?= $isLoggedIn ? base_url('/pelayanan-masyarakat/surat/' . $pelayanan['id_pelayanan']) : 'javascript:void(0);' ?>" 
                           class="btn btn-secondary rounded-pill py-3 px-5"
                           <?= !$isLoggedIn ? 'onclick="alert(\'Daftarkan diri Anda, hubungi admin.\')"' : '' ?>>
                            Buat Surat Kelahiran
                        </a>
                    <?php elseif ($pelayanan['id_pelayanan'] === '3') : ?>
                        <a href="<?= $isLoggedIn ? base_url('/pelayanan-masyarakat/surat/' . $pelayanan['id_pelayanan']) : 'javascript:void(0);' ?>" 
                           class="btn btn-secondary rounded-pill py-3 px-5"
                           <?= !$isLoggedIn ? 'onclick="alert(\'Daftarkan diri Anda, hubungi admin.\')"' : '' ?>>
                            Buat Surat Kematian
                        </a>
                    <?php elseif ($pelayanan['id_pelayanan'] === '4') : ?>
                        <a href="<?= $isLoggedIn ? base_url('/pelayanan-masyarakat/surat/' . $pelayanan['id_pelayanan']) : 'javascript:void(0);' ?>" 
                           class="btn btn-secondary rounded-pill py-3 px-5"
                           <?= !$isLoggedIn ? 'onclick="alert(\'Daftarkan diri Anda, hubungi admin.\')"' : '' ?>>
                            Buat Surat Pernyataan Nikah
                        </a>
                    <?php endif; ?>

                    <!-- Dropdown Menu for Print Surat (Only visible if logged in) -->
                    <?php if ($isLoggedIn) : ?>
                        <div class="dropdown">
                            <button class="btn btn-secondary rounded-pill py-3 px-5 dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                Print Surat
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <?php if (!empty($specificData)) : ?>
                                    <?php foreach ($specificData as $print) : ?>
                                        <?php if ($print['status'] === 'acc') : ?>
                                            <li>
                    <?php if ($pelayanan['id_pelayanan'] == 1): // Surat Keterangan Domisili ?>
                        <a class="dropdown-item" href="<?= base_url('kitaprint_surat/1/'.  $print['id_skd']); ?>">
                            <?= esc($print['nomor_surat']); ?> (Domisili)
                        </a>
                    <?php elseif ($pelayanan['id_pelayanan'] == 2): // Surat Kelahiran ?>
                        <a class="dropdown-item" href="<?= base_url('kitaprint_surat/2/' . $print['id_skk']); ?>">
                            <?= esc($print['nomor_surat']); ?> (Kelahiran)
                        </a>
                    <?php elseif ($pelayanan['id_pelayanan'] == 3): // Surat Kematian ?>
                        <a class="dropdown-item" href="<?= base_url('kitaprint_surat/3/' . $print['id_sk_kematian']); ?>">
                            <?= esc($print['nomor_surat']); ?> (Kematian)
                        </a>
                    <?php elseif ($pelayanan['id_pelayanan'] == 4): // Surat Nikah ?>
                        <a class="dropdown-item" href="<?= base_url('kitaprint_surat/4/' . $print['id_spn']); ?>">
                            <?= esc($print['nomor_surat']); ?> (Nikah)
                        </a>
                    <?php endif; ?>
                </li>

                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <li><a class="dropdown-item disabled" href="#">Tidak ada data tersedia</a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Back Button -->
                <a href="javascript:history.back()" class="btn btn-primary rounded-pill py-3 px-5 mt-3">Kembali</a>
            </div>
        </div>
    </div>
</div>
<!-- Detail Pelayanan Masyarakat End -->

<?= $this->endSection(); ?>
