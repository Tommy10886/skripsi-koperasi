<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotaModel extends Model
{
    protected $table            = 'anggota';
    protected $primaryKey       = 'id';
    
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $allowedFields = [
        'nomor_anggota','nama','hp','id_struktur','saldo','jenis_usaha','alamat'
    ];
    
    public function get_all_data()
    {  		  
      $this->select('anggota.*,struktur.struktur_name');
      $this->join('struktur', 'anggota.id_struktur = struktur.id','LEFT');
      $data = $this->findAll();
		  return $data;
    }
    public function get_by_id($id)
    {
      $this->select('anggota.*,struktur.struktur_name');
      $this->join('struktur', 'anggota.id_struktur = struktur.id','LEFT');
		  $data = $this->find($id);
		  return $data;
    }
    public function validation($var1)
    {
      $array = array('nomor_anggota' => $var1);
		  $data = $this->where($array)->findAll();
		  return $data;
    }
    
    public function rincian($id_anggota)
    {  		  
      $query = $this->query("
            (
              SELECT 
                p.tgl_pembayaran AS tgl, 
                p.pembayaran AS nilai, 
                a.nama, 
                0 AS kode
              FROM pembayaran p
              LEFT JOIN anggota a ON p.id_anggota = a.id
              WHERE 
                p.deleted_at IS NULL 
                AND p.id_anggota = $id_anggota
              GROUP BY p.tgl_pembayaran, p.id
            )

            UNION ALL
            (SELECT 
                p.tgl_simpanan AS tgl, 
                p.simpanan AS nilai, 
                a.nama, 
                0 AS kode
              FROM simpanan p
              LEFT JOIN anggota a ON p.id_anggota = a.id
              WHERE 
                p.deleted_at IS NULL 
                AND p.id_anggota = $id_anggota
              GROUP BY p.tgl_simpanan, p.id
            )

            UNION ALL

            (
              SELECT 
                s.tgl_pinjaman AS tgl, 
                s.pinjaman AS nilai, 
                a.nama, 
                1 AS kode
              FROM pinjaman s
              LEFT JOIN anggota a ON s.id_anggota = a.id
              WHERE 
                s.deleted_at IS NULL 
                AND s.id_anggota = $id_anggota
              GROUP BY s.tgl_pinjaman,s.id
            )

            ORDER BY tgl
            ");
      return $row = $query->getResult();
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
