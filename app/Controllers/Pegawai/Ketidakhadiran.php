<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use App\Models\KetidakhadiranModel;
use CodeIgniter\HTTP\ResponseInterface;

class Ketidakhadiran extends BaseController
{
    function __construct()
    {
        helper(['url', 'form']);
    }

    public function index()
    {
        $ketidakhadiranModel = new KetidakhadiranModel();
        $id_pegawai = session()->get('id_pegawai');
        $data = [
            'title' => 'Ketidakhadiran',
            'ketidakhadiran' => $ketidakhadiranModel->where('id_pegawai', $id_pegawai)->findAll()
        ];
        return view('Pegawai/ketidakhadiran', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Ajukan Izin',
            'validation' => session('validation') ?? \Config\Services::validation()
        ];
        return view('Pegawai/create_ketidakhadiran', $data);
    }

    public function store()
    {
        $rules = [
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan Harus Diisi'
                ],
            ],
            'tanggal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Harus Diisi'
                ],
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi Harus Diisi'
                ],
            ],
            'file' => [
                'rules' => 'uploaded[file]|max_size[file,10240]|mime_in[file,image/png,image/jpeg]',
                'errors' => [
                    'uploaded' => 'File Harus Diupload',
                    'max_size' => 'Ukuran Melebihi 10MB',
                    'mime_in' => 'Hanya Bisa PDF, JPEG, atau PNG'
                ],
            ],
        ];

        if (!$this->validate($rules)){
            $data = [
            'title' => 'Ajukan Izin',
            'validation' => session('validation') ?? \Config\Services::validation()
        ];
        return view('Pegawai/create_ketidakhadiran', $data);
        }else{
            $ketidakhadiranModel = new KetidakhadiranModel();

            $file = $this->request->getFile('file');

            if($file->getError() == 4){
                $nama_file = '';
            }else{
                $nama_file = $file->getRandomName();
                $file->move('file_ketidakhadiran', $nama_file); 
            }

            $ketidakhadiranModel->insert([ 
                'keterangan' => $this->request->getPost('keterangan'),
                'tanggal' =>  $this->request->getPost('tanggal'),
                'id_pegawai' => $this->request->getPost('id_pegawai'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'status' => 'Pending',
                'file' => $nama_file,
            ]);

            session()->setFlashData('berhasil', 'Ketidakhadiran Berhasil Diajukan');

            return redirect()->to(base_url('Pegawai/ketidakhadiran'));
        }
    }

    public function edit($id){

        $ketidakhadiranModel = new KetidakhadiranModel();
        $data = [
                'title' => 'Edit',
                'ketidakhadiran' => $ketidakhadiranModel->find($id),
                'validation' => \Config\Services::validation()
        ];
        return view('Pegawai/edit_ketidakhadiran', $data);
    }

    public function update($id){
        $ketidakhadiranModel = new KetidakhadiranModel();
        $rules = [
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan Harus Diisi'
                ],
            ],
            'tanggal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Harus Diisi'
                ],
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi Harus Diisi'
                ],
            ],
        ];

        if (!$this->validate($rules)){
            $ketidakhadiranModel = new KetidakhadiranModel();
            $data = [
                'title' => 'Edit',
                'ketidakhadiran' => $ketidakhadiranModel->find($id),
                'validation' => \Config\Services::validation()
        ];
        return view('Pegawai/edit_ketidakhadiran', $data);
        } else {
            $ketidakhadiranModel = new KetidakhadiranModel();

            $file = $this->request->getFile('file');

            if($file->getError() == 4){
                $nama_file = $this->request->getPost('file');
            }else{
                $nama_file = $file->getRandomName();
                $file->move('file_ketidakhadiran', $nama_file); 
            }

            $ketidakhadiranModel->update($id, [
                'keterangan' => $this->request->getPost('keterangan'),
                'tanggal' =>  $this->request->getPost('tanggal'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'status' => 'Pending',
                'file' => $nama_file,
            ]);
            
            session()->setFlashData('berhasil', 'Data Berhasil diUpdate');
            return redirect()->to(base_url('Pegawai/ketidakhadiran/'));
        }
    }


    public function delete($id){

        $ketidakhadiranModel = new KetidakhadiranModel();
        $ketidakhadiran = $ketidakhadiranModel->find($id);
        if ($ketidakhadiran) {
            $ketidakhadiranModel->where('id_pegawai', $id)->delete();
            $ketidakhadiranModel->delete($id);
            session()->setFlashData('berhasil', 'Data Berhasil diHapus');
        
        return redirect()->to(base_url('Pegawai/ketidakhadiran/'));
        }
    }
}
