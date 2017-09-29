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
<div class = "head">
 <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand">Admin Presensi</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a class = "klik" id = "data" href = "#">Data Karyawan</a></li>
            <li><a class = "klik" id = "presensi" href = "#">Presensi</a></li>
          </ul>
      </div>
    </nav>
 </div>
 <div class = "blog-post">
<button class = "glyphicon glyphicon-plus" onclick = "show()">Tambah Karyawan</button><br/><br/>
<button class = "btn btn-primary" onclick="tambah()">Klik untuk presensi hari ini</button><br/><br/>
<form action = "<?php echo base_url();?>presensi/insert1" enctype="multipart" id = "form1">
<?php
$i=1;
if(count($tambah_karyawan)){
foreach($tambah_karyawan as $row)
{
?>
<input type = "hidden" name="id-<?=$i?>" value = '<?php echo $row->id;?>'/>
<input type = "hidden" name = "nama-<?=$i?>" value = '<?php echo $row->nama;?>'/>
<input type = "hidden" name = "jabatan-<?=$i?>" value = '<?php echo $row->jabatan;?>'/>

<?php
$i++;
}
}
?>
<input type="hidden" name="count" value="<?=$i-1?>">
</form>

<button> <a href = "<?php echo  base_url();?>presensi/export">Export</a></button>


<div class = "modal fade" id = "modal" role = "dialog">
<div class = "modal-dialog">
<div class = "modal-content">
<div class = "modal-heading">
<button type = "button" class = "close" data-dismiss = "modal">&times;</button>
<div class = "modal-title">
<h3>Tambah Karyawan</h3>
</div>
</div>
<div class = "modal-body form">
<form action = "#" class = "form form-horizontal" id = "form">
<div class = "form-group">
</div>
<div class = "form-group">
<div class = "col-md-9">
<label>Nama Karyawan</label><input type = "hidden" name = "id"/>
<input type = "text" class = "form-control" name = "nama"/>
</div>
</div>
<div class = "form-group">
<div class = "col-md-9">
<label>Jabatan </label>
<input type = "text" class = "form-control" name = "jabatan"/>
</div>
</div>
<div class = "modal-footer">
<button class = "btn btn-success" onclick = "karyawan()">tambah</button>
<button data-dismiss = "modal" class = "btn btn-danger">Close</button>
</div>
</form>
</div>
</div>
</div>
</div>
 </div>
 <div class = "konten">


 </div>
</div>
</body>

</html>
<script type="text/javascript">
function show(){
			$('#modal').modal("show");
}
function expor(){
	$.ajax({
		url:"<?php echo base_url();?>presensi/export"
	});
}
function karyawan(){
	var url;
	var a = $('.modal-title').text();
	if(a == "Edit"){
		url = "<?php base_url();?>presensi/process_edit";
	}else{
		url = "<?php echo base_url();?>presensi/tambah_karyawan";
	}
	$.ajax({
  		url:url,
		type: "POST",
		typeData: "JSON",
		data: $("#form").serialize(),
		success:function(){
			$('#modal').modal('hide');
			location.reload();
		}
	});
}
$(document).ready(function(){
	$('.klik').click(function(){
		var menu = $(this).attr('id');
		if(menu == "data"){
			$(".konten").load("data");
		}else if(menu == "presensi"){
			$(".konten").load("data_presensi");
		}
	});
});
function tambah(){
				$.ajax({
				url:"<?php echo base_url();?>presensi/insert2",
				type:"POST",
				data:$('#form1').serialize(),
				dataType:"JSON",
				success:function(){
				location.reload();
				},
				error:function(){
					alert("error");
				}
			})
		}
</script>