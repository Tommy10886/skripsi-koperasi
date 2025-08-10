<?php

namespace App\Controllers;
use App\Models\AnggotaModel;
use App\Models\StrukturModel;
use CodeIgniter\RESTful\ResourceController;

use App\Controllers\BaseController;
use Dompdf\Dompdf;

class Anggota extends BaseController
{
    protected $session;
	public function __construct(){

		$this->anggotaModel = new AnggotaModel();
		$this->strukturModel = new StrukturModel();
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
        $this->uri = new \CodeIgniter\HTTP\URI(uri_string());
        $this->session->start();
        
	}
    public function index()
    {   
		$list_anggota = $this->anggotaModel->get_all_data();
        $data =[
			'judul_page' => 'Anggota',
			'list_anggota' => $list_anggota,
			'sub_judul_page' => 'Table Data',
			'create' => '/create_anggota',
			'update' => '/update_anggota',
			'delete' => '/delete_anggota',
            'url' =>'anggota'
        ];
		return view('v_anggota',$data);
    }
    public function create()
    {   
		$list_struktur = $this->strukturModel->get_all_data();
        $data =[
            'validation' => $this->validation,
			'list_struktur' => $list_struktur,
			'action' => '/create_action_anggota',
			'judul_page' => 'Anggota',
			'sub_judul_page' => 'Tambah',
			'back' => '/anggota',
            'nomor_anggota' => old('nomor_anggota'),
            'nama' => old('nama'),
            'hp' => old('hp'),
            'saldo' => old('saldo'),
            'id_struktur' => old('id_struktur'),
            'jenis_usaha' => old('jenis_usaha'),
			'id' => '',
            'url' =>'anggota',
        ];
		return view('v_anggota_form',$data);
    }
    public function create_action()
    {   
        $is_uniqe = 'is_unique[anggota.nomor_anggota]';
        if(!$this->validate($this->rules($is_uniqe))) {
            return redirect()->back()->withInput()->with('validation', $this->validation);
        }

        $data =[
            'nomor_anggota' => $this->request->getPost('nomor_anggota'),
            'nama'       	=> $this->request->getPost('nama'),
            'hp'       		=> $this->request->getPost('hp'),
            'id_struktur'   => $this->request->getPost('id_struktur'),
            'jenis_usaha'   => $this->request->getPost('jenis_usaha'),
            'saldo'        => str_replace(".","",str_replace(",","",$this->request->getPost('saldo'))),
        ];
        $tambah = $this->anggotaModel->create_data($data);
        if($tambah){	
            return redirect()->to(base_url().'/anggota');
        }
    }
    public function update($id)
    {   
		$list_struktur = $this->strukturModel->get_all_data();
        $row = $this->anggotaModel->get_by_id($id);
        $data =[
            'validation' => $this->validation,
			'list_struktur' => $list_struktur,
			'action' => '/update_action_anggota',
			'judul_page' => 'Anggota',
			'sub_judul_page' => 'Ubah',
			'back' => '/anggota',
			'id' => $id,
            'nomor_anggota' => $row['nomor_anggota'],
            'nama' => $row['nama'],
            'hp' => $row['hp'],
            'id_struktur' => $row['id_struktur'],
            'saldo' => $row['saldo'],
            'jenis_usaha' => $row['jenis_usaha'],
            'url' =>'anggota',
        ];
		return view('v_anggota_form',$data);
    }
    public function update_action()
    {           
        $id = $this->request->getPost('id');
        $row = $this->anggotaModel->get_by_id($id);
        if($this->request->getPost('nomor_anggota') == $row['nomor_anggota']){
            $is_uniqe = '';
        }else{
            $validation = $this->anggotaModel->validation($this->request->getPost('nomor_anggota'));
            if(!empty($validation)){
                $is_uniqe = 'is_unique[anggota.nomor_anggota]';
            }else{
                $is_uniqe = '';
    
            }

        }
        if(!$this->validate($this->rules($is_uniqe))) {
            return redirect()->back()->withInput()->with('validation', $this->validation);
        }

        $data =[
            'nomor_anggota' => $this->request->getPost('nomor_anggota'),
            'nama'       	=> $this->request->getPost('nama'),
            'hp'       		=> $this->request->getPost('hp'),
            'id_struktur'   => $this->request->getPost('id_struktur'),
            'jenis_usaha'   => $this->request->getPost('jenis_usaha'),
            'saldo'        => str_replace(".","",str_replace(",","",$this->request->getPost('saldo'))),
        ];
        
        $update = $this->anggotaModel->update_data($data,$id);
        if($update){	
            return redirect()->to(base_url().'/anggota');
        }
    }
    
	public function delete($id)
	{
		$hapus = $this->anggotaModel->delete_data($id);
		if($hapus){	
			return redirect()->to(base_url().'/anggota');
		}

    }
    public function rules($is_uniqe)
    {
        $rules= [
            'nomor_anggota' => [
               'rules' => 'required|'.$is_uniqe,
               'errors' => [
                'required' => 'Nomor Anggota Harus Diisi !!',
                'is_unique' => 'Nomor Anggota sudah terdaftar !!',
               ]
            ],
               
            'nama' => [
               'rules' => 'required',
               'errors' => [
                'required' => 'Nama Anggota Harus Diisi !!',
               ]
            ],
               
            'hp' => [
               'rules' => 'required',
               'errors' => [
                'required' => 'Hp Anggota Harus Diisi !!',
               ]
            ],
               
            'jenis_usaha' => [
               'rules' => 'required',
               'errors' => [
                'required' => 'Jenis Usaha Anggota Harus Diisi !!',
               ]
            ]
        ];
        
        return $rules;
    }
    
    public function laporan(){
		$list_anggota = $this->anggotaModel->get_all_data();
        $b64image = base64_encode(file_get_contents('assets/images/logo.png'));
        

        $data =[
			'logo' => $b64image,
			'list_anggota' => $list_anggota
        ];
        $filename = 'Laporan Pinjaman Anggota sampai dengan tanggal '.date('d F Y');

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        // load HTML content
        $dompdf->loadHtml(view('laporan_pinjaman',$data));

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'potrait');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename, array("Attachment" => false));  
        exit();
    }
    
    public function rincian($id_anggota)
    {   
		$list_anggota = $this->anggotaModel->get_all_data();
		$list_rincian_anggota = $this->anggotaModel->rincian($id_anggota);
        
        $row = $this->anggotaModel->get_by_id($id_anggota);
        // print_r($list_rincian_anggota);die;
        $data =[
			'judul_page' => 'Rincian Simpanan dan Pinjaman ' .$row['nama'],
			'list_rincian_anggota' => $list_rincian_anggota,
			'list_anggota' => $list_anggota,
            'id_anggota'=>$id_anggota,
			'sub_judul_page' => 'Table Data',
            'url' =>'anggota_rincian'
        ];
		return view('v_anggota_rincian',$data);
    }
    
    
    public function laporan_rincian($id_anggota){
		$list_rincian_anggota = $this->anggotaModel->rincian($id_anggota);
        
        $row = $this->anggotaModel->get_by_id($id_anggota);
        $b64image = base64_encode(file_get_contents('assets/images/logo.png'));
        

        $data =[
			'logo' => $b64image,
			'list_rincian_anggota' => $list_rincian_anggota
        ];
        $filename = 'Laporan Rincian Saldo Anggota '.$row['nama'];

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        // load HTML content
        $dompdf->loadHtml(view('laporan_rincian_anggota',$data));

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'potrait');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename, array("Attachment" => false));  
        exit();
    }
}
