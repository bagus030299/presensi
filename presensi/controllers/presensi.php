<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Presensi extends MX_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model("model_presensi");
	}
	function edit($id){
		$data = $this->model_presensi->edit($id);
		echo json_encode($data);
	}
	function process_edit(){
		$data = array(
			'nama' => $this->input->post("nama"),
			'jabatan' => $this->input->post('jabatan'),
			);
		$this->model_presensi->process_edit($this->input->post('id'), $data);
		echo json_encode(array("array" => TRUE));
	}
	function delete($id){
		$this->model_presensi->hapus($id);
		echo json_encode(array('status' => TRUE));
	}
	function tambah_karyawan(){
	$data = array(
		'nama' => $this->input->post('nama'),
		'jabatan' => $this->input->post('jabatan'),
		);
	$this->model_presensi->karyawan($data);
	echo json_encode(array('status' => TRUE));
	}
	function admin(){
		$data['tambah_karyawan'] = $this->model_presensi->tambah_karyawan();
		$data['title'] = "Admin";
		$this->load->view('admin', $data);
	}
	public function index()
	{
		$data['s'] = $this->model_presensi->sudah_hadir();
		$data['presensi'] = $this->model_presensi->get_all();
		$data['title'] = "Presensi";
		$data['date'] = date(" D m Y");
		$this->load->view('view_presensi', $data);
	}

	function data(){
		$data['select_all'] = $this->model_presensi->select_all();
		$this->load->view('data', $data);
	}
	function data_presensi(){
		$data['data'] = $this->model_presensi->harian();
		$data['absen1'] = $this->model_presensi->absen1();
		$data['hadir'] = $this->model_presensi->hadir();
		$data['absen'] = $this->model_presensi->absen();
		$data['sakit'] = $this->model_presensi->sakit();
		$data['izin'] = $this->model_presensi->izin();
		$data['presensi'] = $this->model_presensi->get_all();
		$this->load->view('data_presensi', $data);
	}

	function insert(){
		$data = array(
			'status' =>$this->input->post("status"),
			'datang' => $this->input->post('datang'),
			'pulang' => $this->input->post('pulang'),
			'tanggal' => date('y-n-d')
			);
		$this->model_presensi->insert($this->input->post('id'), $data);
		echo json_encode(array('status' => TRUE));
	}
	function get_id($id){
		$data = $this->model_presensi->get($id);
		echo json_encode($data);
	}
		function insert1(){
		$post=$this->input->post();
		$id = array();
		$data=array();
		for ($i=1; $i <= $post["count"]; $i++) {
			$key_status = "status-".$i;
			$key_datang = "datang-".$i;
			$key_pulang = "pulang-".$i;
			$key_id="id-".$i;
			$key_nama="nama-".$i;
			$key_jabatan="jabatan-".$i;
			$data[]=array(
							"id"  =>$post[$key_id],
							"nama"=>$post[$key_nama],
							"jabatan"=>$post[$key_jabatan],
							"tanggal" => date('Y-m-d'),
							"status" => $post[$key_status],
							"datang" => $post[$key_datang],
							'pulang' => $post[$key_pulang],
							);
			
		}
		$this->db->update_batch('presensi', $data, 'id');
		echo json_encode(array('status' => TRUE));

		}
	function insert2(){
		$post=$this->input->post();
		$data=array();
		for ($i=1; $i <= $post["count"]; $i++) { 
			$key_id="id-".$i;
			$key_nama="nama-".$i;
			$key_jabatan="jabatan-".$i;
			$data[]=array(
							"id_karyawan"  =>$post[$key_id],
							"nama"=>$post[$key_nama],
							"jabatan"=>$post[$key_jabatan],
							"tanggal" => date('Y-m-d'),
							"status" => 'Belum Cek Kehadiran'
							);
			
		}
		$this->model_presensi->insert12($data);
		echo json_encode(array('status' => TRUE));

		}
	function export(){
		$data = $this->model_presensi->harian();
		$this->load->library('mpdf/mpdf.php');
		$mpdf =new mPDF('utf-8', 'A4');
		ob_start();?>
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
<head><title>Presensi</title>
</head>	<body>
		<h2 align = "center">Laporan Presensi Karyawan <br/>PT.Vortek Buana Edumedia<br/> Komplek Taman Mutiara Blok C1 NO.11 Kota Cimahi<br/>
		Priode <?php
		$d = date('-M-Y');
		$e = date('d')-4;
		$de = $e.$d;
		$date = date('d-M-Y');
		echo $de.' sampai '.$date.'<br/>';
		?>

		</h2>
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
		</body>
		<?php
		$html = ob_get_contents();
		ob_end_clean();
		$mpdf->WriteHTML($stylesheet, 1);
		$mpdf->WriteHTML(utf8_encode($html));
		$mpdf->Output($dokumen."Presensi.pdf" ,'I');
		exit;

	}
}
