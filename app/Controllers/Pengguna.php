<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelPengguna;

class Pengguna extends BaseController
{
    public function __construct()
    {
        $this->ModelPengguna = new ModelPengguna();
    }
    public function index()
    {
        $data = [
            'judul' => 'Dashboard',
            'subjudul' => '',
            'menu' => 'dashboard',
            'submenu' => '',
            'page' => 'v_p',
        ];
        return view('v_Pengguna', $data);
    }

    public function Setting()
    {
        $data = [
            'judul' => 'Setting',
            'subjudul' => 'Setting',
            'menu' => 'setting',
            'submenu' => '',
            'page' => 'v_setting',
            'setting' => $this->ModelPengguna->DetailData(),
        ];
        return view('v_Pengguna', $data); 
    }

    public function UpdateSetting()
    {
        $data = [
            'id' => '1',
            'nama_toko'=> $this->request->getPost('nama_toko'),
            'slogan'=> $this->request->getPost('slogan'),
            'alamat'=> $this->request->getPost('alamat'),
            'no_hp'=> $this->request->getPost('no_hp'),
            'deskripsi'=> $this->request->getPost('deskripsi'),
        ];
        $this->ModelPengguna->UpdateData($data);
        session()->setFlashdata('pesan','Data Berhasil DiEdit');
        return redirect()->to('Pengguna/Setting');
    }
}
