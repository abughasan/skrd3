<script>

	function gridReload(){
	<?php 
		foreach ($kolom as $kol){
			?>var <?=$kol;?> = $('#gs_<?=$kol;?>').val(); <?php
		}
	?>
		
		jQuery("#grid-table").jqGrid('setGridParam',
		{url:"<?php echo base_url(); ?>index.php/<?=$this->uri->segment(1); ?>/index/load/?<?php foreach($kolom as $kol){ 
		?>&<?=$kol;?>="+<?=$kol;?>+"<?php } ?>",page:1}).trigger("reloadGrid");
		
	}
	function reloadAfterAjax(){

	}

</script>
<script type="text/javascript">
var filter = "";
var filter2 = "";
<?php if(isset($autofilter)): ?>
	var filter = "?filter=<?=$autofilter['field']?>&<?=$autofilter['field']?>_f=<?=$this->session->userdata('id_i_gaji')?>";
<?php endif; ?>
<?php if(isset($menugrid)): ?>
$(document).ready(function(){
	$("select#selectkantor").change(function(){
		var tglabsen=$("#tgl_absen").val();
		var idkantor=$("#selectkantor option:selected").val();
		var insertabsen = tglabsen+'_'+idkantor;
		var filter = '?filter=tgl_absen&tgl_absen_f='+tglabsen;
		var filter2 = '&filter2=id_kantor&id_kantor_f='+idkantor;
		$.ajax({
				url: "<?=base_url()?>index.php/trans/insertabsen/"+insertabsen,
				cache: false,
				success: function(msg){
					$("#msgabsen").html(msg);
				}
			});
		$('#grid-table').jqGrid('GridUnload');

<?php endif; ?>
<?php if(isset($filtergridsingle)): ?>
$(document).ready(function(){

	$("select#<?=$filtergridsingle['id_combo']?>").change(function(){
		var <?=$filtergridsingle['id_combo']?>=$("#<?=$filtergridsingle['id_combo']?> option:selected").val();
		var filter = '?filter=<?=$filtergridsingle['id_combo']?>&<?=$filtergridsingle['id_combo']?>_f='+<?=$filtergridsingle['id_combo']?>;
		$('#grid-table').jqGrid('GridUnload');

<?php endif; ?>

<?php if(isset($filterinputsingle)): ?>
$(document).ready(function(){
	
	$('#grid-table').jqGrid('GridUnload');
	
<?php endif; ?>
//-----------------------------------------------------JQGRID AWAL
$(function () {
	var lastsel3;
   $("#grid-table").jqGrid({
        url: "<?php echo base_url(); ?>index.php/<?=$this->uri->segment(1); ?>/index/load/"+filter+filter2,
        datatype: "xml",
        mtype: "GET",
		<?php 
		((isset($jqgrid_at_name)) ? print colname($table,$jqgrid_at_name) : '');
			// $jqgrid_at adalah variabel dari Controller
		((isset($jqgrid_at)) ? print colmodel($table,$jqgrid_at) : '');
		?>
        pager: "#grid-pager",
        rowNum: 10,
		rowList:[5,10,25,50,100],
		height: 'auto',
		editurl: "<?php echo base_url(); ?>index.php/<?=$this->uri->segment(1); ?>/index/update/",
		toppager:true,
		cellEdit:true,
		cellsubmit : 'remote',
		cellattr : function(rowId, cellValue, rawObject, cm, rdata) {
			if (parseFloat(cellValue) > 200) {
				return " class='ui-state-error-text ui-state-error'";
			}

		},
		cellurl: "<?php echo base_url(); ?>index.php/<?=$this->uri->segment(1); ?>/index/update/",
		<?php if( isset($sortname) ): ?>
			sortname: '<?=$sortname?>',
		<?php endif; ?>

		<?php if( isset($gridsubgrid) ): ?>
			<?php $this->load->view("jqgrid/table_grid_subgrid"); ?>
		<?php endif; ?>
		<?php if( isset($gridsubgrid_new) ): ?>
			<?php $this->load->view("jqgrid/table_grid_subgrid_".$subwhat); ?>
		<?php endif; ?>
		// pgbuttons:false,
		// pgtext:null,
        // rowList: [10, 20, 30],
		// multikey: "ctrlKey",
		// multiselect: true,
		// multiboxonly: true,
		// toolbar: [true,"top"],
        // caption: "Table ASET BAKU"
		
    });
	
	jQuery("#grid-table").navGrid("#grid-table_toppager",{edit:false,add:false,del:false,search:false,refresh:false})
	<?php if (ISSET($button_nav['add']) && $button_nav['add']==TRUE): ?>
	.navButtonAdd('#grid-table_toppager',{
	   caption:"<span class='bplus'>Data</span>", 
	   buttonicon:"ui-icon-plus bplus", 
	   onClickButton: function(){ 
			parameters =
			{
				rowID : "new_row",
				initdata : {<?php ((isset($initdata)) ? print $initdata : '') ?>},
				position :"last",
				useDefValues : false,
				useFormatter : false,
				addRowParams : 
				{
					"keys": true, "aftersavefunc": function() 
					{ 
					var grid = $("#grid-table"); grid.trigger("reloadGrid");
					$(".bcancel").hide('fadeout');
					$(".bplus").show('slow'); 
					}
				},
			}
			jQuery("#grid-table").jqGrid('addRow',parameters);
			$(".bcancel").show('slow');
			$(".bplus").hide('fadeIn');
	   }, 
	   position:"last"
	})
	.navButtonAdd('#grid-table_toppager',{
	   caption:"<span class='bcancel'>Cancel</span>", 
	   buttonicon:"ui-icon-cancel bcancel", 
	   onClickButton: function(){ 
			jQuery("#grid-table").jqGrid('restoreRow',"new_row");
			$(".bcancel").hide('fadeout');
			$(".bplus").show('slow');
	   }
	})
	<?php endif; ?>
	<?php if (ISSET($button_nav['reload']) && $button_nav['reload']==TRUE): ?>
	.navButtonAdd('#grid-table_toppager',{
		caption:"<span class='brefresh'>Reload</span>",
		buttonicon:"ui-icon-refresh",
		onClickButton: function(){
			var grid = $("#grid-table"); grid.trigger("reloadGrid");
		}
	})
	<?php endif; ?>
	<?php if (ISSET($button_nav['cari']) && $button_nav['cari']==TRUE): ?>
	.navButtonAdd('#grid-table_toppager',{
		caption:"<span class='bcari'>Cari</span>",
		buttonicon:"ui-icon-search",
		onClickButton: function(){
			$("#grid-table")[0].toggleToolbar();
		}
	})
	<?php endif; ?>
	<?php if (ISSET($button_nav['delete']) && $button_nav['delete']==TRUE): ?>
	.navButtonAdd('#grid-table_toppager',{
		caption:"<span class='btrash'>Delete</span>",
		buttonicon:"ui-icon-trash",
		onClickButton: function(){
			var rowid = $('#grid-table').jqGrid("getGridParam", "selrow");
			if (rowid === null) {
				$.jgrid.viewModal("#" + 'alertmod_' + this.p.id,
					{gbox: "#gbox_" + $.jgrid.jqID(this.p.id), jqm: true});
				$("#jqg_alrt").focus();
			}else{
				$('#grid-table').jqGrid('delGridRow',rowid);
			}
		}
	});
	<?php endif; ?>
	
	jQuery("#grid-table").jqGrid('filterToolbar'); // must disable jQuery event first, cz all we need is just its interface
	
	$("#grid-table_toppager_center").remove();
	$("#grid-table_toppager_right").remove();
	$(".bcancel").hide();
	$("#grid-table")[0].toggleToolbar();
	
	<?php 
		foreach ($kolom as $kol){
			?>$("#gs_<?=$kol;?>").keyup(function(){gridReload();}); <?php
		}
	?>
	 
	/** FUNGSI MULTI DELETE STILL NOT YET WORK
	$("#t_list").append("<input type='button' value='Click Me' id='deleteButton' style='height:20px;font-size:-3'/>");
	$("input","#t_list").click(function(){
		var s;
		s = jQuery("#grid-table").jqGrid('getGridParam','selarrrow');
		alert(s);
		for(var i=0;i<s.length;i++){
			// alert(s.length);
			myrow = jQuery('#grid-table').jqGrid('getCell',s[i],'nama_aset');
			alert(myrow);
		$("#grid-table").delRowData(s[i]);
		}
		
		});
	**/
	
}); 
//--------------------------------------JQGRID AKHIR
<?php if(isset($menugrid)): ?>
	});
});
<?php endif; ?>
<?php if(isset($filtergridsingle)): ?>
	});
});
<?php endif; ?>
<?php if(isset($filterinputsingle)): ?>
	
	}); // end of jqgrid
	
}); // end of doucment ready function
<?php endif; ?>
</script>