<?php if (! empty($interface) &&  is_array( $interface )): ?>
				<?php foreach($interface as $isi): ?>
					<?php $this->load->view("interface/inf_".$isi); ?>
				<?php endforeach; ?>
				<?php endif; ?>