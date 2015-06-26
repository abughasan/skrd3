<h3 class="lighter block green">1.1 INDEKS LINGKUP PEMBANGUNAN</h3>
														

															<div class="form-group ilp-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="ilp">Lingkup Bangunan</label>

																<div class="col-xs-12 col-sm-9">
																	<select id="ilp" name="ilp"  data-placeholder="Pilih Lingkup Bangunan...">
																	<option value="">&nbsp;</option>
																	<?php foreach($lingkup as $row): ?>
																		<option value="<?=$row->idmlingkup?>"><?=$row->lingkup?></option>
																	<?php endforeach; ?>
																	</select>
																</div>
															</div>
															
															<div class="space-2"></div>

															<div class="form-group lingkupsub-group ">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="lingkupsub">Lingkup Sub</label>

																<div class="col-xs-12 col-sm-9">
																	<select id="lingkupsub" name="lingkupsub"  data-placeholder="Lingkup Sub...">
																	
																	</select>
																</div>
															</div>
															
															<div class="form-group lingkupsubdet-group ">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="lingkupsubdet">Lingkup Sub Detail</label>

																<div class="col-xs-12 col-sm-9">
																	<select id="lingkupsubdet" name="lingkupsubdet"  data-placeholder="Lingkup Sub det...">
																	
																	</select>
																</div>
															</div>
															
															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="ilp_fix">Indeks Lingkup Pembangunan:</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		<input type="text" name="ilp_fix" id="ilp_fix" class="col-xs-12 col-sm-4" readonly="true" />
																	</div>
																</div>
															</div>

															<div class="hr hr-dotted"></div>

<div class="widget-box integrasi_1">
												<div class="widget-header">
													<h4 class="widget-title">Indeks Integrasi (1)</h4>

													<span class="widget-toolbar">

														<a href="#" data-action="collapse">
															<i class="ace-icon fa fa-chevron-up"></i>
														</a>
														
													</span>
												</div>

												<div style="display: block;" class="widget-body">
													<div class="widget-main">


<h3 class="lighter block green">1.2 INDEKS INTEGRITAS</h3>
<h3 class="lighter block blue">1.2.1 INDEKS FUNGSI BANGUNAN GEDUNG</h3>
<form class="form-horizontal" id="form_integrasi_1" method="get">

															<div class="form-group ilp-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="ifbg">Fungsi Bangunan</label>

																<div class="col-xs-12 col-sm-9">
																	<select id="ifbg" name="ifbg" data-placeholder="Pilih Fungsi Bangunan...">
																	<option value="">&nbsp;</option>
																	<?php foreach($fungsi as $row): ?>
																		<option value="<?=$row->idmfungsi?>*<?=$row->indeks?>*<?=$row->keterangan?>"><?=$row->parameter?></option>
																	<?php endforeach; ?>
																	</select>
																</div>
															</div>
															
															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="ket_fungsi">Keterangan:</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		<input type="text" name="ket_fungsi" id="ket_fungsi" class="col-xs-12 col-sm-9" readonly="true" />
																	</div>
																</div>
															</div>
															
															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="if_fix">Indeks Fungsi:</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		<input type="text" name="if_fix" id="if_fix" class="col-xs-12 col-sm-4" readonly="true" />
																	</div>
																</div>
															</div>
															
															<div class="space-2"></div>

