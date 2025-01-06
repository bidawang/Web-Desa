<?php

namespace App\Controllers;

use App\Models\KelahiranModel;
use App\Models\LinkModel;
use App\Models\KontakModel;
use App\Models\SyaratModel;
use App\Models\SPNikahModel;
use App\Models\AnggotaKkModel;
use App\Models\PelayananModel;
use App\Models\PengaturanModel;
use App\Models\SKDomisiliModel;
use App\Models\SKKematianModel;
use App\Models\SKKelahiranModel;
use App\Models\DetailSyaratModel;
use App\Models\BuktiDokumenModel;
use App\Controllers\BaseController;
use App\Models\AlamatModel;
use App\Models\KkModel;
use App\Models\UserMasyarakatModel;
use CodeIgniter\HTTP\ResponseInterface;

class SuratController extends BaseController
{
    protected $pelayananModel;
    protected $detailsyaratModel;
    protected $syaratModel;
    protected $db;
    protected $kontakModel;
    protected $anggotaKK;
    protected $pengaturanModel;
    protected $linkModel;
    protected $alamatModel;
    protected $kelahiranModel;
    protected $KkModel;
    protected $KepalaKK;
    protected $buktiDokumen;
    protected $userMasyarakat;

    public function __construct()
    {
        $this->detailsyaratModel = new DetailSyaratModel();
        $this->syaratModel = new SyaratModel();
        $this->db = \Config\Database::connect();
        $this->pengaturanModel = new PengaturanModel();
        $this->linkModel = new LinkModel();
        $this->kontakModel = new KontakModel();
        $this->anggotaKK = new AnggotaKkModel();
        $this->pelayananModel = new PelayananModel();
        $this->alamatModel = new AlamatModel();
        $this->kelahiranModel = new KelahiranModel();
        $this->KkModel = new KkModel();
        $this->KepalaKK = new AnggotaKkModel();
        $this->buktiDokumen = new BuktiDokumenModel();
        $this->userMasyarakat = new UserMasyarakatModel();
    }


