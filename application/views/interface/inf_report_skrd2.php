<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
		<table width="100%">
			<thead>
				<tr><th>
					<div class="widget-box transparent">
						<div class="widget-header widget-header-large">
							<h3 class="widget-title grey lighter">
								LAMPIRAN SURAT KETETEAPAN RETRIBUSI (SKR)
							</h3>

							<div class="widget-toolbar no-border invoice-info">
								<span class="invoice-info-label">No SKR:</span>
								<span class="red">#<?=$idheaderskr;?></span>

								<br />
								<span class="invoice-info-label">Tanggal:</span>
								<span class="blue"><?=$headerskr->row()->tgl_penetapan?></span>
							</div>

							<div class="widget-toolbar hidden-480">
								<a href="#">
									<i class="ace-icon fa fa-print"></i>
								</a>
							</div>
						</div>
					</div>
				</th></tr>
			</thead>
			<tbody>
				<?php for($i=1;$i<500;$i++): ?>
				<tr><td>test <?=$i?></td></tr>
				<?php endfor; ?>	
			</tbody>
		</table>
		</div>
	</div>
</div>