<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAdmin;

class Admin extends BaseController
{
    public function __construct()
    {
        $this->ModelAdmin = new ModelAdmin();
    }
    public function index()
    {
        $data = [
            'judul' => 'Dashboard',
            'subjudul' => '',
            'menu' => 'dashboard',
            'submenu' => '',
            'page' => 'v_admin',
            'tot_arsip' => $this->ModelAdmin->tot_arsip(),
            'tot_bagian' => $this->ModelAdmin->tot_bagian(),
            'tot_user' => $this->ModelAdmin->tot_user(),
            'tot_kategori' => $this->ModelAdmin->tot_kategori(), 
            
        ];
        return view('v_template', $data);
    }

    public function Setting()
    {
        $data = [
            'judul' => 'Setting',
            'subjudul' => 'Setting',
            'menu' => 'setting',
            'submenu' => '',
            'page' => 'v_setting',
            'setting' => $this->ModelAdmin->DetailData(),
        ];
        return view('v_template', $data); 
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
        $this->ModelAdmin->UpdateData($data);
        session()->setFlashdata('pesan','Data Berhasil DiEdit');
        return redirect()->to('Admin/Setting');
    }
}
