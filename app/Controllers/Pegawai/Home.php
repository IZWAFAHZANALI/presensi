<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\LokasiPresensiModel;
use App\Models\PegawaiModel;
use App\Models\PresensiModel;

class Home extends BaseController
{
    public function index()
{
    $lokasi_presensi = new LokasiPresensiModel();
    $pegawai_model = new PegawaiModel();
    $presensi_model = new PresensiModel();
    $id_pegawai = session()->get('id_pegawai');

    // 1. Ambil data pegawai terbaru dari database
    $pegawai = $pegawai_model->where('id', $id_pegawai)->first();

    // 2. REFRESH SESSION (Agar Foto & Jabatan Sinkron)
    // Bagian ini penting supaya layout.php bisa baca data terbaru
    $PegawaiModel = new PegawaiModel();
    session()->set([
        'foto'    => $pegawai['foto'],    // Pastikan nama kolom di DB adalah 'foto'
        'jabatan' => $pegawai['jabatan'], // Pastikan nama kolom di DB adalah 'jabatan'
    ]);

    $data = [
        'title' => '',
        'lokasi_presensi' => $lokasi_presensi->where('id', $pegawai['lokasi_presensi'])->first(),
        'cek_presensi' => $presensi_model->where('id_pegawai', $id_pegawai)->where('tanggal_masuk', date('Y-m-d'))->countAllResults(),
        'cek_presensi_keluar' => $presensi_model->where('id_pegawai', $id_pegawai)->where('tanggal_masuk', date('Y-m-d'))->where('tanggal_keluar !=', '0000-00-00')->countAllResults(),
        'ambil_presensi_masuk' => $presensi_model->where('id_pegawai', $id_pegawai)->where('tanggal_masuk', date('Y-m-d'))->first(),
    ];

    return view('Pegawai/home', $data); 
}