    public function pelayanandomisili($id)
{
    // Ambil data syarat berdasarkan id pelayanan
    $syarat = $this->syaratModel->where('id_pelayanan', $id)->findAll();
    
    // Ambil detail syarat berdasarkan id_detail_syarat
    $detailsyarat = [];
    foreach ($syarat as $item) {
        // Pecah persyaratan menjadi array ID
        $ids = explode(',', $item['persyaratan']);
        foreach ($ids as $idd) {
            // Cari detail syarat berdasarkan ID
            $detailsyarat[] = $this->detailsyaratModel->find($idd);
        }
    }
    // Ambil data pelayanan
    $pelayanan = $this->pelayananModel->where('id_pelayanan', $id)->first();

    // Ambil semua link
    $link = $this->linkModel->findAll();

    // Ambil pengaturan dan kontak
    $pengaturan = $this->pengaturanModel->first();
    $kontak = $this->kontakModel->first();

    // Siapkan data yang akan dikirim ke view
    $data = [
        'title' => 'Pelayanan Masyarakat',
        'pelayanan' => $pelayanan,
        'link' => $link,
        'pengaturan' => $pengaturan,
        'kontak' => $kontak,
        'syarat' => $syarat,
        'detailsyarat' => $detailsyarat,
        'id' => $id
    ];
// dd($data); 
    // Kembalikan view dengan data yang sudah disiapkan
    if($id == 1){
        return view('landingpage/surat/domisili', $data);
    } elseif ($id == 2) {
        return view('landingpage/surat/kelahiran', $data);
    } elseif ($id == 3) {
        return view('landingpage/surat/kematian', $data);
    } 
}
public function suratCreateDomisili($id)
{
    $session = session(); // Get session instance
    $data = $this->request->getPost(); // Get the POST data
    $iduser = $session->get('nik_pengaju'); // Get NIK Pengaju from session

    // Validation rules
    $rules = [
        'keperluan' => 'required',
    ];

    // Validate input
    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Get the last SKD record to determine the new ID
    $model = new SKDomisiliModel();
    $lastSurat = $model->orderBy('id_skd', 'DESC')->first();
    $primaryKey = $lastSurat ? $lastSurat['id_skd'] + 1 : 1;

    // Format nomor surat
    $bulanRomawi = [
        1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV',
        5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII',
        9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
    ];
    $jenisSurat = 'SKD';
    $bulan = date('n');
    $tahun = date('Y');
    $nomorSurat = sprintf('%04d/%s/%s/%d', $primaryKey, $jenisSurat, $bulanRomawi[$bulan], $tahun);

    // Insert data into SKDomisili table
    $insertData = [
        'keperluan' => $data['keperluan'],
        'nomor_surat' => $nomorSurat,
        'id_pelayanan' => $id,
        'nik_pengaju' => $iduser,
    ];

    if ($model->insert($insertData)) {
        // Get the newly created SK Domisili ID
        $idSkDomisili = $model->getInsertID();

        // Handle file uploads
        $buktiDokumenModel = new BuktiDokumenModel();
        $uploadedFiles = $this->request->getFiles();

        // Check if files were uploaded
        if (!empty($uploadedFiles['dokumen_files'])) {
            $jenisDokumenArray = $this->request->getPost('jenis_dokumen'); // Get the jenis_dokumen array
            
            foreach ($uploadedFiles['dokumen_files'] as $index => $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    // Generate a custom file name
                    $customName = sprintf(
                        'dokumen_SKD_%s_%d_%d_%d.%s',
                        $bulanRomawi[$bulan],
                        $tahun,
                        $idSkDomisili, // Use the SK Domisili ID
                        $index + 1,   // To avoid conflict in case of multiple files
                        $file->getExtension()
                    );

                    // Move file to the "public/bukti_dokumen" folder
                    $file->move(ROOTPATH . 'public/bukti_dokumen', $customName);

                    // Save file metadata into the database
                    $buktiDokumenModel->insert([
                        'id_persyaratan' => $idSkDomisili, // Link to the SK Domisili ID
                        'nik_pengaju' => $iduser,
                        'nama_file' => $customName,
                        'jenis_dokumen' => isset($jenisDokumenArray[$index]) ? $jenisDokumenArray[$index] : null, // Access the correct jenis_dokumen
                    ]);
                }
            }
        }

        return redirect()->to('/pelayanan-masyarakat')->with('message', 'Surat berhasil dibuat.');
    } else {
        return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data.');
    }
}


