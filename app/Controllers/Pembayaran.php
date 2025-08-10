<?php

namespace App\Controllers;
use App\Models\PembayaranModel;
use App\Models\AnggotaModel;
use CodeIgniter\RESTful\ResourceController;

use App\Controllers\BaseController;

class Pembayaran extends BaseController
{
    protected $session;
	public function __construct(){

		$this->pembayaranModel = new PembayaranModel();
		$this->anggotaModel = new AnggotaModel();
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
        $this->uri = new \CodeIgniter\HTTP\URI(uri_string());
        $this->session->start();
        
	}
    public function index()
    {   
		$list_pembayaran = $this->pembayaranModel->get_all_data();
        $data =[
			'judul_page' => 'Pembayaran Pinjaman',
			'list_pembayaran' => $list_pembayaran,
			'sub_judul_page' => 'Table Data',
			'create' => '/create_pembayaran',
			'update' => '/update_pembayaran',
			'delete' => '/delete_pembayaran',
            'url' =>'pembayaran'
        ];
		return view('v_pembayaran',$data);
    }
    public function create()
    {   
		$list_anggota = $this->anggotaModel->get_all_data();
        $data =[
            'validation' => $this->validation,
			'list_anggota' => $list_anggota,
			'action' => '/create_action_pembayaran',
			'judul_page' => 'Pembayaran Pinjaman',
			'sub_judul_page' => 'Tambah',
			'back' => '/pembayaran',
            'id_anggota' => old('id_anggota'),
            'pembayaran' => old('pembayaran'),
            'tgl_pembayaran' =>date('Y-m-d'),
			'id' => '',
            'url' =>'pembayaran',
        ];
		return view('v_pembayaran_form',$data);
    }
    public function create_action()
    {   
        $data =[
            'id_anggota'        => $this->request->getPost('id_anggota'),
            'pembayaran'       => str_replace(".","",str_replace(",","",$this->request->getPost('pembayaran'))),
            'tgl_pembayaran'   => $this->request->getPost('tgl_pembayaran')
        ];
        $tambah = $this->pembayaranModel->create_data($data);
        
        $rowAnggota = $this->anggotaModel->get_by_id($this->request->getPost('id_anggota'));
        $data =[
            'saldo'       => $rowAnggota['saldo'] + str_replace(".","",str_replace(",","",$this->request->getPost('pembayaran'))),
        ];
        $update = $this->anggotaModel->update_data($data,$this->request->getPost('id_anggota'));
        if($tambah){	
            return redirect()->to(base_url().'/pembayaran');
        }
    }
    public function update($id)
    {   
		$list_anggota = $this->anggotaModel->get_all_data();
        $row = $this->pembayaranModel->get_by_id($id);
        $data =[
            'validation' => $this->validation,
			'list_anggota' => $list_anggota,
			'action' => '/update_action_pembayaran',
			'judul_page' => 'Pembayaran Pinjaman',
			'sub_judul_page' => 'Ubah',
			'back' => '/pembayaran',
			'id' => $id,
            'id_anggota' => $row['id_anggota'],
            'pembayaran' => $row['pembayaran'],
            'tgl_pembayaran' => $row['tgl_pembayaran'],
            'url' =>'pembayaran',
        ];
		return view('v_pembayaran_form',$data);
    }
    public function update_action()
    {           
        $id = $this->request->getPost('id');
        $row = $this->pembayaranModel->get_by_id($id);
        
        $pembayaran_before = $row['pembayaran'];
        $data =[
            'id_anggota'        => $this->request->getPost('id_anggota'),
            'pembayaran'       => str_replace(".","",str_replace(",","",$this->request->getPost('pembayaran'))),
            'tgl_pembayaran'   => $this->request->getPost('tgl_pembayaran')
        ];
        $update = $this->pembayaranModel->update_data($data,$id);
        
        $rowAnggota = $this->anggotaModel->get_by_id($this->request->getPost('id_anggota'));
        $data =[
            'saldo'       => $rowAnggota['saldo'] - $pembayaran_before + str_replace(".","",str_replace(",","",$this->request->getPost('pembayaran'))),
        ];
        $update = $this->anggotaModel->update_data($data,$this->request->getPost('id_anggota'));
        if($update){	
            return redirect()->to(base_url().'/pembayaran');
        }
    }
    
	public function delete($id)
	{
        $row = $this->pembayaranModel->get_by_id($id);
		$hapus = $this->pembayaranModel->delete_data($id);
        
        $rowAnggota = $this->anggotaModel->get_by_id($row['id_anggota']);
        $data =[
            'saldo'       => $rowAnggota['saldo'] - $row['pembayaran'],
        ];
        $update = $this->anggotaModel->update_data($data,$row['id_anggota']);
		if($hapus){	
			return redirect()->to(base_url().'/pembayaran');
		}

    }

}
