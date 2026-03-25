<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PegawaiModel;
use CodeIgniter\HTTP\ResponseInterface;

class Profile extends BaseController
{
    protected $pegawaiModel;

    public function __construct()
    {
        $this->pegawaiModel = new PegawaiModel();
    }

    public function index()
    {
        $id = session()->get('id_pegawai');
        $data = [
            'title'      => 'Profile',
            'pegawai'    => $this->pegawaiModel->detailPegawai($id),
            'validation' => \Config\Services::validation()
        ];

        return view('Admin/profile', $data);
    }

    public function update_foto($id)
    {
        $foto = $this->request->getFile('foto');

        // Validasi file
        if (!$this->validate([
            'foto' => [
                'rules' => 'uploaded[foto]|max_size[foto,2048]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih foto terlebih dahulu.',
                    'max_size' => 'Ukuran foto terlalu besar (Max 2MB).',
                    'is_image' => 'Yang Anda pilih bukan gambar.',
                    'mime_in'  => 'Format foto harus JPG, JPEG, atau PNG.'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        $pegawai_lama = $this->pegawaiModel->find($id);
        $namaFoto = $foto->getRandomName();
        $foto->move('profile/', $namaFoto);

        // Hapus foto lama jika ada
        if ($pegawai_lama['foto'] != 'default.png' && file_exists('profile/' . $pegawai_lama['foto'])) {
            unlink('profile/' . $pegawai_lama['foto']);
        }

        $this->pegawaiModel->update($id, ['foto' => $namaFoto]);

        session()->setFlashdata('pesan', 'Foto profil berhasil diperbarui! ✨');
        return redirect()->to('Admin/profile');
    }
}