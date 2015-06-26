<div class="widget-box integrasi_<?=$angka?>">
												<div class="widget-header">
													<h4 class="widget-title">Indeks Integrasi (<?=$angka?>)</h4>

													<span class="widget-toolbar">

														<a href="#" data-action="collapse">
															<i class="ace-icon fa fa-chevron-up"></i>
														</a>

														<a href="#" data-action="close" onclick="show_btn_integrasi(<?=$angka-1?>)">
															<i class="ace-icon fa fa-times"></i>
														</a>
													</span>
												</div>

												<div style="display: block;" class="widget-body">
													<div class="widget-main">
														
														<h3 class="lighter block green">1.2 INDEKS INTEGRITAS</h3>
<h3 class="lighter block blue">1.2.1 INDEKS FUNGSI BANGUNAN GEDUNG</h3>
<form class="form-horizontal" id="form_integrasi_<?=$angka?>" method="get">

															<div class="form-group ilp-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="ifbg<?=$angka?>">Fungsi Bangunan</label>

																<div class="col-xs-12 col-sm-9">
																	<select id="ifbg<?=$angka?>" name="ifbg<?=$angka?>" class="select2" data-placeholder="Pilih Fungsi Bangunan...">
																	<option value="">&nbsp;</option>
																	<?php foreach($fungsi as $row): ?>
																		<option value="<?=$row->idmfungsi?>*<?=$row->indeks?>*<?=$row->keterangan?>"><?=$row->parameter?></option>
																	<?php endforeach; ?>
																	</select>
																</div>
															</div>
															
															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="ket_fungsi<?=$angka?>">Keterangan:</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		<input type="text" name="ket_fungsi<?=$angka?>" id="ket_fungsi<?=$angka?>" class="col-xs-12 col-sm-9" readonly="true" />
																	</div>
																</div>
															</div>
															
															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="if_fix<?=$angka?>">Indeks Fungsi:</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		<input type="text" name="if_fix_<?=$angka?>" id="if_fix_<?=$angka?>" class="col-xs-12 col-sm-4" readonly="true" />
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
																				<td class="idmklas_<?=$angka?>" id="idmklas<?=$no?>_<?=$angka?>"><?=$row->idmklasifikasi?></td>
																				<td class="param_<?=$angka?>" id="param<?=$no?>_<?=$angka?>"><?=$row->parameter?></td>
																				<td class="bobot_<?=$angka?>" id="bobot<?=$no?>_<?=$angka?>"><?=$row->bobot?></td>
																				<td>
																				<select class="parameter idparameter_<?=$angka?>" id="parameter<?=$no?>_<?=$angka?>" name="parameter<?=$no?>_<?=$angka?>">
																					<option value=""></option>
																					<?php $var = $this->app_model->getSelectedData('mklasifikasisub',array('idmklas'=>$row->idmklasifikasi))->result() ?>
																					
																					<?php foreach($var as $row): ?>
																						<option value="<?=$row->idmklasifikasisub?>*<?=$row->indeks?>"><?=$row->parametersub?></option>
																					<?php endforeach; ?>
																				</select>
																				</td>
																				<td><input class="indeksparamsub" id="indeksparamsub<?=$no?>_<?=$angka?>" name="indeksparamsub_<?=$angka?>" type="text"></td>
																				<td><input class="bobotxindeks" name="bobotxindeks_<?=$angka?>" id="bobotxindeks<?=$no?>_<?=$angka?>" type="text"><input id="bobotxindeks_hide<?=$no?>_<?=$angka?>" type="hidden"></td>
																			</tr>
																			<?php endforeach; ?>
																		</table>
																		<button id="btn_klasifikasi_<?=$angka?>" class="btn btn-primary btn-lg" type="button">Total Indeks Klasifikasi (Klik untuk hitung!)</button>
																	</div>
																</div>
															</div>
															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="iklas_fix_<?=$angka?>">Indeks Klasifikasi:</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		<input type="text" name="iklas_fix_<?=$angka?>" id="iklas_fix_<?=$angka?>" class="col-xs-12 col-sm-4" readonly="true" />
																		<input type="hidden" id="iklas_fix_hide<?=$angka?>" />
																	</div>
																</div>
															</div>
															<div class="space-2"></div>															