    public function presensi_masuk()
    {
        // Ambil data lokasi kantor untuk mendapatkan radius asli dari DB
        $id_pegawai = session()->get('id_pegawai');
        $pegawai_model = new PegawaiModel();
        $pegawai = $pegawai_model->where('id', $id_pegawai)->first();
        
        $lokasi_model = new LokasiPresensiModel();
        $lokasi = $lokasi_model->where('id', $pegawai['lokasi_presensi'])->first();

        $latitude_pegawai = (float) $this->request->getPost('latitude_pegawai');
        $longitude_pegawai = (float) $this->request->getPost('longitude_pegawai');
        $latitude_kantor = (float) $lokasi['latitude'];
        $longitude_kantor = (float) $lokasi['longitude'];
        $radius = $lokasi['radius']; // Ambil radius dari database

        // Rumus Haversine yang lebih akurat untuk menghitung jarak dua titik koordinat
        $theta = $longitude_pegawai - $longitude_kantor;
        $dist = sin(deg2rad($latitude_pegawai)) * sin(deg2rad($latitude_kantor)) +  cos(deg2rad($latitude_pegawai)) * cos(deg2rad($latitude_kantor)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $jarak_meter = floor($miles * 1609.344);

        if($jarak_meter > $radius){
            session()->setFlashdata('gagal', 'Anda berada diluar jangkauan kantor! Jarak Anda: ' . $jarak_meter . ' meter');
            return redirect()->to(base_url('Pegawai/home'));
        } else {
            $data = [
                'title' => "Ambil Foto",
                'id_pegawai' => $this->request->getPost('id_pegawai'),
                'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
                'jam_masuk' => $this->request->getPost('jam_masuk'),
                'lokasi_presensi'=> $lokasi['nama_lokasi'],
            ];
            return view('Pegawai/ambil_foto', $data);
        }
    }

    public function presensi_masuk_aksi()
{
    $request = \Config\Services::request();
    $id_pegawai = $request->getPost('id_pegawai');
    
    // GUNAKAN WAKTU SERVER SAAT INI (Bukan dari POST)
    $tanggal_masuk = date('Y-m-d');
    $jam_masuk     = date('H:i:s'); 

    $foto_masuk = $request->getPost('foto_masuk');
    $foto_masuk = str_replace('data:image/jpeg;base64,', '', $foto_masuk);
    $foto_masuk = str_replace(' ', '+', $foto_masuk);
    $foto_masuk = base64_decode($foto_masuk);

    $nama_foto = $id_pegawai . '_' . time() . '.jpg';
    $foto_dir = FCPATH . 'uploads/' . $nama_foto; 
    file_put_contents($foto_dir, $foto_masuk);

    $presensi_model = new PresensiModel();
    $presensi_model->insert([
        'id_pegawai'    => $id_pegawai,
        'jam_masuk'     => $jam_masuk,     // Waktu server yang sudah Asia/Jakarta
        'tanggal_masuk' => $tanggal_masuk, // Tanggal server
        'foto_masuk'    => $nama_foto
    ]);

    session()->setFlashData('berhasil', 'Presensi Masuk Berhasil');
    return $this->response->setStatusCode(200);
}

public function presensi_keluar($id)
    {
        // Ambil data lokasi kantor untuk mendapatkan radius asli dari DB
        $id_pegawai = session()->get('id_pegawai');
        $pegawai_model = new PegawaiModel();
        $pegawai = $pegawai_model->where('id', $id_pegawai)->first();
        
        $lokasi_model = new LokasiPresensiModel();
        $lokasi = $lokasi_model->where('id', $pegawai['lokasi_presensi'])->first();

        $latitude_pegawai = (float) $this->request->getPost('latitude_pegawai');
        $longitude_pegawai = (float) $this->request->getPost('longitude_pegawai');
        $latitude_kantor = (float) $lokasi['latitude'];
        $longitude_kantor = (float) $lokasi['longitude'];
        $radius = $lokasi['radius']; // Ambil radius dari database

        // Rumus Haversine
        $theta = $longitude_kantor - $longitude_pegawai;
        $jarak = sin(deg2rad($latitude_pegawai)) * sin(deg2rad($latitude_kantor)) + cos(deg2rad($latitude_pegawai)) * cos(deg2rad($latitude_kantor)) * cos(deg2rad($theta));
        $jarak = acos($jarak);
        $jarak = rad2deg($jarak);
        $mil = $jarak * 60 * 1.1515;
        $km = $mil * 1.609344;
        $jarak_meter = floor($km * 1000);

        if($jarak_meter > $radius){
            session()->setFlashdata('gagal', 'Anda berada diluar jangkauan kantor! Jarak Anda: ' . $jarak_meter . ' meter');
            return redirect()->to(base_url('Pegawai/home'));
        } else {
            $data = [
                'title' => "Ambil Foto",
                'id_presensi' => $id,
                'tanggal_keluar' => $this->request->getPost('tanggal_keluar'),
                'jam_keluar' => $this->request->getPost('jam_keluar'),
                'lokasi_presensi'=> $lokasi['nama_lokasi'],
            ];
            return view('Pegawai/ambil_foto_keluar', $data);
        }
    }

    public function presensi_keluar_aksi($id)
{
    $request = \Config\Services::request();
    $foto_keluar = $request->getPost('foto_keluar');

    // Gunakan waktu server agar akurat
    $tanggal_keluar = date('Y-m-d');
    $jam_keluar = date('H:i:s'); // Waktu server yang sudah Asia/Jakarta

    $foto_keluar = str_replace('data:image/jpeg;base64,', '', $foto_keluar);
    $foto_keluar = str_replace(' ', '+', $foto_keluar);
    $foto_keluar = base64_decode($foto_keluar);

    $nama_foto = $id . '_' . time() . '.jpg';
    $foto_dir = FCPATH . 'uploads/' . $nama_foto; 

    if (file_put_contents($foto_dir, $foto_keluar)) {
        $presensi_model = new PresensiModel();
    $presensi_model->update($id, [
        'jam_keluar'     => $jam_keluar,
        'tanggal_keluar' => $tanggal_keluar,
        'foto_keluar'    => $nama_foto
    ]);

        session()->setFlashdata('berhasil', 'Presensi Keluar Berhasil');
        return $this->response->setStatusCode(200);
    }
    return $this->response->setStatusCode(500);
}

}
