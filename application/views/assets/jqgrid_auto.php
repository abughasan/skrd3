<script>
	function gridReload(){
	<?php 
		foreach ($kolom as $kol){
			?>var <?=$kol;?> = $('#gs_<?=$kol;?>').val(); <?php
		}
	?>
		
		jQuery("#grid-table").jqGrid('setGridParam',
		{url:"<?php echo base_url(); ?><?=$this->uri->segment(1); ?>/<?=$this->uri->segment(2); ?>/load/?<?php foreach($kolom as $kol){ 
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

$(document).ready(function(){
				var grid_selector = "#grid-table";
				var pager_selector = "#grid-pager";
				//resize to fit page size
				
				$(window).on('resize.jqGrid', function () {
					$(grid_selector).jqGrid( 'setGridWidth', $(".page-content").width() );
			    })
				//resize on sidebar collapse/expand
				var parent_column = $(grid_selector).closest('[class*="col-"]');
				$(document).on('settings.ace.jqGrid' , function(ev, event_name, collapsed) {
					if( event_name === 'sidebar_collapsed' || event_name === 'main_container_fixed' ) {
						//setTimeout is for webkit only to give time for DOM changes and then redraw!!!
						setTimeout(function() {
							$(grid_selector).jqGrid( 'setGridWidth', parent_column.width() );
						}, 0);
					}
			    });
			})

//-----------------------------------------------------JQGRID AWAL
$(function () {

	var lastsel3;
   $("#grid-table").jqGrid({
        url: "<?php echo base_url(); ?>index.php/<?=$this->uri->segment(1); ?>/<?=$this->uri->segment(2); ?>/load/"+filter+filter2,
        datatype: "xml",
        mtype: "GET",
		<?php 
		((isset($jqgrid_at_name)) ? print colname($table,$jqgrid_at_name) : '');
			// $jqgrid_at adalah variabel dari Controller
		((isset($jqgrid_at)) ? print colmodel($table,$jqgrid_at) : '');
		?>
        pager: "#grid-pager",
        rowNum: 5,
		rowList:[5,10,25,50,100],
		height: 250,
		// width: '100%',
		autowidth: true,
		editurl: "<?php echo base_url(); ?><?=$this->uri->segment(1); ?>/<?=$this->uri->segment(2); ?>/update/",
		toppager:true,
		cellEdit:true,
		cellsubmit : 'remote',
		cellattr : function(rowId, cellValue, rawObject, cm, rdata) {
			if (parseFloat(cellValue) > 200) {
				return " class='ui-state-error-text ui-state-error'";
			}

		},
		caption : "<?php ((isset($title)) ? print $title : ""); ?>",
		loadComplete : function() {
						var table = this;
						setTimeout(function(){
							styleCheckbox(table);
							
							updateActionIcons(table);
							updatePagerIcons(table);
							enableTooltips(table);
						}, 0);
					},
		cellurl: "<?php echo base_url(); ?><?=$this->uri->segment(1); ?>/<?=$this->uri->segment(2); ?>/update/",
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
	   buttonicon:"ace-icon fa fa-plus-circle purple bplus", 
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
	   buttonicon:"ace-icon fa fa-close red bcancel", 
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
		buttonicon:"ace-icon fa fa-refresh green",
		onClickButton: function(){
			var grid = $("#grid-table"); grid.trigger("reloadGrid");
		}
	})
	<?php endif; ?>
	<?php if (ISSET($button_nav['cari']) && $button_nav['cari']==TRUE): ?>
	.navButtonAdd('#grid-table_toppager',{
		caption:"<span class='bcari'>Cari</span>",
		buttonicon:"ace-icon fa fa-search orange",
		onClickButton: function(){
			$("#grid-table")[0].toggleToolbar();
		}
	})
	<?php endif; ?>
	<?php if (ISSET($button_nav['delete']) && $button_nav['delete']==TRUE): ?>
	.navButtonAdd('#grid-table_toppager',{
		caption:"<span class='btrash'>Delete</span>",
		buttonicon:"ace-icon fa fa-trash-o red",
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
var grid_selector = "#grid-table";
				var pager_selector = "#grid-pager";

	jQuery(grid_selector).jqGrid('navGrid',pager_selector,
					{ 	//navbar options
						edit: true,
						editicon : 'ace-icon fa fa-pencil blue',
						add: true,
						addicon : 'ace-icon fa fa-plus-circle purple',
						del: true,
						delicon : 'ace-icon fa fa-trash-o red',
						search: true,
						searchicon : 'ace-icon fa fa-search orange',
						refresh: true,
						refreshicon : 'ace-icon fa fa-refresh green',
						view: true,
						viewicon : 'ace-icon fa fa-search-plus grey',
					},
					{
						//edit record form
						//closeAfterEdit: true,
						//width: 700,
						recreateForm: true,
						beforeShowForm : function(e) {
							var form = $(e[0]);
							form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
							style_edit_form(form);
						}
					},
					{
						//new record form
						//width: 700,
						closeAfterAdd: true,
						recreateForm: true,
						viewPagerButtons: false,
						beforeShowForm : function(e) {
							var form = $(e[0]);
							form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar')
							.wrapInner('<div class="widget-header" />')
							style_edit_form(form);
						}
					},
					{
						//delete record form
						recreateForm: true,
						beforeShowForm : function(e) {
							var form = $(e[0]);
							if(form.data('styled')) return false;
							
							form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
							style_delete_form(form);
							
							form.data('styled', true);
						},
						onClick : function(e) {
							//alert(1);
						}
					},
					{
						//search form
						recreateForm: true,
						afterShowSearch: function(e){
							var form = $(e[0]);
							form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
							style_search_form(form);
						},
						afterRedraw: function(){
							style_search_filters($(this));
						}
						,
						multipleSearch: true,
						/**
						multipleGroup:true,
						showQuery: true
						*/
					},
					{
						//view record form
						recreateForm: true,
						beforeShowForm: function(e){
							var form = $(e[0]);
							form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
						}
					}
				)
			
			
				
				function style_edit_form(form) {
					//enable datepicker on "sdate" field and switches for "stock" field
					form.find('input[name=sdate]').datepicker({format:'yyyy-mm-dd' , autoclose:true})
					
					form.find('input[name=stock]').addClass('ace ace-switch ace-switch-5').after('<span class="lbl"></span>');
							   //don't wrap inside a label element, the checkbox value won't be submitted (POST'ed)
							  //.addClass('ace ace-switch ace-switch-5').wrap('<label class="inline" />').after('<span class="lbl"></span>');
			
							
					//update buttons classes
					var buttons = form.next().find('.EditButton .fm-button');
					buttons.addClass('btn btn-sm').find('[class*="-icon"]').hide();//ui-icon, s-icon
					buttons.eq(0).addClass('btn-primary').prepend('<i class="ace-icon fa fa-check"></i>');
					buttons.eq(1).prepend('<i class="ace-icon fa fa-times"></i>')
					
					buttons = form.next().find('.navButton a');
					buttons.find('.ui-icon').hide();
					buttons.eq(0).append('<i class="ace-icon fa fa-chevron-left"></i>');
					buttons.eq(1).append('<i class="ace-icon fa fa-chevron-right"></i>');		
				}
			
				function style_delete_form(form) {
					var buttons = form.next().find('.EditButton .fm-button');
					buttons.addClass('btn btn-sm btn-white btn-round').find('[class*="-icon"]').hide();//ui-icon, s-icon
					buttons.eq(0).addClass('btn-danger').prepend('<i class="ace-icon fa fa-trash-o"></i>');
					buttons.eq(1).addClass('btn-default').prepend('<i class="ace-icon fa fa-times"></i>')
				}
				
				function style_search_filters(form) {
					form.find('.delete-rule').val('X');
					form.find('.add-rule').addClass('btn btn-xs btn-primary');
					form.find('.add-group').addClass('btn btn-xs btn-success');
					form.find('.delete-group').addClass('btn btn-xs btn-danger');
				}
				function style_search_form(form) {
					var dialog = form.closest('.ui-jqdialog');
					var buttons = dialog.find('.EditTable')
					buttons.find('.EditButton a[id*="_reset"]').addClass('btn btn-sm btn-info').find('.ui-icon').attr('class', 'ace-icon fa fa-retweet');
					buttons.find('.EditButton a[id*="_query"]').addClass('btn btn-sm btn-inverse').find('.ui-icon').attr('class', 'ace-icon fa fa-comment-o');
					buttons.find('.EditButton a[id*="_search"]').addClass('btn btn-sm btn-purple').find('.ui-icon').attr('class', 'ace-icon fa fa-search');
				}
				
				function beforeDeleteCallback(e) {
					var form = $(e[0]);
					if(form.data('styled')) return false;
					
					form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
					style_delete_form(form);
					
					form.data('styled', true);
				}
				
				function beforeEditCallback(e) {
					var form = $(e[0]);
					form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
					style_edit_form(form);
				}
			
			
			
				//it causes some flicker when reloading or navigating grid
				//it may be possible to have some custom formatter to do this as the grid is being created to prevent this
				//or go back to default browser checkbox styles for the grid
				function styleCheckbox(table) {
				/**
					$(table).find('input:checkbox').addClass('ace')
					.wrap('<label />')
					.after('<span class="lbl align-top" />')
			
			
					$('.ui-jqgrid-labels th[id*="_cb"]:first-child')
					.find('input.cbox[type=checkbox]').addClass('ace')
					.wrap('<label />').after('<span class="lbl align-top" />');
				*/
				}
				
			
				//unlike navButtons icons, action icons in rows seem to be hard-coded
				//you can change them like this in here if you want
				function updateActionIcons(table) {
					/**
					var replacement = 
					{
						'ui-ace-icon fa fa-pencil' : 'ace-icon fa fa-pencil blue',
						'ui-ace-icon fa fa-trash-o' : 'ace-icon fa fa-trash-o red',
						'ui-icon-disk' : 'ace-icon fa fa-check green',
						'ui-icon-cancel' : 'ace-icon fa fa-times red'
					};
					$(table).find('.ui-pg-div span.ui-icon').each(function(){
						var icon = $(this);
						var $class = $.trim(icon.attr('class').replace('ui-icon', ''));
						if($class in replacement) icon.attr('class', 'ui-icon '+replacement[$class]);
					})
					*/
				}
				
				//replace icons with FontAwesome icons like above
				function updatePagerIcons(table) {
					var replacement = 
					{
						'ui-icon-seek-first' : 'ace-icon fa fa-angle-double-left bigger-140',
						'ui-icon-seek-prev' : 'ace-icon fa fa-angle-left bigger-140',
						'ui-icon-seek-next' : 'ace-icon fa fa-angle-right bigger-140',
						'ui-icon-seek-end' : 'ace-icon fa fa-angle-double-right bigger-140'
					};
					$('.ui-pg-table:not(.navtable) > tbody > tr > .ui-pg-button > .ui-icon').each(function(){
						var icon = $(this);
						var $class = $.trim(icon.attr('class').replace('ui-icon', ''));
						
						if($class in replacement) icon.attr('class', 'ui-icon '+replacement[$class]);
					})
				}
			
				function enableTooltips(table) {
					$('.navtable .ui-pg-button').tooltip({container:'body'});
					$(table).find('.ui-pg-div').tooltip({container:'body'});
				}


</script>