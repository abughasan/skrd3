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
				})
				.on('finished.fu.wizard', function(e) {
					bootbox.dialog({
						message: "Thank you! Your information was successfully saved!", 
						buttons: {
							"success" : {
								"label" : "OK",
								"className" : "btn-sm btn-primary"
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
							required: true,
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
						$('#select2-chosen-8').html("Lingkup sub det...")
					} else {
						$.ajax({
							url: "<?= base_url() ?>transaksi/lingkupsubdet/"+lingkupsub, cache:false,
							success: function(msg){
								$( ".lingkupsubdet-group" ).removeClass('hide');
								$('#lingkupsubdet').html(msg);
							}
						});
						$('#select2-chosen-8').html("Lingkup sub det...")
					}
				})
				$('#lingkupsubdet').change(function(){
					var ilp_fix = $('#lingkupsubdet').val();
					$('#ilp_fix').val(ilp_fix);
				})
				$('#ifbg').change(function(){
					var ifbg = $('#ifbg').val();
					var arr = ifbg.split("*");
					$('#ket_fungsi').val(arr[2]);
					$('#if_fix').val(arr[1]);
				})
				<?php for ($i=0;$i<=$klasifikasi->num_rows();$i++) { ?>
					$('#parameter<?=$i?>').change(function(){
						var indeks<?=$i?> = $('#parameter<?=$i?>').val();
						var bobot<?=$i?> = $('#bobot<?=$i?>').text();
						var klas<?=$i?> = indeks<?=$i?> * bobot<?=$i?>;
						alert(indeks<?=$i?>+' * '+bobot<?=$i?>+ ' = '+klas<?=$i?>);
						$('#indeksparamsub<?=$i?>').val(indeks<?=$i?>);
						$('#bobotxindeks<?=$i?>').val(klas<?=$i?>);
					})
				<?php } ?>
				$('#btn_klasifikasi').click(function(){
					var akumulasi = parseFloat($('#bobotxindeks1').val()) + parseFloat($('#bobotxindeks2').val()) + parseFloat($('#bobotxindeks3').val()) + parseFloat($('#bobotxindeks4').val()) + parseFloat($('#bobotxindeks5').val()) + parseFloat($('#bobotxindeks6').val()) + parseFloat($('#bobotxindeks7').val());
					$('#iklas_fix').val(akumulasi);
				})
			})
		</script>