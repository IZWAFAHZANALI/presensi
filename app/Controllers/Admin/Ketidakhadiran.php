<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KetidakhadiranModel;
use CodeIgniter\HTTP\ResponseInterface;

class Ketidakhadiran extends BaseController
{
    public function index()
    {
        $ketidakhadiranModel = new KetidakhadiranModel();
        $id_pegawai = session()->get('id_pegawai');
        $data = [
            'title' => 'Ketidakhadiran',
            'ketidakhadiran' => $ketidakhadiranModel->findAll()
        ];
        return view('Admin/ketidakhadiran', $data);
    }

    public function approved($id){
        $ketidakhadiranModel = new KetidakhadiranModel();

            $ketidakhadiranModel->update($id, [
                'status' => 'Approved', 
            ]);
            
            session()->setFlashData('berhasil', 'Status Pengajuan Berhasil diUbah');
            return redirect()->to(base_url('Admin/ketidakhadiran/'));
    }
}
