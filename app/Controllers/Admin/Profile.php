<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PegawaiModel;
use CodeIgniter\HTTP\ResponseInterface;

class Profile extends BaseController
{
    public function index()
    {
        $id = session()->get('id_pegawai');

        $PegawaiModel = new PegawaiModel();
        $data =[
            'title' => 'Profile',
            'pegawai' => $PegawaiModel->detailPegawai($id),
        ];

        return view('Admin/profile', $data);
    }
}
