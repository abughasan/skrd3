<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index()
	{
		$var['htmllang'] = "id";
		$var['metadesc'] = "";
		$var['metakeyword'] = "";
		$var['title'] = "Dashboard";
		$var['body_class'] = "no-skin";
		$var['assets_top'] = array("acebootstrap_css","fontawesome_css","ace_min_css","ace-extra_min_js");
		$var['assets_bottom'] = array("jquery","bootstrap_min_js","ace-script_min_js");
		$var['template'] = "standalone";
		$var['interface'] = array("force_login","menu","dashboard","footer");
		$this->load->view('home',$var);
	}
	public function login()
	{
		$var['htmllang'] = "id";
		$var['metadesc'] = "";
		$var['metakeyword'] = "";
		$var['title'] = "Dashboard";
		$var['body_class'] = "login-layout light-login";
		$var['assets_top'] = array("acebootstrap_css","fontawesome_css","ace_min_css","ace-extra_min_js");
		$var['assets_bottom'] = array("jquery","bootstrap_min_js","ace-script_min_js","login_js");
		$var['template'] = "blank";
		$var['interface'] = array("login");
		$this->load->view('home',$var);
	}
	public function login_cek()
	{
		$data['username'] = $_GET['username'];
		$data['password'] = $_GET['password'];
		
		$ceklogin = $this->app_model->getSelectedData('user',$data)->row();
			if(empty($ceklogin)) {
			// echo "salah";
				redirect('welcome/login?m=Maaf sandi salah','refresh');
			}else{
			// echo "benar";
				$sess_array = array(
				 'userid' => $ceklogin->iduser,
				 'username' => $ceklogin->username,
				 'userlevel' => $ceklogin->userlevel,
				);
				$this->session->set_userdata($sess_array);
				redirect('','refresh');			
			}
	}
	public function cekout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('iduser');
		$this->session->unset_userdata('userlevel');
		$user = $this->session->userdata('username');
		if(empty($user)) {
				redirect('welcome/login?m=Anda telah keluar','refresh');
		}
	}
	
	public function edit($noskr)
	{
		$var['htmllang'] = "id";
		$var['metadesc'] = "";
		$var['metakeyword'] = "";
		$var['title'] = "Dashboard";
		$var['body_class'] = "no-skin";
		$var['assets_top'] = array("acebootstrap_css","fontawesome_css","select-formwizard","googleapis_font","ace_min_css","ace-extra_min_js");
		$var['assets_bottom'] = array("jquery","bootstrap_min_js","formwizard_js_plugin","ace-script_min_js","autoNumeric_js","formwizard_js","edit_wizard_js");
		$var['template'] = "standalone";
		$var['interface'] = array("ed_wiz_4");
		$var['komponen_bottom'] = array("footer");
		
		// data dari database
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
	
}