<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PengaturanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'nama_desa' => 'Desa Tajau Pecah',
            'sejarah_desa' => 'Desa Tajau Pecah awalnya adalah wilayah subur di tepi Sungai Lintang. Suku pribumi bermigrasi dan membentuk pemukiman pertanian dan perburuan. Pada abad ke-18, tumbuh menjadi komunitas tetap dengan perdagangan lokal. Era kolonial membawa pengaruh baru dan perkembangan ekonomi Pada kemerdekaan, desa berperan dalam perjuangan nasional dan memperbaiki infrastruktur dasar. 1980-an, modernisasi pertanian dan pariwisata meningkatkan pertumbuhan ekonomi. Kini, desa fokus pada pembangunan berkelanjutan dan pelestarian budaya. Program pendidikan dan pemberdayaan ekonomi meningkatkan kesejahteraan. Desa ini mencerminkan keselarasan antara tradisi dan modernitas, dengan semangat menuju kemajuan.',
            'kalimat_ucapan'=> 'Selamat Datang di Desa Tajau Pecah',
            'visi' => 'Mewujudkan Desa Tajau Pecah yang maju, mandiri, dan berdaya saing',
            'misi'=> '1. Meningkatkan kualitas sumber daya manusia yang beriman dan bertaqwa kepada Tuhan Yang Maha Esa, berakhlak mulia, sehat, cerdas, dan terampil.
            2. Meningkatkan kualitas pelayanan publik yang berkeadilan, transparan, akuntabel, dan partisipatif.
            3. Meningkatkan kualitas pembangunan infrastruktur yang berwawasan lingkungan dan berkelanjutan.
            4. Meningkatkan kualitas pemberdayaan masyarakat yang berbasis potensi lokal dan kearifan lokal.
            ',
            'titik_koordinator' => '0.000000, 0.000000',
            'jumlah_rt' => 16,
            'jumlah_penduduk' => 3133,
            'hari' => 'Senin - Jumat',
            'waktu_bisnis'=> '08.00 - 16.00'
        ];

        $this->db->table('tb_pengaturan')->insertBatch($data);
    }
}
