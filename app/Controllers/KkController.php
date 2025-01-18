<?php

namespace App\Controllers;

use App\Models\KkModel;
use App\Models\AlamatModel;
use CodeIgniter\Controller;

class KkController extends Controller
{
    protected $KkModel;
    protected $alamatModel;

    public function __construct()
    {
        $this->KkModel = new KkModel();
        $this->alamatModel = new AlamatModel();
    }

    // Menampilkan daftar Kartu Keluarga
    public function index()
    {
        // Mengambil data Kartu Keluarga dengan join ke tabel Alamat
        $kk = $this->KkModel->select('tb_kk.*,tb_anggota_keluarga.nama_lengkap, tb_alamat.alamat_lengkap')
                            ->join('tb_alamat', 'tb_kk.id_alamat = tb_alamat.id_alamat', 'left')
                            ->join('tb_anggota_keluarga', 'tb_kk.id_kk = tb_anggota_keluarga.id_kk', 'right')
                            ->where('tb_anggota_keluarga.hubungan_keluarga = "Kepala Keluarga"')
                            ->findAll();
        $data = [
            'title' => 'Kartu Keluarga',
            'kk' => $kk,
        ];

        // Mengirimkan data KK ke view
        return view('kk/index', $data);
    }

    // Menampilkan form untuk menambah Kartu Keluarga baru
    public function create()
    {
        // Ambil semua alamat untuk dropdown
        $alamat = $this->alamatModel->findAll();

        return view('kk/create', [
            'title' => 'Tambah Kartu Keluarga',
            'alamat' => $alamat,
            'validation' => \Config\Services::validation(),
        ]);
    }

    // Menyimpan Kartu Keluarga baru
    public function store()
{
    // Mengambil data yang dikirimkan melalui POST
    $data = $this->request->getPost();

    // Validasi input
    $rules = [
        'nomor_kk' => 'required|is_unique[tb_kk.nomor_kk]',
        'alamat_lengkap' => 'required',
        'rt' => 'required',
        'rw' => 'required',
        'provinsi' => 'required',
        'kota' => 'required',
        'kecamatan' => 'required',
        'kelurahan' => 'required',
        'kode_pos' => 'required',
        'tanggal_dibuat' => 'required|valid_date',
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Memisahkan ID dan nama untuk provinsi, kota, kecamatan, dan kelurahan
    $provinsiData = explode('|', $data['provinsi']);
    $kotaData = explode('|', $data['kota']);
    $kecamatanData = explode('|', $data['kecamatan']);
    $kelurahanData = explode('|', $data['kelurahan']);

    // Data alamat yang akan disimpan
    $alamatData = [
        'alamat_lengkap' => $data['alamat_lengkap'],
        'rt' => $data['rt'],
        'rw' => $data['rw'],
        'provinsi' => $provinsiData[1], // Nama Provinsi
        'kota' => $kotaData[1], // Nama Kota
        'kecamatan' => $kecamatanData[1], // Nama Kecamatan
        'kelurahan' => $kelurahanData[1], // Nama Kelurahan
        'kode_pos' => $data['kode_pos'],
    ];
    // Simpan data alamat ke tabel tb_alamat
    $this->alamatModel->save($alamatData);
    $idAlamat = $this->alamatModel->getInsertID(); // Ambil ID alamat yang baru disimpan

    // Data Kartu Keluarga yang akan disimpan
    $kkData = [
        'nomor_kk' => $data['nomor_kk'],
        'id_alamat' => $idAlamat, // ID alamat yang baru saja disimpan
        'tanggal_dibuat' => $data['tanggal_dibuat'],
    ];

    // Simpan data Kartu Keluarga ke tabel tb_kk
    $this->KkModel->save($kkData);

    // Redirect ke halaman utama dengan pesan sukses
    return redirect()->to('/kk')->with('message', 'Kartu Keluarga berhasil ditambahkan');
}


    // Menampilkan form untuk mengedit Kartu Keluarga
    public function edit($id)
{
    // Ambil data kartu keluarga berdasarkan ID
    $kk = $this->KkModel->find($id);
    
    if (!$kk) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Kartu Keluarga tidak ditemukan');
    }

    // Ambil data lengkap dengan join tabel alamat
    $kk_with_alamat = $this->KkModel->select('tb_kk.*, tb_alamat.*')
                                    ->join('tb_alamat', 'tb_kk.id_alamat = tb_alamat.id_alamat', 'left')
                                    ->where('tb_kk.id_kk', $id)
                                    ->first(); // Hanya mengambil satu baris data
    
    if (!$kk_with_alamat) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data kartu keluarga dan alamat tidak ditemukan');
    }

