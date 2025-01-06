<?= $this->extend('templates/main'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Anggota Keluarga</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Anggota Keluarga</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Tambah Anggota Keluarga</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        <?php if (session()->has('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session('success'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<?php if (session()->has('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session('error'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<?php if (session()->has('warning')) : ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?= session('warning'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>


                            <form action="<?= base_url('/anggota-keluarga/store/'. $kk['id_kk']); ?>" method="post">
                                <?= csrf_field(); ?>

                                <div class="form-group">
                                    <label for="nama_lengkap">Nama Lengkap</label>
                                    <input type="text" class="form-control <?= isset($validation) && $validation->hasError('nama_lengkap') ? 'is-invalid' : ''; ?>" id="nama_lengkap" name="nama_lengkap" value="<?= old('nama_lengkap'); ?>" placeholder="Masukkan Nama Lengkap">
                                    <?php if (isset($validation) && $validation->hasError('nama_lengkap')) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nama_lengkap'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input type="text" class="form-control <?= isset($validation) && $validation->hasError('nik') ? 'is-invalid' : ''; ?>" id="nik" name="nik" value="<?= old('nik'); ?>" placeholder="Masukkan NIK">
                                    <?php if (isset($validation) && $validation->hasError('nik')) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nik'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control <?= isset($validation) && $validation->hasError('jenis_kelamin') ? 'is-invalid' : ''; ?>" id="jenis_kelamin" name="jenis_kelamin">
                                        <option value="" disabled <?= old('jenis_kelamin') ? '' : 'selected'; ?>>Pilih Jenis Kelamin</option>
                                        <option value="L" <?= old('jenis_kelamin') === 'L' ? 'selected' : ''; ?>>Laki - Laki</option>
                                        <option value="P" <?= old('jenis_kelamin') === 'P' ? 'selected' : ''; ?>>Perempuan</option>
                                    </select>
                                    <?php if (isset($validation) && $validation->hasError('jenis_kelamin')) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('jenis_kelamin'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label for="pendidikan">Pendidikan Terakhir</label>
                                    <select class="form-control <?= isset($validation) && $validation->hasError('pendidikan') ? 'is-invalid' : ''; ?>" id="pendidikan" name="pendidikan">
                                        <option value="" disabled <?= old('pendidikan') ? '' : 'selected'; ?>>Pilih Pendidikan Terakhir</option>
                                        <option value="sd" <?= old('pendidikan') === 'sd' ? 'selected' : ''; ?>>SD</option>
                                        <option value="smp" <?= old('pendidikan') === 'smp' ? 'selected' : ''; ?>>SMP/Sederajat</option>
                                        <option value="sma" <?= old('pendidikan') === 'sma' ? 'selected' : ''; ?>>SMA/Sederajat</option>
                                        <option value="d3" <?= old('pendidikan') === 'd3' ? 'selected' : ''; ?>>D3</option>
                                        <option value="d4" <?= old('pendidikan') === 'd4' ? 'selected' : ''; ?>>D4</option>
                                        <option value="s1" <?= old('pendidikan') === 's1' ? 'selected' : ''; ?>>S1</option>
                                        <option value="s2" <?= old('pendidikan') === 's2' ? 'selected' : ''; ?>>S2</option>
                                        <option value="s3" <?= old('pendidikan') === 's3' ? 'selected' : ''; ?>>S3</option>
                                    </select>
                                    <?php if (isset($validation) && $validation->hasError('pendidikan')) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('pendidikan'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label for="agama">Agama</label>
                                    <input type="text" class="form-control <?= isset($validation) && $validation->hasError('agama') ? 'is-invalid' : ''; ?>" id="agama" name="agama" value="<?= old('agama'); ?>" placeholder="Masukkan Agama">
                                    <?php if (isset($validation) && $validation->hasError('agama')) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('agama'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label for="kewarganegaraan">Status Kewarganegaraan</label>
                                    <select class="form-control <?= isset($validation) && $validation->hasError('kewarganegaraan') ? 'is-invalid' : ''; ?>" id="kewarganegaraan" name="kewarganegaraan">
                                        <option value="" disabled <?= old('kewarganegaraan') ? '' : 'selected'; ?>>Pilih Kewarganegaraan</option>
                                        <option value="WNI" <?= old('kewarganegaraan') === 'WNI' ? 'selected' : ''; ?>>WNI</option>
                                        <option value="Asing" <?= old('kewarganegaraan') === 'Asing' ? 'selected' : ''; ?>>Bukan WNI</option>
                                    </select>
                                    <?php if (isset($validation) && $validation->hasError('kewarganegaraan')) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('kewarganegaraan'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label for="tempat_lahir">tempat_lahir</label>
                                    <input type="text" class="form-control <?= isset($validation) && $validation->hasError('tempat_lahir') ? 'is-invalid' : ''; ?>" id="tempat_lahir" name="tempat_lahir" value="<?= old('tempat_lahir'); ?>" placeholder="Masukkan tempat_lahir">
                                    <?php if (isset($validation) && $validation->hasError('tempat_lahir')) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('tempat_lahir'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control <?= isset($validation) && $validation->hasError('tanggal_lahir') ? 'is-invalid' : ''; ?>" id="tanggal_lahir" name="tanggal_lahir" value="<?= old('tanggal_lahir'); ?>">
                                    <?php if (isset($validation) && $validation->hasError('tanggal_lahir')) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('tanggal_lahir'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label for="hubungan_keluarga">Hubungan Dalam Keluarga</label>
                                    <select class="form-control <?= isset($validation) && $validation->hasError('hubungan_keluarga') ? 'is-invalid' : ''; ?>" id="hubungan_keluarga" name="hubungan_keluarga">
                                        <option value="" disabled <?= old('hubungan_keluarga') ? '' : 'selected'; ?>>Pilih Hubungan Keluarga</option>
                                        <?php if (!$isKepalaKeluargaExists): ?>
                                            <option value="Kepala Keluarga" <?= old('hubungan_keluarga') === 'Kepala Keluarga' ? 'selected' : ''; ?>>Kepala Keluarga</option>
                                        <?php endif; ?>
                                        <?php if (!$isIstriExists): ?>
                                            <option value="Istri" <?= old('hubungan_keluarga') === 'Istri' ? 'selected' : ''; ?>>Istri</option>
                                        <?php endif; ?>
                                        <option value="Anak" <?= old('hubungan_keluarga') === 'Anak' ? 'selected' : ''; ?>>Anak</option>
                                    </select>
                                    <?php if (isset($validation) && $validation->hasError('hubungan_keluarga')) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('hubungan_keluarga'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label for="status_perkawinan">Status Perkawinan</label>
                                    <select class="form-control <?= isset($validation) && $validation->hasError('status_perkawinan') ? 'is-invalid' : ''; ?>" id="status_perkawinan" name="status_perkawinan">
                                        <option value="" disabled <?= old('status_perkawinan') ? '' : 'selected'; ?>>Pilih Status Perkawinan</option>
                                        <option value="Belum Kawin" <?= old('status_perkawinan') === 'Belum Kawin' ? 'selected' : ''; ?>>Belum Kawin</option>
                                        <option value="Sudah Kawin" <?= old('status_perkawinan') === 'Sudah Kawin' ? 'selected' : ''; ?>>Sudah Kawin</option>
                                        <option value="Cerai Hidup" <?= old('status_perkawinan') === 'Cerai Hidup' ? 'selected' : ''; ?>>Cerai Hidup</option>
                                        <option value="Cerai Mati" <?= old('status_perkawinan') === 'Cerai Mati' ? 'selected' : ''; ?>>Cerai Mati</option>
                                    </select>
                                    <?php if (isset($validation) && $validation->hasError('status_perkawinan')) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('status_perkawinan'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label for="pekerjaan">pekerjaan</label>
                                    <input type="text" class="form-control <?= isset($validation) && $validation->hasError('pekerjaan') ? 'is-invalid' : ''; ?>" id="pekerjaan" name="pekerjaan" value="<?= old('pekerjaan'); ?>" placeholder="Masukkan pekerjaan">
                                    <?php if (isset($validation) && $validation->hasError('pekerjaan')) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('pekerjaan'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group" id="nama_ayah_group">
    <label for="nama_ayah">Nama Ayah</label>
    <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" placeholder="Masukkan Nama Ayah">
</div>

<div class="form-group" id="nama_ibu_group">
    <label for="nama_ibu">Nama Ibu</label>
    <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" placeholder="Masukkan Nama Ibu">
</div>


                                <!-- Additional input fields for non-WNI -->
                                <div id="additional_info" style="display: none;">
                                    <div class="form-group">
                                        <label for="no_paspor">No. Paspor</label>
                                        <input type="text" class="form-control" id="no_paspor" name="no_paspor" placeholder="Masukkan No. Paspor">
                                    </div>
                                    <div class="form-group">
                                        <label for="no_kitas_kitap">No. KITAS/KITAP</label>
                                        <input type="text" class="form-control" id="no_kitas_kitap" name="no_kitas_kitap" placeholder="Masukkan No. KITAS/KITAP">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="javascript:history.back()" class="btn btn-secondary">Kembali</a>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<script>
    document.getElementById('kewarganegaraan').addEventListener('change', function() {
        var additionalInfo = document.getElementById('additional_info');
        additionalInfo.style.display = this.value === 'Asing' ? 'block' : 'none';
    });

    document.getElementById('hubungan_keluarga').addEventListener('change', function() {
        const hubunganKeluarga = this.value;
        const namaAyahGroup = document.getElementById('nama_ayah_group');
        const namaIbuGroup = document.getElementById('nama_ibu_group');

        if (hubunganKeluarga === 'Anak') {
            namaAyahGroup.style.display = 'none';
            namaIbuGroup.style.display = 'none';
        } else {
            namaAyahGroup.style.display = 'block';
            namaIbuGroup.style.display = 'block';
        }
    });
</script>




<?= $this->endSection(); ?>
