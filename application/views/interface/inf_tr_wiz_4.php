<h3 class="lighter block green">Perhitungan Biaya Retribusi</h3>
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
																		<tr id="skrd_row1" class="skrd_row">
																			<td class="no_skrd" id="no_skrd_1">1</td>
																			<td>
																			<select class="kode_skrd" id="kode_skrd1" name="kode_skrd" onchange="kodeskrd_change(1)">
																					<option value="">Select</option>
																					<?php foreach($hargasatuan->result() as $row): ?>
																						<option value="<?=$row->kode?>*<?=$row->idmhargasatuan?>*<?=$row->harga_satuan?>"><?=$row->kode?>-<?=$row->jenis_bangunan?> </option>
																					<?php endforeach; ?>
																				</select>
																			</td>
																			<td><input size="30" id="unit_bangunan1" name="unit_bangunan" type="text" class=""></td>
																			<td id="tdluas1"><input onblur="hitungskrdblur(1)" id="luas1"  data-a-dec="," data-a-sep="." size="7" name="luas" type="text" class="luasb"></td>
																			<td id='i_integrasi1' style="cursor:pointer" class='skrd_integrasi' onclick="changeIntegrasi(1)" title="Klik untuk ganti indeks integrasi"></td>
																			<td id='i_lingpemb1' class='skrd_lingpem'></td>
																			<td id="skrd_satuan_1">harga satuan</td>
																			<td id="tdjmlunit1"><input id="jmlunit1" size="5" name="jmlunit" type="text" onblur="hitungskrdblur(1)" class="" value=1></td>
																			<td><input id="jumlah_skrd1" size="15" name="jumlah_skrd" type="text" class="jumlah_skrd">
																			<span class="refreshskrd ui-icon ace-icon fa fa-refresh green" style="cursor:pointer" onclick="hitungskrdblur(1)"></span>
																			</td>
																			<td>
																			<span class="hapusskrd ui-icon ace-icon fa fa-trash-o red" style="cursor:pointer" onclick="alert('not allow')"></span>
																			</td>
																		</tr>
																	</table>
																	<button id="btn_tambah_skrd" class="btn btn-warning btn-lg" type="button">Tambah Bangunan / Prasarana (Klik untuk tambah!)</button>
																	<button id="btn_total_skrd" class="btn btn-success btn-lg" type="button">Total Biaya Retribusi</button>
																	<button id="btn_reset_total_skrd" class="btn btn-danger btn-lg hide" type="button">Reset Total</button>
																	<button id="btn_simpan_skrd" class="btn btn-primary btn-lg" type="button">Simpan Biaya Retribusi </button>
																	</div>
																</div>
														</div>
														</form>
<style>
	.kode_skrd {width:100px!important}
</style>