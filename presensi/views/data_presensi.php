	<style>
td {
    padding: 3px 5px 3px 5px;
    border-right: 1px solid #666666;
    border-bottom: 1px solid #666666;
}
 
th {
    padding: 3px 5px 3px 5px;
    border-right: 1px solid #666666;
    border-bottom: 1px solid #666666;
}
.head td {
    font-weight: bold;
    font-size: 12px;
    background: #b7f0ff; 
}

 
table .main tbody tr td {
    font-size: 12px;
}
 
table{
    width: 100%;
    border-top: 1px solid #666;
    border-left: 1px solid #666;
    border-collapse: collapse;
    background: #fff;
}
 
h1 {
    font-size:20px;
}
</style>
<div class = "data_presensi">
<h2>Detail Karyawan Pada Hari Ini</h2>
<table id="table_id1" class = "table table-bordered">
<thead>
<tr>
<th >No</th>
<th>Nama</th>
<th>Jabatan</th>
<th>Datang</th>
<th>Pulang</th>
<th>Total Jam</th>
</tr>
</thead>
<tbody>
<?php
foreach($presensi as $row)
{
?>
<tr>
<td><?php echo $row->id;?></td>
<td><?php echo $row->nama;?></td>
<td><?php echo $row->jabatan;?></td>
<td><?php echo $row->datang;?></td>
<td><?php echo $row->pulang?></td>
<td><?php  $y = $row->datang; $x = $row->pulang; $z = $x - $y;
echo $z
;?></td>
</tr>

<?php
}
?>
</tbody></table>
		<h1 align = "center">Laporan Presensi Karyawan <br/>PT.Vortek Buana Edumedia<br/> Komplek Taman Mutiara Blok C1 NO.11 Kota Cimahi<br/>
		Priode <?php
		$d = date('-M-Y');
		$e = date('d')-4;
		$de = $e.$d;
		$date = date('d-M-Y');
		echo $de.' sampai '.$date.'<br/>';
		?>

		</h1>
		<table>
			<tr>
			<th>id karyawan</th><th>Nama</th>
			<th>Jabatan/Posisi</th>
			<th>Kehadiran</th>
			<th>Datang</th>
			<th>Pulang</th>
			<th>jumlah jam</th>
			</tr>
			<?php
			foreach($data as $row){
				?>
				<tr>
					<td><?php echo $row->id_karyawan;?></td>
					<td><?php echo $row->nama;?></td>
					<td><?php echo $row->jabatan;?></td>
					<td><?php echo $row->status;?></td>
					<td><?php echo $row->datang;?></td>
					<td><?php echo $row->pulang;?></td>
					<td><?php $r = $row->pulang - $row->datang; echo $r .' jam';?></td>
				<tr>
				<?php

			}
			?>
		</table><pagebreak>
		<h1 align = "center">Keterangan Karyawan<br/></h1>
		
		<table>
		<tr>
		<th>Id_karyawan</th>
		<th>Tanggal</th>
		<th>Nama</th>
		<th>Keterangan</th>
		</tr>
		<?php
		$absen1 = $this->model_presensi->absen1();
		$hadir = $this->model_presensi->hadir();
		$absen = $this->model_presensi->absen();
		$sakit = $this->model_presensi->sakit();
		$izin = $this->model_presensi->izin();
		foreach($hadir as $h){
			?>
			<tr>
			<td><?php echo $h->id_karyawan;?></td>
			<td><?php echo $h->tanggal;?></td>
			<td><?php echo $h->nama;?></td>
			<td><?php echo $h->status;?></td>
			</tr>
			<?php
		}
		foreach($absen as $h){
			?>
			<tr>
			<td><?php echo $h->id_karyawan;?></td>
			<td><?php echo $h->tanggal;?></td>
			<td><?php echo $h->nama;?></td>
			<td><?php echo $h->status;?></td>
			</tr>
			<?php
		}
			foreach($absen1 as $h){
			?>
			<tr>
			<td><?php echo $h->id_karyawan;?></td>
			<td><?php echo $h->tanggal;?></td>
			<td><?php echo $h->nama;?></td>
			<td>Absen</td>
			</tr>
			<?php
		}
			foreach($izin as $h){
			?>
			<tr>
			<td><?php echo $h->id_karyawan;?></td>
			<td><?php echo $h->tanggal;?></td>
			<td><?php echo $h->nama;?></td>
			<td><?php echo $h->status;?></td>
			</tr>
			<?php
		}
			foreach($sakit as $h){
			?>
			<tr>
			<td><?php echo $h->id_karyawan;?></td>
			<td><?php echo $h->tanggal;?></td>
			<td><?php echo $h->nama;?></td>
			<td><?php echo $h->status;?></td>
			</tr>
			<?php
		}


		?>
		</table>
		<p>
		<?php
		$jumlah = count($data);
		$b = count($absen1);
		$h = count($hadir);
		$s = count($sakit);
		$i = count($izin);
		$a = count($absen);
		$per_sakit = $s / $jumlah * 100;
		$per_hadir = $h / $jumlah * 100;
		$per_absen = $a / $jumlah * 100;
		$per_absen1 = $b / $jumlah * 100;
		$per_izin = $i / $jumlah * 100;
		$z = $per_absen+$per_absen1;
		echo 'persentase karyawan yang hadir pada seminggu : '.$per_hadir.'%<br/>';
		echo 'persentase karyawan yang sakit pada seminggu : '.$per_sakit.'%<br/>';	
		echo 'persentase karyawan yang tidak hadir pada seminggu : '.$z.'%<br/>';
		echo 'persentase karyawan yang izin pada seminggu : '.$per_izin.'%<br/>';


		?>
		</p>
</table>
</script>