<?php
$user = $this->session->userdata('username');
		if(empty($user)) {
				redirect('welcome/login?m=Anda telah keluar','refresh');
		}