<?php
if(!isset($tipopanel)) $tipopanel="primary";
?>
<div class="panel panel-<?= $tipopanel; ?>">
	<?php if(isset($panelheading) && $panelheading!=""): ?>
		<div class="panel-heading"><?= $panelheading; ?></div>
	<?php endif; ?>
	<?php if(isset($panelbody) && $panelbody!=""): ?>
		<div class="panel-body"><?= $panelbody; ?></div>
	<?php endif; ?>
	<?php if(isset($panelfooter) && $panelfooter!=""): ?>
		<div class="panel-footer"><?= $panelfooter; ?></div>
	<?php endif; ?>
</div>