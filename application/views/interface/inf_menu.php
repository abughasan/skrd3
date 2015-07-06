<div id="sidebar" class="sidebar responsive">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>

				<div class="sidebar-shortcuts hide" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="ace-icon fa fa-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
					<li class="">
						<a href="<?=base_url()?>">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>
					<li class="<?php ((isset($mmaster_data)) ? print $mmaster_data : ""); ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> Master Data </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="<?php ((isset($mlingkup)) ? print $mlingkup : ""); ?>">
								<a href="<?=base_url()?>master/lingkup">
									<i class="menu-icon fa fa-caret-right"></i>
									Lingkup Pembangunan
								</a>

								<b class="arrow"></b>
							</li>

							<li class="<?php ((isset($mfungsi)) ? print $mfungsi : ""); ?>">
								<a href="<?=base_url()?>master/fungsi">
									<i class="menu-icon fa fa-caret-right"></i>
									Fungsi Bangunan
								</a>

								<b class="arrow"></b>
							</li>
							
							<li class="<?php ((isset($mklasifikasi)) ? print $mklasifikasi : ""); ?>">
								<a href="<?=base_url()?>master/klasifikasi">
									<i class="menu-icon fa fa-caret-right"></i>
									Klasifikasi Bangunan
								</a>

								<b class="arrow"></b>
							</li>
							
							<li class="<?php ((isset($mwaktuguna)) ? print $mwaktuguna : ""); ?>">
								<a href="<?=base_url()?>master/waktu">
									<i class="menu-icon fa fa-caret-right"></i>
									Waktu Penggunaan
								</a>

								<b class="arrow"></b>
							</li>
							
							<li class="<?php ((isset($mhargasatuan)) ? print $mhargasatuan : ""); ?>">
								<a href="<?=base_url()?>master/hargasatuan">
									<i class="menu-icon fa fa-caret-right"></i>
									Harga Satuan
								</a>

								<b class="arrow"></b>
							</li>	
							<li class="<?php ((isset($dkasie)) ? print $dkasie : ""); ?>">
								<a href="<?=base_url()?>master/kasie">
									<i class="menu-icon fa fa-users"></i>
									Data Kasie
								</a>

								<b class="arrow"></b>
							</li>	
							<li class="<?php ((isset($dkabid)) ? print $dkabid : ""); ?>">
								<a href="<?=base_url()?>master/kabid">
									<i class="menu-icon fa fa-users"></i>
									Data Kabid
								</a>

								<b class="arrow"></b>
							</li>
							<li class="<?php ((isset($dpenggunaanggaran)) ? print $dpenggunaanggaran : ""); ?>">
								<a href="<?=base_url()?>master/penggunaanggaran">
									<i class="menu-icon fa fa-users"></i>
									Data Pengguna Anggaran
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>

					<li class="">
						<a href="<?=base_url()?>transaksi">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text"> Transaksi </span>
						</a>

						<b class="arrow"></b>
					</li>
					<li class="">
						<a href="<?=base_url()?>report/all">
							<i class="menu-icon fa fa-book"></i>
							<span class="menu-text"> Laporan </span>
						</a>

						<b class="arrow"></b>
					</li>
				</ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
			</div>