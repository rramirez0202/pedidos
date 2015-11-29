<div class="barra_navegacion">
	<div class="container">
		<img src="<?= base_url('project_files/img/sistema/logo_simma.png'); ?>" class="logo_simma" />
		<div class="btn-group pull-right menu_principal">
			<div class="btn-group">
				<button type="button" class="btn btn-default" title="Cerrar Ayuda" onclick="window.close();">
					<span class="glyphicon glyphicon-remove-circle"></span>
				</button>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<?= $vista; ?>
</div>