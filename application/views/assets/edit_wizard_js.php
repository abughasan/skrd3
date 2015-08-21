<script>
$(document).ready(function () {
<?php for($i=1;$integrasi->num_rows()>$i;$i++): ?>
	tambah_integrasi(<?=$i+1?>);
<?php endfor; ?>
});
</script>