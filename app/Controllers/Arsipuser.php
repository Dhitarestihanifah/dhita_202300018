<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelArsipuser;
use App\Models\ModelKategori;


class Arsipuser extends BaseController
{
    public function __construct()
    {
        $this->ModelArsipuser = new ModelArsipuser();
        $this->ModelKategori = new ModelKategori();
    }
    public function index()
    {
        $data = [
            'judul' => 'Master Data',
            'subjudul' => 'Arsip',
            'menu' => 'masterdata',
            'submenu' => 'arsip',
            'page' => 'arsipuser/v_index',
            'arsip' =>  $this->ModelArsipuser->AllData(),
        ];
        return view('v_pengguna', $data);
    }
    public function add()
    {
        $data = array(
            'judul' => 'Master Data',
            'subjudul' => 'Arsip',
            'menu' => 'masterdata',
            'submenu' => 'arsip',
            'page' => 'arsipuser/v_add',
            'kategori' => $this->ModelKategori->alldata(),
        );
        return view('v_pengguna', $data);
    }

    public function insert()
    {
        if ($this->validate([
            'nama_arsip' => [
                'label' => 'Nama Arsip',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
                ],
                'id_kategori' => [
                    'label' => 'Kategori',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Wajib Dipilih !!!',
                    ]
                    ],
                'deskripsi' => [
                    'label' => 'Deskripsi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Wajib Diisi !!!',
                    ]
                    ],
                
                    'file_arsip' => [
                    'label' => 'File Arsip',
                    'rules' => 'uploaded[file_arsip]|max_size[file_arsip, 2048]|ext_in[file_arsip,pdf]',
                    'errors' => [
                        'uploaded' => '{field} Wajib Diisi !!!',
                        'max_size' => 'ukuran {field} Max 2048 KB !!!',
                        'mime_in' => 'format {field} Wajib .pdf !!!',
                    ]
                    ],
        ])) {
            //file 
            $file_arsip = $this->request->getFile('file_arsip');
            // random file
            $nama_file = $file_arsip->getRandomName();
            // ambil ukuran file
            $ukuran_file = $file_arsip->getSize('kb');
            // jika valid
            $data = array(
                'id_kategori' => $this->request->getPost('id_kategori'),
                'no_arsip' => $this->request->getPost('no_arsip'),
                'nama_arsip' => $this->request->getPost('nama_arsip'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'tgl_upload' => date('Y-m-d'),
                'tgl_update' => date('Y-m-d'),
                'id_user' => session()->get('id_user'),
                'file_arsip' => $nama_file,
                'ukuran_file' => $ukuran_file,
            );
            $file_arsip->move('file_arsip',  $nama_file);
            $this->ModelArsipuser->tambah($data);
            session()->setFlashdata('pesan','Data Berhasil Ditambah !!!');
            return redirect()->to(base_url('arsipuser'));

        } else {
            // jika tidak valid
            session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
            return redirect()->to(base_url('arsipuser/add'));
        }


    }

    public function edit($id_arsip)
    {
        $data = array(
            'judul' => 'Master Data',
            'subjudul' => 'Arsip',
            'menu' => 'masterdata',
            'submenu' => 'arsip',
            'page' => 'arsipuser/v_edit',
            'kategori' => $this->ModelKategori->alldata(),
            'arsip' => $this->ModelArsipuser->detaildata($id_arsip),
        );
        return view('v_pengguna', $data);
    }

    public function update($id_arsip)
    {
        if ($this->validate([
            'nama_arsip' => [
                'label' => 'Nama Arsip',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
                ],
                'id_kategori' => [
                    'label' => 'Kategori',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Wajib Dipilih !!!',
                    ]
                    ],
                'deskripsi' => [
                    'label' => 'Deskripsi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Wajib Diisi !!!',
                    ]
                    ],
                
                    'file_arsip' => [
                    'label' => 'File Arsip',
                    'rules' => 'max_size[file_arsip, 2048]|ext_in[file_arsip,pdf]',
                    'errors' => [
                        'max_size' => 'ukuran {field} Max 2048 KB !!!',
                        'mime_in' => 'format {field} Wajib .pdf !!!',
                    ]
                    ],
        ])) {
            //file 
            $file_arsip = $this->request->getFile('file_arsip');
            if ($file_arsip->getError() == 4) {
                $data = array(
                    'id_arsip' => $id_arsip,
                    'id_kategori' => $this->request->getPost('id_kategori'),
                    'no_arsip' => $this->request->getPost('no_arsip'),
                    'nama_arsip' => $this->request->getPost('nama_arsip'),
                    'deskripsi' => $this->request->getPost('deskripsi'),
                    'tgl_update' => date('Y-m-d'),
                    'id_user' => session()->get('id_user'),
                );
                $this->ModelArsipuser->edit($data);
            } else {
                $arsip = $this->ModelArsipuser->detaildata($id_arsip);
                if ($arsip['file_arsip'] != "") {
                    unlink('file_arsip/'.$arsip['file_arsip']);
                }
                // random file
            $nama_file = $file_arsip->getRandomName();
            // ambil ukuran file
            $ukuran_file = $file_arsip->getSize('kb');
            // jika valid
            $data = array(
                'id_arsip' => $id_arsip,
                'id_kategori' => $this->request->getPost('id_kategori'),
                'no_arsip' => $this->request->getPost('no_arsip'),
                'nama_arsip' => $this->request->getPost('nama_arsip'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'tgl_update' => date('Y-m-d'),
                'id_user' => session()->get('id_user'),
                'file_arsip' => $nama_file,
                'ukuran_file' => $ukuran_file,
            );
            $file_arsip->move('file_arsip',  $nama_file);
            $this->ModelArsipuser->edit($data);
            }
            session()->setFlashdata('pesan','Data Berhasil Ditambah !!!');
            return redirect()->to(base_url('arsipuser'));
        }else{
            // jika tidak valid
            session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
            return redirect()->to(base_url('arsipuser/edit'. $id_arsip));
        }
        
    }
    public function delete($id_arsip)
    {
        $arsip = $this->ModelArsipuser->detaildata($id_arsip);
        if ($arsip['file_arsip'] != "") {
            unlink('file_arsip/'. $arsip['file_arsip']);
        }
        $data = array(
            'id_arsip' => $id_arsip,
        );
        $this->ModelArsipuser->delete_data($data);
        session()->setFlashdata('pesan','Data Berhasil Dihapus !!!');
        return redirect()->to(base_url('arsipuser'));
    }

    public function viewpdf($id_arsip)
    {
        $data = array(
            'judul' => 'Master Data',
            'subjudul' => 'Arsip',
            'menu' => 'masterdata',
            'submenu' => 'arsip',
            'page' => 'arsipuser/v_viewpdf',
            'arsip' => $this->ModelArsipuser->detaildata($id_arsip),
           
        );
        return view('v_pengguna', $data);
    }

    
}
