<div class="main-content">
				<div class="main-content-inner">
					

					<div class="page-content">
						
						<div class="row">
							<div class="col-xs-12">
							<div class="widget-box panel widget-color-red">
							  <div class="panel-heading widget-header">
								  <div id="baseDateControl" class="">
									 <div class="dateControlBlock">
									 <?php 
										$date = strtotime(date('Y-m-d') .' -1 months');
										$oneMonthbefore=date('Y-m-d', $date);
									 ?>
											Filter Tanggal <input type="text" name="dateStart" id="dateStart" class="datepicker" value="<?=$oneMonthbefore?>" size="8" /> s/d 
											<input type="text" name="dateEnd" id="dateEnd" class="datepicker" value="<?=date('Y-m-d')?>" size="8"/>
										</div>
									</div>
							  </div>
							  <div class="panel-body">
								<table class="table table-bordered" id="reportAll" class="display">
									<thead>
																	<tr>
																		<th class="center">No</th>
																		<th>No SKR</th>
																		<th class="">Tgl SKR</th>
																		<th class="">Nama Pemohon</th>
																		<th>Fungsi Bangunan</th>
																		<th>Lokasi</th>
																		<th>Nilai SKR</th>
																		<th>Detail</th>
																	</tr>
									</thead>

																<tbody>
																
										<?php $a=0;foreach($headerskr->result() as $row): 
										$a++;
										?>
										<tr>
											<td><?=$a?></td>
											<td><?=$row->id?></td>
											<td><?=$row->tgl_penetapan?></td>
											<td><?=@$this->app_model->getSelectedData('dwajibretribusi',array('id'=>$row->idwajibret))->row()->nama?></td>
											<td><?=@$this->app_model->getSelectedData('mfungsi',array('idmfungsi'=>$this->app_model->getSelectedData('transintegritas',array('idheaderskr'=>"{$row->id}"))->row()->idmfungsi))->row()->parameter?></td>
											<td>
											<?=@$this->app_model->getSelectedData('dbangunan',array('id'=>$row->idbangunan))->row()->lokasi?> Kec. <?=@$this->app_model->getSelectedData('mkecamatan',array('kecamatan_id'=>$this->app_model->getSelectedData('dbangunan',array('id'=>$row->idbangunan))->row()->kecamatan_id))->row()->kecamatan_name?>, Kel. <?=@$this->app_model->getSelectedData('mdesa',array('desa_id'=>$this->app_model->getSelectedData('dbangunan',array('id'=>$row->idbangunan))->row()->desa_id))->row()->desa_name?>
											</td>
											<td class="autonum" align="right"><?=ceil($this->app_model->manualQuery("	SELECT SUM(jumlah_ret) tot FROM transskr WHERE idheaderskr = {$row->id}")->row()->tot / 1000 ) * 1000 ?></td>
											<td align="center" width="80px">
												<a class="btn btn-minier btn-danger" href="<?=base_url()?>report/delete_skrd/<?=$row->id?>"><i class="ace-icon fa fa-trash"></i></a>
												<a class="btn btn-minier btn-warning" href="<?=base_url()?>transaksi/edit/<?=$row->id?>"><i class="ace-icon fa fa-pencil"></i></a>
												<a class="btn btn-minier btn-info" href="<?=base_url()?>report/skrd/<?=$row->id?>"><i class="ace-icon fa fa-print"></i></a>
											</div>
											</td>
										</tr>
										<?php endforeach; ?>
										
																</tbody>
								</table>
								
							  </div>
							</div>
							
							
							
							
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->