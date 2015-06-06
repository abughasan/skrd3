<h3 class="lighter block green">Data Bangunan</h3>

														<form class="form-horizontal" id="validation-form2" method="get">

															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="jenis_b">Jenis Bangunan:</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		<input type="text" name="jenis_b" id="jenis_b" class="col-xs-12 col-sm-4" />
																	</div>
																</div>
															</div>

															<div class="hr hr-dotted"></div>

															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="lokasi_b">Lokasi Pembangunan:</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		<input type="text" id="lokasi_b" name="lokasi_b" class="col-xs-12 col-sm-6" />
																	</div>
																</div>
															</div>
															
															<div class="space-2"></div>

															<div class="form-group kecamatan2-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="kecamatan2">Kecamatan</label>

																<div class="col-xs-12 col-sm-9">
																	<select id="kecamatan2" name="kecamatan2" class="select2" data-placeholder="Pilih Kecamatan...">
																	<option value="">&nbsp;</option>
																	<?php foreach($kecamatan as $row): ?>
																		<option value="<?=$row->kecamatan_id?>"><?=$row->kecamatan_name?></option>
																	<?php endforeach; ?>
																	</select>
																</div>
															</div>
															
															<div class="space-2"></div>

															<div class="form-group desa2-group hide">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="desa2">Desa/Kelurahan</label>

																<div class="col-xs-12 col-sm-9">
																	<select id="desa2" name="desa2" class="select2" data-placeholder="Pilih Desa/Kelurahan...">
																	
																	</select>
																</div>
															</div>
															
															<div class="space-2"></div>
															<!-- INPUT PHONE NUMBER
															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="phone">No Telp / Ponsel:</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="input-group">
																		<span class="input-group-addon">
																			<i class="ace-icon fa fa-phone"></i>
																		</span>

																		<input type="tel" id="phone" name="phone" />
																	</div>
																</div>
															</div> -->
															<!-- TOMBOL SIMPAN
															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="phone"></label>

																<div class="col-xs-12 col-sm-9">
																	<div class="input-group">
																		

																		<input type="submit" value="simpan" />
																	</div>
																</div>
															</div>
															-->
															
														</form>