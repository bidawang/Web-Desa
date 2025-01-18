<?= $this->extend('templates/main'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Kartu Keluarga</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="/kk">Kartu Keluarga</a></li>
                        <li class="breadcrumb-item active">Edit</li>
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
                            <h3 class="card-title">Form Edit Kartu Keluarga</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="<?= site_url('/kk/update/' . $kk['id_kk']); ?>" method="post">
                                <?= csrf_field(); ?>

                                <div class="form-group">
                                    <label for="nomor_kk">Nomor KK</label>
                                    <input type="text" class="form-control" id="nomor_kk" name="nomor_kk" value="<?= old('nomor_kk', $kk['nomor_kk']); ?>" required>
                                </div>
                                <div class="row">
                                <div class="form-group col-6">
                                    <label for="nama_kepala_keluarga">Nama Kepala Keluarga</label>
                                    <input type="text" class="form-control" id="nama_kepala_keluarga" name="nama_kepala_keluarga" value="<?= old('nama_kepala_keluarga', $kk['nama_kepala_keluarga']); ?>" required>
                                </div>

                                <div class="form-group col-3">
                                    <label for="rt">RT</label>
                                    <input type="text" class="form-control" id="rt" name="rt" value="<?= old('rt', $kk['rt']); ?>" required>
                                </div>

                                <div class="form-group col-3">
                                    <label for="rw">RW</label>
                                    <input type="text" class="form-control" id="rw" name="rw" value="<?= old('rw', $kk['rw']); ?>" required>
                                </div>
                                </div>

                                <div class="row">
                               
                                <div class="form-group col-3">
                                    <label for="provinsi">Provinsi</label>
                                    <select class="form-control select2-container" id="provinsi" name="provinsi" required>
                                        <option value="">Pilih Provinsi</option>
                                        <!-- Options will be dynamically loaded based on selected province -->
                                    </select>
                                </div>

                                <div class="form-group col-3">
                                    <label for="kota">Kota</label>
                                    <select class="form-control select2-container" id="kota" name="kota" required>
                                        <option value="">Pilih Kota</option>
                                        <!-- Options will be dynamically loaded based on selected province -->
                                    </select>
                                </div>

                                <div class="form-group col-3">
                                    <label for="kecamatan">Kecamatan</label>
                                    <select class="form-control select2-container" id="kecamatan" name="kecamatan" required>
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                </div>

                                <div class="form-group col-3">
                                    <label for="kelurahan">Kelurahan</label>
                                    <select class="form-control select2-container" id="kelurahan" name="kelurahan" required>
                                        <option value="">Pilih Kelurahan</option>
                                    </select>
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="kode_pos">Kode Pos</label>
                                            <input type="text" class="form-control" id="kode_pos" name="kode_pos" value="<?= old('kode_pos', $kk['kode_pos']); ?>" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="tanggal_dibuat">Tanggal Dibuat</label>
                                            <input type="date" class="form-control" id="tanggal_dibuat" name="tanggal_dibuat" value="<?= old('tanggal_dibuat', $kk['tanggal_dibuat']); ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group col-8">
                                        <label for="alamat_lengkap">Alamat Lengkap</label>
                                        <textarea class="form-control" name="alamat_lengkap" style="height: 120px;" id="alamat_lengkap" required><?= old('alamat_lengkap', $kk['alamat_lengkap']); ?></textarea>
                                    </div>
                                </div>
                                <a href="/kk" class="btn btn-danger">Kembali</a>

                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
     var selectedProvinsi = '<?= $kk['provinsi']; ?>';
     var selectedKota = '<?= $kk['kota']; ?>';
     var selectedKecamatan = '<?= $kk['kecamatan']; ?>';
     var selectedKelurahan = '<?= $kk['kelurahan']; ?>';
</script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
        $.ajax({
        url: 'https://api.goapi.io/regional/provinsi?api_key=7254a2dd-28a7-573f-9b32-03316df1',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            var options = '<option value="">Pilih Provinsi</option>';
            if (Array.isArray(data)) {
                data.forEach(function(provinsi) {
                    var selected = (provinsi.id == selectedProvinsi) ? 'selected' : '';
                    options += '<option value="' + provinsi.id + '" ' + selected + '>' + provinsi.name + '</option>';
                });
            } else if (data && Array.isArray(data.data)) {
                data.data.forEach(function(provinsi) {
                    var selected = (provinsi.id == selectedProvinsi) ? 'selected' : '';
                    options += '<option value="' + provinsi.id + '" ' + selected + '>' + provinsi.name + '</option>';
                });
            }
            $('#provinsi').html(options);

            // Setelah provinsi dimuat, load kota yang sesuai
            loadKota(selectedProvinsi, selectedKota);
        }
    });

    // Fungsi untuk memuat kota berdasarkan ID provinsi yang dipilih
    function loadKota(provinsiId, selectedKota) {
        $.ajax({
            url: 'https://api.goapi.io/regional/kota?provinsi_id=' + provinsiId + '&api_key=7254a2dd-28a7-573f-9b32-03316df1',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                var options = '<option value="">Pilih Kota</option>';
                if (Array.isArray(data)) {
                    data.forEach(function(kota) {
                        var selected = (kota.id == selectedKota) ? 'selected' : '';
                        options += '<option value="' + kota.id + '" ' + selected + '>' + kota.name + '</option>';
                    });
                } else if (data && Array.isArray(data.data)) {
                    data.data.forEach(function(kota) {
                        var selected = (kota.id == selectedKota) ? 'selected' : '';
                        options += '<option value="' + kota.id + '" ' + selected + '>' + kota.name + '</option>';
                    });
                }
                $('#kota').html(options);
                
                // Setelah kota dimuat, load kecamatan yang sesuai
                loadKecamatan(selectedKota, '<?= $kk['kecamatan']; ?>');
            }
        });
    }

    // Fungsi untuk memuat kecamatan berdasarkan ID kota yang dipilih
    function loadKecamatan(kotaId, selectedKecamatan) {
        $.ajax({
            url: 'https://api.goapi.io/regional/kecamatan?kota_id=' + kotaId + '&api_key=7254a2dd-28a7-573f-9b32-03316df1',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                var options = '<option value="">Pilih Kecamatan</option>';
                if (Array.isArray(data)) {
                    data.forEach(function(kecamatan) {
                        var selected = (kecamatan.id == selectedKecamatan) ? 'selected' : '';
                        options += '<option value="' + kecamatan.id + '" ' + selected + '>' + kecamatan.name + '</option>';
                    });
                } else if (data && Array.isArray(data.data)) {
                    data.data.forEach(function(kecamatan) {
                        var selected = (kecamatan.id == selectedKecamatan) ? 'selected' : '';
                        options += '<option value="' + kecamatan.id + '" ' + selected + '>' + kecamatan.name + '</option>';
                    });
                }
                $('#kecamatan').html(options);
                
                // Setelah kecamatan dimuat, load kelurahan yang sesuai
                loadKelurahan(selectedKecamatan, '<?= $kk['kelurahan']; ?>');
            }
        });
    }

    // Fungsi untuk memuat kelurahan berdasarkan ID kecamatan yang dipilih
    function loadKelurahan(kecamatanId, selectedKelurahan) {
        $.ajax({
            url: 'https://api.goapi.io/regional/kelurahan?kecamatan_id=' + kecamatanId + '&api_key=7254a2dd-28a7-573f-9b32-03316df1',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                var options = '<option value="">Pilih Kelurahan</option>';
                if (Array.isArray(data)) {
                    data.forEach(function(kelurahan) {
                        var selected = (kelurahan.id == selectedKelurahan) ? 'selected' : '';
                        options += '<option value="' + kelurahan.id + '" ' + selected + '>' + kelurahan.name + '</option>';
                    });
                } else if (data && Array.isArray(data.data)) {
                    data.data.forEach(function(kelurahan) {
                        var selected = (kelurahan.id == selectedKelurahan) ? 'selected' : '';
                        options += '<option value="' + kelurahan.id + '" ' + selected + '>' + kelurahan.name + '</option>';
                    });
                }
                $('#kelurahan').html(options);
            }
        });
    }

    // Event handler untuk saat provinsi dipilih
    $('#provinsi').change(function() {
        var id_provinsi = $(this).val();
        loadKota(id_provinsi, '');  // Panggil fungsi untuk load kota berdasarkan provinsi yang dipilih
    });

    // Event handler untuk saat kota dipilih
    $('#kota').change(function() {
        var id_kota = $(this).val();
        loadKecamatan(id_kota, '');  // Panggil fungsi untuk load kecamatan berdasarkan kota yang dipilih
    });

    // Event handler untuk saat kecamatan dipilih
    $('#kecamatan').change(function() {
        var id_kecamatan = $(this).val();
        loadKelurahan(id_kecamatan, '');  // Panggil fungsi untuk load kelurahan berdasarkan kecamatan yang dipilih
    });
});
</script>
<?= $this->endSection(); ?>
