<?php

namespace App\Controllers;
use App\Models\PinjamanModel;
use App\Models\AnggotaModel;
use App\Models\PenggunaModel;
use CodeIgniter\RESTful\ResourceController;

use App\Controllers\BaseController;
use Dompdf\Dompdf;

class Pinjaman extends BaseController
{
    protected $session;
	public function __construct(){

		$this->pinjamanModel = new PinjamanModel();
		$this->anggotaModel = new AnggotaModel();
		$this->penggunaModel = new PenggunaModel();
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
        $this->uri = new \CodeIgniter\HTTP\URI(uri_string());
        $this->session->start();
        
	}
    public function persetujuan()
    {   
    
        if($this->session->get("id_struktur") == 1){
            $filter = 'Ketua';
        }else if($this->session->get("id_struktur") == 2){
            $filter = 'Sekretaris';
        }else if($this->session->get("id_struktur") == 3){
            $filter = 'Bendahara';
        }else{
            $filter = 'xxxxxxxx';
            
        }
		$list_pinjaman = $this->pinjamanModel->get_all_persetujuan( $filter);
        $data =[
			'judul_page' => 'Persetuajuan Pinjaman',
			'list_pinjaman' => $list_pinjaman,
			'sub_judul_page' => 'Table Data',
			'create' => '/create_pinjaman',
			'update' => '/update_pinjaman',
			'delete' => '/delete_pinjaman',
            'url' =>'pinjaman'
        ];
		return view('v_persetujuan',$data);
    }
    public function index()
    {   
		$list_pinjaman = $this->pinjamanModel->get_all_data();
        $data =[
			'judul_page' => 'Pinjaman',
			'list_pinjaman' => $list_pinjaman,
			'sub_judul_page' => 'Table Data',
			'create' => '/create_pinjaman',
			'update' => '/update_pinjaman',
			'delete' => '/delete_pinjaman',
            'url' =>'pinjaman'
        ];
		return view('v_pinjaman',$data);
    }
    public function create()
    {   
		$list_anggota = $this->anggotaModel->get_all_data();
        $data =[
            'validation' => $this->validation,
			'list_anggota' => $list_anggota,
			'action' => '/create_action_pinjaman',
			'judul_page' => 'Pinjaman',
			'sub_judul_page' => 'Tambah',
			'back' => '/pinjaman',
            'id_anggota' => old('id_anggota'),
            'pinjaman' => old('pinjaman'),
            'tgl_pinjaman' => date('Y-m-d'),
            'jangka_waktu' => old('jangka_waktu'),
            'jenis_pinjaman' => old('jenis_pinjaman'),
            'nama_pasangan' => old('nama_pasangan'),
            'ttd_pemohon' => old('ttd_pemohon'),
            'ttd_pasangan' => old('ttd_pasangan'),
			'id' => '',
            'url' =>'pinjaman',
        ];
		return view('v_pinjaman_form',$data);
    }
    public function create_action()
    {   
         helper('filesystem');
		$anggota = $this->anggotaModel->get_by_id($this->request->getPost('id_anggota'));
        $nama1 = $anggota['nama'];
        $nama2 = $this->request->getPost('nama2');
        $random = $this->randomString(10);
        // Simpan TTD sebagai PNG
        
        $data =[
            'id_anggota'     => $this->request->getPost('id_anggota'),
            'jangka_waktu'   => $this->request->getPost('jangka_waktu'),
            'jenis_pinjaman' => $this->request->getPost('jenis_pinjaman'),
            'pinjaman'       => str_replace(".","",str_replace(",","",$this->request->getPost('pinjaman'))),
            'tgl_pinjaman'   => $this->request->getPost('tgl_pinjaman'),
            'nama_pasangan'   =>$nama2
        ];
        $nama_ttd = $nama1.$random;
        $nama_ttd2 = $nama2.$random;
        if ($this->isValidBase64Image($this->request->getPost('ttd1'))) {
            $this->simpanTTD($this->request->getPost('ttd1'), WRITEPATH . "../public/assets/images/ttd/ttd_{$nama_ttd}.png");
            $data['ttd_pemohon'] = 'ttd_' . $nama1 . $random . '.png';
        }     
        if ($this->isValidBase64Image($this->request->getPost('ttd2'))) {
            $this->simpanTTD($this->request->getPost('ttd2'), WRITEPATH . "../public/assets/images/ttd/ttd_{$nama_ttd2}.png");
            $data['ttd_pasangan'] = 'ttd_' . $nama2 . $random . '.png';
        }

        $tambah = $this->pinjamanModel->create_data($data);
        if($tambah){	
            return redirect()->to(base_url().'/pinjaman');
        }
    }
    public function update($id)
    {   
		$list_anggota = $this->anggotaModel->get_all_data();
        $row = $this->pinjamanModel->get_by_id($id);
        $data =[
            'validation' => $this->validation,
			'list_anggota' => $list_anggota,
			'action' => '/update_action_pinjaman',
			'judul_page' => 'Pinjaman',
			'sub_judul_page' => 'Ubah',
			'back' => '/pinjaman',
			'id' => $id,
            'id_anggota' => $row['id_anggota'],
            'pinjaman' => $row['pinjaman'],
            'tgl_pinjaman' => $row['tgl_pinjaman'],
            'jangka_waktu' => $row['jangka_waktu'],
            'jenis_pinjaman' => $row['jenis_pinjaman'],
            'nama_pasangan' => $row['nama_pasangan'],
            'ttd_pemohon' => $row['ttd_pemohon'],
            'ttd_pasangan' => $row['ttd_pasangan'],
            'url' =>'pinjaman',
        ];
		return view('v_pinjaman_form',$data);
    }
    public function update_action()
    {           
        $id = $this->request->getPost('id');
        $row = $this->pinjamanModel->get_by_id($id);
        
        $pinjaman_before = $row['pinjaman'];
        helper('filesystem');
		$anggota = $this->anggotaModel->get_by_id($this->request->getPost('id_anggota'));
        $nama1 = $anggota['nama'];
        $nama2 = $this->request->getPost('nama2');
        $random = $this->randomString(10);
        $data =[
            'id_anggota'     => $this->request->getPost('id_anggota'),
            'pinjaman'       => str_replace(".","",str_replace(",","",$this->request->getPost('pinjaman'))),
            'tgl_pinjaman'   => $this->request->getPost('tgl_pinjaman'),
            'jangka_waktu'   => $this->request->getPost('jangka_waktu'),
            'jenis_pinjaman' => $this->request->getPost('jenis_pinjaman'),
            'nama_pasangan'   =>$nama2
        ];
        // Simpan TTD sebagai PNG
        $nama_ttd = $nama1.$random;
        $nama_ttd2 = $nama2.$random;
        if ($this->isValidBase64Image($this->request->getPost('ttd1'))) {
            $this->simpanTTD($this->request->getPost('ttd1'), WRITEPATH . "../public/assets/images/ttd/ttd_{$nama_ttd}.png");
            $data['ttd_pemohon'] = 'ttd_' . $nama1 . $random . '.png';
        }     
        if ($this->isValidBase64Image($this->request->getPost('ttd2'))) {
            $this->simpanTTD($this->request->getPost('ttd2'), WRITEPATH . "../public/assets/images/ttd/ttd_{$nama_ttd2}.png");
            $data['ttd_pasangan'] = 'ttd_' . $nama2 . $random . '.png';
        }
        $update = $this->pinjamanModel->update_data($data,$id);
        
        if($update){	
            return redirect()->to(base_url().'/pinjaman');
        }
    }
    
