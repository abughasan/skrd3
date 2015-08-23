<h3 class="lighter block green">1.1 INDEKS LINGKUP PEMBANGUNAN</h3>
														
<form class="form-horizontal" id="" method="get">
															<div class="form-group ilp-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="ilp">Lingkup Bangunan</label>

																<div class="col-xs-12 col-sm-9">
																	<select id="ilp" name="ilp"  data-placeholder="Pilih Lingkup Bangunan...">
																	<option value="">&nbsp;</option>
																	<?php foreach($lingkup as $row): ?>
																		<option value="<?=$row->idmlingkup?>" <?=(($row->idmlingkup == $ls->row()->idmlingkup) ? 'selected' : '' )?>><?=$row->lingkup?></option>
																	<?php endforeach; ?>
																	</select>
																</div>
															</div>
															
															<div class="space-2"></div>

															<div class="form-group lingkupsub-group ">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="lingkupsub">Lingkup Sub</label>

																<div class="col-xs-12 col-sm-9">
																	<select id="lingkupsub" name="lingkupsub"  data-placeholder="Lingkup Sub...">
																	<option value="">&nbsp;</option>
																	<?php foreach($ilp_sub->result() as $row): ?>
																		<option value="<?=$row->idmlingkupsub?>" selected><?=$row->lingkupsub?> - <?=$row->keterangan?></option>
																	<?php endforeach; ?>
																	</select>
																</div>
															</div>
															
															<div class="form-group lingkupsubdet-group ">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="lingkupsubdet">Lingkup Sub Detail</label>

																<div class="col-xs-12 col-sm-9">
																	<select id="lingkupsubdet" name="lingkupsubdet"  data-placeholder="Lingkup Sub det...">
																		<option value="">&nbsp;</option>
																		<?php foreach($ilp_subdet->result() as $row): ?>
																			<option value="<?=$row->idmlingkupsubdet?>*<?=$row->indeks?>" selected><?=$row->lingkupsubdet?> - indeks : <?=$row->indeks?></option>
																		<?php endforeach; ?>
																	</select>
																</div>
															</div>
															
															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="ilp_fix">Indeks Lingkup Pembangunan:</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		<input type="text" value="<?=$ilp->row()->index_lingpem?>" name="ilp_fix" id="ilp_fix" class="col-xs-12 col-sm-4" readonly="true" />
																	</div>
																</div>
															</div>

															<div class="hr hr-dotted"></div>
</form>

<form class="form-horizontal" id="form_integrasi_1" method="get"> <input type="hidden" value="1" name="tabel_ke"/>
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


															<div class="form-group ilp-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="ifbg">Fungsi Bangunan</label>

																<div class="col-xs-12 col-sm-9">
																	<select id="ifbg" name="ifbg" data-placeholder="Pilih Fungsi Bangunan...">
																	<option value="">&nbsp;</option>
																	<?php foreach($fungsi as $row): ?>
																		<option value="<?=$row->idmfungsi?>*<?=$row->indeks?>*<?=$row->keterangan?>" <?=(($row->idmfungsi == $int->row()->idmfungsi) ? 'selected' : '' )?>><?=$row->parameter?></option>
																	<?php endforeach; ?>
																	</select>
																</div>
															</div>
															
															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="ket_fungsi">Keterangan:</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		<input type="text" name="ket_fungsi" value="<?=$int_idmfungsi_ket->row()->keterangan?>" id="ket_fungsi" class="col-xs-12 col-sm-9" readonly="true" />
																	</div>
																</div>
															</div>
															
															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="if_fix">Indeks Fungsi:</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		<input type="text" value="<?=$int->row()->indeks_fungsi?>" name="if_fix" id="if_fix" class="col-xs-12 col-sm-4" readonly="true" />
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
																			$k="klas_".$no;
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
																						<option value="<?=$row->idmklasifikasisub?>*<?=$row->indeks?>" <?=(($row->idmklasifikasisub == $$k->row()->idmklassub ) ? 'selected': '')?>><?=$row->parametersub?></option>
																					<?php endforeach; ?>
																				</select>
																				</td>
																				<td><input class="indeksparamsub" id="indeksparamsub<?=$no?>" name="indeksparamsub" type="text" value="<?=$$k->row()->indeks?>"></td>
																				<td>
																					<input class="bobotxindeks" name="bobotxindeks" id="bobotxindeks<?=$no?>" type="text" value="<?=$$k->row()->boboxindeks?>">
																					<input id="bobotxindeks_hide<?=$no?>" type="hidden"  value="<?=$$k->row()->boboxindeks?>">
																				</td>
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
																		<input type="text" name="iklas_fix" id="iklas_fix" class="col-xs-12 col-sm-4" readonly="true" value="<?=$int->row()->total_indeks_klas?>"/>
																		<input type="hidden" id="iklas_fix_hide" value="<?=$int->row()->total_indeks_klas?>"/>
																	</div>
																</div>
															</div>
															<div class="space-2"></div>															
<h3 class="lighter block blue">1.2.3 WAKTU PENGGUNAAN</h3>

															<div class="form-group iwp-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="iwp">Jangka Waktu Guna</label>

																<div class="col-xs-12 col-sm-9">
																	<select id="iwp" name="iwp" class="" data-placeholder="Pilih Waktu Penggunaan...">
																	<option value="">&nbsp;</option>
																	<?php foreach($waktuguna->result() as $row): ?>
																		<option value="<?=$row->idmwaktuguna?>*<?=$row->indeks?>*<?=$row->keterangan?>" <?=(($row->idmwaktuguna == $int->row()->idmwaktuguna) ? 'selected' : '' )?>><?=$row->parameter?></option>
																	<?php endforeach; ?>
																	</select>
																</div>
															</div>
															
															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="ket_waktuguna">Keterangan:</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		<input type="text" name="ket_waktuguna" id="ket_waktuguna" class="col-xs-12 col-sm-9" readonly="true" value="<?=$int_idwg_ket->row()->keterangan?>"/>
																	</div>
																</div>
															</div>
															
															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="iwg_fix">Indeks Waktu Guna:</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		<input type="text" name="iwg_fix" id="iwg_fix" class="col-xs-12 col-sm-4" readonly="true" value="<?=$int->row()->indeks_waktuguna?>" />
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
																			<td><input id="if_fix2" name="if_fix2" type="text" value="<?=$int->row()->indeks_fungsi?>"></td>
																			<td>x</td>
																			<td><input id="iklas_fix2" name="iklas_fix2" type="text" value="<?=$int->row()->total_indeks_klas?>"></td>
																			<td>x</td>
																			<td><input id="iwg_fix2" name="iwgfix2" type="text" value="<?=$int->row()->indeks_waktuguna?>"></td>
																			<td>=</td>
																			<td><input id="indeks_integritas" name="indeks_integritas" type="text" value="<?=$int->row()->indeks_integritas?>"></td>
																		</tr>
																	</table>
																	<button id="btn_integritas" class="btn btn-warning btn-lg" type="button">Total Indeks Klasifikasi (Klik untuk hitung!)</button>
																	<button id="btn_tambah_1" onclick="tambah_integrasi(2)" class="btn btn-danger btn-lg" type="button">Tambah Indeks Klasifikasi dan Integrasi</button>
																	</div>
																</div>
															</div>
<!-- widget box-->
														
													</div>
</div>

</div>							
</form>								
<div id="canvas_tambah"></div>
