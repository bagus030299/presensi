<html>
<head>
	<title><?php echo $title;?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/css.css'); ?>"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>"/>
	<script type="text/javascript" src="<?php echo base_url('assets/jquery.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/dataTables.bootstrap.js')?>"></script>
</head>
<body>

<div class = "container">
<h3 align = "center"><?php echo $title;?>, tanggal <?php echo $date;?></h3>	
<form action = "#" id = "forum">
<table id="table_id" class = "table table-bordered">
<thead>
<tr>
<th >No</th>
<th>Nama</th>
<th>Jabatan</th>
<th>Status Hadir</th>
<th>Datang</th>
<th>Pulang</th>

</tr>
</thead>
<tbody>
<?php
$i = 1;
foreach($presensi as $row)
{
?>
<tr>
<td><input type = "hidden" name = "id-<?php echo $i;?>" value = "<?php echo $row->id;?>"/><?php echo $row->id;?></td>
<td><input type = "hidden" value = "<?php echo $row->nama;?>" name = "nama-<?php echo $i;?>"/> <?php echo $row->nama;?></td>
<td><input type = "hidden" value = "<?php echo $row->jabatan;?>" name = "jabatan-<?php echo $i;?>"/><?php echo $row->jabatan?></td>
<td><select name = "status-<?php echo $i;?>"><option value = "Hadir">Hadir</option><option value = "Absen">Absen</option><option value = "Sakit">Sakit</option>
<option value = "Izin">Izin</option></select></td>
<td><input type = "time" class = "time" name = "datang-<?php echo $i;?>"></td>
<td><input type = "time" class = "time" name = "pulang-<?php echo $i;?>"></td>
</tr>
<?php
$i++;
}
?>
</tbody>
<input type="hidden" name="count" value="<?=$i-1?>">
</form>
<button onclick = "simpan_presensi()">Simpan Presensi</button>
<tfooter>
</tfooter>
</table>
</html>
<script type="text/javascript">
$(document).ready(function()
		{	
			$('#table_id').dataTable();
		});
function simpan_presensi(){
	if(confirm("Simpan Presensi?")){
		$.ajax({
			url:"<?php echo base_url();?>presensi/insert1",
			type:"POST",
			data:$("#forum").serialize(),
			dataType:"JSON",
			success:function(){
				location.reload();
			}
		});
	}
}
</script>