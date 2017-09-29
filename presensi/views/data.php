<div class = "data_karyawan">
 <div class = "blog-post">
 <div class = "table-responsive">
<table class = "table table-bordered" id = "table2">
<thead>
<tr>
<th>No Id</th><th>Nama</th><th>Jabatan</th><th>Aksi</th>
</tr>
</thead>
<tbody>
<?php
foreach($select_all as $row){
	?>
	<tr>
	<td><?php echo $row->id;?></td>
	<td><?php echo $row->nama;?></td>
	<td><?php echo $row->jabatan;?></td>
	<td><button class = "glyphicon glyphicon-pencil" onclick = "edit(<?php echo $row->id;?>)">Edit</button><button class = "glyphicon glyphicon-trash" onclick = "hapus(<?php echo $row->id;?>)">Hapus</button></td>
	</tr>
	<?php
}

?>
</tbody>
</table>
 </div>

</div>
<script>
$(document).ready(function(){
	$('#table2').dataTable();
})
function show(){
			$('#modal').modal("show");
}
function hapus(id){
	if(confirm("Anda yakin ingin menghapus")){
		$.ajax({
			url:"<?php echo base_url();?>presensi/delete/"+id,
			type:"POST",
			dataType: "JSON",
			success:function(){
				location.reload();
			}
		});
	}
}
function edit(id){
	$.ajax({
		url:"<?php base_url();?>presensi/edit/"+id,
		type: "GET",
		dataType:"JSON",
		success:function(data){
			$('[name="id"]').val(data.id);
			$('.modal-title').text('Edit');
			$('[name="nama"]').val(data.nama);
			$('[name="jabatan"]').val(data.jabatan);
			$('#modal').modal('show');
		},
		error:function(){
			alert("error");
		}
	});
}
</script>