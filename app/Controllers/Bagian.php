<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelBagian;

class Bagian extends BaseController
{
    public function __construct()
    {
        $this->ModelBagian = new ModelBagian();
    }
    public function index()
    {
        $data = [
            'judul' => 'Master Data',
            'subjudul' => 'bagian',
            'menu' => 'masterdata',
            'submenu' => 'bagian',
            'page' => 'v_bagian',
            'bagian' => $this->ModelBagian->AllData(),
        ];
        return view('v_template', $data);
    }

    public function InsertData()
    {
        $data = ['bagian'=> $this->request->getPost('bagian')];
        $this->ModelBagian->InsertData($data);
        session()->setFlashdata('pesan','Data Berhasil Ditambahkan');
        return redirect()->to('bagian');
    }

    public function UpdateData($id_bagian)
    {
        $data = [
            'id_bagian' => $id_bagian,
            'bagian'=> $this->request->getPost('bagian')
        ];
        $this->ModelBagian->UpdateData($data);
        session()->setFlashdata('pesan','Data Berhasil DiEdit');
        return redirect()->to('bagian');
    }

    public function DeleteData($id_bagian)
    {
        $data = [
            'id_bagian' => $id_bagian,
        ];
        $this->ModelBagian->DeleteData($data);
        session()->setFlashdata('pesan','Data Berhasil DiHapus');
        return redirect()->to('bagian');
    }
}
