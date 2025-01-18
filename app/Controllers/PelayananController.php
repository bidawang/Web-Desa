<?php

namespace App\Controllers;

use App\Models\LinkModel;
use App\Models\KontakModel;
use App\Models\SyaratModel;
use App\Models\SPNikahModel;
use App\Models\PelayananModel;
use App\Models\PengaturanModel;
use App\Models\SKDomisiliModel;
use App\Models\SKKematianModel;
use App\Models\SKKelahiranModel;
use App\Models\DetailSyaratModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class PelayananController extends BaseController
{
    protected $pelayananModel;
    protected $detailsyaratModel;
    protected $syaratModel;
    protected $db;
    protected $kontakModel;
protected $skDomisili;
protected $skKematian;
protected $skKelahiran;
protected $skNikah;

protected $pengaturanModel;
protected $linkModel;

    public function __construct()
    {
        $this->pelayananModel = new PelayananModel();
        $this->detailsyaratModel = new DetailSyaratModel();
        $this->syaratModel = new SyaratModel();
        $this->db = \Config\Database::connect();
        $this->pengaturanModel = new PengaturanModel();
        $this->linkModel = new LinkModel();
        $this->kontakModel = new KontakModel();
        $this->skDomisili = new SKDomisiliModel();
        $this->skKematian = new SKKematianModel();
        $this->skKelahiran = new SKKelahiranModel();
        $this->skNikah = new SPNikahModel();

    }

    public function index()
    {
        $data = [
            'title' => 'Pelayanan',
            'pelayanan' => $this->pelayananModel->findAll()
        ];
        return view('pelayanan/index', $data);
    }

    public function pelayananmasyarakat()
    {
        $pelayanan = $this->pelayananModel->findAll();
        $link = $this->linkModel->findAll();
        $pengaturan = $this->pengaturanModel->first();
        $kontak = $this->kontakModel->first();
        $data = [
            'title' => 'Pelayanan Masyarakat',
            'pelayanan' => $pelayanan,
            'link' => $link,
            'pengaturan' => $pengaturan,
            'kontak' => $kontak,

        ];
        return view('landingpage/pagepelayanan', $data);
    }
    public function detailpelayananmasyarakat()
    {
        // Ambil id_pelayanan dari POST
        $id = $this->request->getPost('id_pelayanan');
    
        if (!$id) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pelayanan tidak ditemukan.');
        }
    
        // Inisialisasi model
        $this->skDomisili = new SKDomisiliModel();
        $this->skKematian = new SKKematianModel();
        $this->skKelahiran = new SKKelahiranModel();
        $this->skNikah = new SPNikahModel();
        $userNik = session()->get('nik_pengaju');
    
        // Ambil data syarat berdasarkan id pelayanan
        $syarat = $this->syaratModel->where('id_pelayanan', $id)->findAll();
    
        // Ambil detail syarat berdasarkan id_detail_syarat
        $detailsyarat = [];
        foreach ($syarat as $item) {
            $ids = explode(',', $item['persyaratan']);
            foreach ($ids as $idDetail) {
                $detailsyarat[] = $this->detailsyaratModel->find($idDetail);
            }
        }
    
        // Ambil data spesifik berdasarkan id_pelayanan
        $specificData = [];
        switch ($id) {
            case 1:
                $specificData = $this->skDomisili->where('nik_pengaju', $userNik)->findAll();
                break;
            case 2:
                $specificData = $this->skKelahiran->where('nik_pengaju', $userNik)->findAll();
                break;
            case 3:
                $specificData = $this->skKematian->where('nik_pengaju', $userNik)->findAll();
                break;
            default:
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Pelayanan tidak ditemukan.');
        }
    
        // Ambil data pelayanan, link, pengaturan, dan kontak
        $pelayanan = $this->pelayananModel->where('id_pelayanan', $id)->first();
        $link = $this->linkModel->findAll();
        $pengaturan = $this->pengaturanModel->first();
        $kontak = $this->kontakModel->first();
    
        $data = [
            'title' => 'Pelayanan Masyarakat',
            'pelayanan' => $pelayanan,
            'link' => $link,
            'pengaturan' => $pengaturan,
            'kontak' => $kontak,
            'syarat' => $syarat,
            'detailsyarat' => $detailsyarat,
            'specificData' => $specificData,
            'isLoggedIn' => session()->get('isLoggedIn') ?? false,
        ];
        // Debugging (opsional)    
        return view('landingpage/detailpagepelayanan', $data);
    }
    



    public function indexsyarat($id)
    {
        $data = [
            'title' => 'Pelayanan',
            'pelayanan' => $this->pelayananModel->find($id),
            'persyaratan' => $this->syaratModel->where('id_pelayanan', $id)->findall(),
            'detailsyarat' => $this->detailsyaratModel->findAll()
        ];

        return view('/pelayanan/persyaratan/index', $data);
    }
    public function tambah_syarat($id)
{
    $syaratIds = $this->request->getPost('syarat');
    if ($syaratIds) {
        $this->db->transStart();

foreach ($syaratIds as $syaratId) {
    $this->syaratModel->insert([
        'persyaratan' => $syaratId,
        'id_pelayanan' => $id
    ]);
}

$this->db->transComplete();

if ($this->db->transStatus() === false) {
    return redirect()->to('/pelayanan/syarat/' . $id)->with('error', 'Terjadi kesalahan saat menambahkan persyaratan.');
}


        return redirect()->to('/pelayanan/syarat/' . $id)->with('success', 'Persyaratan berhasil ditambahkan.');
    }

    return redirect()->to('/pelayanan/syarat/' . $id)->with('error', 'Tidak ada persyaratan yang dipilih.');
}

    
    public function create()
    {
        $data = [
            'title' => 'Pelayanan'
        ];
        return view('/pelayanan/create',$data
    );
    }

    public function store()
    {
        $this->pelayananModel->save([
            'judul_pelayanan' => $this->request->getPost('judul_pelayanan'),
            'deskripsi_pelayanan' => $this->request->getPost('deskripsi_pelayanan')
        ]);

        return redirect()->to('/pelayanan')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Pelayanan',
            'pelayanan' => $this->pelayananModel->find($id)
        ];
        return view('/pelayanan/edit', $data);
    }

    public function update($id)
    {
        $this->pelayananModel->update($id, [
            'judul_pelayanan' => $this->request->getPost('judul_pelayanan'),
            'deskripsi_pelayanan' => $this->request->getPost('deskripsi_pelayanan')
        ]);

        return redirect()->to('/pelayanan')->with('success', 'Data berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->pelayananModel->delete($id);

        return redirect()->to('/pelayanan')->with('success', 'Data berhasil dihapus.');
    }
    public function delete_syarat($id_syarat)
    {
        $syarat = $this->syaratModel->find($id_syarat);

        if (!$syarat) {
            return redirect()->back()->with('error', 'Persyaratan tidak ditemukan.');
        }
        $id_pelayanan = $syarat['id_pelayanan'];
        
    $this->syaratModel->delete($id_syarat);

    return redirect()->to('/pelayanan/syarat/' . $id_pelayanan)->with('success', 'Persyaratan berhasil ditambahkan.');
    }


}
