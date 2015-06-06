<h3 class="lighter block green">1.1 INDEKS LINGKUP PEMBANGUNAN</h3>
														<form class="form-horizontal" id="validation-form3" method="get">

															<div class="form-group ilp-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="ilp">Lingkup Bangunan</label>

																<div class="col-xs-12 col-sm-9">
																	<select id="ilp" name="ilp" class="select2" data-placeholder="Pilih Lingkup Bangunan...">
																	<option value="">&nbsp;</option>
																	<?php foreach($lingkup as $row): ?>
																		<option value="<?=$row->idmlingkup?>"><?=$row->lingkup?></option>
																	<?php endforeach; ?>
																	</select>
																</div>
															</div>
															
															<div class="space-2"></div>

															<div class="form-group lingkupsub-group hide">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="lingkupsub">Lingkup Sub</label>

																<div class="col-xs-12 col-sm-9">
																	<select id="lingkupsub" name="lingkupsub" class="select2" data-placeholder="Lingkup Sub...">
																	
																	</select>
																</div>
															</div>
															
															<div class="form-group lingkupsubdet-group hide">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="lingkupsubdet">Lingkup Sub Detail</label>

																<div class="col-xs-12 col-sm-9">
																	<select id="lingkupsubdet" name="lingkupsubdet" class="select2" data-placeholder="Lingkup Sub det...">
																	
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
<h3 class="lighter block green">1.2 INDEKS TERINTEGRASI</h3>
<h3 class="lighter block blue">1.2.1 INDEKS FUNGSI BANGUNAN GEDUNG</h3>


															<div class="form-group ilp-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="ifbg">Fungsi Bangunan</label>

																<div class="col-xs-12 col-sm-9">
																	<select id="ifbg" name="ifbg" class="select2" data-placeholder="Pilih Fungsi Bangunan...">
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
																		<input type="text" name="ket_fungsi" id="ket_fungsi" class="col-xs-12 col-sm-4" readonly="true" />
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
																				<td><?=$no?></td>
																				<td><?=$row->parameter?></td>
																				<td id="bobot<?=$no?>"><?=$row->bobot?></td>
																				<td>
																				<select class="select2" id="parameter<?=$no?>" name="parameter<?=$no?>">
																					<option value=""></option>
																					<?php $var = $this->app_model->getSelectedData('mklasifikasisub',array('idmklas'=>$row->idmklasifikasi))->result() ?>
																					
																					<?php foreach($var as $row): ?>
																						<option value="<?=$row->indeks?>"><?=$row->parametersub?></option>
																					<?php endforeach; ?>
																				</select>
																				</td>
																				<td><input id="indeksparamsub<?=$no?>" type="text" class=""></td>
																				<td><input id="bobotxindeks<?=$no?>" type="text" class=""></td>
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
																	</div>
																</div>
															</div>

														</form>