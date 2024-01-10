<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelBagianuser;

class Bagianuser extends BaseController
{
    public function __construct()
    {
        $this->ModelBagianuser = new ModelBagianuser();
    }
    public function index()
    {
        $data = [
            'judul' => 'Master Data',
            'subjudul' => 'bagian',
            'menu' => 'masterdata',
            'submenu' => 'bagian',
            'page' => 'v_bagianuser',
            'bagianuser' => $this->ModelBagianuser->AllData(),
        ];
        return view('v_pengguna', $data);
    }

    public function InsertData()
    {
        $data = ['bagian'=> $this->request->getPost('bagian')];
        $this->ModelBagianuser->InsertData($data);
        session()->setFlashdata('pesan','Data Berhasil Ditambahkan');
        return redirect()->to('bagianuser');
    }

    public function UpdateData($id_bagian)
    {
        $data = [
            'id_bagian' => $id_bagian,
            'bagian'=> $this->request->getPost('bagian')
        ];
        $this->ModelBagianuser->UpdateData($data);
        session()->setFlashdata('pesan','Data Berhasil DiEdit');
        return redirect()->to('bagianuser');
    }

    public function DeleteData($id_bagian)
    {
        $data = [
            'id_bagian' => $id_bagian,
        ];
        $this->ModelBagianuser->DeleteData($data);
        session()->setFlashdata('pesan','Data Berhasil DiHapus');
        return redirect()->to('bagianuser');
    }
}
