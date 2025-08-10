<?php

namespace App\Models;

use CodeIgniter\Model;

class StrukturModel extends Model
{
    protected $table            = 'struktur';
    protected $primaryKey       = 'id';
    
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $allowedFields = [
        'struktur_name'
    ];
    
    public function get_all_data()
    {  		  
      $data = $this->findAll();
		  return $data;
    }
    public function get_by_id($id)
    {
		  $data = $this->find($id);
		  return $data;
    }
    public function validation($var1)
    {
      $array = array('struktur_name' => $var1);
		  $data = $this->where($array)->findAll();
		  return $data;
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
