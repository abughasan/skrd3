<div class="main-content">
				<div class="main-content-inner">
					

					<div class="page-content">
						
						<div class="row">
							<div class="col-xs-12">
								
								<table class="skrd_report_awal" border="1" width="100%" >
									<tr>
										<td colspan="3">
										<div class="row">
											<div class="col-sm-2">
												<H5>PEMERINTAH <BR/>CILEGON</H5>
											</div>
											<div class="col-sm-10">
												<H3 align="center">SURAT KETETAPAN RETRIBUSI<BR/>
												( SKR )</H3>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-4">
																						<BR/>
																						<BR/>
											NAMA 	<BR/>
											ALAMAT	<BR/>
											<br/>
											NOMOR POKOK WAJIB PAJAK DAERAH (NPWPD) <BR/>
											TANGGAL JATUH TEMPO <BR/>
											</div>
											<div class="col-sm-8">
																						<BR/>
											MASA TAHUN 2015<br/>
												: <?=@$wajibretribusi->row()->nama?> / <?=@$wajibretribusi->row()->pt?><br/>
												: <?=@$wajibretribusi->row()->alamat?><br/>
												&nbsp;&nbsp;<?=$propinsi->row()->propinsi_name?>, <?=$kota->row()->kota_name?> <?=$kecamatan->row()->kecamatan_name?> <?=@$desa->row()->desa_name?><br/>
												:<br/>
												:<br/>
											</div>
										</div>
										</td>
										<td align="center">
											NO URUT
											<h5><?=$idheaderskr;?></h5>
										</td>
									</tr>
									<tr>
										<td>
											NO
										</td>
										<td align="center">
											KODE REKENING
										</td>
										<td align="center">
											URAIAN RETRIBUSI DAERAH
										</td>
										<td align="center">
											JUMLAH
										</td>
									</tr>
									<tr>
										<td valign="top" width="10px">
											1
										</td>
										<td>
											
										</td>
										<td>
											Retribusi Ijin Mendirikan Bangunan (IMB)<BR/>
											<div class="row">
											<div class="col-sm-2">
												Fungsi Bangunan <BR/>
												Lokasi 
											</div>
											<div class="col-sm-8">
												: <?=$fungsi->row()->parameter?> (<?=$bangunan->row()->jenis_bangunan?>)<br/>
												: <?=$bangunan->row()->lokasi?><br/>
											</div>
											</div>
										</td>
										<td>
											
										</td>
									</tr>
									<tr>
										<td rowspan="3">
											
										</td>
										<td rowspan="3">
											
										</td>
										<td  align="center">
											Jumlah Ketetapan Pokok Retribusi
										</td>
										<td class="jkpr autonum" align="right"><?=$total_retribusi_pemb?>
										</td>
									</tr>
									<tr>
										<td>
										<div class="row">
											<div class="col-sm-6">
												Jumlah Sanksi<br/>
											</div>
											<div class="col-sm-6">
												:	a. Bunga<br/>
												: b. Kenaikan
											</div>
										</div>
											 
											
										</td>
										<td>
											
										</td>
									</tr>
									<tr>
										<td>
											Jumlah Keseluruhan
										</td>
										<td class="jkpr autonum" align="right"><?=$total_retribusi_pemb?>
										</td>
									</tr>
									<tr>
										<td colspan="4" class="terbilang_ret_awal">
											Dengan Huruf : <span></span><br/>
											<u>PERHATIAN :</u> <br/>
											<ol>
												<li>Harap penyetoran dilakukan pada Bank/Bendahara Penerima......</li>
												<li>Apabila SKR ini tidak atau dibayar lewat waktu paling lama 30 hari setelah SKR diterima atau (tanggal jatuh tempo) dikenakan sanksi administrasi berupa bunga sebesar 2% per bulan</li>
											</ol>
										</td>
									</tr>
									<tr>
										<td colspan="4">
											<div class="row">
												<div class="col-sm-4 col-sm-offset-8">
													Cilegon, 1 April 2015<br/>
													Pengguna Anggaran/Kuasa Pengguna Anggaran
													<p>&nbsp;</p>
													<p>&nbsp;</p>
													<p>&nbsp;</p>
													<U><?=$pengguna->row()->nama?></U><br/>
													NIP. <?=$pengguna->row()->nip?>
												</div>
											</div>
										</td>
									</tr>
								</table>
								<p>&nbsp;</p>

								Catatan : 
								<ol>
									<li>Penetapan jumlah SKR Daerah didasarkan pada nota perhitungan sebagai dasar penetapan pajak</li>
									<li>Untuk Retribusi seperti Retribusi Pasar, Retribusi Parkir, Retribusi Pelayaan Kesehatan dan jenis lainnya, format SKR dapat berupa karcis dan bentuk lainnya sebagai alat bukti penarikan</li>
								</ol>
								<table class="table table-bordered">
									<tr>
										<td>
										<div class="row">
											<div class="col-sm-6">
												<B><U>TANDA TERIMA SKR</U></B><BR/><BR/>
												NAMA : <br/>
												ALAMAT : 
											</div>
											<div class="col-sm-6">
												<br/>
												<br/>
												<br/>
												Yang Menerima
											</div>
										</td>
									</tr>
								</table>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12"><br/>
								<a href="<?=base_url()?>report/skrd_lampiran/<?=$idheaderskr?>" class="btn btn-lg btn-danger hidden-print">lihat lampiran</a>
							</div>
						</div>
					</div>
					</div>
					</div>