public function suratcreatekelahiran($id)
{
    $session = session(); // Ambil instance session
    $data = $this->request->getPost();
    $iduser = $session->get('nik_pengaju');

    // Validasi input
    $rules = [
'date_kelahiran' => 'required|valid_date',
    'time_kelahiran' => 'required',
        'kelamin_anak' => 'required',
        'tempat_lahir_anak' => 'required',
    ];

    $date = $this->request->getPost('date_kelahiran'); // Format: Y-m-d
    $time = $this->request->getPost('time_kelahiran'); // Format: H:i:s (atau H:i)
    
    // Gabungkan menjadi format datetime
    $datetimeKelahiran = $date . ' ' . $time;

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Dapatkan primary key terakhir dari database
    $model = new SKKelahiranModel();
    $lastSurat = $model->orderBy('id_skk', 'DESC')->first();
    $primaryKey = $lastSurat ? $lastSurat['id_skk'] + 1 : 1;

    // Format nomor surat
    $bulanRomawi = [
        1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV',
        5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII',
        9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
    ];
    $jenisSurat = 'SKKL';
    $bulan = date('n');
    $tahun = date('Y');
    $nomorSurat = sprintf('%04d/%s/%s/%d', $primaryKey, $jenisSurat, $bulanRomawi[$bulan], $tahun);
$hubungan = $this->anggotaKK->where('nik', $iduser)->select('hubungan_keluarga')->first();
if('hubungan_keluarga == Kepala Keluarga'){
    $hubungan = 'Ayah';
} elseif('hubungan_keluarga == Istri'){
    $hubungan = 'Ibu';
}
    // Simpan data ke database
    $insertData = [
        'datetime_kelahiran' => $datetimeKelahiran,
        'nama_anak' => $data['nama_anak'],
        'anak_ke' => $data['anak_ke'],
        'nik_pengaju' => $iduser,
        'nomor_surat' => $nomorSurat,
        'id_pelayanan' => $id,
        'kelamin_anak' => $data['kelamin_anak'],
        'hubungan_dengan_bayi' => $hubungan,
        'tempat_lahir_anak' => $data['tempat_lahir_anak'],
    ];
    dd($insertData);
    if ($model->insert($insertData)) {
        $idSurat = $model->getInsertID();

        // Tangani upload file
        $buktiDokumenModel = new BuktiDokumenModel();
        $uploadedFiles = $this->request->getFiles();

        if (!empty($uploadedFiles['dokumen_files'])) {
            $jenisDokumenArray = $this->request->getPost('jenis_dokumen');

            foreach ($uploadedFiles['dokumen_files'] as $index => $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $customName = sprintf(
                        'dokumen_SKKL_%s_%d_%d_%d.%s',
                        $bulanRomawi[$bulan],
                        $tahun,
                        $idSurat,
                        $index + 1,
                        $file->getExtension()
                    );

                    $file->move(ROOTPATH . 'public/bukti_dokumen', $customName);

                    $buktiDokumenModel->insert([
                        'id_persyaratan' => $idSurat,
                        'nik_pengaju' => $iduser,
                        'nama_file' => $customName,
                        'jenis_dokumen' => $jenisDokumenArray[$index] ?? null,
                    ]);
                }
            }
        }

        return redirect()->to('/pelayanan-masyarakat')->with('message', 'Surat berhasil dibuat.');
    } else {
        return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data.');
    }
}

public function suratcreatekematian($id)
{
    $session = session();
    $data = $this->request->getPost();
    $iduser = $session->get('nik_pengaju');

    // Validasi input
    $rules = [
        'datetime_kematian' => 'required',
        'nik_kematian' => 'required',
        'lokasi_kematian' => 'required',
        'penyebab_kematian' => 'required',
        'hubungan' => 'required',
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Dapatkan primary key terakhir dari database
    $model = new SKKematianModel();
    $lastSurat = $model->orderBy('id_sk_kematian', 'DESC')->first();
    $primaryKey = $lastSurat ? $lastSurat['id_sk_kematian'] + 1 : 1;

    // Format nomor surat
    $bulanRomawi = [
        1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV',
        5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII',
        9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
    ];
    $jenisSurat = 'SKKM';
    $bulan = date('n');
    $tahun = date('Y');
    $nomorSurat = sprintf('%04d/%s/%s/%d', $primaryKey, $jenisSurat, $bulanRomawi[$bulan], $tahun);

    // Simpan data ke database
    $insertData = [
        'datetime_kematian' => $data['datetime_kematian'],
        'nik_pengaju' => $iduser,
        'nomor_surat' => $nomorSurat,
        'id_pelayanan' => $id,
        'lokasi_kematian' => $data['lokasi_kematian'],
        'penyebab_kematian' => $data['penyebab_kematian'],
        'hubungan' => $data['hubungan'],
        'nik_kematian' => $data['nik_kematian'],
    ];

    if ($model->insert($insertData)) {
        $idSurat = $model->getInsertID();

        // Tangani upload file
        $buktiDokumenModel = new BuktiDokumenModel();
        $uploadedFiles = $this->request->getFiles();

        if (!empty($uploadedFiles['dokumen_files'])) {
            $jenisDokumenArray = $this->request->getPost('jenis_dokumen');

            foreach ($uploadedFiles['dokumen_files'] as $index => $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $customName = sprintf(
                        'dokumen_SKKM_%s_%d_%d_%d.%s',
                        $bulanRomawi[$bulan],
                        $tahun,
                        $idSurat,
                        $index + 1,
                        $file->getExtension()
                    );

                    $file->move(ROOTPATH . 'public/bukti_dokumen', $customName);

                    $buktiDokumenModel->insert([
                        'id_persyaratan' => $idSurat,
                        'nik_pengaju' => $iduser,
                        'nama_file' => $customName,
                        'jenis_dokumen' => $jenisDokumenArray[$index] ?? null,
                    ]);
                }
            }
        }

        return redirect()->to('/pelayanan-masyarakat')->with('message', 'Surat berhasil dibuat.');
    } else {
        return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data.');
    }
}








