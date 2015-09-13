<h3 class="lighter block green">Data Wajib Retribusi</h3>

														<form class="form-horizontal" id="validation-form" method="get">
															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="namawr">Nama Wajib Retribusi:</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		<input type="text" name="namawr" id="namawr" class="col-xs-12 col-sm-6" value="<?=$wr->row()->nama?>" />
																	</div>
																</div>
															</div>

															<div class="space-2"></div>

															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="pt">Nama Perusahaan:</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		<input type="text" name="pt" id="pt" class="col-xs-12 col-sm-4"  value="<?=$wr->row()->pt?>"/>
																	</div>
																</div>
															</div>

															<div class="hr hr-dotted"></div>

															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="alamatpt">Alamat Perusahaan:</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		<input type="text" id="alamatpt" name="alamatpt" class="col-xs-12 col-sm-6" value="<?=$wr->row()->alamat?>" />
																	</div>
																</div>
															</div>
															
															<div class="space-2"></div>

															<div class="form-group propinsi-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="propinsi">Propinsi</label>

																<div class="col-xs-12 col-sm-9">
																	<select id="propinsi" name="propinsi" class="select2" data-placeholder="Pilih Propinsi...">
																	<option value="">&nbsp;</option>
																	<?php foreach($propinsi as $row): ?>
																		<option value="<?=$row->propinsi_id?>"  <?=(($wr->row()->propinsi_id==$row->propinsi_id) ? 'selected' : '')?>><?=$row->propinsi_name?></option>
																	<?php endforeach; ?>
																	</select>
																</div>
															</div>
															
															<div class="space-2"></div>

															<div class="form-group kota-group ">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="kota">Kota/Kabupaten</label>

																<div class="col-xs-12 col-sm-9">
																	<select id="kota" name="kota" class="select2" data-placeholder="Pilih Kota/Kabupaten...">
																	<option value="">&nbsp;</option>
																	<?php foreach($kabupaten as $row): ?>
																		<option value="<?=$row->kota_id?>"  <?=(($wr->row()->kota_id==$row->kota_id) ? 'selected' : '')?>><?=$row->kota_name?></option>
																	<?php endforeach; ?>
																	</select>
																</div>
															</div>
															
															<div class="space-2"></div>

															<div class="form-group kecamatan-group ">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="kecamatan">Kecamatan</label>

																<div class="col-xs-12 col-sm-9">
																	<select id="kecamatan" name="kecamatan" class="select2" data-placeholder="Pilih Kecamatan...">
																	<option value="">&nbsp;</option>
																	<?php foreach($kecamatan as $row): ?>
																		<option value="<?=$row->kecamatan_id?>"  <?=(($wr->row()->kecamatan_id==$row->kecamatan_id) ? 'selected' : '')?>><?=$row->kecamatan_name?></option>
																	<?php endforeach; ?>
																	</select>
																</div>
															</div>
															
															<div class="space-2"></div>

															<div class="form-group desa-group ">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="desa">Desa/Kelurahan</label>

																<div class="col-xs-12 col-sm-9">
																	<select id="desa" name="desa" class="select2" data-placeholder="Pilih Desa/Kelurahan...">
																	
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