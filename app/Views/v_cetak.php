<?php
$path = FCPATH . 'assets/images/logo.png';
$type = pathinfo($path, PATHINFO_EXTENSION);
$data_base64 = file_get_contents($path);
$logo = 'data:image/' . $type . ';base64,' . base64_encode($data_base64);
?>
<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

th {
  border: 1px solid #000000;
  padding: 8px;
  font-size: 12px;
}
td {
  border: 1px solid #000000;
  padding: 8px;
  font-size: 12px;
}

/* tr:nth-child(even) {
  background-color: #dddddd;
} */
p {
	margin : 5px;
}.center {
  margin-left: 50px;
  margin-right: auto;
}
div.auto-row {
  display: flex;
  flex-flow: row wrap;
  justify-content: space-between;
  padding-left: 0;
  padding-right: 0;

  > div {
    flex: 1 1 auto;
    min-height: 1px;
    padding-left: 15px;
    padding-right: 15px;
  }
}
.crop {
	width: 130px; /* Width of the cropped area */
	height: 50px; /* Height of the cropped area */
	overflow: hidden; /* Hide overflow */
	position: relative;
}

.crop img {
	position: absolute;
	right: -100px; /* Adjust the left position */
	width: 150px; /* Width of the original image */
	height: auto; /* Maintain aspect ratio */
}
.crop2 {
	width: 130px; /* Width of the cropped area */
	height: 50px; /* Height of the cropped area */
	overflow: hidden; /* Hide overflow */
	position: relative;
}

.crop2 img {
	position: absolute;
	right: -100px; /* Adjust the left position */
	width: 150px; /* Width of the original image */
	height: auto; /* Maintain aspect ratio */
}
</style>
</head>
<body>
	
<table  class="center" style="width:50%;text-align: left;margin-left:0px;border:0px">
	<tr>
		<td rowspan="4" width="50px" style="text-align:left;border:0px;padding:0px;margin:0px"> <img src="<?=$logo?>" width="100" height="100" alt="Logo"></td>
		<td width="530px" style="text-align:center;border:0px;font-size: 18px;padding:0px;margin:0px"><b>KOPERASI PEDAGANG PASAR REGIONAL JARINEGARA</b></td>
		
	</tr>
	<tr>
		
		<td width="530px" style="text-align:center;border:0px;font-size: 24px;padding:0px;margin-bottom:0px"><b>KOPPAS JARINEGARA</b></td>
		
	</tr>
	<tr>
		
		<td width="530px" style="text-align:center;border:0px;font-size: 12px;padding:0px;margin-top:0px">LANTAI III PASAR JATINEGARA JAKARTA TIMUR 13310</td>
		
	</tr> 
	<tr>
		
		<td width="530px" style="text-align:center;border:0px;font-size: 12px;padding:0px;margin-top:0px">TELP 8194907 - 8190169 FAX 8190169</td>
		
	</tr> 
</table>
	<hr><hr>
<p style="text-align:center;font-size: 18px;margin-top:30px;margin-bottom:30px"><b>FORMULIR PERMOHONAN PINJAMAN ANGGOTA KOPPAS<b></p>

<br>
<table  class="center" style="width:100%;text-align: left;margin-left:0px;border:0px">
	<tr>
		<td width="10px" style="text-align:center;border:0px">1.</td>
		<td width="100px" style="text-align:left;border:0px">NAMA/NO ANGGOTA</b></td>
		<td width="10px" style="text-align:left;border:0px">:</td>
		<td width="200px" style="text-align:left;border:0px"><?=$data['nama'] .' / '. $data['nomor_anggota']?></td>
	</tr>
  	<tr>
		<td width="10px" style="text-align:center;border:0px">2.</td>
		<td width="100px" style="text-align:left;border:0px">ALAMAT</b></td>
		<td width="10px" style="text-align:left;border:0px">:</td>
		<td width="200px" style="text-align:left;border:0px"><?=$data['alamat'] ?></td>
	</tr>
  	<tr>
		<td width="10px" style="text-align:center;border:0px">3.</td>
		<td width="100px" style="text-align:left;border:0px">NO.TELP/NO.HP</b></td>
		<td width="10px" style="text-align:left;border:0px">:</td>
		<td width="200px" style="text-align:left;border:0px"><?=$data['hp'] ?></td>
	</tr>
  	<tr>
		<td width="10px" style="text-align:center;border:0px">4.</td>
		<td width="100px" style="text-align:left;border:0px">JENIS USAHA</b></td>
		<td width="10px" style="text-align:left;border:0px">:</td>
		<td width="200px" style="text-align:left;border:0px"><?=$data['jenis_usaha'] ?></td>
	</tr>
  	<tr>
		<td width="10px" style="text-align:center;border:0px">5.</td>
		<td width="100px" style="text-align:left;border:0px">JUMLAH PERMOHONAN</b></td>
		<td width="10px" style="text-align:left;border:0px">:</td>
		<td width="200px" style="text-align:left;border:0px">Rp. <?=number_format($data['pinjaman']) ?></td>
	</tr>
  	<tr>
		<td width="10px" style="text-align:center;border:0px">6.</td>
		<td width="100px" style="text-align:left;border:0px">JANGKA WAKTU</b></td>
		<td width="10px" style="text-align:left;border:0px">:</td>
		<td width="200px" style="text-align:left;border:0px"><?=($data['jangka_waktu']) ?></td>
	</tr>
  	<tr>
		<td width="10px" style="text-align:center;border:0px">7.</td>
		<td width="100px" style="text-align:left;border:0px">JENIS PINJAMAN</b></td>
		<td width="10px" style="text-align:left;border:0px">:</td>
		<td width="200px" style="text-align:left;border:0px"> <?=($data['jenis_pinjaman']) ?></td>
	</tr>
	