//KITA MASUK KE KELOOOOOLA SYURAT MENYURAT

//hak nya si admin
public function viewDomisili()
{
    $model = new SKDomisiliModel();
    // Fetch all surat data
    $data['surat'] = $model->findAll();
    $kontak = $model->first();

    $getkontak = $this->anggotaKK->where('nik', $kontak['nik_pengaju'])->first();
    $get = $this->userMasyarakat->where('id_anggota_keluarga', $getkontak['id_anggota'])->first();
    // Fetch the bukti dokumen related to each surat
    foreach ($data['surat'] as &$surat) {
        // Fetch the bukti dokumen for each skd entry
        $bukti = $this->buktiDokumen->where('id_persyaratan', $surat['id_skd'])->findAll();
        // Add the bukti to the surat data
        $surat['bukti'] = $bukti;
    }


    // Pass the data to the view
    return view('surat/skdomisili', [
        'surat' => $data['surat'],
        'bukti' => $bukti,
        'no_hp' => $get,
        'pengaju' => $getkontak,
        'title' => 'Surat Domisili',
    ]);
}



public function viewKelahiran()
{
    $model = new SKKelahiranModel();
    $data['surat'] = $model->findAll();
    // Mengambil data pengaju
    $kontak = $model->first();
    $getkontak = $this->anggotaKK->where('nik', $kontak['nik_pengaju'])->first();
    $get = $this->userMasyarakat->where('id_anggota_keluarga', $getkontak['id_anggota'])->first();

    // Menambahkan bukti dokumen terkait setiap surat
    foreach ($data['surat'] as &$surat) {
        $bukti = $this->buktiDokumen->where('id_persyaratan', $surat['id_skk'])->findAll();
        $surat['bukti'] = $bukti;
    }

    // Pass data ke view
    return view('surat/skkelahiran', [
        'surat' => $data['surat'],
        'bukti' => $bukti,
        'no_hp' => $get,
        'pengaju' => $getkontak,
        'title' => 'Surat Kelahiran',
    ]);
}

