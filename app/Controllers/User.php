<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ModelUser;
use App\Models\ModelBagian;

class User extends BaseController
{
    public function __construct()
    {
        $this->ModelUser = new ModelUser();
        $this->ModelBagian = new ModelBagian();
    }
    public function index()
    {
        $data = [
            'judul' => 'User',
            'subjudul' => 'User',
            'menu' => 'masterdata',
            'submenu' => 'user',
            'page' => 'v_user',
            'user' => $this->ModelUser->AllData(),
            'bagian' =>  $this->ModelBagian->AllData(),
        ];
        return view('v_template', $data);
    }
    public function InsertData()
    {
        $data = [
        'nama_user'=> $this->request->getPost('nama_user'),
        'email'=> $this->request->getPost('email'),
        'password' => sha1( $this->request->getPost('password')),
        'level'=> $this->request->getPost('level'),
        'id_bagian'=> $this->request->getPost('id_bagian'),

        ];
        $this->ModelUser->InsertData($data);
        session()->setFlashdata('pesan','Data Berhasil Ditambahkan');
        return redirect()->to('User');
    }
    public function UpdateData($id_user)
    {
        $data = [
        'id_user' => $id_user,
        'nama_user'=> $this->request->getPost('nama_user'),
        'email'=> $this->request->getPost('email'),
        'password' => sha1( $this->request->getPost('password')),
        'level'=> $this->request->getPost('level'),
        'id_bagian'=> $this->request->getPost('id_bagian'),

        ];
        $this->ModelUser->UpdateData($data);
        session()->setFlashdata('pesan','Data Berhasil Diedit');
        return redirect()->to('User');
    }
    public function DeleteData($id_user)
    {
        $data = [
            'id_user' => $id_user,
        ];
        $this->ModelUser->DeleteData($data);
        session()->setFlashdata('pesan','Data Berhasil DiHapus');
        return redirect()->to('User');
    }
}
