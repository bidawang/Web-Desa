<?= $this->extend('templates/main'); ?>

<?= $this->section('content'); ?>
<h1><?= $title; ?></h1>

<a href="/user-masyarakat/create/<?= $id_anggota_keluarga; ?>" class="btn btn-primary">Tambah User</a>
<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Email</th>
            <th>No HP</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($users)) : ?>
            <?php $i = 1; ?>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $user['username']; ?></td>
                    <td><?= $user['email']; ?></td>
                    <td><?= $user['no_hp']; ?></td>
                    <td>
                        <a href="/user-masyarakat/edit/<?= $user['id_user_masyarakat']; ?>" class="btn btn-warning">Edit</a>
                        <form action="/user-masyarakat/delete/<?= $user['id_user_masyarakat']; ?>" method="post" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?');">
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="5" class="text-center">Tidak ada data untuk ID Anggota Keluarga: <?= $id_anggota_keluarga; ?></td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<?= $this->endSection(); ?>
