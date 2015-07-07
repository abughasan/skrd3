<div class="main-content">
				<div class="main-content-inner">
					

					<div class="page-content">
						
						<div class="row">
							<div class="col-xs-12">
							
							<table class="table table-bordered">
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
										<?=@$this->app_model->getSelectedData('dbangunan',array('id'=>$row->idbangunan))->row()->lokasi?> <br/>
										Kec. <?=@$this->app_model->getSelectedData('mkecamatan',array('kecamatan_id'=>$this->app_model->getSelectedData('dbangunan',array('id'=>$row->idbangunan))->row()->kecamatan_id))->row()->kecamatan_name?>, Kel. <?=@$this->app_model->getSelectedData('mdesa',array('desa_id'=>$this->app_model->getSelectedData('dbangunan',array('id'=>$row->idbangunan))->row()->desa_id))->row()->desa_name?>
										</td>
										<td class="autonum" align="right"><?=ceil($this->app_model->manualQuery("	SELECT SUM(jumlah_ret) tot FROM transskr WHERE idheaderskr = {$row->id}")->row()->tot / 1000 ) * 1000 ?></td>
										<td align="center">
											<a class="btn btn-xs btn-app btn-light" href="<?=base_url()?>report/skrd/<?=$row->id?>"><i class="ace-icon fa fa-print"></i></a>
										</td>
									</tr>
									<?php endforeach; ?>
									
															</tbody>
							</table>
							
							
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->