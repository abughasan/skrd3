<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {
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
	public function lingkup()
	{
		$var['htmllang'] = "id";
		$var['metadesc'] = "";
		$var['metakeyword'] = "";
		$var['title'] = "Master Lingkup";
		$var['body_class'] = "no-skin";
		$var['mmaster_data'] = "active open";
		$var['mlingkup'] = "active";
		$var['assets_top'] = array("acebootstrap_css","fontawesome_css","jquery-ui_css","datepicker_css","ui_jqgrid_css","ace_min_css","ace-extra_min_js");
		$var['assets_bottom'] = array("jquery","bootstrap_min_js","datepicker_js","jqgrid_js","ace-script_min_js","jqgrid_auto");
		$var['template'] = "standalone";
		$var['interface'] = array("force_login","menu","jqgrid","footer");
		
		#------------------------------------------------------------------------------------------------------------
		#	jQGrid variable dimulai dari sini 							KETERANGAN
		#------------------------------------------------------------------------------------------------------------
		
		// $var['interface'] = array('grid');								#--- Tambahkan interface grid di template kolom 2
		$mode = $this->uri->segment(3);
		$var['jqgrid'] = 'table_interface_jqgrid';					#--- meload javascript jqgrid interface
		$var['table'] = 'mlingkup';									#--- mendefinisikan nama table yang dipanggil ke jqgrid
		$var['kolom'] = $this->_getkolom($var['table']);				#--- memanggil private fungsi _getkolom. lihat fungsi _getkolom utk ket lebih lanjut
		$var['jqgrid_at_name'] = array(								#--- mendefinisikan nama kolom pada jqgrid
				$var['kolom'][1] => 'ID',								#    didefnikan  berdasarkan urutan kolom 
				$var['kolom'][2] => 'Paramter',							#    misalkan kolom[1] namanya ID, kolom[2] namanya Nama, dst
				// $var['kolom'][3] => 'Indeks',												
				// $var['kolom'][4] => 'Keterangan',												
		);
		$var['jqgrid_at'] = array(										#--- mendefinisikan attribut kolom pada jqgrid
			$var['kolom'][1] => 'hidden:false,width:30',				#    didefnikan  berdasarkan urutan kolom 
			$var['kolom'][2] => 'hidden:false,width:200,editable:true',				#    didefnikan  berdasarkan urutan kolom 
			// $var['kolom'][3] => 'hidden:false,width:100',				#    didefnikan  berdasarkan urutan kolom 
			// 	$var['kolom'][4] => 'editable:true,width:650',						#    misalkan kolom[1] attributnua hidden:false, kolom[2] attributnya width:100, dst
		);
		// $var['jqgrid_at'][$var['kolom'][3]] = 'editable:true,edittype:"select",width:250,';		#--- mendefinisikan attribut kolom diluar format array default
					
		$var['button_nav'] = array(									#--- Tambahkan tombol perintah di jqgrid
			'add' => true,												#    tersedia tombol add, reload, cari dan delete
			'reload' => true,											#    cara mengaktifkannya dengan memberi nilai TRUE pada key variabel array
			'delete' => true,
			'cari' => true,
		);
		$var['join'] = array(											  #--- mengaktifkan fungsi join table di jqgird
			'id_i_guru'	=> array( 'i_guru-idid'	=>	'nama' ), #	contoh :
			'id_mtd'	=> array( 'm_tunjangan_detail-idid'	=>	'detail_tunjangan' ),  #	'id_lembaga'	=> array( 'm_lembaga-idid'			=>	'desc' ),
			// 'id_status'		=> array( 'm_status-idid'	=>	'status' ),  
		);																  
		
		if ( empty ( $mode ) ):
			$this->load->view('home',$var);
		endif;
		if (isset($mode) and $mode == 'load' ):
			$this->load->view('jqgrid/table_load_jqgrid',$var);
		endif;
		if (isset($mode) and $mode == 'update' ):
			$this->load->view('jqgrid/table_update_jqgrid',$var);
		endif;
	}
	
	public function klasifikasi()
	{
		$var['htmllang'] = "id";
		$var['metadesc'] = "";
		$var['metakeyword'] = "";
		$var['title'] = "Master Klasifikasi";
		$var['body_class'] = "no-skin";
		$var['mmaster_data'] = "active open";
		$var['mklasifikasi'] = "active";
		$var['assets_top'] = array("acebootstrap_css","fontawesome_css","jquery-ui_css","datepicker_css","ui_jqgrid_css","ace_min_css","ace-extra_min_js");
		$var['assets_bottom'] = array("jquery","bootstrap_min_js","datepicker_js","jqgrid_js","ace-script_min_js","jqgrid_auto");
		$var['template'] = "standalone";
		$var['interface'] = array("force_login","menu","jqgrid","footer");
		
		#------------------------------------------------------------------------------------------------------------
		#	jQGrid variable dimulai dari sini 							KETERANGAN
		#------------------------------------------------------------------------------------------------------------
		
		// $var['interface'] = array('grid');								#--- Tambahkan interface grid di template kolom 2
		$mode = $this->uri->segment(3);
		$var['jqgrid'] = 'table_interface_jqgrid';					#--- meload javascript jqgrid interface
		$var['table'] = 'mklasifikasi';									#--- mendefinisikan nama table yang dipanggil ke jqgrid
		$var['kolom'] = $this->_getkolom($var['table']);				#--- memanggil private fungsi _getkolom. lihat fungsi _getkolom utk ket lebih lanjut
		$var['jqgrid_at_name'] = array(								#--- mendefinisikan nama kolom pada jqgrid
				$var['kolom'][1] => 'ID',								#    didefnikan  berdasarkan urutan kolom 
				$var['kolom'][2] => 'Paramter',							#    misalkan kolom[1] namanya ID, kolom[2] namanya Nama, dst
				$var['kolom'][3] => 'Bobot',												
				// $var['kolom'][4] => 'Satuan',												
				// $var['kolom'][5] => 'harga_satuan',												
				// $var['kolom'][6] => 'keterangan',												
		);
		$var['jqgrid_at'] = array(										#--- mendefinisikan attribut kolom pada jqgrid
			$var['kolom'][1] => 'hidden:false,width:20',				#    didefnikan  berdasarkan urutan kolom 
			$var['kolom'][2] => 'hidden:false,width:250',				#    didefnikan  berdasarkan urutan kolom 
			$var['kolom'][3] => 'hidden:false,width:100',				#    didefnikan  berdasarkan urutan kolom 
			// $var['kolom'][4] => 'editable:true,width:50',						#    misalkan kolom[1] attributnua hidden:false, kolom[2] attributnya 
			// $var['kolom'][5] => 'editable:true,width:100',						#    misalkan kolom[1] attributnua hidden:false, kolom[2] attributnya width:100, dst
			// $var['kolom'][6] => 'editable:true,width:400',						#    misalkan kolom[1] attributnua hidden:false, kolom[2] attributnya width:100, dst
		);
		// $var['jqgrid_at'][$var['kolom'][3]] = 'editable:true,edittype:"select",width:250,';		#--- mendefinisikan attribut kolom diluar format array default
					
		$var['button_nav'] = array(									#--- Tambahkan tombol perintah di jqgrid
			'add' => true,												#    tersedia tombol add, reload, cari dan delete
			'reload' => true,											#    cara mengaktifkannya dengan memberi nilai TRUE pada key variabel array
			'delete' => true,
			'cari' => true,
		);
		$var['join'] = array(											  #--- mengaktifkan fungsi join table di jqgird
			'id_i_guru'	=> array( 'i_guru-idid'	=>	'nama' ), #	contoh :
			'id_mtd'	=> array( 'm_tunjangan_detail-idid'	=>	'detail_tunjangan' ),  #	'id_lembaga'	=> array( 'm_lembaga-idid'			=>	'desc' ),
			// 'id_status'		=> array( 'm_status-idid'	=>	'status' ),  
		);																  
		
		if ( empty ( $mode ) ):
			$this->load->view('home',$var);
		endif;
		if (isset($mode) and $mode == 'load' ):
			$this->load->view('jqgrid/table_load_jqgrid',$var);
		endif;
		if (isset($mode) and $mode == 'update' ):
			$this->load->view('jqgrid/table_update_jqgrid',$var);
		endif;
	}
	public function fungsi()
	{
		$var['htmllang'] = "id";
		$var['metadesc'] = "";
		$var['metakeyword'] = "";
		$var['title'] = "Master Fungsi";
		$var['body_class'] = "no-skin";
		$var['mmaster_data'] = "active open";
		$var['mfungsi'] = "active";
		$var['assets_top'] = array("acebootstrap_css","fontawesome_css","jquery-ui_css","datepicker_css","ui_jqgrid_css","ace_min_css","ace-extra_min_js");
		$var['assets_bottom'] = array("jquery","bootstrap_min_js","datepicker_js","jqgrid_js","ace-script_min_js","jqgrid_auto");
		$var['template'] = "standalone";
		$var['interface'] = array("force_login","menu","jqgrid","footer");
		
		#------------------------------------------------------------------------------------------------------------
		#	jQGrid variable dimulai dari sini 							KETERANGAN
		#------------------------------------------------------------------------------------------------------------
		
		// $var['interface'] = array('grid');								#--- Tambahkan interface grid di template kolom 2
		$mode = $this->uri->segment(3);
		$var['jqgrid'] = 'table_interface_jqgrid';					#--- meload javascript jqgrid interface
		$var['table'] = 'mfungsi';									#--- mendefinisikan nama table yang dipanggil ke jqgrid
		$var['kolom'] = $this->_getkolom($var['table']);				#--- memanggil private fungsi _getkolom. lihat fungsi _getkolom utk ket lebih lanjut
		$var['jqgrid_at_name'] = array(								#--- mendefinisikan nama kolom pada jqgrid
				$var['kolom'][1] => 'ID',								#    didefnikan  berdasarkan urutan kolom 
				$var['kolom'][2] => 'Paramter',							#    misalkan kolom[1] namanya ID, kolom[2] namanya Nama, dst
				$var['kolom'][3] => 'Indeks',												
				$var['kolom'][4] => 'Keterangan',												
				// $var['kolom'][4] => 'Satuan',												
				// $var['kolom'][5] => 'harga_satuan',												
				// $var['kolom'][6] => 'keterangan',												
		);
		$var['jqgrid_at'] = array(										#--- mendefinisikan attribut kolom pada jqgrid
			$var['kolom'][1] => 'hidden:false,width:20',				#    didefnikan  berdasarkan urutan kolom 
			$var['kolom'][2] => 'editable:true,width:150',				#    didefnikan  berdasarkan urutan kolom 
			$var['kolom'][3] => 'editable:true,width:50',				#    didefnikan  berdasarkan urutan kolom 
			$var['kolom'][4] => 'editable:true,width:600',						#    misalkan kolom[1] attributnua hidden:false, kolom[2] attributnya 
			// $var['kolom'][5] => 'editable:true,width:100',						#    misalkan kolom[1] attributnua hidden:false, kolom[2] attributnya width:100, dst
			// $var['kolom'][6] => 'editable:true,width:400',						#    misalkan kolom[1] attributnua hidden:false, kolom[2] attributnya width:100, dst
		);
		// $var['jqgrid_at'][$var['kolom'][3]] = 'editable:true,edittype:"select",width:250,';		#--- mendefinisikan attribut kolom diluar format array default
					
		$var['button_nav'] = array(									#--- Tambahkan tombol perintah di jqgrid
			'add' => true,												#    tersedia tombol add, reload, cari dan delete
			'reload' => true,											#    cara mengaktifkannya dengan memberi nilai TRUE pada key variabel array
			'delete' => true,
			'cari' => true,
		);
		$var['join'] = array(											  #--- mengaktifkan fungsi join table di jqgird
			'id_i_guru'	=> array( 'i_guru-idid'	=>	'nama' ), #	contoh :
			'id_mtd'	=> array( 'm_tunjangan_detail-idid'	=>	'detail_tunjangan' ),  #	'id_lembaga'	=> array( 'm_lembaga-idid'			=>	'desc' ),
			// 'id_status'		=> array( 'm_status-idid'	=>	'status' ),  
		);																  
		
		if ( empty ( $mode ) ):
			$this->load->view('home',$var);
		endif;
		if (isset($mode) and $mode == 'load' ):
			$this->load->view('jqgrid/table_load_jqgrid',$var);
		endif;
		if (isset($mode) and $mode == 'update' ):
			$this->load->view('jqgrid/table_update_jqgrid',$var);
		endif;
	}
	public function hargasatuan()
	{
		$var['htmllang'] = "id";
		$var['metadesc'] = "";
		$var['metakeyword'] = "";
		$var['title'] = "Master Harga Satuan";
		$var['body_class'] = "no-skin";
		$var['mmaster_data'] = "active open";
		$var['mhargasatuan'] = "active";
		$var['assets_top'] = array("acebootstrap_css","fontawesome_css","jquery-ui_css","datepicker_css","ui_jqgrid_css","ace_min_css","ace-extra_min_js");
		$var['assets_bottom'] = array("jquery","bootstrap_min_js","datepicker_js","jqgrid_js","ace-script_min_js","jqgrid_auto");
		$var['template'] = "standalone";
		$var['interface'] = array("force_login","menu","jqgrid","footer");
		
		#------------------------------------------------------------------------------------------------------------
		#	jQGrid variable dimulai dari sini 							KETERANGAN
		#------------------------------------------------------------------------------------------------------------
		
		// $var['interface'] = array('grid');								#--- Tambahkan interface grid di template kolom 2
		$mode = $this->uri->segment(3);
		$var['jqgrid'] = 'table_interface_jqgrid';					#--- meload javascript jqgrid interface
		$var['table'] = 'mhargasatuan';									#--- mendefinisikan nama table yang dipanggil ke jqgrid
		$var['kolom'] = $this->_getkolom($var['table']);				#--- memanggil private fungsi _getkolom. lihat fungsi _getkolom utk ket lebih lanjut
		$var['jqgrid_at_name'] = array(								#--- mendefinisikan nama kolom pada jqgrid
				$var['kolom'][1] => 'ID',								#    didefnikan  berdasarkan urutan kolom 
				$var['kolom'][2] => 'Kode',							#    misalkan kolom[1] namanya ID, kolom[2] namanya Nama, dst
				$var['kolom'][3] => 'Jenis Bangunan',												
				$var['kolom'][4] => 'Satuan',												
				$var['kolom'][5] => 'harga_satuan',												
				$var['kolom'][6] => 'keterangan',												
		);
		$var['jqgrid_at'] = array(										#--- mendefinisikan attribut kolom pada jqgrid
			$var['kolom'][1] => 'hidden:false,width:20',				#    didefnikan  berdasarkan urutan kolom 
			$var['kolom'][2] => 'editable:true,width:70',				#    didefnikan  berdasarkan urutan kolom 
			$var['kolom'][3] => 'editable:true,width:400',				#    didefnikan  berdasarkan urutan kolom 
			$var['kolom'][4] => 'editable:true,width:50',						#    misalkan kolom[1] attributnua hidden:false, kolom[2] attributnya 
			$var['kolom'][5] => 'editable:true,width:100',						#    misalkan kolom[1] attributnua hidden:false, kolom[2] attributnya width:100, dst
			$var['kolom'][6] => 'editable:true,width:400',						#    misalkan kolom[1] attributnua hidden:false, kolom[2] attributnya width:100, dst
		);
		// $var['jqgrid_at'][$var['kolom'][3]] = 'editable:true,edittype:"select",width:250,';		#--- mendefinisikan attribut kolom diluar format array default
					
		$var['button_nav'] = array(									#--- Tambahkan tombol perintah di jqgrid
			'add' => true,												#    tersedia tombol add, reload, cari dan delete
			'reload' => true,											#    cara mengaktifkannya dengan memberi nilai TRUE pada key variabel array
			'delete' => true,
			'cari' => true,
		);
		$var['join'] = array(											  #--- mengaktifkan fungsi join table di jqgird
			'id_i_guru'	=> array( 'i_guru-idid'	=>	'nama' ), #	contoh :
			'id_mtd'	=> array( 'm_tunjangan_detail-idid'	=>	'detail_tunjangan' ),  #	'id_lembaga'	=> array( 'm_lembaga-idid'			=>	'desc' ),
			// 'id_status'		=> array( 'm_status-idid'	=>	'status' ),  
		);																  
		
		if ( empty ( $mode ) ):
			$this->load->view('home',$var);
		endif;
		if (isset($mode) and $mode == 'load' ):
			$this->load->view('jqgrid/table_load_jqgrid',$var);
		endif;
		if (isset($mode) and $mode == 'update' ):
			$this->load->view('jqgrid/table_update_jqgrid',$var);
		endif;
	}
	
	public function waktu()
	{
		$var['htmllang'] = "id";
		$var['metadesc'] = "";
		$var['metakeyword'] = "";
		$var['title'] = "Master Waktu Penggunaan";
		$var['body_class'] = "no-skin";
		$var['mmaster_data'] = "active open";
		$var['mwaktuguna'] = "active";
		$var['assets_top'] = array("acebootstrap_css","fontawesome_css","jquery-ui_css","datepicker_css","ui_jqgrid_css","ace_min_css","ace-extra_min_js");
		$var['assets_bottom'] = array("jquery","bootstrap_min_js","datepicker_js","jqgrid_js","ace-script_min_js","jqgrid_auto");
		$var['template'] = "standalone";
		$var['interface'] = array("force_login","menu","jqgrid","footer");
		
		#------------------------------------------------------------------------------------------------------------
		#	jQGrid variable dimulai dari sini 							KETERANGAN
		#------------------------------------------------------------------------------------------------------------
		
		// $var['interface'] = array('grid');								#--- Tambahkan interface grid di template kolom 2
		$mode = $this->uri->segment(3);
		$var['jqgrid'] = 'table_interface_jqgrid';					#--- meload javascript jqgrid interface
		$var['table'] = 'mwaktuguna';									#--- mendefinisikan nama table yang dipanggil ke jqgrid
		$var['kolom'] = $this->_getkolom($var['table']);				#--- memanggil private fungsi _getkolom. lihat fungsi _getkolom utk ket lebih lanjut
		$var['jqgrid_at_name'] = array(								#--- mendefinisikan nama kolom pada jqgrid
				$var['kolom'][1] => 'ID',								#    didefnikan  berdasarkan urutan kolom 
				$var['kolom'][2] => 'Paramter',							#    misalkan kolom[1] namanya ID, kolom[2] namanya Nama, dst
				$var['kolom'][3] => 'Indeks',												
				$var['kolom'][4] => 'Keterangan',												
				// $var['kolom'][5] => 'harga_satuan',												
				// $var['kolom'][6] => 'keterangan',												
		);
		$var['jqgrid_at'] = array(										#--- mendefinisikan attribut kolom pada jqgrid
			$var['kolom'][1] => 'hidden:false,width:20',				#    didefnikan  berdasarkan urutan kolom 
			$var['kolom'][2] => 'hidden:false,width:200',				#    didefnikan  berdasarkan urutan kolom 
			$var['kolom'][3] => 'hidden:false,width:40',				#    didefnikan  berdasarkan urutan kolom 
			$var['kolom'][4] => 'editable:true,width:450',						#    misalkan kolom[1] attributnua hidden:false, kolom[2] attributnya 
			// $var['kolom'][5] => 'editable:true,width:100',						#    misalkan kolom[1] attributnua hidden:false, kolom[2] attributnya width:100, dst
			// $var['kolom'][6] => 'editable:true,width:400',						#    misalkan kolom[1] attributnua hidden:false, kolom[2] attributnya width:100, dst
		);
		// $var['jqgrid_at'][$var['kolom'][3]] = 'editable:true,edittype:"select",width:250,';		#--- mendefinisikan attribut kolom diluar format array default
					
		$var['button_nav'] = array(									#--- Tambahkan tombol perintah di jqgrid
			'add' => true,												#    tersedia tombol add, reload, cari dan delete
			'reload' => true,											#    cara mengaktifkannya dengan memberi nilai TRUE pada key variabel array
			'delete' => true,
			'cari' => true,
		);
		$var['join'] = array(											  #--- mengaktifkan fungsi join table di jqgird
			'id_i_guru'	=> array( 'i_guru-idid'	=>	'nama' ), #	contoh :
			'id_mtd'	=> array( 'm_tunjangan_detail-idid'	=>	'detail_tunjangan' ),  #	'id_lembaga'	=> array( 'm_lembaga-idid'			=>	'desc' ),
			// 'id_status'		=> array( 'm_status-idid'	=>	'status' ),  
		);																  
		
		if ( empty ( $mode ) ):
			$this->load->view('home',$var);
		endif;
		if (isset($mode) and $mode == 'load' ):
			$this->load->view('jqgrid/table_load_jqgrid',$var);
		endif;
		if (isset($mode) and $mode == 'update' ):
			$this->load->view('jqgrid/table_update_jqgrid',$var);
		endif;
	}
	
	public function kasie()
	{
		$var['htmllang'] = "id";
		$var['metadesc'] = "";
		$var['metakeyword'] = "";
		$var['title'] = "Master Kasie";
		$var['body_class'] = "no-skin";
		$var['mmaster_data'] = "active open";
		$var['dkasie'] = "active";
		$var['assets_top'] = array("acebootstrap_css","fontawesome_css","jquery-ui_css","datepicker_css","ui_jqgrid_css","ace_min_css","ace-extra_min_js");
		$var['assets_bottom'] = array("jquery","bootstrap_min_js","datepicker_js","jqgrid_js","ace-script_min_js","jqgrid_auto");
		$var['template'] = "standalone";
		$var['interface'] = array("force_login","menu","jqgrid","footer");
		
		#------------------------------------------------------------------------------------------------------------
		#	jQGrid variable dimulai dari sini 							KETERANGAN
		#------------------------------------------------------------------------------------------------------------
		
		// $var['interface'] = array('grid');								#--- Tambahkan interface grid di template kolom 2
		$mode = $this->uri->segment(3);
		$var['jqgrid'] = 'table_interface_jqgrid';					#--- meload javascript jqgrid interface
		$var['table'] = 'dkasie';									#--- mendefinisikan nama table yang dipanggil ke jqgrid
		$var['kolom'] = $this->_getkolom($var['table']);				#--- memanggil private fungsi _getkolom. lihat fungsi _getkolom utk ket lebih lanjut
		$var['jqgrid_at_name'] = array(								#--- mendefinisikan nama kolom pada jqgrid
				$var['kolom'][1] => 'ID',								#    didefnikan  berdasarkan urutan kolom 
				$var['kolom'][2] => 'NIP',							#    misalkan kolom[1] namanya ID, kolom[2] namanya Nama, dst
				$var['kolom'][3] => 'Nama',												
				$var['kolom'][4] => 'Jabatan',												
				$var['kolom'][5] => 'Dinas',												
				$var['kolom'][6] => 'Flag',												
				// $var['kolom'][5] => 'harga_satuan',												
				// $var['kolom'][6] => 'keterangan',												
		);
		$var['jqgrid_at'] = array(										#--- mendefinisikan attribut kolom pada jqgrid
			$var['kolom'][1] => 'hidden:false,width:20',				#    didefnikan  berdasarkan urutan kolom 
			$var['kolom'][2] => 'editable:true,width:200',				#    didefnikan  berdasarkan urutan kolom 
			$var['kolom'][3] => 'editable:true,width:200',				#    didefnikan  berdasarkan urutan kolom 
			$var['kolom'][4] => 'editable:true,width:100',						#    misalkan kolom[1] attributnua hidden:false, kolom[2] attributnya 
			$var['kolom'][5] => 'editable:true,width:100',						#    misalkan kolom[1] attributnua hidden:false, kolom[2] attributnya 
			$var['kolom'][6] => 'editable:true,width:100',						#    misalkan kolom[1] attributnua hidden:false, kolom[2] attributnya 
			// $var['kolom'][5] => 'editable:true,width:100',						#    misalkan kolom[1] attributnua hidden:false, kolom[2] attributnya width:100, dst
			// $var['kolom'][6] => 'editable:true,width:400',						#    misalkan kolom[1] attributnua hidden:false, kolom[2] attributnya width:100, dst
		);
		// $var['jqgrid_at'][$var['kolom'][3]] = 'editable:true,edittype:"select",width:250,';		#--- mendefinisikan attribut kolom diluar format array default
					
		$var['button_nav'] = array(									#--- Tambahkan tombol perintah di jqgrid
			'add' => true,												#    tersedia tombol add, reload, cari dan delete
			'reload' => true,											#    cara mengaktifkannya dengan memberi nilai TRUE pada key variabel array
			'delete' => true,
			'cari' => true,
		);
		$var['join'] = array(											  #--- mengaktifkan fungsi join table di jqgird
			// 'id_i_guru'	=> array( 'i_guru-idid'	=>	'nama' ), #	contoh :
			// 'id_mtd'	=> array( 'm_tunjangan_detail-idid'	=>	'detail_tunjangan' ),  #	'id_lembaga'	=> array( 'm_lembaga-idid'			=>	'desc' ),
			// 'id_status'		=> array( 'm_status-idid'	=>	'status' ),  
		);																  
		
		if ( empty ( $mode ) ):
			$this->load->view('home',$var);
		endif;
		if (isset($mode) and $mode == 'load' ):
			$this->load->view('jqgrid/table_load_jqgrid',$var);
		endif;
		if (isset($mode) and $mode == 'update' ):
			$this->load->view('jqgrid/table_update_jqgrid',$var);
		endif;
	}
	
	public function kabid()
	{
		$var['htmllang'] = "id";
		$var['metadesc'] = "";
		$var['metakeyword'] = "";
		$var['title'] = "Master Kabid";
		$var['body_class'] = "no-skin";
		$var['mmaster_data'] = "active open";
		$var['dkabid'] = "active";
		$var['assets_top'] = array("acebootstrap_css","fontawesome_css","jquery-ui_css","datepicker_css","ui_jqgrid_css","ace_min_css","ace-extra_min_js");
		$var['assets_bottom'] = array("jquery","bootstrap_min_js","datepicker_js","jqgrid_js","ace-script_min_js","jqgrid_auto");
		$var['template'] = "standalone";
		$var['interface'] = array("force_login","menu","jqgrid","footer");
		
		#------------------------------------------------------------------------------------------------------------
		#	jQGrid variable dimulai dari sini 							KETERANGAN
		#------------------------------------------------------------------------------------------------------------
		
		// $var['interface'] = array('grid');								#--- Tambahkan interface grid di template kolom 2
		$mode = $this->uri->segment(3);
		$var['jqgrid'] = 'table_interface_jqgrid';					#--- meload javascript jqgrid interface
		$var['table'] = 'dkabid';									#--- mendefinisikan nama table yang dipanggil ke jqgrid
		$var['kolom'] = $this->_getkolom($var['table']);				#--- memanggil private fungsi _getkolom. lihat fungsi _getkolom utk ket lebih lanjut
		$var['jqgrid_at_name'] = array(								#--- mendefinisikan nama kolom pada jqgrid
				$var['kolom'][1] => 'ID',								#    didefnikan  berdasarkan urutan kolom 
				$var['kolom'][2] => 'NIP',							#    misalkan kolom[1] namanya ID, kolom[2] namanya Nama, dst
				$var['kolom'][3] => 'Nama',												
				$var['kolom'][4] => 'Jabatan',												
				$var['kolom'][5] => 'Dinas',												
				$var['kolom'][6] => 'Flag',												
				// $var['kolom'][5] => 'harga_satuan',												
				// $var['kolom'][6] => 'keterangan',												
		);
		$var['jqgrid_at'] = array(										#--- mendefinisikan attribut kolom pada jqgrid
			$var['kolom'][1] => 'hidden:false,width:20',				#    didefnikan  berdasarkan urutan kolom 
			$var['kolom'][2] => 'editable:true,width:200',				#    didefnikan  berdasarkan urutan kolom 
			$var['kolom'][3] => 'editable:true,width:200',				#    didefnikan  berdasarkan urutan kolom 
			$var['kolom'][4] => 'editable:true,width:100',						#    misalkan kolom[1] attributnua hidden:false, kolom[2] attributnya 
			$var['kolom'][5] => 'editable:true,width:100',						#    misalkan kolom[1] attributnua hidden:false, kolom[2] attributnya 
			$var['kolom'][6] => 'editable:true,width:100',						#    misalkan kolom[1] attributnua hidden:false, kolom[2] attributnya 
			// $var['kolom'][5] => 'editable:true,width:100',						#    misalkan kolom[1] attributnua hidden:false, kolom[2] attributnya width:100, dst
			// $var['kolom'][6] => 'editable:true,width:400',						#    misalkan kolom[1] attributnua hidden:false, kolom[2] attributnya width:100, dst
		);
		// $var['jqgrid_at'][$var['kolom'][3]] = 'editable:true,edittype:"select",width:250,';		#--- mendefinisikan attribut kolom diluar format array default
					
		$var['button_nav'] = array(									#--- Tambahkan tombol perintah di jqgrid
			'add' => true,												#    tersedia tombol add, reload, cari dan delete
			'reload' => true,											#    cara mengaktifkannya dengan memberi nilai TRUE pada key variabel array
			'delete' => true,
			'cari' => true,
		);
		$var['join'] = array(											  #--- mengaktifkan fungsi join table di jqgird
			'id_i_guru'	=> array( 'i_guru-idid'	=>	'nama' ), #	contoh :
			'id_mtd'	=> array( 'm_tunjangan_detail-idid'	=>	'detail_tunjangan' ),  #	'id_lembaga'	=> array( 'm_lembaga-idid'			=>	'desc' ),
			// 'id_status'		=> array( 'm_status-idid'	=>	'status' ),  
		);																  
		
		if ( empty ( $mode ) ):
			$this->load->view('home',$var);
		endif;
		if (isset($mode) and $mode == 'load' ):
			$this->load->view('jqgrid/table_load_jqgrid',$var);
		endif;
		if (isset($mode) and $mode == 'update' ):
			$this->load->view('jqgrid/table_update_jqgrid',$var);
		endif;
	}
	public function penggunaanggaran()
	{
		$var['htmllang'] = "id";
		$var['metadesc'] = "";
		$var['metakeyword'] = "";
		$var['title'] = "Master Pengguna Anggaran";
		$var['body_class'] = "no-skin";
		$var['mmaster_data'] = "active open";
		$var['dpenggunaanggaran'] = "active";
		$var['assets_top'] = array("acebootstrap_css","fontawesome_css","jquery-ui_css","datepicker_css","ui_jqgrid_css","ace_min_css","ace-extra_min_js");
		$var['assets_bottom'] = array("jquery","bootstrap_min_js","datepicker_js","jqgrid_js","ace-script_min_js","jqgrid_auto");
		$var['template'] = "standalone";
		$var['interface'] = array("force_login","menu","jqgrid","footer");
		
		#------------------------------------------------------------------------------------------------------------
		#	jQGrid variable dimulai dari sini 							KETERANGAN
		#------------------------------------------------------------------------------------------------------------
		
		// $var['interface'] = array('grid');								#--- Tambahkan interface grid di template kolom 2
		$mode = $this->uri->segment(3);
		$var['jqgrid'] = 'table_interface_jqgrid';					#--- meload javascript jqgrid interface
		$var['table'] = 'dpenggunaanggaran';									#--- mendefinisikan nama table yang dipanggil ke jqgrid
		$var['kolom'] = $this->_getkolom($var['table']);				#--- memanggil private fungsi _getkolom. lihat fungsi _getkolom utk ket lebih lanjut
		$var['jqgrid_at_name'] = array(								#--- mendefinisikan nama kolom pada jqgrid
				$var['kolom'][1] => 'ID',								#    didefnikan  berdasarkan urutan kolom 
				$var['kolom'][2] => 'NIP',							#    misalkan kolom[1] namanya ID, kolom[2] namanya Nama, dst
				$var['kolom'][3] => 'Nama',												
				$var['kolom'][4] => 'Jabatan',												
				$var['kolom'][5] => 'Dinas',												
				$var['kolom'][6] => 'Flag',												
				// $var['kolom'][5] => 'harga_satuan',												
				// $var['kolom'][6] => 'keterangan',												
		);
		$var['jqgrid_at'] = array(										#--- mendefinisikan attribut kolom pada jqgrid
			$var['kolom'][1] => 'hidden:false,width:20',				#    didefnikan  berdasarkan urutan kolom 
			$var['kolom'][2] => 'editable:true,width:200',				#    didefnikan  berdasarkan urutan kolom 
			$var['kolom'][3] => 'editable:true,width:200',				#    didefnikan  berdasarkan urutan kolom 
			$var['kolom'][4] => 'editable:true,width:100',						#    misalkan kolom[1] attributnua hidden:false, kolom[2] attributnya 
			$var['kolom'][5] => 'editable:true,width:100',						#    misalkan kolom[1] attributnua hidden:false, kolom[2] attributnya 
			$var['kolom'][6] => 'editable:true,width:100',						#    misalkan kolom[1] attributnua hidden:false, kolom[2] attributnya 
			// $var['kolom'][5] => 'editable:true,width:100',						#    misalkan kolom[1] attributnua hidden:false, kolom[2] attributnya width:100, dst
			// $var['kolom'][6] => 'editable:true,width:400',						#    misalkan kolom[1] attributnua hidden:false, kolom[2] attributnya width:100, dst
		);
		// $var['jqgrid_at'][$var['kolom'][3]] = 'editable:true,edittype:"select",width:250,';		#--- mendefinisikan attribut kolom diluar format array default
					
		$var['button_nav'] = array(									#--- Tambahkan tombol perintah di jqgrid
			'add' => true,												#    tersedia tombol add, reload, cari dan delete
			'reload' => true,											#    cara mengaktifkannya dengan memberi nilai TRUE pada key variabel array
			'delete' => true,
			'cari' => true,
		);
		$var['join'] = array(											  #--- mengaktifkan fungsi join table di jqgird
			'id_i_guru'	=> array( 'i_guru-idid'	=>	'nama' ), #	contoh :
			'id_mtd'	=> array( 'm_tunjangan_detail-idid'	=>	'detail_tunjangan' ),  #	'id_lembaga'	=> array( 'm_lembaga-idid'			=>	'desc' ),
			// 'id_status'		=> array( 'm_status-idid'	=>	'status' ),  
		);																  
		
		if ( empty ( $mode ) ):
			$this->load->view('home',$var);
		endif;
		if (isset($mode) and $mode == 'load' ):
			$this->load->view('jqgrid/table_load_jqgrid',$var);
		endif;
		if (isset($mode) and $mode == 'update' ):
			$this->load->view('jqgrid/table_update_jqgrid',$var);
		endif;
	}
	
	public function user()
	{
		$var['htmllang'] = "id";
		$var['metadesc'] = "";
		$var['metakeyword'] = "";
		$var['title'] = "Manage User Aplikasi SKRD";
		$var['body_class'] = "no-skin";
		$var['mmaster_data'] = "active open";
		$var['duser'] = "active";
		$var['assets_top'] = array("acebootstrap_css","fontawesome_css","jquery-ui_css","datepicker_css","ui_jqgrid_css","ace_min_css","ace-extra_min_js");
		$var['assets_bottom'] = array("jquery","bootstrap_min_js","datepicker_js","jqgrid_js","ace-script_min_js","jqgrid_auto");
		$var['template'] = "standalone";
		$var['interface'] = array("force_login","menu","jqgrid","footer");
		
		#------------------------------------------------------------------------------------------------------------
		#	jQGrid variable dimulai dari sini 							KETERANGAN
		#------------------------------------------------------------------------------------------------------------
		
		// $var['interface'] = array('grid');								#--- Tambahkan interface grid di template kolom 2
		$mode = $this->uri->segment(3);
		$var['jqgrid'] = 'table_interface_jqgrid';					#--- meload javascript jqgrid interface
		$var['table'] = 'user';									#--- mendefinisikan nama table yang dipanggil ke jqgrid
		$var['kolom'] = $this->_getkolom($var['table']);				#--- memanggil private fungsi _getkolom. lihat fungsi _getkolom utk ket lebih lanjut
		$var['jqgrid_at_name'] = array(								#--- mendefinisikan nama kolom pada jqgrid
				$var['kolom'][1] => 'ID',								#    didefnikan  berdasarkan urutan kolom 
				$var['kolom'][2] => 'Username (login)',							#    misalkan kolom[1] namanya ID, kolom[2] namanya Nama, dst
				$var['kolom'][3] => 'Sandi',												
				$var['kolom'][4] => 'userlevel',																						
				// $var['kolom'][5] => 'harga_satuan',												
				// $var['kolom'][6] => 'keterangan',												
		);
		$var['jqgrid_at'] = array(										#--- mendefinisikan attribut kolom pada jqgrid
			$var['kolom'][1] => 'hidden:false,width:20',				#    didefnikan  berdasarkan urutan kolom 
			$var['kolom'][2] => 'editable:true,width:200',				#    didefnikan  berdasarkan urutan kolom 
			$var['kolom'][3] => 'editable:true,width:200',				#    didefnikan  berdasarkan urutan kolom 
			$var['kolom'][4] => 'editable:true,width:200',						#    misalkan kolom[1] attributnua hidden:false, kolom[2] attributnya 
			// $var['kolom'][5] => 'editable:true,width:100',						#    misalkan kolom[1] attributnua hidden:false, kolom[2] attributnya width:100, dst
			// $var['kolom'][6] => 'editable:true,width:400',						#    misalkan kolom[1] attributnua hidden:false, kolom[2] attributnya width:100, dst
		);
		// $var['jqgrid_at'][$var['kolom'][3]] = 'editable:true,edittype:"select",width:250,';		#--- mendefinisikan attribut kolom diluar format array default
					
		$var['button_nav'] = array(									#--- Tambahkan tombol perintah di jqgrid
			'add' => true,												#    tersedia tombol add, reload, cari dan delete
			'reload' => true,											#    cara mengaktifkannya dengan memberi nilai TRUE pada key variabel array
			'delete' => true,
			'cari' => true,
		);
		$var['join'] = array(											  #--- mengaktifkan fungsi join table di jqgird
			'id_i_guru'	=> array( 'i_guru-idid'	=>	'nama' ), #	contoh :
			'id_mtd'	=> array( 'm_tunjangan_detail-idid'	=>	'detail_tunjangan' ),  #	'id_lembaga'	=> array( 'm_lembaga-idid'			=>	'desc' ),
			// 'id_status'		=> array( 'm_status-idid'	=>	'status' ),  
		);																  
		
		if ( empty ( $mode ) ):
			$this->load->view('home',$var);
		endif;
		if (isset($mode) and $mode == 'load' ):
			$this->load->view('jqgrid/table_load_jqgrid',$var);
		endif;
		if (isset($mode) and $mode == 'update' ):
			$this->load->view('jqgrid/table_update_jqgrid',$var);
		endif;
	}
	
	# Fungsi pRIVATE ambil nama kolom dari table
	private function _getkolom($table)
	{
		$i=0;
		$fields = $this->db->list_fields($table);
		foreach ($fields as $field){$i++;$kolom[$i] = $field;}
		return $var['kolom'] = $kolom;
	}
}