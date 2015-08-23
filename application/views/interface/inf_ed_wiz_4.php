<h3 class="lighter block green">Edit Perhitungan Biaya Retribusi</h3>
														<form class="form-horizontal" id="validation-form3">
														<div class="form-group">
																<div class="col-xs-12 col-sm-12">
																	<div class="clearfix">
																	<table class="table table-bordered table-hover">
																		<tr>
																			<th>No</th>
																			<th>KODE</th>
																			<th>BANGUNAN</th>
																			<th>LUAS (M2)</th>
																			<th>Indeks<br/>Integrasi</th>
																			<th>Indeks<br/>Ling Pemb</th>
																			<th>Harga Satuan</th>
																			<th>Unit</th>
																			<th>Jumlah</th>
																			<th>*</th>
																		</tr>
																		<?php $i=0;foreach($skr_ed->result() as $r):$i++; ?>
																			<tr id="skrd_row<?=$i?>" class="skrd_row">
																			<td class="no_skrd" id="no_skrd_<?=$i?>"><?=$i?></td>
																			<td>
																			<select class="kode_skrd" id="kode_skrd<?=$i?>" name="kode_skrd" onchange="kodeskrd_change(<?=$i?>)">
																					<option value="">Select</option>
																					<?php foreach($hargasatuan->result() as $row): ?>
																						<option value="<?=$row->kode?>*<?=$row->idmhargasatuan?>*<?=$row->harga_satuan?>" <?=(($row->kode==$r->kode) ? 'selected' : '')?>><?=$row->kode?>-<?=$row->jenis_bangunan?> </option>
																					<?php endforeach; ?>
																				</select>
																			</td>
																			<td><input size="30" id="unit_bangunan<?=$i?>" name="unit_bangunan" type="text" value="<?=$r->unit_bangunan?>"></td>
																			<td id="tdluas<?=$i?>"><input onblur="hitungskrdblur(<?=$i?>)" id="luas<?=$i?>"  data-a-dec="," data-a-sep="." size="7" name="luas" type="text" class="luasb" value="<?=$r->luas?>"></td>
																			<td id='i_integrasi<?=$i?>' style="cursor:pointer" class='skrd_integrasi' onclick="changeIntegrasi(<?=$i?>)" title="Klik untuk ganti indeks integrasi"><?=$r->indeks_integritas?> <?=$r->indeks_basement?></td>
																			<td id='i_lingpemb<?=$i?>' class='skrd_lingpem'><?=$r->indeks_lingpem?></td>
																			<td id="skrd_satuan_<?=$i?>"><?=$r->harga_satuan?></td>
																			<td id="tdjmlunit<?=$i?>"><input id="jmlunit1" size="5" name="jmlunit" type="text" onblur="hitungskrdblur(<?=$i?>)" class="" value=<?=$r->jumlah_unit?>></td>
																			<td><input id="jumlah_skrd<?=$i?>" size="15" name="jumlah_skrd" type="text" class="jumlah_skrd" value="<?=$r->jumlah_ret?>">
																			<span class="refreshskrd ui-icon ace-icon fa fa-refresh green" style="cursor:pointer" onclick="hitungskrdblur(<?=$i?>)"></span>
																			</td>
																			<td>
																			<span class="hapusskrd ui-icon ace-icon fa fa-trash-o red" style="cursor:pointer" onclick="hapusskrd(<?=$i?>)"></span>
																			</td>
																		</tr>
																		<?php endforeach; ?>
																		
																		
																	</table>
																	<button id="btn_tambah_skrd" class="btn btn-warning btn-lg" type="button">Tambah Bangunan / Prasarana (Klik untuk tambah!)</button>
																	<button id="btn_total_skrd" class="btn btn-success btn-lg" type="button">Total Biaya Retribusi</button>
																	<button id="btn_reset_total_skrd" class="btn btn-danger btn-lg hide" type="button">Reset Total</button>
																	<button id="btn_update_skrd" class="hide btn btn-primary btn-lg" type="button">Update Biaya Retribusi </button>
																	</div>
																</div>
														</div>
														</form>
<style>
	.kode_skrd {width:100px!important}
</style>