<h3 class="lighter block blue">1.2.2 INDEKS KLASIFIKASI</h3>
															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="if_fix">Input Klasifikasi Bangunan:</label>
																
																<div class="col-xs-12 col-sm-10">
																	<div class="clearfix">
																		<table class="table table-striped table-bordered table-hover"> 
																			<tr>
																				<th>No</th>
																				<th>Klasifikasi</th>
																				<th>Bobot</th>
																				<th>Parameter</th>
																				<th>Indeks</th>
																				<th>Bobot x Indeks</th>
																			</tr>
																			<?php $no=0;foreach($klasifikasi->result() as $row): 
																			$no++;
																			?>
																			<tr>
																				<td class="idmklas" id="idmklas<?=$no?>"><?=$row->idmklasifikasi?></td>
																				<td class="param" id="param<?=$no?>"><?=$row->parameter?></td>
																				<td class="bobot" id="bobot<?=$no?>"><?=$row->bobot?></td>
																				<td>
																				<select class="parameter idparameter" id="parameter<?=$no?>" name="parameter<?=$no?>">
																					<option value=""></option>
																					<?php $var = $this->app_model->getSelectedData('mklasifikasisub',array('idmklas'=>$row->idmklasifikasi))->result() ?>
																					
																					<?php foreach($var as $row): ?>
																						<option value="<?=$row->idmklasifikasisub?>*<?=$row->indeks?>"><?=$row->parametersub?></option>
																					<?php endforeach; ?>
																				</select>
																				</td>
																				<td><input class="indeksparamsub" id="indeksparamsub<?=$no?>" name="indeksparamsub" type="text"></td>
																				<td><input class="bobotxindeks" name="bobotxindeks" id="bobotxindeks<?=$no?>" type="text"><input id="bobotxindeks_hide<?=$no?>" type="hidden"></td>
																			</tr>
																			<?php endforeach; ?>
																		</table>
																		<button id="btn_klasifikasi" class="btn btn-primary btn-lg" type="button">Total Indeks Klasifikasi (Klik untuk hitung!)</button>
																	</div>
																</div>
															</div>
															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="iklas_fix">Indeks Klasifikasi:</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		<input type="text" name="iklas_fix" id="iklas_fix" class="col-xs-12 col-sm-4" readonly="true" />
																		<input type="hidden" id="iklas_fix_hide" />
																	</div>
																</div>
															</div>
															<div class="space-2"></div>															
<h3 class="lighter block blue">1.2.3 WAKTU PENGGUNAAN</h3>

															<div class="form-group iwp-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="iwp">Fungsi Bangunan</label>

																<div class="col-xs-12 col-sm-9">
																	<select id="iwp" name="iwp" class="" data-placeholder="Pilih Waktu Penggunaan...">
																	<option value="">&nbsp;</option>
																	<?php foreach($waktuguna->result() as $row): ?>
																		<option value="<?=$row->idmwaktuguna?>*<?=$row->indeks?>*<?=$row->keterangan?>"><?=$row->parameter?></option>
																	<?php endforeach; ?>
																	</select>
																</div>
															</div>
															
															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="ket_waktuguna">Keterangan:</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		<input type="text" name="ket_waktuguna" id="ket_waktuguna" class="col-xs-12 col-sm-9" readonly="true" />
																	</div>
																</div>
															</div>
															
															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="iwg_fix">Indeks Waktu Guna:</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		<input type="text" name="iwg_fix" id="iwg_fix" class="col-xs-12 col-sm-4" readonly="true" />
																	</div>
																</div>
															</div>
															
															<div class="space-2"></div>

<h3 class="lighter block blue">1.2.4 PERHITUNGAN INDEKS INTEGRITAS</h3>
															
															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="indeks_integritas">Indeks Integritas:</label>

																<div class="col-xs-12 col-sm-10">
																	<div class="clearfix">
																	<table class="table table-striped table-bordered table-hover">
																		<tr>
																			<th>I. Fungsi</th>
																			<th></th>
																			<th>I. Klasifikasi</th>
																			<th></th>
																			<th>Waktu Guna</th>
																			<th></th>
																			<th>I. Integritas</th>
																		</tr>
																		<tr>
																			<td><input id="if_fix2" name="if_fix2" type="text" class=""></td>
																			<td>x</td>
																			<td><input id="iklas_fix2" name="iklas_fix2" type="text" class=""></td>
																			<td>x</td>
																			<td><input id="iwg_fix2" name="iwgfix2" type="text" class=""></td>
																			<td>=</td>
																			<td><input id="indeks_integritas" name="indeks_integritas" type="text" class=""></td>
																		</tr>
																	</table>
																	<button id="btn_integritas" class="btn btn-warning btn-lg" type="button">Total Indeks Klasifikasi (Klik untuk hitung!)</button>
																	<button id="btn_tambah_1" onclick="tambah_integrasi(2)" class="btn btn-danger btn-lg" type="button">Tambah Indeks Klasifikasi dan Integrasi</button>
																	</div>
																</div>
															</div>
<!-- widget box-->
														</form>
													</div>
</div>

</div>															
<div id="canvas_tambah"></div>