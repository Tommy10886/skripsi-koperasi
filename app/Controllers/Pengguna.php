<?php

namespace App\Controllers;
use App\Models\PenggunaModel;
use App\Models\StrukturModel;
use CodeIgniter\RESTful\ResourceController;

use App\Controllers\BaseController;

class Pengguna extends BaseController
{
    protected $session;
	public function __construct(){

		$this->penggunaModel = new PenggunaModel();
		$this->strukturModel = new StrukturModel();
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
        $this->uri = new \CodeIgniter\HTTP\URI(uri_string());
        $this->session->start();
	}
    public function index()
    {   
		$list_pengguna = $this->penggunaModel->get_all_data();
        $data =[
			'judul_page' => 'Pengguna',
			'list_pengguna' => $list_pengguna,
			'sub_judul_page' => 'Table Data',
			'create' => '/create_pengguna',
			'update' => '/update_pengguna',
			'delete' => '/delete_pengguna',
            'url' =>'pengguna'
        ];
		return view('v_pengguna',$data);
    }
    public function create()
    {   
        $list_struktur = $this->strukturModel->get_all_data();
        
        $data =[
            'validation' => $this->validation,
			'action' => '/create_action_pengguna',
			'list_struktur' => $list_struktur,
			'judul_page' => 'Pengguna',
			'sub_judul_page' => 'Tambah',
			'back' => '/pengguna',
            'nama' => old('nama'),
            'user_name' => old('user_name'),
            'password' => old('password'),
            'id_struktur' => old('id_struktur'),
            'ttd' => old('ttd'),
			'id' => '',
            'url' =>'pengguna',
        ];
		return view('v_pengguna_form',$data);
    }
    public function create_action()
    {   
        $is_uniqe = 'is_unique[pengguna.user_name]';
        if(!$this->validate($this->rules($is_uniqe))) {
            return redirect()->back()->withInput()->with('validation', $this->validation);
        }

        $data =[
            'id_struktur'       => $this->request->getPost('id_struktur'),
            'user_name'         => $this->request->getPost('user_name'),
            'password' 		    => hash('sha512', $this->request->getPost('password')),
            'nama'       		=> $this->request->getPost('nama')
        ];
        
        $nama1 = $this->request->getPost('nama');
        $random = $this->randomString(10);
         $nama_ttd = $nama1.$random;
        if ($this->isValidBase64Image($this->request->getPost('ttd1'))) {
            $this->simpanTTD($this->request->getPost('ttd1'), WRITEPATH . "../assets/images/ttd/ttd_{$nama_ttd}.png");
            $data['ttd'] = 'ttd_' . $nama1 . $random . '.png';
        }     
        $tambah = $this->penggunaModel->create_data($data);
        if($tambah){	
            return redirect()->to(base_url().'/pengguna');
        }
    }
    public function update($id)
    {   
        $row = $this->penggunaModel->get_by_id($id);
        $list_struktur = $this->strukturModel->get_all_data();
        $data =[
            'validation' => $this->validation,
            'list_struktur' => $list_struktur,
			'action' => '/update_action_pengguna',
			'judul_page' => 'Pengguna',
			'sub_judul_page' => 'Ubah',
			'back' => '/pengguna',
			'id' => $id,
            'nama' => $row['nama'],
            'user_name' => $row['user_name'],
            'password' => $row['password'],
            'id_struktur' => $row['id_struktur'],
            'ttd' => $row['ttd'],
            'url' =>'pengguna',
        ];
		return view('v_pengguna_form',$data);
    }
    public function update_action()
    {           
        $id = $this->request->getPost('id');
        $row = $this->penggunaModel->get_by_id($id);
        if($this->request->getPost('user_name') == $row['user_name']){
            $is_uniqe = '';
        }else{
            $validation = $this->penggunaModel->validation($this->request->getPost('user_name'));
            if(!empty($validation)){
                $is_uniqe = 'is_unique[pengguna.user_name]';
            }else{
                $is_uniqe = '';
    
            }

        }
        if(!$this->validate($this->rules($is_uniqe))) {
            return redirect()->back()->withInput()->with('validation', $this->validation);
        }

        if($row['password'] == $this->request->getPost('password')){
            $data =[
                'id_struktur'       => $this->request->getPost('id_struktur'),
                'user_name'         => $this->request->getPost('user_name'),
                'nama'       		=> $this->request->getPost('nama')
            ];
        }else{
            $data =[
                'id_struktur'       => $this->request->getPost('id_struktur'),
                'user_name'         => $this->request->getPost('user_name'),
                'password' 		    => hash('sha512', $this->request->getPost('password')),
                'nama'       		=> $this->request->getPost('nama')
            ];
        }
        $nama1 = $this->request->getPost('nama');
        $random = $this->randomString(10);
         $nama_ttd = $nama1.$random;
        if ($this->isValidBase64Image($this->request->getPost('ttd1'))) {
            $this->simpanTTD($this->request->getPost('ttd1'), WRITEPATH . "../assets/images/ttd/ttd_{$nama_ttd}.png");
            $data['ttd'] = 'ttd_' . $nama1 . $random . '.png';
        }     
        $ubah = $this->penggunaModel->update_data($data,$id);
        if($ubah){	
            return redirect()->to(base_url().'/pengguna');
        }
    }
    
	public function delete($id)
	{
		$hapus = $this->penggunaModel->delete_data($id);
		if($hapus){	
			return redirect()->to(base_url().'/pengguna');
		}

    }
    public function rules($is_uniqe)
    {
        $rules= [
            'user_name' => [
               'rules' => 'required|'.$is_uniqe,
               'errors' => [
                'required' => 'User Name Harus Diisi !!',
                'is_unique' => 'User Name sudah terdaftar !!',
               ]
            ],
            'nama' => [
               'rules' => 'required',
               'errors' => [
                'required' => 'Nama Pengguna Harus Diisi !!',
               ]
            ],
            'password' => [
               'rules' => 'required',
               'errors' => [
                'required' => 'Password Harus Diisi !!',
               ]
            ],
            'repassword' => [
               'rules' => 'required|matches[password]',
               'errors' => [
                'required' => 'Masukan ulang Password Harus Diisi !!',
                'matches' => 'Pasword tidak sama !!',
               ]
            ]
        ];
        
        return $rules;
    }
    
    private function simpanTTD($dataURL, $path)
    {
        $img = str_replace('data:image/png;base64,', '', $dataURL);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        file_put_contents($path, $data);
        
    }
    function randomString($length = 10) {
        return substr(str_shuffle(str_repeat(
            '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', 
            $length
        )), 0, $length);
    }
    function isValidBase64Image($base64) {
        // Harus diawali dengan prefix dan punya isi sesudahnya
         if (!is_string($base64)) return false;

        $prefix = 'data:image/png;base64,';

        if (strpos($base64, $prefix) !== 0) {
            return false;
        }

        $data = base64_decode(substr($base64, strlen($prefix)), true);

        // valid dan ukurannya minimal 1KB (1024 byte)
        return $data !== false && strlen($data) > 1024;
    }
}
