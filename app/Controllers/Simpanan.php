<?php

namespace App\Controllers;
use App\Models\SimpananModel;
use App\Models\AnggotaModel;
use CodeIgniter\RESTful\ResourceController;

use App\Controllers\BaseController;

class Simpanan extends BaseController
{
    protected $session;
	public function __construct(){

		$this->simpananModel = new SimpananModel();
		$this->anggotaModel = new AnggotaModel();
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
        $this->uri = new \CodeIgniter\HTTP\URI(uri_string());
        $this->session->start();
        
	}
    public function index()
    {   
		$list_simpanan = $this->simpananModel->get_all_data();
        $data =[
			'judul_page' => 'Simpanan / Simpanan Pinjaman',
			'list_simpanan' => $list_simpanan,
			'sub_judul_page' => 'Table Data',
			'create' => '/create_simpanan',
			'update' => '/update_simpanan',
			'delete' => '/delete_simpanan',
            'url' =>'simpanan'
        ];
		return view('v_simpanan',$data);
    }
    public function create()
    {   
		$list_anggota = $this->anggotaModel->get_all_data();
        $data =[
            'validation' => $this->validation,
			'list_anggota' => $list_anggota,
			'action' => '/create_action_simpanan',
			'judul_page' => 'Simpanan',
			'sub_judul_page' => 'Tambah',
			'back' => '/simpanan',
            'id_anggota' => old('id_anggota'),
            'simpanan' => old('simpanan'),
            'tgl_simpanan' =>date('Y-m-d'),
			'id' => '',
            'url' =>'simpanan',
        ];
		return view('v_simpanan_form',$data);
    }
    public function create_action()
    {   
        $data =[
            'id_anggota'        => $this->request->getPost('id_anggota'),
            'simpanan'       => str_replace(".","",str_replace(",","",$this->request->getPost('simpanan'))),
            'tgl_simpanan'   => $this->request->getPost('tgl_simpanan')
        ];
        $tambah = $this->simpananModel->create_data($data);
        
        $rowAnggota = $this->anggotaModel->get_by_id($this->request->getPost('id_anggota'));
        $data =[
            'saldo'       => $rowAnggota['saldo'] + str_replace(".","",str_replace(",","",$this->request->getPost('simpanan'))),
        ];
        $update = $this->anggotaModel->update_data($data,$this->request->getPost('id_anggota'));
        if($tambah){	
            return redirect()->to(base_url().'/simpanan');
        }
    }
    public function update($id)
    {   
		$list_anggota = $this->anggotaModel->get_all_data();
        $row = $this->simpananModel->get_by_id($id);
        $data =[
            'validation' => $this->validation,
			'list_anggota' => $list_anggota,
			'action' => '/update_action_simpanan',
			'judul_page' => 'Simpanan',
			'sub_judul_page' => 'Ubah',
			'back' => '/simpanan',
			'id' => $id,
            'id_anggota' => $row['id_anggota'],
            'simpanan' => $row['simpanan'],
            'tgl_simpanan' => $row['tgl_simpanan'],
            'url' =>'simpanan',
        ];
		return view('v_simpanan_form',$data);
    }
    public function update_action()
    {           
        $id = $this->request->getPost('id');
        $row = $this->simpananModel->get_by_id($id);
        
        $simpanan_before = $row['simpanan'];
        $data =[
            'id_anggota'        => $this->request->getPost('id_anggota'),
            'simpanan'       => str_replace(".","",str_replace(",","",$this->request->getPost('simpanan'))),
            'tgl_simpanan'   => $this->request->getPost('tgl_simpanan')
        ];
        $update = $this->simpananModel->update_data($data,$id);
        
        $rowAnggota = $this->anggotaModel->get_by_id($this->request->getPost('id_anggota'));
        $data =[
            'saldo'       => $rowAnggota['saldo'] - $simpanan_before + str_replace(".","",str_replace(",","",$this->request->getPost('simpanan'))),
        ];
        $update = $this->anggotaModel->update_data($data,$this->request->getPost('id_anggota'));
        if($update){	
            return redirect()->to(base_url().'/simpanan');
        }
    }
    
	public function delete($id)
	{
        $row = $this->simpananModel->get_by_id($id);
		$hapus = $this->simpananModel->delete_data($id);
        
        $rowAnggota = $this->anggotaModel->get_by_id($row['id_anggota']);
        $data =[
            'saldo'       => $rowAnggota['saldo'] - $row['simpanan'],
        ];
        $update = $this->anggotaModel->update_data($data,$row['id_anggota']);
		if($hapus){	
			return redirect()->to(base_url().'/simpanan');
		}

    }

}
