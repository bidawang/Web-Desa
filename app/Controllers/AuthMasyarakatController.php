<?php

namespace App\Controllers;

use App\Models\LinkModel;
use App\Models\KontakModel;
use App\Models\AnggotaKkModel;
use App\Models\PengaturanModel;
use App\Controllers\BaseController;
use App\Models\UserMasyarakatModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthMasyarakatController extends BaseController
{
    protected $beritaModel;
    protected $pengaturanModel;
    protected $linkModel;
    protected $kontakModel;
    protected $userMasyarakatModel;
    protected $AnggotaKkModel;

    protected $PopulerModel;
    public function __construct()
    {
        $this->pengaturanModel = new PengaturanModel();
        $this->linkModel = new LinkModel();
        $this->kontakModel = new KontakModel();
        $this->userMasyarakatModel = new UserMasyarakatModel();
$this->AnggotaKkModel = new AnggotaKkModel();
        $this->session = session(); // Memulai session

    }
    public function login()
    {
        // Data tambahan
    $pengaturan = $this->pengaturanModel->first();
    $link = $this->linkModel->getLink();
    $kontak = $this->kontakModel->first();
    $data = [
        'title' => 'Login',
       
        'pengaturan' => $pengaturan,
        'link' => $link,
        'kontak' => $kontak,
    ];

        return view('landingpage/login/index',$data);
    }

    public function authenticate()
{
    // Validasi input form
    $rules = [
        'username' => 'required',
        'password' => 'required',
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('error', 'Semua field harus diisi!');
    }

    // Ambil data input dari form
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');

    // Cari pengguna berdasarkan username
    $user = $this->userMasyarakatModel->where('username', $username)->first();
    $anggota = $this->AnggotaKkModel->where('id_anggota', $user['id_anggota_keluarga'])->first();
    if ($user) {
        // Validasi password
        if (password_verify($password, $user['password'])) {
            // Simpan data ke session
            $sessionData = [
                'username' => $user['username'],
                'id_user_masyarakat' => $user['id_user_masyarakat'],
                'nik_pengaju' => $anggota['nik'],
                'isLoggedIn' => true,
            ];
            session()->set($sessionData);

            // Redirect ke halaman dashboard
            return redirect()->to('/')->with('message', 'Login berhasil!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Password salah!');
        }
    } else {
        return redirect()->back()->withInput()->with('error', 'Username tidak ditemukan!');
    }
}


    // Proses logout
    public function logout()
    {
        // Hapus semua session
        $this->session->destroy();
        return redirect()->to('/')->with('message', 'Logout berhasil!');
    }


}
