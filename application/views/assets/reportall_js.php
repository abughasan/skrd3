<script>
	jQuery(function($) {
	  $('.autonum').autoNumeric('init'); 
	});
	$(document).ready(function() {
    var table = $('#reportAll').DataTable({
        dom: 'T<"clear">lfrtip',
		tableTools: {
            "sSwfPath": "<?=$this->config->item('base_assets')?>jqplugins/dataTables/ext/copy_csv_xls_pdf.swf"
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
</script>