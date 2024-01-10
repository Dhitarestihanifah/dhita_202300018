<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelKategoriuser;


class Kategoriuser extends BaseController
{
    public function __construct()
    {
        $this->ModelKategoriuser = new ModelKategoriuser();
    }
    public function index()
    {
        $data = [
            'judul' => 'Master Data',
            'subjudul' => 'Kategori',
            'menu' => 'masterdata',
            'submenu' => 'kategori',
            'page' => 'v_kategoriuser',
            'kategoriuser' =>  $this->ModelKategoriuser->AllData(),
        ];
        return view('v_pengguna', $data);
    }

    public function InsertData()
    {
        $data = ['nama_kategori'=> $this->request->getPost('nama_kategori')];
        $this->ModelKategoriuser->InsertData($data);
        session()->setFlashdata('pesan','Data Berhasil Ditambahkan');
        return redirect()->to('Kategoriuser');
    }

    public function UpdateData($id_kategori)
    {
        $data = [
            'id_kategori' => $id_kategori,
            'nama_kategori'=> $this->request->getPost('nama_kategori')
        ];
        $this->ModelKategoriuser->UpdateData($data);
        session()->setFlashdata('pesan','Data Berhasil DiEdit');
        return redirect()->to('Kategoriuser');
    }

    public function DeleteData($id_kategori)
    {
        $data = [
            'id_kategori' => $id_kategori,
        ];
        $this->ModelKategoriuser->DeleteData($data);
        session()->setFlashdata('pesan','Data Berhasil DiHapus');
        return redirect()->to('Kategoriuser');
    }
}
