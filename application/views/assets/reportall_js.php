<script>
	jQuery(function($) {
	  $('.autonum').autoNumeric('init'); 
	});
	$(document).ready(function() {
    var table = $('#reportAll').DataTable({
        dom: 'T<"clear">lfrtip',
		tableTools: {
			"sRowSelect": "multi",
            "sSwfPath": "<?=$this->config->item('base_assets')?>jqplugins/dataTables/ext/copy_csv_xls_pdf.swf",
			"aButtons": [
				{
                    "sExtends":    "collection",
                    "sButtonText": "Pilih",
                    "aButtons":    [ "select_all", "select_none"]
                },
				{
					"sExtends": "copy",
					"bSelectedOnly": true
				},
				{
					"sExtends": "xls",
					"bSelectedOnly": true
				},
				{
					"sExtends": "pdf",
					"bSelectedOnly": true
				},
				{
					"sExtends": "print",
					"bSelectedOnly": true
				},
			]
        }
    });
	$( ".datepicker" ).datepicker({
		dateFormat: "yy-mm-dd"
	});
	// Add event listeners to the two range filtering inputs
      $('#dateStart').keyup( function() { table.draw(); } );
      $('#dateStart').change( function() { table.draw(); } );
      $('#dateEnd').keyup( function() { table.draw(); } );
      $('#dateEnd').change( function() { table.draw(); } );
	} );
	$( ".datepicker2" ).each(function(i) {
		this.id = $(this).attr('id');
	}).datepicker({
		dateFormat: "yy-mm-dd",
		showOn: "button",
		buttonImage: "<?=$this->config->item('base_assets')?>jqplugins/jqui/images/calendar.gif",
		buttonImageOnly: true,
		onSelect:function(selectedDate){
				$.ajax({
					url:'<?=base_url()?>report/edittglpenetapan/'+selectedDate+'_'+this.id,cache:false,
					success:function(msg){
						alert(msg);
						window.location='';
					}
				})
		   }
	});

function deletelap(idlap)
{
	var t = confirm("Data laporan akan terhapus. Yakin?");
	if (t==true) 
	{
		$.ajax({
		url: "<?=base_url()?>report/delete_skrd/"+idlap, cache:false,
		success:function(e){
			alert("Data no "+idlap+" telah terhapus.");
			window.location='';
		}
		})
	}
	else
	{
		
	}
}

function editnoskr(noskr)
{
	var data = prompt("Masukkan no SKR Baru.", "123");
	// alert(data);
	if(data == "123" || data == null){
	}else{
		$.ajax({
			url: '<?=base_url()?>report/editnoskr/'+data+'_'+noskr, cache:false,
			success:function(e){
				alert(e);
				window.location='';
			}
		})
	}
}
function edittglpenetapan(noskr)
{
	
}
</script>