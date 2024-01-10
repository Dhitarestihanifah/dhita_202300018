<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAdmin extends Model
{
    public function DetailData()
    {
        return $this->db->table('tbl_setting')->where('id','1')->get()->getRowArray();
    }

    public function UpdateData($data)
    {
        $this->db->table('tbl_setting')
        ->where('id',$data['id'])
        ->update($data);
    }
    public function tot_arsip()
    {
        return $this->db->table('tbl_arsip')->countAll();
    }
    

    public function tot_bagian()
    {
        return $this->db->table('tbl_bagian')->countAll();
    }

    public function tot_user()
    {
        return $this->db->table('tbl_user')->countAll();
    }

    public function tot_kategori()
    {
        return $this->db->table('tbl_kategori')->countAll();
    }
}