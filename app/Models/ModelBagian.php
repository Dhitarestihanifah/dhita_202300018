<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBagian extends Model
{
    public function AllData()
    {
        return $this->db->table('tbl_bagian')->get()->getResultArray();
    }
    public function InsertData($data)
    {
    $this->db->table('tbl_bagian')->insert($data);
    }

    public function UpdateData($data)
    {
        $this->db->table('tbl_bagian')
        ->where('id_bagian',$data['id_bagian'])
        ->update($data);
    }

    public function DeleteData($data)
    {
        $this->db->table('tbl_bagian')
        ->where('id_bagian',$data['id_bagian'])
        ->delete($data);
    }
}