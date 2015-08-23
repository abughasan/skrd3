<script>
$(document).ready(function () {
<?php for($i=1;$int2->num_rows()>$i;$i++): ?>
	tambah_integrasi2(<?=$i+1?>);
<?php endfor; ?>

<?php $i=0;foreach($skr_ed->result() as $r):$i++; ?>
	autonumskrd(<?=$i?>)
	// alert(<?=$i?>)
<?php endforeach; ?>
});
</script>