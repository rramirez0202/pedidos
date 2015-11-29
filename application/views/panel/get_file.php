<?php
if(!isset($extra)) $extra="";

if($extra!="")
{
	?>
	<div>
		<?= $extra; ?>
	</div>
	<?php
}
?>
<form class="form-horizontal" role="form" id="frm_file" method="post" enctype="multipart/form-data">
	<div class="form-group">
        <label for="frm_archivo" class="col-sm-12">Archivo a cargar:</label>
	</div>
	<div class="form-group">
        <div class="col-sm-12">
        	<input type="file" class="form-control" id="frm_archivo" name="frm_archivo" />
        </div>
	</div>
</form>