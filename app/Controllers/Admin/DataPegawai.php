<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PegawaiModel;
use App\Models\UserModel;
use App\Models\LokasiPresensiModel;
use App\Models\JabatanModel;

class DataPegawai extends BaseController
{
    function __construct()
    {
        helper(['url', 'form']);
    }

    public function index()
    {
        $PegawaiModel = new PegawaiModel();
        $data = [
            'title' => 'Data Pegawai',
            'pegawai' => $PegawaiModel->findALL()
        ];
        return view('admin/data_pegawai/data_pegawai', $data);
    }

    public function detail($id)
    {
        $PegawaiModel = new PegawaiModel();
        $data =[
            'title' => 'Detail Pegawai',
            'pegawai' => $PegawaiModel->detailPegawai($id),
        ];

        return view('Admin/data_pegawai/detail', $data);
    }

    public function create()
    {
        $lokasi_presensi = new LokasiPresensiModel();
        $jabatan_model = new JabatanModel();    
        $data = [
            'title' => 'Tambah Pegawai',
            'lokasi_presensi' => $lokasi_presensi->findALL(),
            'jabatan' => $jabatan_model->orderBy('jabatan', 'ASC')->findALL(),
            'validation' => session('validation') ?? \Config\Services::validation()
        ];
        return view('Admin/data_pegawai/create', $data);
    }

    public function generateNIP()
    {
        $PegawaiModel = new PegawaiModel();
        $pegawaiTerakhir = $PegawaiModel->select('nip')->orderBy('id', 'DESC')->first();
        $nipTerakhir = $pegawaiTerakhir ? $pegawaiTerakhir['nip'] : 'PEG-0000';
        $angkaNip = (int) substr($nipTerakhir, 4);
        $angkaNip++;
        return 'PEG-' . str_pad($angkaNip, 4, '0', STR_PAD_LEFT);
    }

