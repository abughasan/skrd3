<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			 $(document).on('click', '.widget-box a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			 });
			 $('#login-form').submit(function(e){
				e.preventDefault();
				$('#login-side').removeClass('visible');
				$('#login-loading').addClass('visible');
			 });
			});
		</script>