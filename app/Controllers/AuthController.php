<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class AuthController extends BaseController
{

    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UsersModel();
    }


    public function login()
    {
        if (session()->get('user_id')) {
            return redirect()->to('/dashboard');
        }
        return view('auth/login'); // Menampilkan halaman login
    }
   
    public function processLogin()
    {
        $validation =  \Config\Services::validation();
     // Set validation rules
        $validation->setRules([
            'username' => 'required',
            'password' => 'required',
        ]);

        // validation
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        $username = $this->request->getPost('username');
        $password = $this->request->getVar('password');

        $user = $this->userModel->where('username', $username)->first();
        if ($user && password_verify($password, $user['password'])) {

            $userData = [
                'user_id' => $user['id'],
                'nama' => $user['nama'],
                'username' => $user['username'],
                'password' => $user['password'],
            ];

            session()->set($userData);
            return redirect()->to('/dashboard');
        } else {
            return redirect()->back()->withInput()->with('error', 'username atau password salah.');
        }
    }

    public function logout()
    {
        session()->destroy(); // Hapus data session
        return redirect()->to('/login');
    }
}
