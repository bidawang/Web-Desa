<?= $this->extend('templates/main'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        <?= $title ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">
                            <?= $title ?>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- tabel menggunakan data table -->

            <div class="card">
                <?php if (session()->getFlashdata('pesan')): ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->getFlashdata('pesan') ?>
                    </div>
                <?php endif; ?>

                <div class="card-header">

                    <a href="<?= base_url('/create-galleryphoto') ?>" class="btn btn-primary float-left">Tambah Data</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="galleryphoto" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Foto</th>
                                <th>Nama Foto</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                                <th>Carousel</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0;
                            foreach ($gallery as $row):
                                $i++; ?>
                                <tr>
                                    <td>
                                        <?= $i ?>
                                    </td>
                                    <td>
                                        <?= $row['judul_foto'] ?>
                                    </td>
                                    <td><img src="<?= base_url('uploads/' . $row['nama_foto']) ?>" alt="" width="100px">
                                    </td>
                                    <td>
                                        <?= $row['deskripsi'] ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('/galleryphoto/edit/' . $row['id']) ?>"
                                            class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                        <a href="<?= base_url('/galleryphoto/detail/' . $row['judul_foto']) ?> "
                                            class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                        <a href="<?= base_url('galleryphoto/delete/' . $row['id']) ?>"
                                            class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin?')"> <i
                                                class="fas fa-trash"></i></a>
                                    </td>
                                    <td>
                             
                                    </td>
                                
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
                <!-- /.card-body -->


            </div>
    </section>
    <!-- /.content -->
</div>
<?= $this->endSection(); ?>