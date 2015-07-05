<div class="main-content">
				<div class="main-content-inner">
					

					<div class="page-content">
						

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="space-6"></div>

								<div class="row">
									<div class="col-sm-12">
										<div class="widget-box transparent">
											<div class="widget-header widget-header-large">
												<h3 class="widget-title grey lighter">
													LAMPIRAN SURAT KETETEAPAN RETRIBUSI (SKR)
												</h3>

												<div class="widget-toolbar no-border invoice-info">
													<span class="invoice-info-label">No SKR:</span>
													<span class="red">#<?=$idheaderskr;?></span>

													<br />
													<span class="invoice-info-label">Tanggal:</span>
													<span class="blue"><?=$headerskr->row()->tgl_penetapan?></span>
												</div>

												<div class="widget-toolbar hidden-480">
													<a href="#">
														<i class="ace-icon fa fa-print"></i>
													</a>
												</div>
											</div>

											<div class="widget-body">
												<div class="widget-main padding-24">
													<div class="row">
														<div class="col-sm-6">
															<div class="row hidden-print">
																<div class="col-xs-11 label label-lg label-info arrowed-in arrowed-right">
																	<b>Info Perusahaan / Wajib Retribusi</b>
																</div>
															</div>

															<div>
																<ul class="list-unstyled spaced">
																	<li>
																		<i class="ace-icon fa fa-caret-right blue hidden-print"></i>
																		NAMA : <?=@$wajibretribusi->row()->nama?> / <?=@$wajibretribusi->row()->pt?>
																	</li>

																	<li>
																		<i class="ace-icon fa fa-caret-right blue hidden-print"></i>
																		ALAMAT : <?=@$wajibretribusi->row()->alamat?>
																	</li>

																	<li>
																		<i class="ace-icon fa fa-caret-right blue hidden-print"></i>
																		<?=$propinsi->row()->propinsi_name?>, <?=$kota->row()->kota_name?> <?=$kecamatan->row()->kecamatan_name?> <?=@$desa->row()->desa_name?>
																	</li>

																	<li class="divider"></li>

																</ul>
															</div>
														</div><!-- /.col -->

														<div class="col-sm-6">
															<div class="row hidden-print">
																<div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
																	<b>Informasi Gedung / Prasarana</b>
																</div>
															</div>

															<div>
																<ul class="list-unstyled  spaced">
																	<li>
																		<i class="ace-icon fa fa-caret-right green hidden-print"></i>
																		Fungsi Bangunan : <?=$fungsi->row()->parameter?> (<?=$bangunan->row()->jenis_bangunan?>)
																	</li>

																	<li>
																		<i class="ace-icon fa fa-caret-right green hidden-print"></i>
																		Lokasi : <?=$bangunan->row()->lokasi?>
																	</li>

																	<li>
																		<i class="ace-icon fa fa-caret-right green hidden-print"></i>
																		<?=$kecamatan_b->row()->kecamatan_name?> <?=@$desa_b->row()->desa_name?>
																	</li>

																	
																</ul>
															</div>
														</div><!-- /.col -->
														
													</div><!-- /.row -->
													
													<div class="hr hr1 hr-double hr-dotted hidden-print"></div>
													
													<div class="row">

													<div class="col-sm-12">
													<h3> PENETAPAN INDEKS </H3>
															<div class="report_skrd">
																<h4>1.1 INDEKS LINGKUP PEMBANGUNAN</h4>
																Parameter : <?=$ilp->row()->lingkupsubdet?><br/>
																Indeks : <?=$headerskr->row()->index_lingpem ?>
															</div>
															
															<div class="space-2"></div>
															
													</div>
													</div>
				<?php foreach($cek_num_tabel->result() as $row):	?>
				<div class="integrasi widget-box" style="padding:10px">	
													<div class="row">
													<div class="col-sm-12">
															<div class="report_skrd">
																<h4>1.2 INDEKS INTEGRASI</h4>
																<h5>1.2.1 INDEKS FUNGSI BANGUNAN</h5>
																Parameter : <?=${'ifb_'.$row->tabel_ke}->row()->parameter?><br/>
																Indeks : <?=${'transintegrasi_'.$row->tabel_ke}->row()->indeks_fungsi ?>
																
															</div>
															
															<div class="space-2"></div>
													</div>
													</div>
													<div class="report_skrd">
																<h5>1.2.1 INDEKS KLASIFIKASI BANGUNAN</h4>
													</div>
													
													
													<div>
														<table class="table table-striped table-bordered table-condensed">
															<thead>
																<tr>
																	<th class="center">No</th>
																	<th>Klasifikasi</th>
																	<th class="hidden-xs">Bobot</th>
																	<th class="hidden-480">Parameter</th>
																	<th>Indeks</th>
																	<th>Bobot x Indeks</th>
																</tr>
															</thead>

															<tbody>
															<?php
															$a=0;
															foreach (${'klasifikasi_'.$row->tabel_ke}->result() as $baris): 
															$a++;
															?>
																<tr>
																	<td class="center"><?=$a?></td>

																	<td>
																		<?=$baris->parameter?>
																	</td>
																	<td class="hidden-xs">
																		<?=$baris->bobot?>
																	</td>
																	<td class="hidden-480">
																		<?=$baris->parametersub?>
																	</td>
																	<td>
																		<?=$baris->indeks?>
																	</td>
																	<td>
																		<?=$baris->boboxindeks?>
																	</td>
																</tr>

																<?php endforeach; ?>
																<tr>
																	<td colspan="5">JUMLAH (INDEKS Klasifikasi)</td>
																	<td><?=${'transintegrasi_'.$row->tabel_ke}->row()->total_indeks_klas ?></td>
																</tr>
															</tbody>
														</table>
													</div>
													
													<div class="row">
														<div class="col-sm-12">
															<div class="report_skrd">
																<h5>1.2.3 INDEKS WAKTU GUNA  </h5>
																Parameter : <?=@${'iwg_'.$row->tabel_ke}->row()->parameter?><br/>
																Indeks : <?=${'transintegrasi_'.$row->tabel_ke}->row()->indeks_waktuguna ?>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-sm-12">
															<div class="report_skrd">
																<h5>1.2.4 PERHITUNGAN INDEKS TERINTEGRASI</h5>
															</div>
														</div>
														<div class="col-xs-3"> INDEKS Fungsi</div>
														<div class="col-xs-1"> X</div>
														<div class="col-xs-3"> INDEKS Klasifikasi</div>
														<div class="col-xs-1"> X</div>
														<div class="col-xs-3"> INDEKS Waktu Guna </div>
														<div class="col-xs-1"> </div>
														<!--- NILAI -->
														<div class="col-xs-3"> <?=${'transintegrasi_'.$row->tabel_ke}->row()->indeks_fungsi ?></div>
														<div class="col-xs-1"> X</div>
														<div class="col-xs-3"> <?=${'transintegrasi_'.$row->tabel_ke}->row()->total_indeks_klas ?></div>
														<div class="col-xs-1"> X</div>
														<div class="col-xs-2"> <?=${'transintegrasi_'.$row->tabel_ke}->row()->indeks_waktuguna ?></div>
														<div class="col-xs-2"> = <?=${'transintegrasi_'.$row->tabel_ke}->row()->indeks_integritas ?></div>
													</div>
				</div>
				<?php endforeach; ?>
													<div class="hr hr8 hr-double hr-dotted"></div>

													<h3> PERHITUNGAN BESARNYA BIAYA RETRIBUSI </H3>
													
													<div class="row">
														<div class="col-sm-12">
															<table class="table table-striped table-bordered table-condensed">
															<thead>
																<tr>
																	<th class="center">No</th>
																	<th>Kode</th>
																	<th class="">Unit Bangunan</th>
																	<th class="">Luas Bangunan</th>
																	<th>IIG</th>
																	<th>ILP</th>
																	<th>Harga Satuan</th>
																	<th class="hidden-sm">Unit</th>
																	<th>Jumlah</th>
																</tr>
															</thead>

															<tbody>
															<?php
															$a=0;
															foreach ($skr->result() as $baris): 
																?>
																<tr>
																	<td><?=$a?></td>
																	<td><?=$baris->kode?></td>
																	<td><?=$baris->unit_bangunan?></td>
																	<td><?=$baris->luas?></td>
																	<td><?=$baris->indeks_integritas?></td>
																	<td><?=$baris->indeks_lingpem?></td>
																	<td><?=$baris->harga_satuan?></td>
																	<td><?=$baris->jumlah_unit?></td>
																	<td class="jumlah_ret autonum" align="right"><?=$baris->jumlah_ret?></td>
																</tr>
																<?php
															$a++;
															?>
															
															<?php endforeach; ?>
																<tr>
																	<td	colspan="8">TOTAL</td>
																	<td align="right" class="total_ret autonum"></td>
																</tr>
																<tr>
																	<td	colspan="8">PEMBULATAN</td>
																	<td align="right" class="pemb_ret autonum"></td>
																</tr>
																<tr>
																	<td	colspan="9" class="terbilang_ret">TERBILANG : <span></span></td>
																</tr>
															</tbody>
															</table>
														</div>
													</div>
													
													<div class="row">
														<div class="col-xs-6" align="center">
														KABID PENGENDALIAN BANGUNAN<br/>
														DAN REKLAME DINAS TATA KOTA<br/>
														KOTA CILEGON
														<p>&nbsp;</p>
														<p>&nbsp;</p>
														<p>&nbsp;</p>
														<u><?=$kabid->row()->nama?></u><br/>
														NIP : <?=$kabid->row()->nip?><br/>
														</div>
														<div class="col-xs-6" align="center">
														KASIE PENGENDALIAN TEKNIS<br/>
														BANGUNAN DINAS TATA KOTA<br/>
														KOTA CILEGON
														<p>&nbsp;</p>
														<p>&nbsp;</p>
														<p>&nbsp;</p>
														<u><?=$kasie->row()->nama?></u><br/>
														NIP : <?=$kasie->row()->nip?><br/>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
			