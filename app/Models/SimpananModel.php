<?php

namespace App\Models;

use CodeIgniter\Model;

class SimpananModel extends Model
{
    protected $table            = 'simpanan';
    protected $primaryKey       = 'id';
    
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $allowedFields = [
        'id_anggota','simpanan','tgl_simpanan'
    ];
    
    public function get_all_data()
    {  		  
      $this->select('simpanan.*,anggota.nama,anggota.nomor_anggota');
      $this->join('anggota', 'simpanan.id_anggota = anggota.id','LEFT');
      $data = $this->findAll();
		  return $data;
    }
    public function get_by_id($id)
    {
      $this->select('simpanan.*,anggota.nama,anggota.nomor_anggota');
      $this->join('anggota', 'simpanan.id_anggota = anggota.id','LEFT');
		  $data = $this->find($id);
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