    // Mengirimkan data ke view
    $data = [
        'title' => 'Edit Kartu Keluarga',
        'kk' => $kk_with_alamat, // Data Kartu Keluarga dan Alamat
        'validation' => \Config\Services::validation(),
    ];

    return view('kk/edit', $data);
}


    // Mengupdate data Kartu Keluarga
    public function update($id)
{
    $data = $this->request->getPost();

    // Validasi input
    $rules = [
        'nomor_kk' => 'required|is_unique[tb_kk.nomor_kk,id_kk,' . $id . ']',
        'nama_kepala_keluarga' => 'required',
        'alamat_lengkap' => 'required',
        'rt' => 'required',
        'rw' => 'required',
        'provinsi' => 'required',
        'kota' => 'required',
        'kecamatan' => 'required',
        'kelurahan' => 'required',
        'kode_pos' => 'required',
        'tanggal_dibuat' => 'required|valid_date',
    ];

    
    $kk= $this->KkModel->find($id);
    if (!$kk) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Kartu Keluarga tidak ditemukan');
    }
    $id_alamat= $kk['id_alamat'];

    // Jika validasi gagal
    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }


    // Memperbarui data alamat ke tabel tb_alamat
    $alamatData = [
        'alamat_lengkap' => $data['alamat_lengkap'],
        'rt' => $data['rt'],
        'rw' => $data['rt'],
        'provinsi' => $data['provinsi'],
        'kota' => $data['kota'],
        'kecamatan' => $data['kecamatan'],
        'kelurahan' => $data['kelurahan'],
        'kode_pos' => $data['kode_pos'],
    ];
    // Perbarui alamat berdasarkan ID yang dikirimkan
    $this->alamatModel->update($id_alamat, $alamatData);

    // Memperbarui data Kartu Keluarga ke tabel tb_kk
    $kkData = [
        'nomor_kk' => $data['nomor_kk'],
        'nama_kepala_keluarga' => $data['nama_kepala_keluarga'],
        'tanggal_dibuat' => $data['tanggal_dibuat'],
    ];

    // Perbarui data KK berdasarkan ID yang dikirimkan
    $this->KkModel->update($id, $kkData);

    // Redirect ke halaman utama dengan pesan sukses
    return redirect()->to('/kk')->with('message', 'Kartu Keluarga berhasil diperbarui');
}


    // Menghapus Kartu Keluarga
    public function delete($id)
{
    // Ambil id_alamat dari Kartu Keluarga
    $kk = $this->KkModel->find($id);
    $id_alamat = $kk['id_alamat']; // Mengambil id_alamat dari Kartu Keluarga yang ingin dihapus

    // Hapus data Alamat berdasarkan id_alamat
    if ($id_alamat) {
        $this->alamatModel->delete($id_alamat); // Menghapus alamat terkait
    }

    // Hapus data Kartu Keluarga berdasarkan ID
    $this->KkModel->delete($id);

    // Redirect ke halaman utama dengan pesan sukses
    return redirect()->to('/kk')->with('message', 'Kartu Keluarga beserta Alamat terkait berhasil dihapus');
}

}
