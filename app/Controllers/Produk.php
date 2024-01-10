<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelProduk;


class Produk extends BaseController
{
    public function __construct()
    {
        $this->ModelProduk = new ModelProduk();
    }
    public function index()
    {
        $data = [
            'judul' => 'Master Data',
            'subjudul' => 'Produk Hukum',
            'menu' => 'masterdata',
            'submenu' => 'produk',
            'page' => 'v_produk',
            'produk' =>  $this->ModelProduk->AllData(),
        ];
        return view('v_template', $data);
    }

    public function InsertData()
    {
        $data = [
            'judul'=> $this->request->getPost('judul'),
            'nomor'=> $this->request->getPost('nomor'),
            'tanggal'=>date('Y-m-d'),
            'penadatangan'=> $this->request->getPost('penadatangan'),
            'kategori'=> $this->request->getPost('kategori'),
            'status'=> $this->request->getPost('status'),
            'subjek'=> $this->request->getPost('subjek'),
            'jumlah'=> $this->request->getPost('jumlah'),
        
    ];

        $this->ModelProduk->InsertData($data);
        session()->setFlashdata('pesan','Data Berhasil Ditambahkan');
        return redirect()->to('Produk');
    }

    public function UpdateData($id_produk)
    {
        $data = [
            'id_produk' => $id_produk,
            'judul'=> $this->request->getPost('judul')
        ];
        $this->ModelProduk->UpdateData($data);
        session()->setFlashdata('pesan','Data Berhasil DiEdit');
        return redirect()->to('Produk');
    }

    public function DeleteData($id_produk)
    {
        $data = [
            'id_produk' => $id_produk,
        ];
        $this->ModelProduk->DeleteData($data);
        session()->setFlashdata('pesan','Data Berhasil DiHapus');
        return redirect()->to('Produk');
    }
}
