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
		$var['interface'] = array("menu","dashboard","footer");
		$this->load->view('home',$var);
	}
}