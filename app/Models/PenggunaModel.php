<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{
    protected $table            = 'pengguna';
    protected $primaryKey       = 'id';
    
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $allowedFields = [
        'nama', 'user_name', 'password','id_struktur','status_login','ttd'
    ];
    
    public function get_all_data()
    {  
		  $data = $this->findAll();
		  return $data;
    }
    public function validation($var1)
    {
      $array = array('user_name' => $var1);
		  $data = $this->where($array)->findAll();
		  return $data;
    }
    public function get_by_id($id)
    {
		  $data = $this->find($id);
		  return $data;
    }
    
    public function login($var1,$var2)
    {
      $array = array('user_name' => $var1,'password' => $var2);
		  $data = $this->where($array)->find();
		  return $data;
    }
    public function struktur($id_struktur)
    {
      $array = array('id_struktur' => $id_struktur);
		  $data = $this->where($array)->find();
		  return $data;
    }
    
    public function set_login($data,$id)
    {
      return $this->update(['id' => $id],$data);
    }
    public function create_data($data)
    {
      return $this->insert($data);
    } 
    public function update_data($data,$id)
    {
      return $this->update(['id' => $id],$data);
    
    } 
    public function delete_data($id)
    {
      return $this->delete(['id' => $id]);
    } 
}
