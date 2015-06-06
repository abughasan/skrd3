<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {
	public function index()
	{
		$var['htmllang'] = "id";
		$var['metadesc'] = "";
		$var['metakeyword'] = "";
		$var['title'] = "Dashboard";
		$var['body_class'] = "no-skin";
		$var['assets_top'] = array("acebootstrap_css","fontawesome_css","select-formwizard","googleapis_font","ace_min_css","ace-extra_min_js");
		$var['assets_bottom'] = array("jquery","bootstrap_min_js","formwizard_js_plugin","ace-script_min_js","formwizard_js");
		$var['template'] = "standalone";
		$var['interface'] = array("menu","transaksi_wizard","footer");
		
		// data dari database
		//wizard 1
		$var['propinsi'] = $this->app_model->getAllData('mpropinsi')->result();
		//wizard 2
		$var['kecamatan'] = $this->app_model->getSelectedData('mkecamatan',array('kota_id'=>'106'))->result();
		//wizard 3
		$var['lingkup'] = $this->app_model->getAllData('mlingkup')->result();
		$var['fungsi'] = $this->app_model->getAllData('mfungsi')->result();
		$var['klasifikasi'] = $this->app_model->getAllData('mklasifikasi');
		
		$this->load->view('home',$var);
	}
	
	
	//AJAX LOAD DATA
	
	function kota($id)
	{
		$kota = $this->app_model->getSelectedData('mkota',array('propinsi_id'=>$id))->result();
		?>
		<option value="">&nbsp;</option>
		<?php foreach($kota as $row): ?>
			<option value="<?=$row->kota_id?>"><?=$row->kota_name?></option>
		<?php endforeach; ?>
		
		<?php
	}
	function kecamatan($id)
	{
		$kecamatan = $this->app_model->getSelectedData('mkecamatan',array('kota_id'=>$id))->result();
		?>
		<option value="">&nbsp;</option>
		<?php foreach($kecamatan as $row): ?>
			<option value="<?=$row->kecamatan_id?>"><?=$row->kecamatan_name?></option>
		<?php endforeach; ?>
		
		<?php
	}
	function desa($id)
	{
		$desa = $this->app_model->getSelectedData('mdesa',array('kecamatan_id'=>$id))->result();
		?>
		<option value="">&nbsp;</option>
		<?php foreach($desa as $row): ?>
			<option value="<?=$row->desa_id?>"><?=$row->desa_name?></option>
		<?php endforeach; ?>
		
		<?php
	}
	function lingkupsub($id)
	{
		$desa = $this->app_model->getSelectedData('mlingkupsub',array('idmling'=>$id))->result();
		?>
		<option value="">&nbsp;</option>
		<?php foreach($desa as $row): ?>
			<option value="<?=$row->idmlingkupsub?>"><?=$row->lingkupsub?> - <?=$row->keterangan?></option>
		<?php endforeach; ?>
		
		<?php
	}
	function lingkupsubdet($id)
	{
		$desa = $this->app_model->getSelectedData('mlingkupsubdet',array('idmlingkupsub'=>$id))->result();
		?>
		<option value="">&nbsp;</option>
		<?php foreach($desa as $row): ?>
			<option value="<?=$row->indeks?>"><?=$row->lingkupsubdet?> - indeks : <?=$row->indeks?></option>
		<?php endforeach; ?>
		
		<?php
	}
	function clearselected()
	{
		?><option value="">&nbsp;</option><?php
	}
	
	
	//AJAX SIMPAN DATA
	
	function simpanDataWajibPajak()
	{
		$data['nama'] = $_POST['namawr'];
		$data['pt'] = $_POST['pt'];
		$data['alamat'] = $_POST['alamatpt'];
		$data['propinsi_id'] = $_POST['propinsi'];
		$data['kota_id'] = $_POST['kota'];
		$data['kecamatan_id'] = $_POST['kecamatan'];
		$data['desa_id'] = $_POST['desa'];
		
		$insert = $this->app_model->insertData('dwajibretribusi',$data);
		$wrlastid =  $this->db->insert_id();
		if($this->db->affected_rows()>0):
			echo "Data wajib retribusi an ".$data['nama']." telah tersimpan dengan ID ". $wrlastid;
		else:
			echo "GAGAL Menyimpan Data WR. Periksa koneksi internet / Hubungi IT administrator anda";
		endif;
		
		$transheader['noskr'] = '123';
		$transheader['tgl_penetapan'] = date('Y-m-d');
		$transheader['idpengguna'] = $this->app_model->getSelectedData('dpenggunaanggaran',array('flag'=>'aktif'))->row()->id;
		$transheader['idkasie'] = $this->app_model->getSelectedData('dkasie',array('flag'=>'aktif'))->row()->id;
		$transheader['idkabid'] = $this->app_model->getSelectedData('dkabid',array('flag'=>'aktif'))->row()->id;
		$transheader['idwajibret'] = $wrlastid;
		
		$insert2 = $this->app_model->insertData('transheaderskr',$transheader);
		$thlastid =  $this->db->insert_id();
		if($this->db->affected_rows()>0):
			echo "\nData transaksi header telah disimpan dengan ID ". $thlastid;
		else:
			echo "\nGAGAL Menyimpan Transaksi Header. Periksa koneksi internet / Hubungi IT administrator anda";
		endif;
		
		
		$this->session->set_userdata('namawr', $data['nama']);
		$this->session->set_userdata('idtransheader', $thlastid);
		
	}
	
	function simpanDataGedung()
	{
		$data['jenis_bangunan'] = $_POST['jenis_b'];
		$data['lokasi'] = $_POST['lokasi_b'];
		$data['kecamatan_id'] = $_POST['kecamatan2'];
		$data['desa_id'] = @$_POST['desa2'];
		
		$insert = $this->app_model->insertData('dbangunan',$data);
		$dglastid =  $this->db->insert_id();
		
		if($this->db->affected_rows()>0):
			echo "Data bangunan telah tersimpan dengan ID ". $dglastid;	
		else:
			echo "GAGAL Menyimpan Data bangunan. Periksa koneksi internet / Hubungi IT administrator anda";
		endif;
		
		$transheader['idbangunan'] = $dglastid;
		$transwhere['id'] = $this->session->userdata('idtransheader');
		
		$update = $this->app_model->updateData('transheaderskr',$transheader,$transwhere);
		
		if($this->db->affected_rows()>0):
			echo "\nData transaksi header terupdate";	
		else:
			echo "\nGAGAL update transaksi header. Periksa koneksi internet / Hubungi IT administrator anda";
		endif;
	}
}