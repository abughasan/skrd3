<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
	public function index()
	{
		echo "not allowed";
	}
	
	function skrd()
	{
		$var['htmllang'] = "id";
		$var['metadesc'] = "";
		$var['metakeyword'] = "";
		$var['title'] = "Dashboard";
		$var['body_class'] = "no-skin";
		$var['assets_top'] = array("acebootstrap_css","fontawesome_css","select-formwizard","googleapis_font","ace_min_css","ace-extra_min_js","report_css");
		$var['assets_bottom'] = array("jquery","bootstrap_min_js","formwizard_js_plugin","ace-script_min_js","autoNumeric_js","report1_js");
		$var['template'] = "standalone";
		$var['interface'] = array("menu","report_awal_skrd");
		$idheaderskr2 = $this->uri->segment(3);
		$idheaderskr1 = $this->session->userdata('idtransheader');
		if($idheaderskr2):
			$idheaderskr = $idheaderskr2;
			$var['idheaderskr'] = $idheaderskr2;
		else:
			$idheaderskr = $idheaderskr1;
			$var['idheaderskr'] = $idheaderskr1;
		endif;
		
		
		// data dari database
		//data transaksi utama
		$var['headerskr'] = $this->app_model->getSelectedData('transheaderskr',array('id'=>$idheaderskr));
		$var['transintegrasi'] = $this->app_model->getSelectedData('transintegritas',array('idheaderskr'=>$idheaderskr));
		$var['klasifikasi'] = $this->app_model->getSelectedData('transklasifikasi',array('idheaderskr'=>$idheaderskr));
		$var['skr'] = $this->app_model->getSelectedData('transskr',array('idheaderskr'=>$idheaderskr));
		
		// data perusahaan / nama
		$var['wajibretribusi'] = $this->app_model->getSelectedData('dwajibretribusi',array('id'=>$var['headerskr']->row()->idwajibret));
		$var['propinsi'] = $this->app_model->getSelectedData('mpropinsi',array('propinsi_id'=>$var['wajibretribusi']->row()->propinsi_id));
		$var['kota'] = $this->app_model->getSelectedData('mkota',array('kota_id'=>$var['wajibretribusi']->row()->kota_id));
		$var['kecamatan'] = $this->app_model->getSelectedData('mkecamatan',array('kecamatan_id'=>$var['wajibretribusi']->row()->kecamatan_id));
		$var['desa'] = $this->app_model->getSelectedData('mdesa',array('desa_id'=>$var['wajibretribusi']->row()->desa_id));
		
		//data gedung
		$var['bangunan'] = $this->app_model->getSelectedData('dbangunan',array('id'=>$var['headerskr']->row()->idbangunan));
		$var['fungsi'] = @$this->app_model->getSelectedData('mfungsi',array('idmfungsi'=>$var['transintegrasi']->row()->idmfungsi));
		$var['kecamatan_b'] = $this->app_model->getSelectedData('mkecamatan',array('kecamatan_id'=>$var['bangunan']->row()->kecamatan_id));
		$var['desa_b'] = $this->app_model->getSelectedData('mdesa',array('desa_id'=>$var['bangunan']->row()->desa_id));
		
		//penetapan indeks
		$var['ilp'] =$this->app_model->getSelectedData('mlingkupsubdet',array('idmlingkupsubdet'=>$var['headerskr']->row()->idmlingkupsubdet));
		
		$var['cek_num_tabel'] = $this->app_model->manualQuery("select distinct(tabel_ke) from transintegritas where idheaderskr = {$idheaderskr}");
		
		$var['total_retribusi'] = $this->app_model->manualQuery("SELECT SUM(jumlah_ret) tot FROM transskr WHERE idheaderskr = {$idheaderskr}");
		
		$var['total_retribusi_pemb'] = ceil($var['total_retribusi']->row()->tot / 1000) * 1000;
		$var['pengguna'] = $this->app_model->getSelectedData('dpenggunaanggaran',array('flag'=>'aktif'));
		
		$this->load->view('home',$var);
	}
	
	function skrd_lampiran()
	{
		$var['htmllang'] = "id";
		$var['metadesc'] = "";
		$var['metakeyword'] = "";
		$var['title'] = "Dashboard";
		$var['body_class'] = "no-skin";
		$var['assets_top'] = array("acebootstrap_css","fontawesome_css","select-formwizard","googleapis_font","ace_min_css","ace-extra_min_js","report_css");
		$var['assets_bottom'] = array("jquery","bootstrap_min_js","formwizard_js_plugin","ace-script_min_js","autoNumeric_js","report1_js");
		$var['template'] = "standalone";
		$var['interface'] = array("menu","report_skrd");
		$idheaderskr2 = $this->uri->segment(3);
		$idheaderskr1 = $this->session->userdata('idtransheader');
		if($idheaderskr2):
			$idheaderskr = $idheaderskr2;
			$var['idheaderskr'] = $idheaderskr2;
		else:
			$idheaderskr = $idheaderskr1;
			$var['idheaderskr'] = $idheaderskr1;
		endif;
		
		// data dari database
		//data transaksi utama
		$var['headerskr'] = $this->app_model->getSelectedData('transheaderskr',array('id'=>$idheaderskr));
		$var['transintegrasi'] = $this->app_model->getSelectedData('transintegritas',array('idheaderskr'=>$idheaderskr));
		$var['klasifikasi'] = $this->app_model->getSelectedData('transklasifikasi',array('idheaderskr'=>$idheaderskr));
		$var['skr'] = $this->app_model->getSelectedData('transskr',array('idheaderskr'=>$idheaderskr));
		
		// data perusahaan / nama
		$var['wajibretribusi'] = $this->app_model->getSelectedData('dwajibretribusi',array('id'=>$var['headerskr']->row()->idwajibret));
		$var['propinsi'] = $this->app_model->getSelectedData('mpropinsi',array('propinsi_id'=>$var['wajibretribusi']->row()->propinsi_id));
		$var['kota'] = $this->app_model->getSelectedData('mkota',array('kota_id'=>$var['wajibretribusi']->row()->kota_id));
		$var['kecamatan'] = $this->app_model->getSelectedData('mkecamatan',array('kecamatan_id'=>$var['wajibretribusi']->row()->kecamatan_id));
		$var['desa'] = $this->app_model->getSelectedData('mdesa',array('desa_id'=>$var['wajibretribusi']->row()->desa_id));
		
		//data gedung
		$var['bangunan'] = $this->app_model->getSelectedData('dbangunan',array('id'=>$var['headerskr']->row()->idbangunan));
		$var['fungsi'] = $this->app_model->getSelectedData('mfungsi',array('idmfungsi'=>$var['transintegrasi']->row()->idmfungsi));
		$var['kecamatan_b'] = $this->app_model->getSelectedData('mkecamatan',array('kecamatan_id'=>$var['bangunan']->row()->kecamatan_id));
		$var['desa_b'] = $this->app_model->getSelectedData('mdesa',array('desa_id'=>$var['bangunan']->row()->desa_id));
		
		//penetapan indeks
		$var['ilp'] =$this->app_model->getSelectedData('mlingkupsubdet',array('idmlingkupsubdet'=>$var['headerskr']->row()->idmlingkupsubdet));
		
		$var['cek_num_tabel'] = $this->app_model->manualQuery("select distinct(tabel_ke) from transintegritas where idheaderskr = {$idheaderskr}");
		
		foreach ($var['cek_num_tabel']->result() as $row):
			// echo $row->tabel_ke;
			$var['klasifikasi_'.$row->tabel_ke] = $this->app_model->getSelectedData('transklasifikasi',array('idheaderskr'=>$idheaderskr,'tabel_ke'=>$row->tabel_ke));
			$var['transintegrasi_'.$row->tabel_ke] = $this->app_model->getSelectedData('transintegritas',array('idheaderskr'=>$idheaderskr,'tabel_ke'=>$row->tabel_ke));
			
			$var['ifb_'.$row->tabel_ke] =$this->app_model->getSelectedData('mfungsi',array('idmfungsi'=>$var['transintegrasi_'.$row->tabel_ke]->row()->idmfungsi));
			$var['iwg_'.$row->tabel_ke] =$this->app_model->getSelectedData('mwaktuguna',array('idmwaktuguna'=>$var['transintegrasi_'.$row->tabel_ke]->row()->idmwaktuguna));
			
		endforeach;
		
		$var['kabid'] = $this->app_model->getSelectedData('dkabid',array('flag'=>'aktif'));
		$var['kasie'] = $this->app_model->getSelectedData('dkasie',array('flag'=>'aktif'));
		
		$this->load->view('home',$var);
	}
	
	function all()
	{
		$var['htmllang'] = "id";
		$var['metadesc'] = "";
		$var['metakeyword'] = "";
		$var['title'] = "Dashboard";
		$var['body_class'] = "no-skin";
		$var['assets_top'] = array("acebootstrap_css","jquery-ui_css","fontawesome_css","datatable_css","datatable_ext_tabletool_css","googleapis_font","ace_min_css","ace-extra_min_js","report_css");
		$var['assets_bottom'] = array("jquery","jquery-ui_js","datatable_js","datatable_ext_tabletool_js","datatable_plugins_daterange_js","bootstrap_min_js","ace-script_min_js","autoNumeric_js","reportall_js");
		$var['template'] = "standalone";
		$var['interface'] = array("menu","report_all");
		
		$this->db->order_by("id", "desc"); 
		$var['headerskr'] = $this->app_model->getAllData('transheaderskr');
		
		$this->load->view('home',$var);
	}
}