	public function delete($id)
	{
        $row = $this->pinjamanModel->get_by_id($id);
		$hapus = $this->pinjamanModel->delete_data($id);
        
        $rowAnggota = $this->anggotaModel->get_by_id($row['id_anggota']);
        $data =[
            'saldo'       => $rowAnggota['saldo'] + $row['pinjaman'],
        ];
        $update = $this->anggotaModel->update_data($data,$row['id_anggota']);
		if($hapus){	
			return redirect()->to(base_url().'/pinjaman');
		}

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
    
    public function cetak($id)
    {           
        $row = $this->pinjamanModel->get_by_id($id);
        $ttd1 = base64_encode(file_get_contents('public/assets/images/ttd/'.$row['ttd_pemohon']));
        $ttd2 = base64_encode(file_get_contents('public/assets/images/ttd/'.$row['ttd_pasangan']));
        $ketua = $this->penggunaModel->struktur(1);
        $sekretaris = $this->penggunaModel->struktur(2);
        $bendahara = $this->penggunaModel->struktur(3);
        
        $ttd_k = base64_encode(file_get_contents('public/assets/images/ttd/'.$ketua[0]['ttd']));
        $ttd_s = base64_encode(file_get_contents('public/assets/images/ttd/'.$sekretaris[0]['ttd']));
        $ttd_b = base64_encode(file_get_contents('public/assets/images/ttd/'.$bendahara[0]['ttd']));
        $data =[
            'data' => $row,
            'ttd1' => $ttd1,
            'ttd2' => $ttd2,
            'ttd_k' => $ttd_k,
            'ttd_s' => $ttd_s,
            'ttd_b' => $ttd_b,
            'ketua' => $ketua[0],
            'sekretaris' => $sekretaris[0],
            'bendahara' => $bendahara[0],
        ];
        $filename = 'Pengajuan Pinjaman';

        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('v_cetak',$data));
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        $dompdf->stream($filename, array("Attachment" => false));  
        exit();
    
    }
    public function setuju($id)
    {           
        $row = $this->pinjamanModel->get_by_id($id);
        if($row['status'] == 'Bendahara'){
            $status = "Sekretaris";
             $data =[
                'status'   =>$status
            ];
        
            $update = $this->pinjamanModel->update_data($data,$id);
        }else if($row['status'] == 'Sekretaris'){
            $status = "Ketua";
             $data =[
                'status'   =>$status
            ];
        
            $update = $this->pinjamanModel->update_data($data,$id);
        }else if($row['status'] == 'Ketua'){
            $status = "Disetujui";
            
        
            $rowAnggota = $this->anggotaModel->get_by_id($row['id_anggota']);
            $data =[
                'saldo'       => $rowAnggota['saldo'] -$row['pinjaman'],
            ];
            $update = $this->anggotaModel->update_data($data,$row['id_anggota']);
            
             $data =[
                'status'   =>$status,
                'pinjaman_disetujui'   =>$row['pinjaman']
            ];
        
            $update = $this->pinjamanModel->update_data($data,$id);
        }else if($row['status'] == 'Disetujui'){
			return redirect()->to(base_url().'/pinjaman');
        }
        
       
        
        
        if($update){	
            return redirect()->to(base_url().'/persetujuan');
        }
    }
    public function tolak($id)
    {           
        $row = $this->pinjamanModel->get_by_id($id);
        
        
        $data =[
            'status'   =>'Ditolak'
        ];
      
        $update = $this->pinjamanModel->update_data($data,$id);
        
        
        if($update){	
            return redirect()->to(base_url().'/persetujuan');
        }
    }
}
