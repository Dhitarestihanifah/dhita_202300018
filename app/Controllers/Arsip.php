<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelArsip;
use App\Models\ModelKategori;


class Arsip extends BaseController
{
    public function __construct()
    {
        $this->ModelArsip = new ModelArsip();
        $this->ModelKategori = new ModelKategori();
    }
    public function index()
    {
        $data = [
            'judul' => 'Master Data',
            'subjudul' => 'Arsip',
            'menu' => 'masterdata',
            'submenu' => 'arsip',
            'page' => 'arsip/v_index',
            'arsip' =>  $this->ModelArsip->AllData(),
        ];
        return view('v_template', $data);
    }
    public function add()
    {
        $data = array(
            'judul' => 'Master Data',
            'subjudul' => 'Arsip',
            'menu' => 'masterdata',
            'submenu' => 'arsip',
            'page' => 'arsip/v_add',
            'kategori' => $this->ModelKategori->alldata(),
        );
        return view('v_template', $data);
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
            $this->ModelArsip->tambah($data);
            session()->setFlashdata('pesan','Data Berhasil Ditambah !!!');
            return redirect()->to(base_url('arsip'));

        } else {
            // jika tidak valid
            session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
            return redirect()->to(base_url('arsip/add'));
        }


    }

    public function edit($id_arsip)
    {
        $data = array(
            'judul' => 'Master Data',
            'subjudul' => 'Arsip',
            'menu' => 'masterdata',
            'submenu' => 'arsip',
            'page' => 'arsip/v_edit',
            'kategori' => $this->ModelKategori->alldata(),
            'arsip' => $this->ModelArsip->detaildata($id_arsip),
        );
        return view('v_template', $data);
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
                $this->ModelArsip->edit($data);
            } else {
                $arsip = $this->ModelArsip->detaildata($id_arsip);
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
            $this->ModelArsip->edit($data);
            }
            session()->setFlashdata('pesan','Data Berhasil Ditambah !!!');
            return redirect()->to(base_url('arsip'));
        }else{
            // jika tidak valid
            session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
            return redirect()->to(base_url('arsip/edit'. $id_arsip));
        }
        
    }
    public function delete($id_arsip)
    {
        $arsip = $this->ModelArsip->detaildata($id_arsip);
        if ($arsip['file_arsip'] != "") {
            unlink('file_arsip/'. $arsip['file_arsip']);
        }
        $data = array(
            'id_arsip' => $id_arsip,
        );
        $this->ModelArsip->delete_data($data);
        session()->setFlashdata('pesan','Data Berhasil Dihapus !!!');
        return redirect()->to(base_url('arsip'));
    }

    public function viewpdf($id_arsip)
    {
        $data = array(
            'judul' => 'Master Data',
            'subjudul' => 'Arsip',
            'menu' => 'masterdata',
            'submenu' => 'arsip',
            'page' => 'arsip/v_viewpdf',
            'arsip' => $this->ModelArsip->detaildata($id_arsip),
           
        );
        return view('v_template', $data);
    }

    
}