<h3 class="lighter block blue">1.2.3 WAKTU PENGGUNAAN</h3>

															<div class="form-group iwp-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="iwp<?=$angka?>">Fungsi Bangunan</label>

																<div class="col-xs-12 col-sm-9">
																	<select id="iwp<?=$angka?>" name="iwp<?=$angka?>" class="select2" data-placeholder="Pilih Waktu Penggunaan...">
																	<option value="">&nbsp;</option>
																	<?php foreach($waktuguna->result() as $row): ?>
																		<option value="<?=$row->idmwaktuguna?>*<?=$row->indeks?>*<?=$row->keterangan?>"><?=$row->parameter?></option>
																	<?php endforeach; ?>
																	</select>
																</div>
															</div>
															
															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="ket_waktuguna<?=$angka?>">Keterangan:</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		<input type="text" name="ket_waktuguna<?=$angka?>" id="ket_waktuguna<?=$angka?>" class="col-xs-12 col-sm-9" readonly="true" />
																	</div>
																</div>
															</div>
															
															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="iwg_fix_<?=$angka?>">Indeks Waktu Guna:</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		<input type="text" name="iwg_fix_<?=$angka?>" id="iwg_fix_<?=$angka?>" class="col-xs-12 col-sm-4" readonly="true" />
																	</div>
																</div>
															</div>
															
															<div class="space-2"></div>

<h3 class="lighter block blue">1.2.4 PERHITUNGAN INDEKS INTEGRITAS</h3>
															
															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="indeks_integritas<?=$angka?>">Indeks Integritas:</label>

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
																			<td><input id="if_fix2_<?=$angka?>" name="if_fix2_<?=$angka?>" type="text" class=""></td>
																			<td>x</td>
																			<td><input id="iklas_fix2_<?=$angka?>" name="iklas_fix2_<?=$angka?>" type="text" class=""></td>
																			<td>x</td>
																			<td><input id="iwg_fix2_<?=$angka?>" name="iwgfix2_<?=$angka?>" type="text" class=""></td>
																			<td>=</td>
																			<td><input id="indeks_integritas_<?=$angka?>" name="indeks_integritas_<?=$angka?>" type="text" class=""></td>
																		</tr>
																	</table>
																	<button id="btn_integritas<?=$angka?>" class="btn btn-warning btn-lg" type="button">Total Indeks Klasifikasi (Klik untuk hitung!)</button>
																	<button id="btn_tambah_<?=$angka?>" onclick="tambah_integrasi(<?=$angka+1?>)" class="btn btn-danger btn-lg" type="button">Tambah Indeks Klasifikasi dan Integrasi</button>
																	</div>
																</div>
															</div>
														
														</form>
													</div>
												</div>

