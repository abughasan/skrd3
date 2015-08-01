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
}