public function viewKematian()
{
    $model = new SKKematianModel();
    $data['surat'] = $model->findAll();
    // Debug the data to inspect its structure
    // Mengambil data pengaju
    $kontak = $model->first();
    // dd($kontak);
    $getkontak = $this->anggotaKK->where('nik', $kontak['nik_pengaju'])->first();

    $get = $this->userMasyarakat->where('id_anggota_keluarga', $getkontak['id_anggota'])->first();
    // Menambahkan bukti dokumen terkait setiap surat
    foreach ($data['surat'] as &$surat) {
        $bukti = $this->buktiDokumen->where('id_persyaratan', $surat['id_sk_kematian'])->findAll();
        $surat['bukti'] = $bukti;
    }

    // Pass data ke view
    return view('surat/skkematian', [
        'surat' => $data['surat'],
        'bukti' => $bukti,
        'no_hp' => $get,
        'pengaju' => $getkontak,
        'title' => 'Surat Kematian',
    ]);
}

    public function updateStatus($id)
{
    $data = $this->request->getPost();
    $status = $data['status'];
    $modelType = $data['id_pelayanan']; // Ensure this data is sent from the form

    // Check model based on the sequence 1, 2, 3, 4
    $model = null;
    $fileModel = null; // Variable to handle the file model

    if ($modelType == '1') { // 1 for domisili
        $model = new SKDomisiliModel();
        $fileModel = new BuktiDokumenModel();
    } elseif ($modelType == '2') { // 2 for kelahiran
        $model = new SKKelahiranModel();
        $fileModel = new BuktiDokumenModel();
    } elseif ($modelType == '3') { // 3 for kematian
        $model = new SKKematianModel();
        $fileModel = new BuktiDokumenModel();
    } elseif ($modelType == '4') { // 4 for nikah
        $model = new SPNikahModel();
        $fileModel = new BuktiDokumenModel();
    }

    // If the model is not found
    if (!$model) {
        return redirect()->back()->with('error', 'Model tidak ditemukan.');
    }

    // If the status is "tolak", delete data and associated file
    if ($status == 'tolak') {
        // Get the record from the respective model
        $record = $model->find($id);
        if ($record) {
            // Get all associated files from the tb_bukti_dokumen table
            $buktiDokumen = $fileModel->where('id_persyaratan', $id)->findAll(); // Use findAll() to get multiple records
    
            if ($buktiDokumen) {
                // Loop through each file and delete it
                foreach ($buktiDokumen as $dokumen) {
                    // Delete the file from the server
                    $filePath = ROOTPATH . 'public/bukti_dokumen/' . $dokumen['nama_file'];
                    if (file_exists($filePath)) {
                        unlink($filePath); // Delete the file from the filesystem
                    }
    
                    // Delete the file entry from the tb_bukti_dokumen table
                    $fileModel->delete($dokumen['id_bukti_dokumen']);
                }
            }
    
            // Now delete the record from the appropriate model
            if ($model->delete($id)) {
                return redirect()->back()->with('success', 'Status ditolak dan data serta file berhasil dihapus.');
            } else {
                return redirect()->back()->with('error', 'Gagal menghapus data.');
            }
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
    } else {
        // If status is not "tolak", just update the status
        if ($model->update($id, ['status' => $status])) {
            return redirect()->back()->with('success', 'Status berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui status.');
        }
    }
}


    


//ini bagian print" an masyarakat
    
public function print_sk_domisili($id)
{
    // Ambil data surat berdasarkan ID
    $model = new SKDomisiliModel();
    $pelayanan = $model->find($id);

    // Periksa apakah data surat ditemukan
    if (!$pelayanan) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Surat tidak ditemukan');
    }

    // Ambil data anggota KK berdasarkan NIK pengaju
    $anggotaKK = $this->anggotaKK->where('nik', $pelayanan['nik_pengaju'])->first();
    $kelahiran = $this->kelahiranModel->where('id_kelahiran', $anggotaKK['id_kelahiran'])->first();
    $kk = $this->KkModel->where('id_kk', $anggotaKK['id_kk'])->first();
    $kepala = $this->anggotaKK
    ->where('id_kk', $kk['id_kk'])
    ->where('hubungan_keluarga', 'Kepala Keluarga')
    ->first();
    $kades = $this->anggotaKK->where('pekerjaan', 'Kades')->first();
    $alamat = $this->alamatModel->where('id_alamat', $kk['id_alamat'])->first();
    // Siapkan data untuk view
    $data = [
        'title' => 'Surat Keterangan Domisili',
        'surat' => $pelayanan, // Hanya data spesifik berdasarkan ID
        'anggotaKK' => $anggotaKK,
        'kk' => $kepala,
        'kelahiran' => $kelahiran,
        'alamat' => $alamat,
        'kades' => $kades
    ];

    // Debug data (opsional)

    return view('pelayanan/surat/skdomisili', $data);
}

