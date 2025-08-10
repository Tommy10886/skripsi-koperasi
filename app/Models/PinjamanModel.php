<?php

namespace App\Models;

use CodeIgniter\Model;

class PinjamanModel extends Model
{
    protected $table            = 'pinjaman';
    protected $primaryKey       = 'id';
    
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $allowedFields = [
        'id_anggota','pinjaman','tgl_pinjaman','jenis_pinjaman','jangka_waktu','status','pinjaman_disetujui','ttd_pemohon','ttd_pasangan','nama_pasangan'
    ];
    
    public function get_all_data()
    {  		  
      $this->select('pinjaman.*,anggota.nama,anggota.nomor_anggota');
      $this->join('anggota', 'pinjaman.id_anggota = anggota.id','LEFT');
      $data = $this->findAll();
		  return $data;
    }
    
    public function get_all_persetujuan($var1)
    {  		  
      $this->select('pinjaman.*,anggota.nama,anggota.nomor_anggota');
      $this->join('anggota', 'pinjaman.id_anggota = anggota.id','LEFT');
       $array = array('status' => $var1);
		  $data = $this->where($array)->findAll();
		  return $data;
    }
    
     
    public function get_by_id($id)
    {
      $this->select('pinjaman.*,anggota.nama,anggota.nomor_anggota,anggota.alamat,anggota.hp,anggota.jenis_usaha');
      $this->join('anggota', 'pinjaman.id_anggota = anggota.id','LEFT');
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
