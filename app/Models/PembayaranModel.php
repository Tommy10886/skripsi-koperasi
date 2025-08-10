<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table            = 'pembayaran';
    protected $primaryKey       = 'id';
    
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $allowedFields = [
        'id_anggota','pembayaran','tgl_pembayaran'
    ];
    
    public function get_all_data()
    {  		  
      $this->select('pembayaran.*,anggota.nama,anggota.nomor_anggota');
      $this->join('anggota', 'pembayaran.id_anggota = anggota.id','LEFT');
      $data = $this->findAll();
		  return $data;
    }
    public function get_by_id($id)
    {
      $this->select('pembayaran.*,anggota.nama,anggota.nomor_anggota');
      $this->join('anggota', 'pembayaran.id_anggota = anggota.id','LEFT');
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
