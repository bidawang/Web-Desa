<?php

namespace App\Controllers;

use App\Models\AnggotaKkModel;
use App\Controllers\BaseController;
use App\Models\UserMasyarakatModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Exceptions\PageNotFoundException;

class UserMasyarakatController extends BaseController
{
    protected $userMasyarakatModel;
    protected $anggotaKK;

    public function __construct()
    {
        $this->userMasyarakatModel = new UserMasyarakatModel();
        $this->anggotaKK = new AnggotaKkModel();

    }

    // Menampilkan daftar user masyarakat
    public function index($id_anggota_keluarga)
{
    $users = $this->userMasyarakatModel
        ->where('id_anggota_keluarga', $id_anggota_keluarga)
        ->findAll();

    $data = [
        'title' => 'Daftar User Masyarakat',
        'users' => $users,
        'id_anggota_keluarga' => $id_anggota_keluarga,
    ];

    return view('kk/anggotakeluarga/login/index', $data);
}

    // Menampilkan form tambah data
    public function create($id_anggota_keluarga)
{
    $data = [
        'title' => 'Tambah User Masyarakat',
        'id_anggota_keluarga' => $id_anggota_keluarga,
    ];

    return view('kk/anggotakeluarga/login/create', $data);
}


    // Proses simpan data
    public function store()
{
    $id_anggota_keluarga = $this->request->getPost('id_anggota_keluarga');
    
    // Simpan data akun
    $this->userMasyarakatModel->save([
        'username' => $this->request->getVar('username'),
        'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
        'no_hp' => $this->request->getVar('no_hp'),
        'email' => $this->request->getVar('email'),
        'id_anggota_keluarga' => $this->request->getVar('id_anggota_keluarga'),
    ]);
    
    // Ambil id_kk berdasarkan id_anggota
    $backtoview = $this->anggotaKK->select('id_kk')
    ->where('id_anggota', $id_anggota_keluarga)
    ->first();
    
    // dd($backtoview);
    
    // dd($backtoview);

    // Pastikan $backtoview adalah array atau objek yang valid dan memiliki 'id_kk'
    if ($backtoview) {
        return redirect()->to('/anggota-keluarga/' . $backtoview['id_kk'])->with('message', 'Akun berhasil dibuat!');
    } else {
        // Jika id_kk tidak ditemukan, bisa memberikan pesan kesalahan atau redirect lain
        return redirect()->to('/anggota-keluarga')->with('message', 'ID Anggota Keluarga tidak ditemukan!');
    }
}


    // Menampilkan form edit data
    public function edit($id)
    {
        $user = $this->userMasyarakatModel->find($id);

        if (!$user) {
            throw PageNotFoundException::forPageNotFound('User tidak ditemukan');
        }

        $data = [
            'title' => 'Edit User Masyarakat',
            'user' => $user,
        ];

        return view('kk/anggotakeluarga/login/edit', $data);
    }

    // Proses update data
    public function update($id)
{
    // Ambil data user berdasarkan id
    $user = $this->userMasyarakatModel->find($id);
    $id_anggota_keluarga = $this->request->getPost('id_anggota_keluarga');
    $backtoview = $this->anggotaKK->select('id_kk')
    ->where('id_anggota', $id_anggota_keluarga)
    ->first();
    if (!$user) {
        throw PageNotFoundException::forPageNotFound('User tidak ditemukan');
    }

    // Update data pengguna
    $this->userMasyarakatModel->update($id, [
        'username' => $this->request->getVar('username'),
        'password' => $this->request->getVar('password') ? password_hash($this->request->getVar('password'), PASSWORD_BCRYPT) : $user['password'],
        'no_hp' => $this->request->getVar('no_hp'),
        'email' => $this->request->getVar('email'),
        'id_anggota_keluarga' => $this->request->getVar('id_anggota_keluarga'),
    ]);

    if ($backtoview) {
        return redirect()->to('/anggota-keluarga/' . $backtoview['id_kk'])->with('message', 'User berhasil diperbarui');
    } else {
        // Jika id_kk tidak ditemukan, bisa memberikan pesan kesalahan atau redirect lain
        return redirect()->to('/anggota-keluarga')->with('message', 'User berhasil diperbarui');
    }
}


    // Proses hapus data
    public function delete($id)
    {
        $this->userMasyarakatModel->delete($id);

        return redirect()->to('/user-masyarakat')->with('message', 'User berhasil dihapus');
    }
}