</div>
<script>
	$('#ifbg<?=$angka?>').change(function(){
					var ifbg = $('#ifbg<?=$angka?>').val();
					var arr = ifbg.split("*");
					$('#ket_fungsi<?=$angka?>').val(arr[2]);
					$('#if_fix_<?=$angka?>').val(arr[1]);
					$('#if_fix2_<?=$angka?>').val(arr[1]);
	})
	$('#iwp<?=$angka?>').change(function(){
					var iwp = $('#iwp<?=$angka?>').val();
					var arr = iwp.split("*");
					$('#ket_waktuguna<?=$angka?>').val(arr[2]);
					$('#iwg_fix_<?=$angka?>').val(arr[1]);
					$('#iwg_fix2_<?=$angka?>').val(arr[1]);
	})
	<?php for ($i=0;$i<=$klasifikasi->num_rows();$i++) { ?>
					$('#parameter<?=$i?>_<?=$angka?>').change(function(){
						var indeks<?=$i?>_<?=$angka?> = $('#parameter<?=$i?>_<?=$angka?>').val().split("*")[1];
						var bobot<?=$i?>_<?=$angka?> = $('#bobot<?=$i?>_<?=$angka?>').text();
						var klas<?=$i?>_<?=$angka?> = indeks<?=$i?>_<?=$angka?> * bobot<?=$i?>_<?=$angka?>;
						var hasil<?=$i?>_<?=$angka?> = Math.round(klas<?=$i?>_<?=$angka?> * 100) / 100;
						// alert(indeks<?=$i?>+' * '+bobot<?=$i?>+ ' = '+hasil<?=$i?>.toFixed(2));
						$('#indeksparamsub<?=$i?>_<?=$angka?>').val(indeks<?=$i?>_<?=$angka?>);
						$('#bobotxindeks<?=$i?>_<?=$angka?>').val(hasil<?=$i?>_<?=$angka?>.toFixed(2));
						$('#bobotxindeks_hide<?=$i?>_<?=$angka?>').val(klas<?=$i?>_<?=$angka?>);
					})
	<?php } ?>

		$('#btn_klasifikasi_<?=$angka?>').click(function(){
					var akumulasi = parseFloat($('#bobotxindeks_hide1_<?=$angka?>').val()) + parseFloat($('#bobotxindeks_hide2_<?=$angka?>').val()) + parseFloat($('#bobotxindeks_hide3_<?=$angka?>').val()) + parseFloat($('#bobotxindeks_hide4_<?=$angka?>').val()) + parseFloat($('#bobotxindeks_hide5_<?=$angka?>').val()) + parseFloat($('#bobotxindeks_hide6_<?=$angka?>').val()) + parseFloat($('#bobotxindeks_hide7_<?=$angka?>').val());
					$('#iklas_fix_hide<?=$angka?>').val(akumulasi);
					$('#iklas_fix_<?=$angka?>').val((Math.round(akumulasi.toFixed(3) * 100) / 100).toFixed(2));
					$('#iklas_fix2_<?=$angka?>').val((Math.round(akumulasi.toFixed(3) * 100) / 100).toFixed(2));
					// var arridmklas = $.makeArray($('td.idmklas').text()).reverse();
					var arridmklas = [];
					var arrparam = [];
					var arrbobot = [];
					// var arrparameter = [];
					$("td.idmklas_<?=$angka?>").each(function() { arridmklas.push($(this).text()) });
					$("td.param_<?=$angka?>").each(function() { arrparam.push($(this).text()) });
					$("td.bobot_<?=$angka?>").each(function() { arrbobot.push($(this).text()) });
					var arridmklassub = $(".idparameter_<?=$angka?> option:selected").map(function() { return $(this).val().split("*")[0]; }).get();
					var arrparameter = $(".idparameter_<?=$angka?> option:selected").map(function() { return $(this).text(); }).get();
					// $(".parameter > .select2-choice > .select2-chosen").each(function() { arrparameter.push($(this).text()) });
					var arrindeksparamsub = $('[name^="indeksparamsub_<?=$angka?>"]').map(function(){
						return $(this).val()
					}).get();
					var arrbobotxindeks = $('[name^="bobotxindeks_<?=$angka?>"]').map(function(){
						return $(this).val()
					}).get();

					$.ajax({
						url: "<?= base_url() ?>transaksi/simpanTransKlasifikasi/", cache: false,
						type: 'post',
						data: {idmklas:arridmklas,param:arrparam,bobot:arrbobot,parameter:arrparameter,idmklassub:arridmklassub,indeksparamsub:arrindeksparamsub,bobotxindeks:arrbobotxindeks,tabel_ke:'<?=$angka?>'},
						success: function(msg){
							alert(msg);
						}
					})
				});
				$('#btn_integritas<?=$angka?>').click(function(){
					var akumulasi = parseFloat($('#if_fix2_<?=$angka?>').val()) * parseFloat($('#iklas_fix_hide<?=$angka?>').val()) * parseFloat($('#iwg_fix2_<?=$angka?>').val());
					$('#indeks_integritas_<?=$angka?>').val((Math.round(akumulasi.toFixed(3) * 100) / 100).toFixed(2));
				})
	function show_btn_integrasi(angka)
		{
			// alert(angka);
				$('#btn_tambah_'+angka).removeClass('hide');
				$('.integrasi_'+angka+1).remove();
				$.ajax({
					url:'<?= base_url() ?>transaksi/deleteIntegrasinKlas/<?=$angka?>', cache: false,
				})
		}
	
</script>