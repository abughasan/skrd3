<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			
				$('[data-rel=tooltip]').tooltip();
			
				$(".select2").css('width','200px').select2({allowClear:true})
				.on('change', function(){
					$(this).closest('form').validate().element($(this));
				}); 
			
			
				var $validation = false;
				$('#fuelux-wizard-container')
				.ace_wizard({
					//step: 2 //optional argument. wizard will jump to step "2" at first
					//buttons: '.wizard-actions:eq(0)'
				})
				.on('actionclicked.fu.wizard' , function(e, info){
					if(info.step == 1) {
						if(!$('#validation-form').valid()) {
							e.preventDefault();
						}else{
							var wajibpajak = $('#validation-form').serialize();
							$.ajax({
								type: 'post',
								data: wajibpajak,
								url: "<?= base_url() ?>transaksi/simpanDataWajibPajak/", cache:false,
								success: function(msg){
									alert(msg);
								}
							});
						}
					}
					if(info.step == 2) {
						if(!$('#validation-form2').valid()) {
						e.preventDefault();
						}else{
							var dbangunan = $('#validation-form2').serialize();
							$.ajax({
								type: 'post',
								data: dbangunan,
								url: "<?= base_url() ?>transaksi/simpanDataGedung/", cache:false,
								success: function(msg){
									alert(msg);
								}
							});
						}
					}
					if(info.step == 3) {
						if(!$('#validation-form3').valid()) {
						e.preventDefault();
						}else{
							
						}
					}
				})
				.on('finished.fu.wizard', function(e) {
					// var idheaderskr = 
					bootbox.dialog({
						message: "Thank you! Your information was successfully saved!", 
						buttons: {
							"success" : {
								"label" : "LIHAT REKAPITULASI LAPORAN",
								"className" : "btn-sm btn-primary",
								callback: function() {
									window.location = '<?= base_url() ?>report/skrd/';
								}
							}
						}
					});
				}).on('stepclick.fu.wizard', function(e){
					//e.preventDefault();//this will prevent clicking and selecting steps
				});
			
			
				//jump to a step
				/**
				var wizard = $('#fuelux-wizard-container').data('fu.wizard')
				wizard.currentStep = 3;
				wizard.setState();
				*/
			
				//determine selected step
				//wizard.selectedItem().step
			
			
			
				//hide or show the other form which requires validation
				//this is for demo only, you usullay want just one form in your application
				/* hide not use
				$('#skip-validation').removeAttr('checked').on('click', function(){
					$validation = this.checked;
					if(this.checked) {
						$('#sample-form').hide();
						$('#validation-form').removeClass('hide');
					}
					else {
						$('#validation-form').addClass('hide');
						$('#sample-form').show();
					}
				})
				*/
			
			
			
				//documentation : http://docs.jquery.com/Plugins/Validation/validate
			
				// $validation = this.checked;
				$.mask.definitions['~']='[+-]';
				$('#phone').mask('(999) 999-9999');
				$('#luas1').autoNumeric('init');    
				$('#jumlah_skrd1').autoNumeric('init');    
				
				  
			
				jQuery.validator.addMethod("phone", function (value, element) {
					return this.optional(element) || /^\(\d{3}\) \d{3}\-\d{4}( x\d{1,6})?$/.test(value);
				}, "Enter a valid phone number.");
			
				$('#validation-form2').validate({
					errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: false,
					ignore: "",
					rules: {
						jenis_b: {
							required: true,
						},
						lokasi_b: {
							required: true,
						},
						kecamatan2: {
							required: true,
						}
					},
					errorPlacement: function (error, element) {
						if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
							var controls = element.closest('div[class*="col-"]');
							if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
							else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
						}
						else if(element.is('.select2')) {
							error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
						}
						else if(element.is('.chosen-select')) {
							error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
						}
						else error.insertAfter(element.parent());
					},
					highlight: function (e) {
						$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
					},
			
					success: function (e) {
						$(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
						$(e).remove();
					},
				});
				$('#validation-form').validate({
					errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: false,
					ignore: "",
					rules: {
						namawr: {
							required: true,
						},
						pt: {
							required: true,
						},
						alamatpt: {
							required: true,
						},
						propinsi: {
							required: true,
						},
						kota: {
							required: true,
						},
						kecamatan: {
							required: true,
						},
						desa: {
							required: false,
						},
						phone: {
							required: true,
							phone: 'required'
						},
					},
			
					messages: {
						namawr: {
							required: "Isi nama lengkap anda sesuai KTP/NPWP",
						},
						state: "Please choose state",
						subscription: "Please choose at least one option",
						gender: "Please choose gender",
						agree: "Please accept our policy"
					},
			
			
					highlight: function (e) {
						$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
					},
			
					success: function (e) {
						$(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
						$(e).remove();
					},
			
					errorPlacement: function (error, element) {
						if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
							var controls = element.closest('div[class*="col-"]');
							if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
							else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
						}
						else if(element.is('.select2')) {
							error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
						}
						else if(element.is('.chosen-select')) {
							error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
						}
						else error.insertAfter(element.parent());
					},
			
					submitHandler: function (form) {
					},
					invalidHandler: function (form) {
					}
				});
			
				
				
				
				$('#modal-wizard-container').ace_wizard();
				$('#modal-wizard .wizard-actions .btn[data-dismiss=modal]').removeAttr('disabled');
				
				
				/**
				$('#date').datepicker({autoclose:true}).on('changeDate', function(ev) {
					$(this).closest('form').validate().element($(this));
				});
				
				$('#mychosen').chosen().on('change', function(ev) {
					$(this).closest('form').validate().element($(this));
				});
				*/
				
				
				$(document).one('ajaxloadstart.page', function(e) {
					//in ajax mode, remove remaining elements before leaving page
					$('[class*=select2]').remove();
				});
				
				$('#propinsi').change(function(){
					var propinsi_id = $('#propinsi').val();
					if (propinsi_id == "") {
						$.ajax({
							url: "<?= base_url() ?>transaksi/clearselected/", cache:false,
							success: function(msg){
								$('#kota').html(msg);
								$('#kecamatan').html(msg);
								$('#desa').html(msg);
							}
						});
						$('#select2-chosen-2').html("Pilih Kota/Kabupaten...");
						$('#select2-chosen-3').html("Pilih Kecamatan...");
						$('#select2-chosen-4').html("Pilih Kelurahan/Desa...");
					} else {					
						$.ajax({
							url: "<?= base_url() ?>transaksi/kota/"+propinsi_id, cache:false,
							success: function(msg){
								$( ".kota-group" ).removeClass('hide');
								$('#kota').html(msg);
							}
						});
						$('#select2-chosen-2').html("Pilih Kota/Kabupaten...")
					}
				})
				$('#kota').change(function(){
					var kota_id = $('#kota').val();
					if (kota_id == "") {
						$.ajax({
							url: "<?= base_url() ?>transaksi/clearselected/", cache:false,
							success: function(msg){
								$('#kota').html(msg);
								$('#kecamatan').html(msg);
								$('#desa').html(msg);
							}
						});
						$('#select2-chosen-3').html("Pilih Kecamatan...");
						$('#select2-chosen-4').html("Pilih Kelurahan/Desa...");
					} else {
						$.ajax({
							url: "<?= base_url() ?>transaksi/kecamatan/"+kota_id, cache:false,
							success: function(msg){
								$( ".kecamatan-group" ).removeClass('hide');
								$('#kecamatan').html(msg);
							}
						});
						$('#select2-chosen-3').html("Pilih Kecamatan...")
					}
				})
				$('#kecamatan').change(function(){
					var kecamatan_id = $('#kecamatan').val();
					if (kecamatan_id == "") {
						$.ajax({
							url: "<?= base_url() ?>transaksi/clearselected/", cache:false,
							success: function(msg){
								$('#kecamatan').html(msg);
								$('#desa').html(msg);
							}
						});
						$('#select2-chosen-4').html("Pilih Kelurahan/Desa...")
					} else {
						$.ajax({
							url: "<?= base_url() ?>transaksi/desa/"+kecamatan_id, cache:false,
							success: function(msg){
								$( ".desa-group" ).removeClass('hide');
								$('#desa').html(msg);
							}
						});
						$('#select2-chosen-4').html("Pilih Kelurahan/Desa...")
					}
				})
				$('#kecamatan2').change(function(){
					var kecamatan_id = $('#kecamatan2').val();
					if (kecamatan_id == "") {
						$.ajax({
							url: "<?= base_url() ?>transaksi/clearselected/", cache:false,
							success: function(msg){
								$('#desa2').html(msg);
							}
						});
						$('#select2-chosen-6').html("Pilih Kelurahan/Desa...")
					} else {
						$.ajax({
							url: "<?= base_url() ?>transaksi/desa/"+kecamatan_id, cache:false,
							success: function(msg){
								$( ".desa2-group" ).removeClass('hide');
								$('#desa2').html(msg);
							}
						});
						$('#select2-chosen-6').html("Pilih Kelurahan/Desa...")
					}
				})
				$('#ilp').change(function(){
					var ilp = $('#ilp').val();
					if (ilp == "") {
						$.ajax({
							url: "<?= base_url() ?>transaksi/clearselected/", cache:false,
							success: function(msg){
								$('#lingkupsub').html(msg);
							}
						});
						$('#select2-chosen-8').html("Lingkup sub...")
					} else {
						$.ajax({
							url: "<?= base_url() ?>transaksi/lingkupsub/"+ilp, cache:false,
							success: function(msg){
								$( ".lingkupsub-group" ).removeClass('hide');
								$('#lingkupsub').html(msg);
							}
						});
						$('#select2-chosen-8').html("Lingkup sub...")
					}
				})
				$('#lingkupsub').change(function(){
					var lingkupsub = $('#lingkupsub').val();
					if (lingkupsub == "") {
						$.ajax({
							url: "<?= base_url() ?>transaksi/clearselected/", cache:false,
							success: function(msg){
								$('#lingkupsubdet').html(msg);
							}
						});
						$('#select2-chosen-9').html("Lingkup sub det...")
					} else {
						$.ajax({
							url: "<?= base_url() ?>transaksi/lingkupsubdet/"+lingkupsub, cache:false,
							success: function(msg){
								$( ".lingkupsubdet-group" ).removeClass('hide');
								$('#lingkupsubdet').html(msg);
							}
						});
						$('#select2-chosen-9').html("Lingkup sub det...")
					}
				})
				$('#lingkupsubdet').change(function(){
					var ilp_fix = $('#lingkupsubdet').val();
					var arr = ilp_fix.split("*");
					$('#ilp_fix').val(arr[1]);
					$('#ilp_fix2').val(arr[1]);
							$.ajax({
								url: "<?= base_url() ?>transaksi/simpanILP/"+ilp_fix, cache:false,
								success: function(msg){
									alert(msg);
								}
							});
				})
				$('#ifbg').change(function(){
					var ifbg = $('#ifbg').val();
					var arr = ifbg.split("*");
					$('#ket_fungsi').val(arr[2]);
					$('#if_fix').val(arr[1]);
					$('#if_fix2').val(arr[1]);
				})
				$('#iwp').change(function(){
					var iwp = $('#iwp').val();
					var arr = iwp.split("*");
					$('#ket_waktuguna').val(arr[2]);
					$('#iwg_fix').val(arr[1]);
					$('#iwg_fix2').val(arr[1]);
				})
				<?php for ($i=0;$i<=$klasifikasi->num_rows();$i++) { ?>
					$('#parameter<?=$i?>').change(function(){
						var indeks<?=$i?> = $('#parameter<?=$i?>').val().split("*")[1];
						var bobot<?=$i?> = $('#bobot<?=$i?>').text();
						var klas<?=$i?> = indeks<?=$i?> * bobot<?=$i?>;
						var hasil<?=$i?> = Math.round(klas<?=$i?> * 100) / 100;
						// alert(indeks<?=$i?>+' * '+bobot<?=$i?>+ ' = '+hasil<?=$i?>.toFixed(2));
						$('#indeksparamsub<?=$i?>').val(indeks<?=$i?>);
						$('#bobotxindeks<?=$i?>').val(hasil<?=$i?>.toFixed(2));
						$('#bobotxindeks_hide<?=$i?>').val(klas<?=$i?>);
					})
				<?php } ?>
				$('#btn_klasifikasi').click(function(){
					var akumulasi = parseFloat($('#bobotxindeks_hide1').val()) + parseFloat($('#bobotxindeks_hide2').val()) + parseFloat($('#bobotxindeks_hide3').val()) + parseFloat($('#bobotxindeks_hide4').val()) + parseFloat($('#bobotxindeks_hide5').val()) + parseFloat($('#bobotxindeks_hide6').val()) + parseFloat($('#bobotxindeks_hide7').val());
					$('#iklas_fix_hide').val(akumulasi);
					$('#iklas_fix').val((Math.round(akumulasi.toFixed(3) * 100) / 100).toFixed(2));
					$('#iklas_fix2').val((Math.round(akumulasi.toFixed(3) * 100) / 100).toFixed(2));
					// var arridmklas = $.makeArray($('td.idmklas').text()).reverse();
					var arridmklas = [];
					var arrparam = [];
					var arrbobot = [];
					// var arrparameter = [];
					$("td.idmklas").each(function() { arridmklas.push($(this).text()) });
					$("td.param").each(function() { arrparam.push($(this).text()) });
					$("td.bobot").each(function() { arrbobot.push($(this).text()) });
					var arridmklassub = $(".idparameter option:selected").map(function() { return $(this).val().split("*")[0]; }).get();
					var arrparameter = $(".idparameter option:selected").map(function() { return $(this).text(); }).get();
					// $(".parameter > .select2-choice > .select2-chosen").each(function() { arrparameter.push($(this).text()) });
					var arrindeksparamsub = $('[name^="indeksparamsub"]').map(function(){
						return $(this).val()
					}).get();
					var arrbobotxindeks = $('[name^="bobotxindeks"]').map(function(){
						return $(this).val()
					}).get();

					$.ajax({
						url: "<?= base_url() ?>transaksi/simpanTransKlasifikasi/", cache: false,
						type: 'post',
						data: {idmklas:arridmklas,param:arrparam,bobot:arrbobot,parameter:arrparameter,idmklassub:arridmklassub,indeksparamsub:arrindeksparamsub,bobotxindeks:arrbobotxindeks,tabel_ke:'1'},
						success: function(msg){
							alert(msg);
						}
					})
				})
				$('#btn_integritas').click(function(){
					var akumulasi = parseFloat($('#if_fix2').val()) * parseFloat($('#iklas_fix_hide').val()) * parseFloat($('#iwg_fix2').val());
					$('#indeks_integritas').val((Math.round(akumulasi.toFixed(3) * 100) / 100).toFixed(2));
					var index_i = $('#form_integrasi_1').serialize();
					$.ajax({
						type: 'post', data: index_i,
								url: "<?= base_url() ?>transaksi/simpanIndeks/", cache:false,
								success: function(msg){
									alert(msg);
								}
					});
				})
				
				
				$('#btn_tambah_skrd').on('click',function(){
					var nomer = parseInt($('.no_skrd:last').text()) + 1;
					$("					<tr id='skrd_row"+nomer+"' class='skrd_row'>																			<td class='no_skrd' id='no_skrd_1'>"+nomer+"</td>																			<td><select class='kode_skrd' id='kode_skrd"+nomer+"' onchange='kodeskrd_change("+nomer+")' name='kode_skrd'>																					<option value=''>Select</option>																					<?php foreach($hargasatuan->result() as $row): ?>																						<option value='<?=$row->kode?>*<?=$row->idmhargasatuan?>*<?=$row->harga_satuan?>'><?=$row->kode?>-<?=$row->jenis_bangunan?> </option>																					<?php endforeach; ?>																				</select>																			</td>																			<td><input size='30' id='unit_bangunan"+nomer+"' name='unit_bangunan' type='text' class=''></td>																			<td id='tdluas"+nomer+"'><input data-a-dec=',' data-a-sep='.' id='luas"+nomer+"' size='7' name='luas' type='text' onblur='hitungskrdblur("+nomer+")' class=''></td>			<td id='i_integrasi"+nomer+"' style='cursor:pointer' class='skrd_integrasi' onclick='changeIntegrasi("+nomer+")' title='Klik untuk ganti indeks integrasi' >i integrasi</td><td class='skrd_lingpem' id='i_lingpemb"+nomer+"'>i ling pemb</td>						<td id='skrd_satuan_"+nomer+"'>harga satuan</td>																			<td id='tdjmlunit"+nomer+"'><input id='jmlunit"+nomer+"' size='5' name='jmlunit' value=1 onblur='hitungskrdblur("+nomer+")' type='text' class=''></td>																			<td><input id='jumlah_skrd"+nomer+"' size='15' name='jumlah_skrd' type='text' class='jumlah_skrd'> <span class='refreshskrd ui-icon ace-icon fa fa-refresh green' style='cursor:pointer' onclick='hitungskrdblur("+nomer+")'></span></td>	<td><span onclick='hapusskrd("+nomer+")' class='hapusskrd ui-icon ace-icon fa fa-trash-o red' style='cursor:pointer'></span></td>	</tr>")
					.insertAfter('table tr:last');
					autonumskrd(nomer);
				})
				$('#btn_total_skrd').on('click',function(){
					var total_skrd_fix_element = '<tr class="success tr_total" id="tr_total"><td colspan=8><H4>TOTAL</H4></td><td><input type="text" id="total_skrd_fix"></td><td></td></tr><tr class="success tr_total" id="tr_total_bulat"><td colspan=8><H4>PEMBULATAN</H4></td><td><input type="text" id="total_skrd_fix_bulat"></td><td></td></tr>';
					$(total_skrd_fix_element).insertAfter('table tr:last');
					var arrjumlah_skrd = [];
					$("input.jumlah_skrd").each(function() { arrjumlah_skrd.push($(this).autoNumeric('get')) });
					var arrkode_skrd = $(".kode_skrd option:selected").map(function() { return $(this).val().split("*")[0]; }).get();
					// alert(arrjumlah_skrd);
					
					var total = 0;
					for (var i = 0; i < arrjumlah_skrd.length; i++) {
						total += arrjumlah_skrd[i] << 0;
						// alert(arrjumlah_skrd[i]);
					}
					$('#total_skrd_fix').autoNumeric('init');
					$('#total_skrd_fix_bulat').autoNumeric('init');
					$('#total_skrd_fix').autoNumeric('set',total);
					$('#total_skrd_fix_bulat').autoNumeric('set',Math.ceil(total / 1000) * 1000);
					$('#btn_total_skrd').addClass('hide');
					$('#btn_reset_total_skrd').removeClass('hide');
				})
				$('#btn_reset_total_skrd').click(function(){
					$('#btn_total_skrd').removeClass('hide');
					$('#btn_reset_total_skrd').addClass('hide');
					$('.tr_total').remove();
				});
				$('#btn_simpan_skrd').click(function(){
					var arridmhargasatuan = [];
					var arrkode = [];
					var arrunitbangunan = [];
					var arrluas = [];
					var arrharga_satuan = [];
					var arrindeks_integritas = [];
					var arrindeks_lingpem = [];
					var arrjumlah_unit = [];
					var arrjumlah_ret = [];
					
					var arridmhargasatuan = $(".kode_skrd option:selected").map(function() { return $(this).val().split("*")[1]; }).get();
					var arrkode = $(".kode_skrd option:selected").map(function() { return $(this).val().split("*")[0]; }).get();
					$('[name^="unit_bangunan"]').each(function() { arrunitbangunan.push($(this).val()) });
					$('[name^="luas"]').each(function() { arrluas.push($(this).autoNumeric('get')) });
					var arrharga_satuan = $(".kode_skrd option:selected").map(function() { return $(this).val().split("*")[2]; }).get();
					$("td.skrd_integrasi").each(function() { arrindeks_integritas.push($(this).text()) });
					$("td.skrd_lingpem").each(function() { arrindeks_lingpem.push($(this).text()) });
					$('[name^="jmlunit"]').each(function() { arrjumlah_unit.push($(this).val()) });
					$('[name^="jumlah_skrd"]').each(function() { arrjumlah_ret.push($(this).autoNumeric('get')) });
					
					// alert(arrindeks_integritas);
					
					$.ajax({
						url: "<?= base_url() ?>transaksi/simpanTransSKRD/", cache: false,
						type: 'post',
						data: {idmhargasatuan:arridmhargasatuan,kode:arrkode,unit_bangunan:arrunitbangunan,luas:arrluas,harga_satuan:arrharga_satuan,indeks_integritas:arrindeks_integritas,indeks_lingpem:arrindeks_lingpem,jumlah_unit:arrjumlah_unit,jumlah_ret:arrjumlah_ret},
						success: function(msg){
							alert(msg);
						}
					})
				});
				
				
			})
			function kodeskrd_change(nth)
			{
				var nomer = nth;
				var tdluas = $('#tdluas'+nomer);
				var tdintegrasi = $('#i_integrasi'+nomer);
				var tdilp = $('#i_lingpemb'+nomer);
				var tdhargas = $('#skrd_satuan_'+nomer);
				var tdjmlunit = $('#tdjmlunit'+nomer);
				
				var harga_satuan = $('select#kode_skrd'+nomer).val().split('*')[2];
				var kode = $('select#kode_skrd'+nomer).val().split('*')[0];
				var jenis_bangunan = $('select#kode_skrd'+nomer+' option:selected').text().split('-')[1];
				var luas = $('#luas'+nomer).autoNumeric('get');
				
				$('#unit_bangunan'+nomer).val(jenis_bangunan);
				$('#i_integrasi'+nomer).text($('#indeks_integritas').val());
				$('#i_lingpemb'+nomer).text($('#ilp_fix').val());
				$('#skrd_satuan_'+nomer).text(harga_satuan);
				
				if (kode.slice(0,1) == 1) 
				{
					jumlahskrd = parseFloat(luas) * parseFloat($('#indeks_integritas').val()) * parseFloat($('#ilp_fix').val()) * parseFloat(harga_satuan) * parseFloat($('#jmlunit'+nomer).val());
					$('#jumlah_skrd'+nomer).val(jumlahskrd);
					tdluas.addClass('danger');
					tdintegrasi.addClass('danger');
					tdilp.addClass('danger');
					tdhargas.addClass('danger');
					tdjmlunit.addClass('danger');
				}
				if (kode.slice(0,1) == 2) 
				{
					jumlahskrd = parseFloat(luas) * parseFloat($('#ilp_fix').val()) * parseFloat(harga_satuan) * parseFloat($('#jmlunit'+nomer).val());
					$('#jumlah_skrd'+nomer).val(jumlahskrd);
					tdluas.addClass('danger');
					tdilp.addClass('danger');
					tdintegrasi.removeClass('danger');
					tdhargas.addClass('danger');
					tdjmlunit.addClass('danger');
				}
				autonumskrd(nomer);
			}
			function hitungskrdblur(nth) 
			{
				var nomer = nth;
				var tdluas = $('#tdluas'+nomer);
				var tdintegrasi = $('#i_integrasi'+nomer);
				var tdilp = $('#i_lingpemb'+nomer);
				var tdhargas = $('#skrd_satuan_'+nomer);
				var tdjmlunit = $('#tdjmlunit'+nomer);
				var kode = $('select#kode_skrd'+nomer).val().split('*')[0];
				var luas = $('#luas'+nomer).autoNumeric('get');
				var harga_satuan = $('select#kode_skrd'+nomer).val().split('*')[2];
				if (kode.slice(0,1) == 1) 
				{
					jumlahskrd = parseFloat(luas) * parseFloat(tdintegrasi.text()) * parseFloat($('#ilp_fix').val()) * parseFloat(harga_satuan) * parseFloat($('#jmlunit'+nomer).val());
					$('#jumlah_skrd'+nomer).val(jumlahskrd);
					tdluas.addClass('danger');
					tdintegrasi.addClass('danger');
					tdilp.addClass('danger');
					tdhargas.addClass('danger');
					tdjmlunit.addClass('danger');
				}
				if (kode.slice(0,1) == 2) 
				{
					jumlahskrd = parseFloat(luas) * parseFloat($('#ilp_fix').val()) * parseFloat(harga_satuan) * parseFloat($('#jmlunit'+nomer).val());
					$('#jumlah_skrd'+nomer).val(jumlahskrd);
					tdluas.addClass('danger');
					tdilp.addClass('danger');
					tdhargas.addClass('danger');
					tdjmlunit.addClass('danger');
				}
				autonumskrd(nomer);
			}
			function hapusskrd(nth){
				var nomer = nth;
				$('tr#skrd_row'+nomer).remove();
			}
			function autonumskrd(nomer) {
			  $('#luas'+nomer).autoNumeric('init');
			  $('#jumlah_skrd'+nomer).autoNumeric('init');    
			  $('#luas'+nomer).autoNumeric('update');    
			  $('#jumlah_skrd'+nomer).autoNumeric('update');    
			}
			function tambah_integrasi(angka)
			{
				var hapus = angka - 1;
				// alert(hapus);
				$('#btn_tambah_'+hapus).addClass('hide');
					$.ajax({
						url: "<?= base_url() ?>transaksi/tambah_int_klas/"+angka, cache: false,
						success: function(msg){
							$('#canvas_tambah').append(msg);
						}
					})
			}
			function changeIntegrasi(nomer)
			{
				var value = $('#i_integrasi'+nomer).text();
				$('#modal-change-integrasi').modal('show');
				$.ajax({
					url : "<?= base_url() ?>transaksi/changeIntegrasi/"+nomer, cache: false,
					success : function(msg){
						$('#integrasi_option_inmodal').html(msg);
					}
				})
			}
			
		</script>