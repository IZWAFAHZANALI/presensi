<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\LokasiPresensiModel;

class LokasiPresensi extends BaseController
{
    public function index()
    {
        $LokasiPresensiModel = new LokasiPresensiModel();
        $data = [
            'title' => 'Data Lokasi Presensi',
            'lokasi_presensi' => $LokasiPresensiModel->findALL()
        ];
        return view('admin/lokasi_presensi/lokasi_presensi', $data);
    }

    public function detail($id)
    {
        $LokasiPresensiModel = new LokasiPresensiModel();
        $data =[
            'title' => 'Detail Lokasi Presensi',
            'lokasi_presensi' => $LokasiPresensiModel->find($id),
        ];
        return view('Admin/lokasi_presensi/detail', $data);
    }

    public function create(){
        $data = [
            'title' => 'Tambah Lokasi Presensi',
            'validation' => \Config\Services::validation()
        ];
        return view('Admin/lokasi_presensi/create', $data);
    }

    public function store(){
        $rules = [
            'nama_lokasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Lokasi Harus Diisi'
                ],
            ],
            'alamat_lokasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat Harus Diisi'
                ],
            ],
            'tipe_lokasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tipe Lokasi Harus Diisi'
                ],
            ],
            'latitude' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Latitude Harus Diisi'
                ],
            ],
            'longitude' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Longitude Harus Diisi'
                ],
            ],
            'radius' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Radius Harus Diisi'
                ],
            ],
            'zona_waktu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Zona Waktu Harus Diisi'
                ],
            ],
            'jam_masuk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jam Masuk Harus Diisi'
                ],
            ],
            'jam_pulang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jam Pulang Harus Diisi'
                ],
            ],
        ];

        if (!$this->validate($rules)){
            $data = [
                'title' => 'Tambah Lokasi Presensi',
                'validation' => \Config\Services::validation()
            ];
            echo view('admin/lokasi_presensi/create', $data);
        }else{
            $LokasiPresensiModel = new LokasiPresensiModel();
            $LokasiPresensiModel->insert([
                'nama_lokasi' => $this->request->getPost('nama_lokasi'),
                'alamat_lokasi' => $this->request->getPost('alamat_lokasi'),
                'tipe_lokasi' => $this->request->getPost('tipe_lokasi'),
                'latitude' => $this->request->getPost('latitude'),
                'longitude' => $this->request->getPost('longitude'),
                'radius' => $this->request->getPost('radius'),
                'zona_waktu' => $this->request->getPost('zona_waktu'),
                'jam_masuk' => $this->request->getPost('jam_masuk'),
                'jam_pulang' => $this->request->getPost('jam_pulang')

            ]);

            session()->setFlashData('berhasil', 'Data Lokasi Presensi Berhasil Tersimpan');

            return redirect()->to(base_url('Admin/lokasi_presensi'));
        }
    }

    public function edit($id){

        $LokasiPresensiModel = new LokasiPresensiModel();
        $data = [
            'title' => 'Edit Lokasi',
            'lokasi_presensi' => $LokasiPresensiModel->find($id),      
            'validation' => \Config\Services::validation()
        ];
        return view('admin/lokasi_presensi/edit', $data);
    }

    public function update($id){
        $LokasiPresensiModel = new LokasiPresensiModel();
        $rules = [
            'nama_lokasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Lokasi Harus Diisi'
                ],
            ],
            'alamat_lokasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat Harus Diisi'
                ],
            ],
            'tipe_lokasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tipe Lokasi Harus Diisi'
                ],
            ],
            'latitude' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Latitude Harus Diisi'
                ],
            ],
            'longitude' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Longitude Harus Diisi'
                ],
            ],
            'radius' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Radius Harus Diisi'
                ],
            ],
            'zona_waktu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Zona Waktu Harus Diisi'
                ],
            ],
            'jam_masuk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jam Masuk Harus Diisi'
                ],
            ],
            'jam_pulang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jam Pulang Harus Diisi'
                ],
            ],
        ];

        if (!$this->validate($rules)){
            $data = [
            'title' => 'Edit Lokasi',
            'lokasi_presensi' => $LokasiPresensiModel->find($id),      
            'validation' => \Config\Services::validation()
            ];
            echo view('admin/lokasi_presensi/edit', $data);
        }else{
            $LokasiPresensiModel = new LokasiPresensiModel();
            $LokasiPresensiModel->update($id, [
                'nama_lokasi' => $this->request->getPost('nama_lokasi'),
                'alamat_lokasi' => $this->request->getPost('alamat_lokasi'),
                'tipe_lokasi' => $this->request->getPost('tipe_lokasi'),
                'latitude' => $this->request->getPost('latitude'),
                'longitude' => $this->request->getPost('longitude'),
                'radius' => $this->request->getPost('radius'),
                'zona_waktu' => $this->request->getPost('zona_waktu'),
                'jam_masuk' => $this->request->getPost('jam_masuk'),
                'jam_pulang' => $this->request->getPost('jam_pulang')
            ]);

            session()->setFlashData('berhasil', 'Data Presensi Berhasil diUpdate');

            return redirect()->to(base_url('Admin/lokasi_presensi'));
        }
    }

    public function delete($id){

        $LokasiPresensiModel = new LokasiPresensiModel();

        $lokasi_presensi = $LokasiPresensiModel->find($id);
        if ($lokasi_presensi) {
            $LokasiPresensiModel->delete($id);
            session()->setFlashData('berhasil', 'Data Presensi Berhasil diHapus');
        
        return redirect()->to(base_url('Admin/lokasi_presensi/'));
        }
    }
}
