<div class="container">
	<!-- starting template two column kiri 4 kanan 8 
		available for 
			desktop medium width >= 992px
			desktop / tablet small width >= 768px
	-->
		<div class="row">
			
			<div class="col-md-1 hidden-sm hidden-xs"></div>
			<div class="col-md-10 col-sm-12 co-xs-12 canvas">
				<?php if (! empty($interface)): ?>
				<?php foreach($interface as $isi): ?>
					<?php $this->load->view("interface/inf_".$isi); ?>
				<?php endforeach; ?>
				<?php endif; ?>
			</div>
			<div class="col-md-1 hidden-sm hidden-xs"></div>
			
		</div>
</div>