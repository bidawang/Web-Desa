<?= $this->extend('templates/main'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Kartu Keluarga</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="/kk">Kartu Keluarga</a></li>
                        <li class="breadcrumb-item active">Tambah</li>
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
                            <h3 class="card-title">Form Tambah Kartu Keluarga</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="<?= site_url('/kk/store'); ?>" method="post">
                                <?= csrf_field(); ?>

                                <div class="form-group">
                                    <label for="nomor_kk">Nomor KK</label>
                                    <input type="text" class="form-control" id="nomor_kk" name="nomor_kk" value="<?= old('nomor_kk'); ?>" required>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="nama_kepala_keluarga">Nama Kepala Keluarga</label>
                                        <input type="text" class="form-control" id="nama_kepala_keluarga" name="nama_kepala_keluarga" value="<?= old('nama_kepala_keluarga'); ?>" required>
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="rt">RT</label>
                                        <input type="text" class="form-control" id="rt" name="rt" value="<?= old('rt'); ?>" required>
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="rw">RW</label>
                                        <input type="text" class="form-control" id="rw" name="rw" value="<?= old('rw'); ?>" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-3">
                                        <label for="provinsi">Provinsi</label>
                                        <select class="form-control select2" id="provinsi" name="provinsi" required>
                                            <option value="">Pilih Provinsi</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-3">
                                        <label for="kota">Kota</label>
                                        <select class="form-control select2" id="kota" name="kota" required>
                                            <option value="">Pilih Kota</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-3">
                                        <label for="kecamatan">Kecamatan</label>
                                        <select class="form-control select2" id="kecamatan" name="kecamatan" required>
                                            <option value="">Pilih Kecamatan</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-3">
                                        <label for="kelurahan">Kelurahan</label>
                                        <select class="form-control select2" id="kelurahan" name="kelurahan" required>
                                            <option value="">Pilih Kelurahan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="kode_pos">Kode Pos</label>
                                            <input type="text" class="form-control" id="kode_pos" name="kode_pos" value="<?= old('kode_pos'); ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="tanggal_dibuat">Tanggal Dibuat</label>
                                            <input type="date" class="form-control" id="tanggal_dibuat" name="tanggal_dibuat" value="<?= old('tanggal_dibuat'); ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group col-8">
                                        <div class="form-group">
                                            <label for="alamat_lengkap">Alamat Lengkap</label>
                                            <textarea class="form-control" style="height: 120px;" name="alamat_lengkap" id="alamat_lengkap"><?= old('alamat_lengkap'); ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <a href="/kk" class="btn btn-danger">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
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
</div>

<script>
    $(document).ready(function() {
        // Inisialisasi select2
        $('.select2').select2();

        // Load Provinsi
        $.ajax({
            url: 'https://api.goapi.io/regional/provinsi?api_key=7254a2dd-28a7-573f-9b32-03316df1',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                var options = '<option value="">Pilih Provinsi</option>';
                if (Array.isArray(data)) {
                    data.forEach(function(provinsi) {
                        options += '<option value="' + provinsi.id + '|' + provinsi.name + '">' + provinsi.name + '</option>';
                    });
                } else if (data && Array.isArray(data.data)) {
                    data.data.forEach(function(provinsi) {
                        options += '<option value="' + provinsi.id + '|' + provinsi.name + '">' + provinsi.name + '</option>';
                    });
                }
                $('#provinsi').html(options);
            }
        });

        // Event handler untuk perubahan provinsi
        $('#provinsi').change(function() {
            var provinsi_data = $(this).val();
            if (provinsi_data) {
                var provinsi_parts = provinsi_data.split('|');
                var id_provinsi = provinsi_parts[0];
                var provinsi_name = provinsi_parts[1];

                $('#kota').html('<option value="">Pilih Kota</option>'); // Reset kota
                $('#kecamatan').html('<option value="">Pilih Kecamatan</option>'); // Reset kecamatan
                $('#kelurahan').html('<option value="">Pilih Kelurahan</option>'); // Reset kelurahan

                if (id_provinsi) {
                    $.ajax({
                        url: 'https://api.goapi.io/regional/kota?provinsi_id=' + id_provinsi + '&api_key=7254a2dd-28a7-573f-9b32-03316df1',
                        method: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            var options = '<option value="">Pilih Kota</option>';
                            if (Array.isArray(data)) {
                                data.forEach(function(kota) {
                                    options += '<option value="' + kota.id + '|' + kota.name + '">' + kota.name + '</option>';
                                });
                            } else if (data && Array.isArray(data.data)) {
                                data.data.forEach(function(kota) {
                                    options += '<option value="' + kota.id + '|' + kota.name + '">' + kota.name + '</option>';
                                });
                            }
                            $('#kota').html(options);
                        }
                    });
                }
            }
        });

        // Event handler untuk perubahan kota
        $('#kota').change(function() {
            var kota_data = $(this).val();
            if (kota_data) {
                var kota_parts = kota_data.split('|');
                var id_kota = kota_parts[0];
                var kota_name = kota_parts[1];

                $('#kecamatan').html('<option value="">Pilih Kecamatan</option>'); // Reset kecamatan
                $('#kelurahan').html('<option value="">Pilih Kelurahan</option>'); // Reset kelurahan

                if (id_kota) {
                    $.ajax({
                        url: 'https://api.goapi.io/regional/kecamatan?kota_id=' + id_kota + '&api_key=7254a2dd-28a7-573f-9b32-03316df1',
                        method: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            var options = '<option value="">Pilih Kecamatan</option>';
                            if (Array.isArray(data)) {
                                data.forEach(function(kecamatan) {
                                    options += '<option value="' + kecamatan.id + '|' + kecamatan.name + '">' + kecamatan.name + '</option>';
                                });
                            } else if (data && Array.isArray(data.data)) {
                                data.data.forEach(function(kecamatan) {
                                    options += '<option value="' + kecamatan.id + '|' + kecamatan.name + '">' + kecamatan.name + '</option>';
                                });
                            }
                            $('#kecamatan').html(options);
                        }
                    });
                }
            }
        });

        // Event handler untuk perubahan kecamatan
        $('#kecamatan').change(function() {
            var kecamatan_data = $(this).val();
            if (kecamatan_data) {
                var kecamatan_parts = kecamatan_data.split('|');
                var id_kecamatan = kecamatan_parts[0];
                var kecamatan_name = kecamatan_parts[1];

                $('#kelurahan').html('<option value="">Pilih Kelurahan</option>'); // Reset kelurahan

                if (id_kecamatan) {
                    $.ajax({
                        url: 'https://api.goapi.io/regional/kelurahan?kecamatan_id=' + id_kecamatan + '&api_key=7254a2dd-28a7-573f-9b32-03316df1',
                        method: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            var options = '<option value="">Pilih Kelurahan</option>';
                            if (Array.isArray(data)) {
                                data.forEach(function(kelurahan) {
                                    options += '<option value="' + kelurahan.id + '|' + kelurahan.name + '">' + kelurahan.name + '</option>';
                                });
                            } else if (data && Array.isArray(data.data)) {
                                data.data.forEach(function(kelurahan) {
                                    options += '<option value="' + kelurahan.id + '|' + kelurahan.name + '">' + kelurahan.name + '</option>';
                                });
                            }
                            $('#kelurahan').html(options);
                        }
                    });
                }
            }
        });
    });
</script>

<?= $this->endSection(); ?>
