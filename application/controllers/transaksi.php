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
		$var['assets_bottom'] = array("jquery","bootstrap_min_js","formwizard_js_plugin","ace-script_min_js","autoNumeric_js","formwizard_js");
		$var['template'] = "standalone";
		$var['interface'] = array("force_login","menu","transaksi_wizard");
		$var['komponen_bottom'] = array("footer");
		
		// data dari database
		//wizard 1
		$var['propinsi'] = $this->app_model->getAllData('mpropinsi')->result();
		$var['desa'] = $this->app_model->getAllData('mdesa')->result();
		//wizard 2
		$var['kecamatan'] = $this->app_model->getSelectedData('mkecamatan',array('kota_id'=>'106'))->result();
		//wizard 3
		$var['lingkup'] = $this->app_model->getAllData('mlingkup')->result();
		$var['fungsi'] = $this->app_model->getAllData('mfungsi')->result();
		$var['klasifikasi'] = $this->app_model->getAllData('mklasifikasi');
		$var['waktuguna'] = $this->app_model->getAllData('mwaktuguna');
		$var['hargasatuan'] = $this->app_model->getAllData('mhargasatuan');
		
		$this->load->view('home',$var);
	}
	
	public function edit($noskr)
	{
		$var['htmllang'] = "id";
		$var['metadesc'] = "";
		$var['metakeyword'] = "";
		$var['title'] = "Dashboard";
		$var['body_class'] = "no-skin";
		$var['assets_top'] = array("acebootstrap_css","fontawesome_css","select-formwizard","googleapis_font","ace_min_css","ace-extra_min_js");
		$var['assets_bottom'] = array("jquery","bootstrap_min_js","formwizard_js_plugin","ace-script_min_js","autoNumeric_js","edit_wizard_js");
		$var['template'] = "standalone";
		$var['interface'] = array("force_login","menu","edit_wizard");
		$var['komponen_bottom'] = array("footer");
		
		$var['noskr'] = $noskr;
		// data dari database
		//wizard 1
		$var['propinsi'] = $this->app_model->getAllData('mpropinsi')->result();
		$var['kabupaten'] = $this->app_model->getAllData('mkota')->result();
		$var['kecamatan'] = $this->app_model->getAllData('mkecamatan')->result();
		//wizard 2
		$var['kecamatan_cilegon'] = $this->app_model->getSelectedData('mkecamatan',array('kota_id'=>'106'))->result();
		//wizard 3
		$var['lingkup'] = $this->app_model->getAllData('mlingkup')->result();
		$var['fungsi'] = $this->app_model->getAllData('mfungsi')->result();
		$var['klasifikasi'] = $this->app_model->getAllData('mklasifikasi');
		$var['waktuguna'] = $this->app_model->getAllData('mwaktuguna');
		$var['hargasatuan'] = $this->app_model->getAllData('mhargasatuan');
		
		$this->session->set_userdata('idtransheader', $noskr);
		
		$var['ilp'] = $this->app_model->getSelectedData('transheaderskr',array('id'=>$noskr));
		
		$var['ilp_subdet'] = $this->app_model->getSelectedData('mlingkupsubdet',
							array( 'idmlingkupsubdet'  =>  $var['ilp']->row()->idmlingkupsubdet )
						);
		$var['ilp_sub'] = $this->app_model->getSelectedData('mlingkupsub',
							array( 'idmlingkupsub'  =>  $var['ilp_subdet']->row()->idmlingkupsub )
						);
		$var['ls'] = $this->app_model->getSelectedData('mlingkup',
							array( 'idmlingkup'  =>  $var['ilp_sub']->row()->idmling )
						);
		
		//-----------WRet EDIT
		$var['wr'] = $this->app_model->getSelectedData('dwajibretribusi',array('id'=>$var['ilp']->row()->idwajibret));
		//-----------Bangunan EDIT
		$var['dbangunan'] = $this->app_model->getSelectedData('dbangunan',array('id'=>$var['ilp']->row()->idbangunan));
		
		//-----------INTEGRASI EDIT
		$var['int2'] = $this->app_model->getSelectedData('transintegritas',array('idheaderskr'=>$noskr));
		$var['int'] = $this->app_model->getSelectedData('transintegritas',array('idheaderskr'=>$noskr,'tabel_ke'=>'1'));
		$var['int_idmfungsi_ket'] = $this->app_model->getSelectedData('mfungsi',array('idmfungsi'=>$var['int']->row()->idmfungsi));
		$var['int_idwg_ket'] = $this->app_model->getSelectedData('mwaktuguna',array('idmwaktuguna'=>$var['int']->row()->idmwaktuguna));
		$var['klas'] = $this->app_model->getSelectedData('transklasifikasi',array('idheaderskr'=>$noskr,'tabel_ke'=>'1'));
		
		//-----------KLASIFIKASI EDIT
		for($i=1;$i<=7;$i++):
			$var['klas_'.$i] = $this->app_model->getSelectedData('transklasifikasi',
							array( 'idheaderskr' => $noskr, 'tabel_ke' => '1', 'idmklas' => $i )
							);
		endfor;
		
		//----------SKRD EDIT
		$var['skr_ed'] = $this->app_model->getSelectedData('transskr',array('idheaderskr'=>$noskr));
		
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
			<option value="<?=$row->idmlingkupsubdet?>*<?=$row->indeks?>"><?=$row->lingkupsubdet?> - indeks : <?=$row->indeks?></option>
		<?php endforeach; ?>
		
		<?php
	}
	function clearselected()
	{
		?><option value="">&nbsp;</option><?php
	}
	
	function tambah_int_klas($angka)
	{
		$var['fungsi'] = $this->app_model->getAllData('mfungsi')->result();
		$var['klasifikasi'] = $this->app_model->getAllData('mklasifikasi');
		$var['waktuguna'] = $this->app_model->getAllData('mwaktuguna');
		$var['angka'] = $angka;
		$this->load->view('interface/inf_tr_wiz_3-1',$var);
	}
	function tambah_int_klas2($angka)
	{
		$var['fungsi'] = $this->app_model->getAllData('mfungsi')->result();
		$var['klasifikasi'] = $this->app_model->getAllData('mklasifikasi');
		$var['waktuguna'] = $this->app_model->getAllData('mwaktuguna');
		$var['angka'] = $angka;
		
		$noskr = $this->session->userdata('idtransheader');
		
		$var['ilp'] = $this->app_model->getSelectedData('transheaderskr',array('id'=>$noskr));
		
		$var['ilp_subdet'] = $this->app_model->getSelectedData('mlingkupsubdet',
							array( 'idmlingkupsubdet'  =>  $var['ilp']->row()->idmlingkupsubdet )
						);
		$var['ilp_sub'] = $this->app_model->getSelectedData('mlingkupsub',
							array( 'idmlingkupsub'  =>  $var['ilp_subdet']->row()->idmlingkupsub )
						);
		$var['ls'] = $this->app_model->getSelectedData('mlingkup',
							array( 'idmlingkup'  =>  $var['ilp_sub']->row()->idmling )
						);
						
		//-----------INTEGRASI EDIT
		$var['int2'] = $this->app_model->getSelectedData('transintegritas',array('idheaderskr'=>$noskr));
		$var['int'] = $this->app_model->getSelectedData('transintegritas',array('idheaderskr'=>$noskr,'tabel_ke'=>$angka));
		$var['int_idmfungsi_ket'] = $this->app_model->getSelectedData('mfungsi',array('idmfungsi'=>$var['int']->row()->idmfungsi));
		$var['int_idwg_ket'] = $this->app_model->getSelectedData('mwaktuguna',array('idmwaktuguna'=>$var['int']->row()->idmwaktuguna));
		$var['klas'] = $this->app_model->getSelectedData('transklasifikasi',array('idheaderskr'=>$noskr,'tabel_ke'=>$angka));
		
		//-----------KLASIFIKASI EDIT
		for($i=1;$i<=7;$i++):
			$var['klas_'.$i] = $this->app_model->getSelectedData('transklasifikasi',
							array( 'idheaderskr' => $noskr, 'tabel_ke' => $angka, 'idmklas' => $i )
							);
		endfor;
		$this->load->view('interface/inf_ed_wiz_3-1',$var);
	}
	
	
	//AJAX SIMPAN DATA
	
	function simpanDataWajibPajak()
	{
		$data['nama'] = $_POST['namawr'];
		$data['pt'] = $_POST['pt'];
		$data['alamat'] = $_POST['alamatpt'];
		$data['propinsi_id'] = @$_POST['propinsi'];
		$data['kota_id'] = @$_POST['kota'];
		$data['kecamatan_id'] = $_POST['kecamatan'];
		$data['desa_id'] = @$_POST['desa'];
		
		$insert = $this->app_model->insertData('dwajibretribusi',$data);
		$wrlastid =  $this->db->insert_id();
		if($this->db->affected_rows()>0):
			echo "Data wajib retribusi an ".$data['nama']." telah tersimpan dengan ID ". $wrlastid;
		else:
			echo "GAGAL Menyimpan Data WR. Periksa koneksi internet / Hubungi IT administrator anda";
		endif;
		
		$transheader['noskr'] = '123';
		$transheader['tgl_penetapan'] = date('Y-m-d');
		$transheader['idpengguna'] = $this->app_model->getSelectedData('dpenggunaanggaran',array('flag'=>'aktif'))->row()->idpeng;
		$transheader['idkasie'] = $this->app_model->getSelectedData('dkasie',array('flag'=>'aktif'))->row()->idkasie;
		$transheader['idkabid'] = $this->app_model->getSelectedData('dkabid',array('flag'=>'aktif'))->row()->idkabid;
		$transheader['idwajibret'] = $wrlastid;
		
		$insert2 = $this->app_model->insertData('transheaderskr',$transheader);
		$thlastid =  $this->db->insert_id();
		if($this->db->affected_rows()>0):
			echo "\nData transaksi header telah disimpan dengan ID ". $thlastid;
		else:
			echo "\nGAGAL Menyimpan Transaksi Header. Periksa koneksi internet / Hubungi IT administrator anda";
		endif;
		
		$user = $this->session->userdata('idtransheader');
		
		if(empty($user)) {
			$this->session->set_userdata('namawr', $data['nama']);
			$this->session->set_userdata('idtransheader', $thlastid);
		}
		
	}
	
	function updateDataWajibPajak()
	{
		$data['nama'] = $_POST['namawr'];
		$data['pt'] = $_POST['pt'];
		$data['alamat'] = $_POST['alamatpt'];
		$data['propinsi_id'] = @$_POST['propinsi'];
		$data['kota_id'] = @$_POST['kota'];
		$data['kecamatan_id'] = $_POST['kecamatan'];
		$data['desa_id'] = @$_POST['desa'];
		
		$insert = $this->app_model->insertData('dwajibretribusi',$data);
		$wrlastid =  $this->db->insert_id();
		if($this->db->affected_rows()>0):
			echo "Data wajib retribusi an ".$data['nama']." telah tersimpan dengan ID ". $wrlastid;
		else:
			echo "GAGAL Menyimpan Data WR. Periksa koneksi internet / Hubungi IT administrator anda";
		endif;
		
		$idtransheader = $this->session->userdata('idtransheader');
		$transheader['idwajibret'] = $wrlastid;
		$where['id'] = $idtransheader;
		
		$update = $this->app_model->updateData('transheaderskr',$transheader,$where);
		if($this->db->affected_rows()>0):
			echo "\nData transaksi header telah terupdate ";
		else:
			echo "\nGAGAL Mengupdate Transaksi Header. Periksa koneksi internet / Hubungi IT administrator anda";
		endif;
		
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
	
	function simpanTransKlasifikasi()
	{
		$tabel_ke = $_POST['tabel_ke'];
		$i=count($_POST['param']);
		$sess_transheader = $this->session->userdata('idtransheader');
		$cek = $this->app_model->getSelectedData('transklasifikasi',array('idheaderskr'=>$sess_transheader));
		$cek_num_table = $this->app_model->manualQuery("select distinct(tabel_ke) from transklasifikasi where idheaderskr = {$sess_transheader}")->num_rows();
		
		if ($tabel_ke <= $cek_num_table && $cek->num_rows()>0):
		
		$update_count = 0;
		for($a=0;$a<$i;$a++)
		{
			$data['parameter'] = $_POST['param'][$a];
			$data['bobot'] = $_POST['bobot'][$a];
			$data['idmklassub'] = $_POST['idmklassub'][$a];
			$data['parametersub'] = $_POST['parameter'][$a];
			$data['indeks'] = $_POST['indeksparamsub'][$a];
			$data['boboxindeks'] = $_POST['bobotxindeks'][$a];
			$where['idmklas'] = $_POST['idmklas'][$a];
			$where['idheaderskr'] = $sess_transheader;
			$where['tabel_ke'] = $tabel_ke;
			$update = $this->app_model->updateData('transklasifikasi',$data,$where);
			if ($this->db->affected_rows()>0) {$update_count++;}
		}
		if($update_count>0):
			echo $update_count ." data indeks klasifikasi telah terupdate";	
		else:
			echo "Tidak berhasil update data indeks klasifikasi. Ada beberapa kemungkinan \n1. Tidak ada data klasifikasi yang anda rubah \n2. Anda sudah menyimpan data sebelumnya \n3. Sistem GAGAL Mengupdate rincian indeks klasifikasi. Periksa koneksi internet / Hubungi IT administrator anda";
		endif;
		
		else:
		
		for($a=0;$a<$i;$a++)
		{
			$data['idmklas'] = $_POST['idmklas'][$a];
			$data['parameter'] = $_POST['param'][$a];
			$data['bobot'] = $_POST['bobot'][$a];
			$data['idmklassub'] = $_POST['idmklassub'][$a];
			$data['parametersub'] = $_POST['parameter'][$a];
			$data['indeks'] = $_POST['indeksparamsub'][$a];
			$data['boboxindeks'] = $_POST['bobotxindeks'][$a];
			$data['idheaderskr'] = $sess_transheader;
			$data['tabel_ke'] = $tabel_ke;
			$insert = $this->app_model->insertData('transklasifikasi',$data);
		}
		if($this->db->affected_rows()>0):
			echo "Data rincian indeks klasifikasi telah tersimpan";	
		else:
			echo "GAGAL menyimpan rincian indeks klasifikasi. Periksa koneksi internet / Hubungi IT administrator anda";
		endif;
		
		endif;
	}
	
	function simpanILP($ilp)
	{
		$sess_transheader = $this->session->userdata('idtransheader');
		$idmlin_arr = explode("*",$ilp);
		$transheader['idmlingkupsubdet'] = $idmlin_arr[0];
		$transheader['index_lingpem'] = $idmlin_arr[1];
		$transwhere['id'] = $sess_transheader;
		
		$update = $this->app_model->updateData('transheaderskr',$transheader,$transwhere);
		
		if($this->db->affected_rows()>0):
			echo "Data transaksi header terupdate";	
		else:
			echo "Tidak ada perubahan transaksi header";
		endif;
	}
	
	function simpanIndeks()
	{	
		$tabel_ke = $_POST['tabel_ke'];
		$sess_transheader = $this->session->userdata('idtransheader');
		$cek = $this->app_model->getSelectedData('transintegritas',array('idheaderskr'=>$sess_transheader));
		$cek_num_table = $this->app_model->manualQuery("select distinct(tabel_ke) from transintegritas where idheaderskr = {$sess_transheader}")->num_rows();
		
		if ($tabel_ke == 1):
		
			if ($tabel_ke <= $cek_num_table && $cek->num_rows()>0):
			
			$data['idmfungsi'] = $_POST['ifbg'];
			$data['indeks_fungsi'] = $_POST['if_fix'];
			$data['total_indeks_klas'] = $_POST['iklas_fix'];
			$data['idmwaktuguna'] = $_POST['iwp'];
			$data['indeks_waktuguna'] = $_POST['iwg_fix'];
			$data['indeks_integritas'] = $_POST['indeks_integritas'];
			$data['tabel_ke'] = $_POST['tabel_ke'];
			$where['idheaderskr'] = $sess_transheader;
			
			$insert = $this->app_model->updateData('transintegritas',$data,$where);
			
			if($this->db->affected_rows()>0):
				echo "\nIndeks Integritas terupdate";	
			else:
				echo "\nTidak ada perubahan indeks integritas";
			endif;
			
			else:
			
			$data['idmfungsi'] = $_POST['ifbg'];
			$data['indeks_fungsi'] = $_POST['if_fix'];
			$data['total_indeks_klas'] = $_POST['iklas_fix'];
			$data['idmwaktuguna'] = $_POST['iwp'];
			$data['indeks_waktuguna'] = $_POST['iwg_fix'];
			$data['indeks_integritas'] = $_POST['indeks_integritas'];
			$data['tabel_ke'] = $_POST['tabel_ke'];
			$data['idheaderskr'] = $sess_transheader;
			
			$insert = $this->app_model->insertData('transintegritas',$data);
			
			if($this->db->affected_rows()>0):
				echo "\nIndeks Integritas tersimpan";	
			else:
				echo "\nGAGAL menyimpan indeks integritas. Periksa koneksi internet / Hubungi IT administrator anda";
			endif;
			
			endif;
		
		else:
			
			if ($tabel_ke <= $cek_num_table && $cek->num_rows()>0):
			
			$data['idmfungsi'] = $_POST['ifbg'.$tabel_ke];
			$data['indeks_fungsi'] = $_POST['if_fix_'.$tabel_ke];
			$data['total_indeks_klas'] = $_POST['iklas_fix_'.$tabel_ke];
			$data['idmwaktuguna'] = $_POST['iwp'.$tabel_ke];
			$data['indeks_waktuguna'] = $_POST['iwg_fix_'.$tabel_ke];
			$data['indeks_integritas'] = $_POST['indeks_integritas_'.$tabel_ke];
			$where['tabel_ke'] = $tabel_ke;
			$where['idheaderskr'] = $sess_transheader;
			
			$insert = $this->app_model->updateData('transintegritas',$data,$where);
			
			if($this->db->affected_rows()>0):
				echo "\nIndeks Integritas terupdate";	
			else:
				echo "\nTidak ada perubahan indeks integritas ";
			endif;
			
			else:
			
			$data['idmfungsi'] = $_POST['ifbg'.$tabel_ke];
			$data['indeks_fungsi'] = $_POST['if_fix_'.$tabel_ke];
			$data['total_indeks_klas'] = $_POST['iklas_fix_'.$tabel_ke];
			$data['idmwaktuguna'] = $_POST['iwp'.$tabel_ke];
			$data['indeks_waktuguna'] = $_POST['iwg_fix_'.$tabel_ke];
			$data['indeks_integritas'] = $_POST['indeks_integritas_'.$tabel_ke];
			$data['idheaderskr'] = $sess_transheader;
			$data['tabel_ke'] = $tabel_ke;
			
			$insert = $this->app_model->insertData('transintegritas',$data);
			
			if($this->db->affected_rows()>0):
				echo "\nIndeks Integritas tersimpan";	
			else:
				echo "\nGAGAL menyimpan indeks integritas. Periksa koneksi internet / Hubungi IT administrator anda";
			endif;
			
			endif;

		
		
		endif;
	}
	
	function deleteIntegrasinKlas($tabel_ke)
	{
		$sess_transheader = $this->session->userdata('idtransheader');
		$where['tabel_ke'] = $tabel_ke;
		$where['idheaderskr'] = $sess_transheader;
		$delete_klas = $this->app_model->deleteData('transklasifikasi',$where);
		if($this->db->affected_rows()>0):
				echo "Klasifikasi tabel_ke {$tabel_ke} terhapus";	
			else:
				echo "\nGAGAL menghapus. Periksa koneksi internet / Hubungi IT administrator anda";
			endif;
		$delete_int = $this->app_model->deleteData('transintegritas',$where);
		if($this->db->affected_rows()>0):
				echo "Integrasi tabel_ke {$tabel_ke} terhapus";	
			else:
				echo "\nGAGAL menyimpan indeks integritas. Periksa koneksi internet / Hubungi IT administrator anda";
			endif;
	}
	
	
	function simpanTransSKRD() 
	{
		
		$i=count($_POST['kode']);
		$sess_transheader = $this->session->userdata('idtransheader');
		$cek = $this->app_model->getSelectedData('transskr',array('idheaderskr'=>$sess_transheader));
		
		if ($cek->num_rows()>0):
		$wheredel['idheaderskr'] = $sess_transheader;
		$delete = $this->app_model->deleteData('transskr',$wheredel);
		$update_count = 0;
		for($a=0;$a<$i;$a++)
		{
			if(substr($_POST['indeks_integritas'][$a],-3)=="(b)")
			{$data['indeks_basement']="(b)";}else{$data['indeks_basement']="";}
			
			echo "data ke ". $a." tersimpan \n";
			$data['idmhargasat'] = $_POST['idmhargasatuan'][$a];
			$data['kode'] = $_POST['kode'][$a];
			$data['unit_bangunan'] = $_POST['unit_bangunan'][$a];
			$data['luas'] = $_POST['luas'][$a];
			$data['harga_satuan'] = $_POST['harga_satuan'][$a];
			$data['indeks_integritas'] = $_POST['indeks_integritas'][$a];
			$data['indeks_lingpem'] = $_POST['indeks_lingpem'][$a];
			$data['jumlah_unit'] = $_POST['jumlah_unit'][$a];
			$data['jumlah_ret'] = $_POST['jumlah_ret'][$a];
			$data['idheaderskr'] = $sess_transheader;
			$insert = $this->app_model->insertData('transskr',$data);
			if ($this->db->affected_rows()>0) {$update_count++;}
		}
		if($update_count>0):
			echo $update_count ." biaya retribusi terupdate";	
		else:
			echo "Tidak berhasil update rincian biaya retribusi. Ada beberapa kemungkinan \n1. Tidak ada data klasifikasi yang anda rubah \n2. Anda sudah menyimpan data sebelumnya \n3. Sistem GAGAL Mengupdate rincian indeks klasifikasi. Periksa koneksi internet / Hubungi IT administrator anda";
		endif;
		
		else:
		
		for($a=0;$a<$i;$a++)
		{
			if(substr($_POST['indeks_integritas'][$a],-3)=="(b)")
			{$data['indeks_basement']="(b)";}else{$data['indeks_basement']="";}
			
			echo "data ke ". $a." tersimpan \n";
			$data['idmhargasat'] = $_POST['idmhargasatuan'][$a];
			$data['kode'] = $_POST['kode'][$a];
			$data['unit_bangunan'] = $_POST['unit_bangunan'][$a];
			$data['luas'] = $_POST['luas'][$a];
			$data['harga_satuan'] = $_POST['harga_satuan'][$a];
			$data['indeks_integritas'] = $_POST['indeks_integritas'][$a];
			$data['indeks_lingpem'] = $_POST['indeks_lingpem'][$a];
			$data['jumlah_unit'] = $_POST['jumlah_unit'][$a];
			$data['jumlah_ret'] = $_POST['jumlah_ret'][$a];
			$data['idheaderskr'] = $sess_transheader;
			$insert = $this->app_model->insertData('transskr',$data);
		}
		if($this->db->affected_rows()>0):
			echo "Data rincian biaya retribusi tersimpan";	
		else:
			echo "GAGAL menyimpan rincian biaya retribusi. Periksa koneksi internet / Hubungi IT administrator anda";
		endif;
		
		endif;
	}
	
	function changeIntegrasi($nomer_row)
	{
		$sess_transheader = $this->session->userdata('idtransheader');
		$where['idheaderskr'] = $sess_transheader;
		$cek = $this->app_model->getSelectedData('transintegritas',$where);
		?>
		<select name="" id="changeIntegrasi">
			<option value="">-pilih-</option>
		<?php foreach($cek->result() as $row): ?>
			<option value="<?=$row->indeks_integritas?>"><?=$row->indeks_integritas?> - indeks ke - <?=$row->tabel_ke?></option>
		<?php endforeach; ?>
		</select>
		&nbsp;<input type="checkbox" name="basement" id="checkbox_basement" onclick="ibase_check(<?=$nomer_row?>)"> Basement
		
		<script>
			$('#changeIntegrasi').change(function(){
				var new_indeks = $('#changeIntegrasi option:selected').val();
				$('#i_integrasi<?=$nomer_row?>').text(new_indeks);
				hitungskrdblur(<?=$nomer_row?>);
			})
			function ibase_check(a)
			{
			if (document.getElementById('checkbox_basement').checked) {
				var new_indeks = Math.round($('#changeIntegrasi option:selected').val() * 1.3 * 100)/100 + "(b)";
				$('#i_integrasi<?=$nomer_row?>').text(new_indeks);
				hitungskrdblur(<?=$nomer_row?>);
			} else {
				var new_indeks = $('#changeIntegrasi option:selected').val();
				$('#i_integrasi<?=$nomer_row?>').text(new_indeks);
				hitungskrdblur(<?=$nomer_row?>);
			}
			}
		</script>
		<?php
	}
	
	function updateiiSKR($noskr)
	{
		$ii = $_POST['iii'];
		$ii_b = round($_POST['iii'] * 1.3 * 100) /100;
		$this->db->where('indeks_basement = ""');
		$update = $this->app_model->updateData('transskr',array('indeks_integritas'=>$ii),array('idheaderskr'=>$noskr));
		$this->db->where('indeks_basement = "(b)"');
		$update = $this->app_model->updateData('transskr',array('indeks_integritas'=>$ii_b),array('idheaderskr'=>$noskr));
		
		//----------SKRD EDIT
		$var['skr_ed'] = $this->app_model->getSelectedData('transskr',array('idheaderskr'=>$noskr));
		$var['hargasatuan'] = $this->app_model->getAllData('mhargasatuan');
		
		if($this->db->affected_rows()>0):
			$this->load->view('interface/inf_ed_wiz_4',$var);
		else:
			echo "gagal update ii";
			$this->load->view('interface/inf_ed_wiz_4',$var);
		endif;
	}
	
	function updateII1by1($var)
	{
		$var = explode("-",$var);
		$noskr = $var[0];
		$iike = $var[1]-1;
		$this->db->limit(1,$iike);
		$get = $this->app_model->getSelectedData('transskr',array('idheaderskr'=>$noskr));
		echo $get->row()->indeks_integritas;
		if($get->row()->indeks_basement != ""):
			echo " ".$get->row()->indeks_basement;
		endif;
	}
}