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
		$var['assets_top'] = array("acebootstrap_css","fontawesome_css","select-formwizard","googleapis_font","ace_min_css","ace-extra_min_js");
		$var['assets_bottom'] = array("jquery","bootstrap_min_js","formwizard_js_plugin","ace-script_min_js","autoNumeric_js","formwizard_js");
		$var['template'] = "standalone";
		$var['interface'] = array("menu","report_skrd","footer");
		$idheaderskr2 = $this->uri->segment(3);
		$idheaderskr1 = $this->session->userdata('idtransheader');
		if($idheaderskr1):
			$idheaderskr = $idheaderskr1;
			$var['idheaderskr'] = $idheaderskr1;
		else:
			$idheaderskr = $idheaderskr2;
			$var['idheaderskr'] = $idheaderskr2;
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
		
		
		$this->load->view('home',$var);
	}
}