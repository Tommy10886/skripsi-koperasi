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
p {
	margin : 5px;
}.center {
  margin-left: 50px;
  margin-right: auto;
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
<br>
<!-- <img src="data:image/png;base64,<?=$logo?>" width="70" height="50" class="left">  -->
<p style="text-align:center;font-size: 18px;"><b>Laporan Pinjaman Anggota KOPPAS Jatinegara<b></p>
<br>
<table  class="center" style="width:50%;text-align: left;margin-left:0px">
	<tr>
		<th style="text-align:center;">No</th>
		<th style="text-align:center;">Nomor Anggota</th>
		<th style="text-align:center;">Nama</th>
		<th style="text-align:center;">Saldo</th>
	</tr>
	<?php 
		$nomor = 1;
		foreach ($list_anggota as $key => $value) {
	?>
	<tr>
		<td width="30px" style="text-align:center;"><?=$nomor++?></td>
		<td width="150px" style="text-align:center;"><?=$value['nomor_anggota']?></td>
		<td width="200px" style="text-align:center;"><?=$value['nama']?></td>
		<td width="200px" style="text-align:center;"><?=number_format($value['saldo'])?></td>
	</tr>
	<?php 
		}
	?>
	
</table>

<br>
<p style="margin-top:30dp;font-size:8px">Printed Date : <?=date('d-M-Y H:i:s')?></p>
</body>
</html>

