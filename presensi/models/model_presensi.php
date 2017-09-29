<?php
class Model_Presensi extends CI_Model {
	function get_all(){
	 $sql = "Select * from presensi where tanggal = curdate()";
	$q = $this->db->query($sql);
	return $q->result();

	}
	function edit($id){
		$this->db->where('id', $id);
		$query = $this->db->get('karyawan');
		return $query->row();
	}
	function hapus($id){
		$this->db->where('id', $id);
		$this->db->delete('karyawan');
	}
	function process_edit($id, $data){
		$this->db->where('id', $id);
		$this->db->update('karyawan', $data);
	}
	function select_all(){
		$query = $this->db->get('karyawan');
		return $query->result();
	}
	function karyawan($data){
		$this->db->insert('karyawan', $data);
	}
	function get($id){
		$this->db->where('id', $id);
		$query = $this->db->get('presensi');
		return $query->row();
	}
	function insert($id, $data){
		$this->db->where('id', $id);
		$this->db->update('presensi', $data);
	}
	function sudah_hadir(){
	 $sql = "Select karyawan.nama from karyawan join presensi on karyawan.id = presensi.id_karyawan where tanggal =  curdate()";
	$q = $this->db->query($sql);
	return $q->result();
	}
	function from_db($data){
		$this->db->insert_batch('presensi', $data);
	}
	function tambah_karyawan(){
		$query = $this->db->get('karyawan');
		return $query->result();
	}
	function insert12($data){
		$this->db->insert_batch('presensi', $data);
	}
	function insert123($data){
		$this->db->update_batch('presensi', $data, 'id');
	}
	function fetch(){
		$query = $this->db->get('presensi');
		return $query->result();
	}
	function harian(){
		$this->db->order_by('nama');
		$d = date('Y-m-');
		$e = date('d')-5;
		$de = $d.$e;
		$date = date('Y-m-d');
		$this->db->where('tanggal >', $de);
		$this->db->where('tanggal <=', $date);
		$query = $this->db->get('presensi');
		return $query->result();
	}
	function datang_pulang(){
		$query = $this->db->query("select datang, pulang from presensi");
		return $query->result();
	}
	function hadir(){
		$this->db->order_by('nama');
		$d = date('Y-m-');
		$e = date('d')-5;
		$de = $d.$e;
		$date = date('Y-m-d');
		$this->db->where('tanggal >', $de);
		$this->db->where('tanggal <=', $date);
		$this->db->where('status', 'Hadir');
		$query = $this->db->get('presensi');
		return $query->result();
	}
	function absen(){
		$this->db->order_by('nama');
		$d = date('Y-m-');
		$e = date('d')-5;
		$de = $d.$e;
		$date = date('Y-m-d');
		$this->db->where('tanggal >', $de);
		$this->db->where('tanggal <=', $date);
		$this->db->where('status', 'Absen');
		$query = $this->db->get('presensi');
		return $query->result();
	}
	function absen1(){
		$this->db->order_by('nama');
		$d = date('Y-m-');
		$e = date('d')-5;
		$de = $d.$e;
		$date = date('Y-m-d');
		$this->db->where('tanggal >', $de);
		$this->db->where('tanggal <=', $date);
		$this->db->where('status', 'Belum Cek Kehadiran');
		$query = $this->db->get('presensi');
		return $query->result();
	}
	function sakit(){
		$this->db->order_by('nama');
		$d = date('Y-m-');
		$e = date('d')-5;
		$de = $d.$e;
		$date = date('Y-m-d');
		$this->db->where('tanggal >', $de);
		$this->db->where('tanggal <=', $date);
		$this->db->where('status', 'Sakit');
		$query = $this->db->get('presensi');
		return $query->result();
	}
	function izin(){
		$this->db->order_by('nama');
		$d = date('Y-m-');
		$e = date('d')-5;
		$de = $d.$e;
		$date = date('Y-m-d');
		$this->db->where('tanggal >', $de);
		$this->db->where('tanggal <=', $date);
		$this->db->where('status', 'Izin');
		$query = $this->db->get('presensi');
		return $query->result();

	}

}

?>