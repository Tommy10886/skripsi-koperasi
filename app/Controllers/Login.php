<?php

namespace App\Controllers;
use App\Models\PenggunaModel;
use CodeIgniter\RESTful\ResourceController;
use App\Controllers\BaseController;

class Login extends BaseController
{
    
    protected $session;
	public function __construct(){
		$this->penggunaModel = new PenggunaModel();
	}

    public function index()
    {
        $data =[];
		return view('v_login',$data);
    }
    
    public function login()
    {   
        $cek_login = $this->penggunaModel->login($this->request->getPost('username'),hash('sha512', $this->request->getPost('password')));

        if(!empty($cek_login)){ 
            
            $data =[
				'status_login' 		=> 1,
			];
            $update = $this->penggunaModel->set_login($data,$cek_login[0]['id']);
			if($update){	
                $data =  [
                    'nama' => $cek_login[0]['nama'],
                    'user_name' => $cek_login[0]['user_name'],
                    'status_login' => $cek_login[0]['status_login'],
                    'id_pengguna' => $cek_login[0]['id'],
                    'id_struktur' => $cek_login[0]['id_struktur'],

                ];
                // print_r($data);die;
                $this->session->set($data);
                if($cek_login[0]['id_struktur'] == 1 ||$cek_login[0]['id_struktur'] == 2 ||$cek_login[0]['id_struktur'] == 3){
                    return redirect()->to(base_url().'/persetujuan');

                }else{
                    return redirect()->to(base_url().'/pinjaman');

                }
                
            }else{
                return redirect()->to(base_url().'/');
            }
        }else{
            return redirect()->to(base_url().'/');

        }
    }
    public function logout()
	{
        $this->session->destroy();
        return redirect()->to(base_url().'/');
    }
    
}

