<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUser extends Model
{
    public function AllData()
    {
        return $this->db->table('tbl_user')
        ->join('tbl_bagian','tbl_bagian.id_bagian = tbl_user.id_bagian', 'left')
        ->orderBy('id_user','DESC')
        ->get()->getResultArray();
    }

    public function detaildata($id_user)
    {
        return $this->db->table('tbl_user')
        ->join('tbl_bagian','tbl_bagian.id_bagian = tbl_user.id_bagian', 'left')
        ->where('id_user',$id_user)
        ->get()
        ->getRowArray();
    }
    public function InsertData($data)
    {
    $this->db->table('tbl_user')
    ->insert($data);
    }

    public function UpdateData($data)
    {
        $this->db->table('tbl_user')
        ->where('id_user',$data['id_user'])
        ->update($data);
    }

    public function DeleteData($data)
    {
        $this->db->table('tbl_user')
        ->where('id_user',$data['id_user'])
        ->delete($data);
    }

    public function LoginUser($email,$password)
    {
        return $this->db->table('tbl_user')
        ->where([
            'email' => $email,
            'password' => $password,
        ])->get()->getRowArray();
    }
}