//PRINT SURAT KELAHIRAN
public function print_sk_kelahiran($id){
    // Ambil data surat berdasarkan ID
    $model = new SKKelahiranModel();
    $pelayanan = $model->find($id);
    // Periksa apakah data surat ditemukan
    if (!$pelayanan) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Surat tidak ditemukan');
    }

    // Ambil data anggota KK berdasarkan NIK pengaju
    $anggotaKK = $this->anggotaKK->where('nik', $pelayanan['nik_pengaju'])->first();
    $kelahiran = $this->kelahiranModel->where('id_kelahiran', $anggotaKK['id_kelahiran'])->first();

    $kk = $this->KkModel->where('id_kk', $anggotaKK['id_kk'])->first();

    $kades = $this->anggotaKK->where('pekerjaan', 'Kades')->first();
    $keluarga = $this->anggotaKK->where('id_kk', $kk['id_kk'])->findall();
    $alamat = $this->alamatModel->where('id_alamat', $kk['id_alamat'])->first();

    // Tentukan apakah hubungan_dengan_bayi adalah ayah atau ibu
    if ($pelayanan['hubungan_dengan_bayi'] == 'Ayah') {
        // Jika pengaju adalah ayah, maka cari ibu yang statusnya 'Istri'
        $ayah = $anggotaKK;
        $ibu = $this->anggotaKK->where('id_kk', $kk['id_kk'])
            ->where('hubungan_keluarga', 'Istri')
            ->first();
    } else {
        // Jika pengaju adalah ibu, maka cari ayah yang statusnya 'Kepala Keluarga'
        $ibu = $anggotaKK;
        $ayah = $this->anggotaKK->where('id_kk', $kk['id_kk'])
            ->where('hubungan_keluarga', 'Kepala Keluarga')
            ->first();
    }

    // Fungsi untuk menghitung umur berdasarkan tanggal lahir
    function hitungUmur($tanggalLahir) {
        $lahir = new \DateTime($tanggalLahir);
        $sekarang = new \DateTime('today');
        return $sekarang->diff($lahir)->y; // Mengembalikan umur dalam tahun
    }

    // Ambil tanggal lahir dari data kelahiran
    $tanggalLahirAyah = $this->kelahiranModel->where('id_kelahiran', $ayah['id_kelahiran'])->first()['tanggal_lahir'];
    $tanggalLahirIbu = $this->kelahiranModel->where('id_kelahiran', $ibu['id_kelahiran'])->first()['tanggal_lahir'];
    $tanggalLahirPelapor = $this->kelahiranModel->where('id_kelahiran', $anggotaKK['id_kelahiran'])->first()['tanggal_lahir'];

    // Hitung umur untuk ayah, ibu, dan pelapor
    $umurAyah = hitungUmur($tanggalLahirAyah);
    $umurIbu = hitungUmur($tanggalLahirIbu);
    $umurPelapor = hitungUmur($tanggalLahirPelapor);

    // Siapkan data untuk view
    $data = [
        'title' => 'Surat Keterangan Domisili',
        'surat' => $pelayanan, // Hanya data spesifik berdasarkan ID
        'anggotaKK' => $anggotaKK,
        'kelahiran' => $kelahiran,
        'alamat' => $alamat,
        'kk' => $keluarga,
        'kades' => $kades,
        'ayah' => $ayah,
        'ibu' => $ibu,
        'umurAyah' => $umurAyah,
        'umurIbu' => $umurIbu,
        'umurPelapor' => $umurPelapor
    ];

    dd($data);
    return view('pelayanan/surat/skkelahiran', $data);
}




    public function print_sk_kematian($id){
        // Ambil data surat berdasarkan ID
    $model = new SKKematianModel();
    $pelayanan = $model->find($id);
    // Periksa apakah data surat ditemukan
    if (!$pelayanan) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Surat tidak ditemukan');
    }
    $kades = $this->anggotaKK->where('pekerjaan', 'Kades')->first();

    // Ambil data kematian
    $kematian = $this->anggotaKK->where('nik', $pelayanan['nik_kematian'])->first();
    $kelahiran = $this->kelahiranModel->where('id_kelahiran', $kematian['id_kelahiran'])->first();
    $kk = $this->KkModel->where('id_kk', $kematian['id_kk'])->first();
    $alamat = $this->alamatModel->where('id_alamat', $kk['id_alamat'])->first();
    // Siapkan data untuk view
    $data = [
        'title' => 'Surat Keterangan Domisili',
        'surat' => $pelayanan, // Hanya data spesifik berdasarkan ID
        'anggotaKK' => $kematian,
        'kelahiran' => $kelahiran,
        'alamat' => $alamat,
        'kades' => $kades,

    ];
    // dd($data);
    // Debug data (opsional)
    return view('pelayanan/surat/skkematian', $data);
    }
    

}
