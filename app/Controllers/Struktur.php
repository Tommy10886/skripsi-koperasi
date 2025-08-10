<?php

namespace App\Controllers;
use App\Models\StrukturModel;
use CodeIgniter\RESTful\ResourceController;

use App\Controllers\BaseController;

class Struktur extends BaseController
{
    protected $session;
	public function __construct(){

		$this->strukturModel = new StrukturModel();
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
        $this->uri = new \CodeIgniter\HTTP\URI(uri_string());
        $this->session->start();
        
	}
    public function index()
    {   
		$list_struktur = $this->strukturModel->get_all_data();
        $data =[
			'judul_page' => 'Struktur',
			'list_struktur' => $list_struktur,
			'sub_judul_page' => 'Table Data',
			'create' => '/create_struktur',
			'update' => '/update_struktur',
			'delete' => '/delete_struktur',
            'url' =>'struktur'
        ];
		return view('v_struktur',$data);
    }
    public function create()
    {   
        $data =[
            'validation' => $this->validation,
			'action' => '/create_action_struktur',
			'judul_page' => 'Struktur',
			'sub_judul_page' => 'Tambah',
			'back' => '/struktur',
            'struktur_name' => old('struktur_name'),
			'id' => '',
            'url' =>'struktur',
        ];
		return view('v_struktur_form',$data);
    }
    public function create_action()
    {   
        $is_uniqe = 'is_unique[struktur.struktur_name]';
        if(!$this->validate($this->rules($is_uniqe))) {
            return redirect()->back()->withInput()->with('validation', $this->validation);
        }

        $data =[
            'struktur_name'       		=> $this->request->getPost('struktur_name')
        ];
        $tambah = $this->strukturModel->create_data($data);
        if($tambah){	
            return redirect()->to(base_url().'/struktur');
        }
    }
    public function update($id)
    {   
        $row = $this->strukturModel->get_by_id($id);
        $data =[
            'validation' => $this->validation,
			'action' => '/update_action_struktur',
			'judul_page' => 'Struktur',
			'sub_judul_page' => 'Ubah',
			'back' => '/struktur',
			'id' => $id,
            'struktur_name' => $row['struktur_name'],
            'url' =>'struktur',
        ];
		return view('v_struktur_form',$data);
    }
    public function update_action()
    {           
        $id = $this->request->getPost('id');
        $row = $this->strukturModel->get_by_id($id);
        if($this->request->getPost('struktur_name') == $row['struktur_name']){
            $is_uniqe = '';
        }else{
            $validation = $this->strukturModel->validation($this->request->getPost('struktur_name'));
            if(!empty($validation)){
                $is_uniqe = 'is_unique[struktur.struktur_name]';
            }else{
                $is_uniqe = '';
    
            }

        }
        if(!$this->validate($this->rules($is_uniqe))) {
            return redirect()->back()->withInput()->with('validation', $this->validation);
        }

        
        $data =[
            'struktur_name'       		=> $this->request->getPost('struktur_name')
        ];
        
        $update = $this->strukturModel->update_data($data,$id);
        if($update){	
            return redirect()->to(base_url().'/struktur');
        }
    }
    
	public function delete($id)
	{
		$hapus = $this->strukturModel->delete_data($id);
		if($hapus){	
			return redirect()->to(base_url().'/struktur');
		}

    }
    public function rules($is_uniqe)
    {
        $rules= [
            'struktur_name' => [
               'rules' => 'required|'.$is_uniqe,
               'errors' => [
                'required' => 'Nama Struktur Harus Diisi !!',
                'is_unique' => 'Nama Struktur sudah terdaftar !!',
               ]
            ]
        ];
        
        return $rules;
    }
}