</table>
<br>

<table  class="center" style="width:50%;text-align: left;margin-left:0px;border:0px">


	<tr>
		<td width="300px" style="text-align:left;border:0px"></td>
		<td width="400px" colspan="2" style="text-align:left;border:0px">Jakarta,<?=(date('d F Y',strtotime($data['tgl_pinjaman']))) ?> </td>
		
	</tr>
	<tr>
		<td width="300px" style="text-align:left;border:0px"></td>
		<td width="200px" style="text-align:left;border:0px">Pemohon,</td>
		<td width="200px" style="text-align:left;border:0px">Suami/Isteri,</td>
		
	</tr>
	<tr>
		<td width="300px" style="text-align:left;border:0px"></td>
		<td width="200px" style="text-align:left;border:0px"><div ><img src="data:image/png;base64,<?=$ttd1?>" style="width:100px" ></div></td>
		<td width="200px" style="text-align:left;border:0px">
			
				<div ><img src="data:image/png;base64,<?=$ttd1?>" style="width:100px" ></div>
		
		</td>
		
	</tr>
	<tr>
		<td width="300px" style="text-align:left;border:0px"></td>
		<td width="200px" style="text-align:left;border:0px"><b><u><?=($data['nama']) ?></u></b></td>
		<td width="200px" style="text-align:left;border:0px"><b><u><?=($data['nama_pasangan']) ?></u></b></td>
		
	</tr>
</table>
<br>
<p>DISETUJUI / DITOLAK : Rp. <?=number_format($data['pinjaman_disetujui'])?></p>
<br>
<table  class="center" style="width:100%;text-align: left;margin-left:0px;border:0px">
	<tr>
		<td width="700px" colspan="3" style="text-align:center;border:0px">TIM ANALIS SIMPAN PINJAM KOPPAS JATINEGARA</td>
	</tr>
  	<tr>
		<td width="230px" style="text-align:center;border:0px">
			<?php 
				if($data['status'] == 'Disetujui'){
			?>
			<div ><img src="data:image/png;base64,<?=$ttd_k?>" style="width:100px" ></div>
			<?php 
				}
			?>
		</td>
		<td width="230px" style="text-align:center;border:0px">
			<?php 
				if($data['status'] == 'Disetujui'||$data['status'] == 'Ketua'){
			?>
			<div ><img src="data:image/png;base64,<?=$ttd_s?>" style="width:100px" ></div>
			<?php 
				}
			?>
		</td>
		<td width="240px" style="text-align:center;border:0px">
			<?php 
				if($data['status'] == 'Disetujui' || $data['status'] == 'Sekretaris' ||$data['status'] == 'Ketua'){
			?>
			<div ><img src="data:image/png;base64,<?=$ttd_b?>" style="width:100px" ></div>
			<?php 
				}
			?>
		</td>
	</tr>
  	
  	<tr>
		<td width="230px" style="text-align:center;border:0px"><?=$ketua['nama'] ?></td>
		<td width="230px" style="text-align:center;border:0px"><?=$sekretaris['nama'] ?></td>
		<td width="240px" style="text-align:center;border:0px"><?=$bendahara['nama'] ?></td>
	</tr>
  	<tr>
		<td width="230px" style="text-align:center;border:0px">KETUA</td>
		<td width="230px" style="text-align:center;border:0px">SEKRETASI</td>
		<td width="240px" style="text-align:center;border:0px">BENDAHARA</td>
	</tr>
	
</table>
<br>

</body>
</html>

