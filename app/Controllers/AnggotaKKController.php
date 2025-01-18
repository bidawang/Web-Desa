<?php

namespace App\Controllers;

use App\Models\KkModel;
use App\Controllers\BaseController;
use App\Models\AnggotaKkModel;
use App\Models\DetailKkModel;
use App\Models\KelahiranModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class AnggotaKKController extends BaseController
{
    protected $KkModel;
    protected $anggotaKk;
    protected $detailKK;
    protected $kelahiran;

    public function __construct()
    {
        // Load models
        $this->KkModel = new KkModel();
        $this->anggotaKk = new AnggotaKkModel();
        $this->detailKK = new DetailKkModel();
        $this->kelahiran = new KelahiranModel();
    }

    // Menampilkan daftar Anggota Keluarga
    public function index($idKk)
    {
        // Cari Kartu Keluarga
        $kk = $this->KkModel->find($idKk);
        if (!$kk) {
            throw PageNotFoundException::forPageNotFound('Kartu Keluarga tidak ditemukan');
        }

        // Ambil data anggota keluarga
        $anggota = $this->anggotaKk->where('id_kk', $idKk)->findAll();

        // Kirim data ke view
        $data = [
            'title' => 'Anggota Keluarga',
            'kk' => $kk,
            'anggota' => $anggota,
        ];

        return view('kk/anggotakeluarga/index', $data);
    }

    // Menampilkan form untuk menambahkan anggota keluarga baru
    public function create($idKk)
{
    $kk = $this->KkModel->find($idKk);
    if (!$kk) {
        throw PageNotFoundException::forPageNotFound('Kartu Keluarga tidak ditemukan');
    }

    // Cek apakah sudah ada Kepala Keluarga dalam anggota keluarga
    $isKepalaKeluargaExists = $this->anggotaKk
        ->where('id_kk', $idKk)
        ->where('hubungan_keluarga', 'Kepala Keluarga')
        ->first();

    // Cek apakah sudah ada Istri dalam anggota keluarga
    $isIstriExists = $this->anggotaKk
        ->where('id_kk', $idKk)
        ->where('hubungan_keluarga', 'Istri')
        ->first();

    $data = [
        'title' => 'Tambah Anggota Keluarga',
        'kk' => $kk,
        'validation' => \Config\Services::validation(),
        'isKepalaKeluargaExists' => $isKepalaKeluargaExists,
        'isIstriExists' => $isIstriExists,
    ];

    return view('kk/anggotakeluarga/create', $data);
}


    // Menyimpan data anggota keluarga baru
    public function store($idKk)
{
    // Validasi input data
    $rules = [
        'nama_lengkap' => 'required',
        'nik' => 'required|is_unique[tb_anggota_keluarga.nik]',
        'tanggal_lahir' => 'required',
        'tempat_lahir' => 'required',
        'hubungan_keluarga' => 'required',
        'agama' => 'required',
        'status_perkawinan' => 'required',
        'pendidikan' => 'required',
        'jenis_kelamin' => 'required',
        'kewarganegaraan' => 'required',
    ];

    // Validasi data input
    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Ambil hubungan keluarga dari input
    $hubunganKeluarga = $this->request->getPost('hubungan_keluarga');
    $namaAyah = $this->request->getPost('nama_ayah');
    $namaIbu = $this->request->getPost('nama_ibu');

    // Jika hubungan keluarga adalah "Anak", otomatis ambil nama ayah dan ibu
    if ($hubunganKeluarga === 'Anak') {
        $kepalaKeluarga = $this->anggotaKk
            ->where('id_kk', $idKk)
            ->where('hubungan_keluarga', 'Kepala Keluarga')
            ->first();

        $istri = $this->anggotaKk
            ->where('id_kk', $idKk)
            ->where('hubungan_keluarga', 'Istri')
            ->first();

        // Tetapkan nama ayah dan ibu jika ditemukan
        $namaAyah = $kepalaKeluarga['nama_lengkap'] ?? null;
        $namaIbu = $istri['nama_lengkap'] ?? null;

        // Jika tidak ditemukan Kepala Keluarga atau Istri, beri error
        if (!$namaAyah || !$namaIbu) {
            return redirect()->back()->withInput()->with('error', 'Data Kepala Keluarga atau Istri tidak ditemukan dalam KK ini.');
        }
    }

    // Proses data detail Kartu Keluarga
    $kewarganegaraan = $this->request->getPost('kewarganegaraan');
    $KKDetail = [
        'nama_ayah' => $namaAyah,
        'nama_ibu' => $namaIbu,
    ];

    // Jika WNA, tambahkan data paspor dan KITAS/KITAP
    if ($kewarganegaraan !== 'WNI') {
        $KKDetail['no_paspor'] = $this->request->getPost('no_paspor');
        $KKDetail['no_kitas_kitap'] = $this->request->getPost('no_kitas_kitap');
    }
    // Simpan data detail KK
    $this->detailKK->save($KKDetail);
    $iddetail = $this->detailKK->getInsertID();

    // Simpan data kelahiran
    $kelahiran = [
        'tempat_lahir' => $this->request->getPost('tempat_lahir'),
        'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
    ];
    $this->kelahiran->save($kelahiran);
    $idkelahiran = $this->kelahiran->getInsertID();

    // Simpan data anggota keluarga
    $data = [
        'id_kk' => $idKk,
        'nama_lengkap' => $this->request->getPost('nama_lengkap'),
        'nik' => $this->request->getPost('nik'),
        'agama' => $this->request->getPost('agama'),
        'pekerjaan' => $this->request->getPost('pekerjaan'),
        'status_perkawinan' => $this->request->getPost('status_perkawinan'),
        'id_kelahiran' => $idkelahiran,
        'id_detail_kk' => $iddetail,
        'hubungan_keluarga' => $hubunganKeluarga,
    ];
    $this->anggotaKk->save($data);

    return redirect()->to("/anggota-keluarga/$idKk")->with('message', 'Anggota keluarga berhasil ditambahkan');
}



    // Menampilkan form untuk mengedit anggota keluarga
    public function edit($id)
    {
        // Ambil data anggota berdasarkan ID
        $anggota = $this->anggotaKk->find($id);
        if (!$anggota) {
            throw PageNotFoundException::forPageNotFound('Anggota Keluarga tidak ditemukan');
        }
    
        // Ambil data Kartu Keluarga berdasarkan id_kk dari anggota
        $kk = $this->KkModel->find($anggota['id_kk']);
        if (!$kk) {
            throw PageNotFoundException::forPageNotFound('Kartu Keluarga tidak ditemukan');
        }
    
        // Ambil data kelahiran dan detail KK
        $kelahiran = $this->anggotaKk->select('tb_anggota_keluarga.*, tb_kelahiran.*, tb_detail_kk.*')
            ->join('tb_kelahiran', 'tb_anggota_keluarga.id_kelahiran = tb_kelahiran.id_kelahiran', 'left')
            ->join('tb_detail_kk', 'tb_anggota_keluarga.id_detail_kk = tb_detail_kk.id_detail_kk', 'left')
            ->where('tb_anggota_keluarga.id_anggota', $id)
            ->first();
    
        // Cek apakah sudah ada Kepala Keluarga dalam anggota keluarga
        $isKepalaKeluargaExists = $this->anggotaKk
            ->where('id_kk', $kk['id_kk']) // Perbaiki: gunakan $kk['id_kk']
            ->where('hubungan_keluarga', 'Kepala Keluarga')
            ->first();
    
        // Cek apakah sudah ada Istri dalam anggota keluarga
        $isIstriExists = $this->anggotaKk
            ->where('id_kk', $kk['id_kk']) // Perbaiki: gunakan $kk['id_kk']
            ->where('hubungan_keluarga', 'Istri')
            ->first();
    
        $data = [
            'title' => 'Edit Anggota Keluarga',
            'kk' => $kk,
            'anggota' => $anggota,
            'kelahiran' => $kelahiran,
            'validation' => \Config\Services::validation(),
            'isKepalaKeluargaExists' => $isKepalaKeluargaExists,
            'isIstriExists' => $isIstriExists,
        ];
    
        return view('kk/anggotakeluarga/edit', $data);
    }
    

// Mengupdate data anggota keluarga
public function update($id)
{
    // Validasi input data
    $anggota = $this->anggotaKk->find($id);
    if (!$anggota) {
        throw PageNotFoundException::forPageNotFound('Anggota Keluarga tidak ditemukan');
    }

    // Aturan validasi untuk form edit
    $rules = [
        'nama_lengkap' => 'required',
        'nik' => "required|is_unique[tb_anggota_keluarga.nik,id_anggota,$id]", // Pastikan NIK unik kecuali untuk anggota yang sedang diedit
        'tanggal_lahir' => 'required|valid_date',
        'tempat_lahir' => 'required',
        'hubungan_keluarga' => 'required',
        'agama' => 'required',
        'status_perkawinan' => 'required',
        'nama_ayah' => 'required',
        'nama_ibu' => 'required',
        'pendidikan' => 'required',
        'jenis_kelamin' => 'required',
        'kewarganegaraan' => 'required',
    ];

    // Jika validasi gagal, kembalikan ke form dengan error
    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Update detail KK dan kelahiran
    $detailKK = [
        'nama_ayah' => $this->request->getPost('nama_ayah'),
        'nama_ibu' => $this->request->getPost('nama_ibu'),
    ];

    if ($this->request->getPost('kewarganegaraan') !== 'WNI') {
        $detailKK['no_paspor'] = $this->request->getPost('no_paspor');
        $detailKK['no_kitas_kitap'] = $this->request->getPost('no_kitas_kitap');
    }

    // Update kelahiran
    $kelahiran = [
        'tempat_lahir' => $this->request->getPost('tempat_lahir'),
        'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
    ];
    $this->kelahiran->update($anggota['id_kelahiran'], $kelahiran);

    // Update detail KK
    $this->detailKK->update($anggota['id_detail_kk'], $detailKK);

    // Update data anggota keluarga
    $data = [
        'nama_lengkap' => $this->request->getPost('nama_lengkap'),
        'nik' => $this->request->getPost('nik'),
        'hubungan_keluarga' => $this->request->getPost('hubungan_keluarga'),
        'agama' => $this->request->getPost('agama'),
        'status_perkawinan' => $this->request->getPost('status_perkawinan'),
    ];

    $this->anggotaKk->update($id, $data);

    return redirect()->to("/anggota-keluarga/{$anggota['id_kk']}")->with('message', 'Anggota keluarga berhasil diperbarui');
}


    // Menghapus data anggota keluarga
    public function delete($id)
{
    // Cari anggota keluarga berdasarkan ID
    $anggota = $this->anggotaKk->find($id);

    // Periksa apakah anggota ditemukan
    if (!$anggota) {
        throw PageNotFoundException::forPageNotFound('Anggota Keluarga tidak ditemukan');
    }

    // Ambil ID KK untuk redirect nanti
    $idKk = $anggota['id_kk'];

    // Hapus data terkait jika ada
    if (isset($anggota['id_kelahiran'])) {
        $this->kelahiran->delete($anggota['id_kelahiran']);
    }
    if (isset($anggota['id_detail_kk'])) {
        $this->detailKK->delete($anggota['id_detail_kk']);
    }

    // Hapus data anggota keluarga
    $this->anggotaKk->delete($id);

    // Redirect ke halaman anggota keluarga dengan pesan sukses
    return redirect()->to("/anggota-keluarga/$idKk")->with('message', 'Anggota keluarga berhasil dihapus');
}

}