    public function store(){
        $rules = [
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Harus Diisi'
                ],
            ],
            'jenis_kelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis Kelamin Harus Diisi'
                ],
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat Harus Diisi'
                ],
            ],
            'no_handphone' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomor Handphone Harus Diisi'
                ],
            ],
            'jabatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jabatan Harus Diisi'
                ],
            ],
            'lokasi_presensi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Lokasi Harus Diisi'
                ],
            ],
            'foto' => [
                'rules' => 'uploaded[foto]|max_size[foto,10240]|mime_in[foto,image/png,image/jpeg]',
                'errors' => [
                    'uploaded' => 'Foto Harus Diupload',
                    'max_size' => 'Ukuran Melebihi 10MB',
                    'mime_in' => 'Hanya Bisa PDF & JPEG'
                ],
            ],
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Username Harus Diisi'
                ],
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password Harus Diisi'
                ],
            ],
            'konfirmasi_password' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Harus Konfirmasi Password',
                    'matches' => 'Password Tidak Sesuai'
                ],
            ],
            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Role Harus Diisi'
                ],
            ],
        ];

        if (!$this->validate($rules)){
            $lokasi_presensi = new LokasiPresensiModel();
            $jabatan_model = new JabatanModel();    
            $data = [
            'title' => 'Tambah Pegawai',
            'lokasi_presensi' => $lokasi_presensi->findALL(),
            'jabatan' => $jabatan_model->orderBy('jabatan', 'ASC')->findALL(),
            'validation' => \Config\Services::validation(),
        ];
            return redirect()->back()->withInput()->with('validation', \Config\Services::validation());
        }else{
            $PegawaiModel = new PegawaiModel();
            $userModel = new UserModel();
            $nipBaru = $this->generateNIP();

            $foto = $this->request->getFile('foto');

            if($foto->getError() == 4){
                $nama_foto = '';
            }else{
                $nama_foto = $foto->getRandomName();
                $foto->move('profile', $nama_foto); 
            }

            $PegawaiModel = new PegawaiModel();
            $PegawaiModel->insert([
                'nip' => $nipBaru, 
                'nama' => $this->request->getPost('nama'),
                'jenis_kelamin' =>  $this->request->getPost('jenis_kelamin'),
                'alamat' => $this->request->getPost('alamat'),
                'no_handphone' => $this->request->getPost('no_handphone'),
                'jabatan' => $this->request->getPost('jabatan'),
                'lokasi_presensi' => $this->request->getPost('lokasi_presensi'),
                'foto' => $nama_foto,
            ]);
            $id_pegawai = $PegawaiModel->insertID();
            $userModel = new UserModel();
            $userModel->insert([
            'id_pegawai' => $id_pegawai,
            'username'   => $this->request->getPost('username'),
            'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'status'     => 'Aktif',
            'role'       => $this->request->getPost('role'),
        ]);

            session()->setFlashData('berhasil', 'Data Pegawai Presensi Berhasil Tersimpan');

            return redirect()->to(base_url('Admin/data_pegawai'));
        }
    }

    public function edit($id){

        $lokasi_presensi = new LokasiPresensiModel();
        $jabatan_model = new JabatanModel();
        $PegawaiModel = new PegawaiModel();
        $data = [
            'title' => 'Edit Data Pegawai',
            'pegawai' => $PegawaiModel->editPegawai($id),
            'lokasi_presensi' => $lokasi_presensi->findALL(),
            'jabatan' => $jabatan_model->orderBy('jabatan', 'ASC')->findALL(),
            'validation' => \Config\Services::validation()
        ];
        return view('Admin/data_pegawai/edit', $data);
    }

    public function update($id){
        $PegawaiModel = new PegawaiModel();
        $rules = [
            'nama' => [
                'rules' => 'required',
                'errors' => ['required' => 'Nama Harus Diisi'],
            ],
            'jenis_kelamin' => [
                'rules' => 'required',
                'errors' => ['required' => 'Jenis kelamin Harus Diisi'],
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => ['required' => 'Alamat Harus Diisi'],
            ],
            'no_handphone' => [
                'rules' => 'required',
                'errors' => ['required' => 'Nomor Handphone Harus Diisi'],
            ],
            'jabatan' => [
                'rules' => 'required',
                'errors' => ['required' => 'Jabatan Harus Diisi'],
            ],
            'lokasi_presensi' => [
                'rules' => 'required',
                'errors' => ['required' => 'Lokasi Harus Diisi'],
            ],
            'foto' => [
                'rules' => 'max_size[foto,10240]|mime_in[foto,image/png,image/jpeg]',
                'errors' => [
                    'max_size' => 'Ukuran Melebihi 10MB',
                    'mime_in' => 'Hanya Bisa PNG & JPEG'
                ],
            ],
            'username' => [
                'rules' => 'required',
                'errors' => ['required' => 'Username Harus Diisi'],
            ],
            'role' => [
                'rules' => 'required',
                'errors' => ['required' => 'Role Harus Diisi'],
            ],
        ];

        if (!$this->validate($rules)){
            return redirect()->back()->withInput();
        } else {
            $foto = $this->request->getFile('foto');
            if($foto->getError() == 4){
                $nama_foto = $this->request->getPost('foto_lama');
            }else{
                $nama_foto = $foto->getRandomName();
                $foto->move('profile', $nama_foto); 
            }

            $PegawaiModel->update($id, [
                'nama'            => $this->request->getPost('nama'),
                'jenis_kelamin'   => $this->request->getPost('jenis_kelamin'),
                'alamat'          => $this->request->getPost('alamat'),
                'no_handphone'    => $this->request->getPost('no_handphone'),
                'jabatan'         => $this->request->getPost('jabatan'),
                'lokasi_presensi' => $this->request->getPost('lokasi_presensi'), 
                'foto'            => $nama_foto,
            ]);

            $password = $this->request->getPost('password') == '' 
                ? $this->request->getPost('password_lama') 
                : password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

            $userModel = new UserModel();
            $userModel->where('id_pegawai', $id)->set([
                'username' => $this->request->getPost('username'),
                'password' => $password,
                'status'   => $this->request->getPost('status'),
                'role'     => $this->request->getPost('role'),
            ])->update();
            
            session()->setFlashData('berhasil', 'Data Pegawai Berhasil diUpdate');
            return redirect()->to(base_url('Admin/data_pegawai'));
        }
    }


    public function delete($id){

        $PegawaiModel = new PegawaiModel();
        $userModel = new Usermodel;
        $lokasi_presensi = $PegawaiModel->find($id);
        if ($lokasi_presensi) {
            $userModel->where('id_pegawai', $id)->delete();
            $PegawaiModel->delete($id);
            session()->setFlashData('berhasil', 'Data Pegawai Berhasil diHapus');
        
        return redirect()->to(base_url('Admin/data_pegawai/'));
        }
    }
}
