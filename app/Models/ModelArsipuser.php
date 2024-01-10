<?php namespace App\Models;

use CodeIgniter\Model;

class ModelArsipuser extends Model
{
    public function alldata()
    {
        return $this->db->table('tbl_arsip')
        ->join('tbl_bagian','tbl_bagian.id_bagian = tbl_arsip.id_bagian', 'left')
        ->join('tbl_user','tbl_user.id_user = tbl_arsip.id_user', 'left')
        ->join('tbl_kategori','tbl_kategori.id_kategori = tbl_arsip.id_kategori', 'left')
        ->orderBy('id_arsip','DESC')
        ->get()
        ->getResultArray();
    }

    public function detaildata($id_arsip)
    {
        return $this->db->table('tbl_arsip')
        ->join('tbl_bagian','tbl_bagian.id_bagian = tbl_arsip.id_bagian', 'left')
        ->join('tbl_user','tbl_user.id_user = tbl_arsip.id_user', 'left')
        ->join('tbl_kategori','tbl_kategori.id_kategori = tbl_arsip.id_kategori', 'left')
        ->where('id_arsip',$id_arsip)
        ->get()
        ->getRowArray();
    }

    public function tambah($data)
    {
        $this->db->table('tbl_arsip')->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('tbl_arsip')
        ->where('id_arsip',$data['id_arsip'])
        ->update($data);
    }

    public function delete_data($data)
    {
        $this->db->table('tbl_arsip')
        ->where('id_arsip',$data['id_arsip'])
        ->delete($data);
    }
}