<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PengaturanModel;

class PengaturanController extends BaseController
{
    protected $pengaturanModel;

    public function __construct()
    {
        $this->pengaturanModel = new PengaturanModel();
    }

    public function index()
    {
        $pengaturan = $this->pengaturanModel->first();
        $data = [
            'title' => 'Data Desa',
            'validation' => \Config\Services::validation(),
            'pengaturan' => $pengaturan
        ];

        return view('pengaturan/index', $data);
    }

    public function update()
    {
        $validationRules = [
            'nama_desa' => 'required',
            'sejarah_desa' => 'required',
            'kalimat_ucapan' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'titik_koordinator' => 'required',
            'jumlah_rt' => 'required|numeric',
            'jumlah_penduduk' => 'required|numeric',
            'hari' => 'required',
            'waktu_bisnis' => 'required',
        ];

        $validationMessages = [
            'required' => 'Field :field harus diisi.',
            'numeric' => 'Field :field harus berbentuk angka.',
        ];

        // Validasi input foto logo_desa
        if ($this->request->getFile('logo_desa')) {
            $validationRules['logo_desa'] = 'uploaded[logo_desa]|max_size[logo_desa,2048]|ext_in[logo_desa,png,jpg,jpeg]|is_image[logo_desa,image/jpeg,image/png]';
        }

        // Validasi input foto struktur_organisasi
        if ($this->request->getFile('struktur_organisasi')) {
            $validationRules['struktur_organisasi'] = 'uploaded[struktur_organisasi]|max_size[struktur_organisasi,2048]|ext_in[struktur_organisasi,png,jpg,jpeg]|is_image[struktur_organisasi,image/jpeg,image/png]';
        }

        // Validasi input foto img_potensi_wilayah
        if ($this->request->getFile('img_potensi_wilayah')) {
            $validationRules['img_potensi_wilayah'] = 'uploaded[img_potensi_wilayah]|max_size[img_potensi_wilayah,2048]|ext_in[img_potensi_wilayah,png,jpg,jpeg]|is_image[img_potensi_wilayah,image/jpeg,image/png]';
        }

        if (!$this->validate($validationRules, $validationMessages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama_desa' => $this->request->getVar('nama_desa'),
            'sejarah_desa' => $this->request->getVar('sejarah_desa'),
            'kalimat_ucapan' => $this->request->getVar('kalimat_ucapan'),
            'visi' => $this->request->getVar('visi'),
            'misi' => $this->request->getVar('misi'),
            'titik_koordinator' => $this->request->getVar('titik_koordinator'),
            'jumlah_rt' => $this->request->getVar('jumlah_rt'),
            'jumlah_penduduk' => $this->request->getVar('jumlah_penduduk'),
            'hari' => $this->request->getVar('hari'),
            'waktu_bisnis' => $this->request->getVar('waktu_bisnis'),
        ];

        // Upload dan simpan logo_desa jika di-upload
        if ($logoDesaFile = $this->request->getFile('logo_desa')) {
            if ($logoDesaFile->isValid()) {
                $newLogoName = $logoDesaFile->getRandomName();
                $logoDesaFile->move(ROOTPATH . '../public_html/uploads', $newLogoName);

                // Hapus data logo_desa yang sudah ada sebelumnya
                $existingData = $this->pengaturanModel->find(1);
                $existingLogoPath = ROOTPATH . 'public_html/uploads/' . $existingData['logo_desa'];
                if (file_exists($existingLogoPath)) {
                    unlink($existingLogoPath);
                }

                $data['logo_desa'] = $newLogoName;
            }
        }

        // Handle struktur_organisasi
        if ($strukturOrganisasiFile = $this->request->getFile('struktur_organisasi')) {
            if ($strukturOrganisasiFile->isValid()) {
                $newStrukturName = $strukturOrganisasiFile->getRandomName();
                $strukturOrganisasiFile->move(ROOTPATH . '../public_html/uploads', $newStrukturName);

                // Resize the image to the desired dimensions (1361x595)
                $image = \Config\Services::image()
                    ->withFile(ROOTPATH . '../public_html/uploads/' . $newStrukturName)
                    ->resize(1361, 595, false)
                    ->save(ROOTPATH . '../public_html/uploads/' . $newStrukturName);

                // Delete the old struktur_organisasi file if it exists
                $existingData = $this->pengaturanModel->find(1);
                $existingStrukturPath = ROOTPATH . 'public_html/uploads/' . $existingData['struktur_organisasi'];
                if (file_exists($existingStrukturPath)) {
                    unlink($existingStrukturPath);
                }

                $data['struktur_organisasi'] = $newStrukturName;
            }
        }

        // Handle img_potensi_wilayah
        if ($imgPotensiWilayahFile = $this->request->getFile('img_potensi_wilayah')) {
            if ($imgPotensiWilayahFile->isValid()) {
                $newImgPotensiName = $imgPotensiWilayahFile->getRandomName();
                $imgPotensiWilayahFile->move(ROOTPATH . '../public_html/uploads', $newImgPotensiName);

                // Resize the image to the desired dimensions (1022x630)
                $image = \Config\Services::image()
                    ->withFile(ROOTPATH . '../public_html/uploads/' . $newImgPotensiName)
                    ->resize(1022, 630, false)
                    ->save(ROOTPATH . '../public_html/uploads/' . $newImgPotensiName);

                // Delete the old img_potensi_wilayah file if it exists
                $existingData = $this->pengaturanModel->find(1);
                $existingImgPotensiPath = ROOTPATH . 'public_html/uploads/' . $existingData['img_potensi_wilayah'];
                if (file_exists($existingImgPotensiPath)) {
                    unlink($existingImgPotensiPath);
                }

                $data['img_potensi_wilayah'] = $newImgPotensiName;
            }
        }

        if ($this->pengaturanModel->update(1, $data)) {
            return redirect()->to('/settings')->with('success', 'Data berhasil diperbarui!');
        } else {
            return redirect()->to('/settings')->with('error', 'Data gagal diperbarui.');
        }
    }
}
