<?php
if(!isset($idcatalogo)) $$idcatalogo=0;
?>
Opciones para agregar:<br />
<form id="opcionescatalogo" action="<?= base_url('catalogos/agregarOpciones/'.$idcatalogo); ?>" method="post">
	<input type="text" name="option1" id="option1" value="" /><br />
	<input type="text" name="option2" id="option2" value="" /><br />
	<input type="text" name="option3" id="option3" value="" /><br />
	<input type="text" name="option4" id="option4" value="" /><br />
	<input type="text" name="option5" id="option5" value="" /><br />
</form>
<br />
&nbsp;