<?= $menumain; ?>
<div class="container">
	<div class="btn-toolbar pull-right" role="toolbar">
		<div class="btn-group">
			<?php if($this->modsesion->hasPermisoHijo(10)): ?>
			<button type="button" class="btn btn-default" title="Ver todos los Perfiles" onclick="location.href='<?= base_url('perfiles'); ?>';">
				<span class="glyphicon glyphicon-th-list"></span>
			</button>
			<?php endif;
			if($this->modsesion->hasPermisoHijo(20)): ?>
			<button type="button" class="btn btn-default" title="Actualizar Perfil" onclick="location.href='<?= base_url('perfiles/actualizar/'.$objeto->getIdperfil()); ?>';">
				<span class="glyphicon glyphicon-edit"></span>
			</button>
			<?php endif;
			if($this->modsesion->hasPermisoHijo(21)): ?>
			<button type="button" class="btn btn-default" title="Borrar Perfil" onclick="Perfil.Eliminar(<?= $objeto->getIdperfil(); ?>)">
				<span class="glyphicon glyphicon-trash"></span>
			</button>
			<?php endif; ?>
		</div>
	</div>
	<table class="contenidos">
		<tr>
			<td class="primero">
				<div class="notePostIt" style="background-image: url('<?= base_url("project_files/img/sistema/post-it.png"); ?>');" onclick="location.href='<?= base_url("configuracion"); ?>'">
					<h1>Configuración</h1>
				</div>
				<div class="list-group">
					<?php if($this->modsesion->hasPermisoHijo(6)): ?>
					<a href="<?= base_url("cambiopassword"); ?>" class="list-group-item">Cambiar Contraseña</a>
					<?php endif;
					if($this->modsesion->hasPermisoHijo(7)): ?>
					<a href="<?= base_url("reseteopassword"); ?>" class="list-group-item">Resetar Contraseña</a>
					<?php endif;
					if($this->modsesion->hasPermisoHijo(8)): ?>
					<a href="<?= base_url("catalogos"); ?>" class="list-group-item">Catalogos</a>
					<?php endif;
					if($this->modsesion->hasPermisoHijo(10)): ?>
					<a href="<?= base_url("perfiles"); ?>" class="list-group-item active">Perfiles</a>
					<?php endif;
					if($this->modsesion->hasPermisoHijo(11)): ?>
					<a href="<?= base_url("permisos"); ?>" class="list-group-item">Permisos</a>
					<?php endif; ?>
				</div>
			</td>
			<td>
				<form class="form-horizontal" role="form" id="frm_perfiles">
			        <input type="hidden" id="frm_perfil_idperfil" name="frm_perfil_idperfil" value="<?= $objeto->getIdperfil(); ?>" />
			        <div class="form-group">
        				<label for="frm_perfil_nombre" class="col-sm-2 control-label">Nombre</label>
        				<div class="col-sm-10">
        					<p class="form-control-static"><?= $objeto->getNombre(); ?></p>
        				</div>
			        </div>
			        <div class="form-group">
        				<label for="frm_perfil_observaciones" class="col-sm-2 control-label">Observaciones</label>
        				<div class="col-sm-10">
        					<p class="form-control-static"><?= $objeto->getObservaciones(); ?></p>
        				</div>
			        </div>
			        <div class="form-group">
        				<div class="col-sm-12">
        					<fieldset>
        						<legend>Permisos</legend>
        						<?php if($permisos!==false) foreach($permisos as $permiso) PrintPermiso($objeto, $permiso); ?>
        					</fieldset>
        				</div>
			        </div>
				</form>
			</td>
		</tr>
	</table>
</div>
<?php
function PrintPermiso($objeto, $permiso,$level=0)
{
	$levelStr="";
	for($x=1;$x<=$level;$x++)
		$levelStr.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	?>
	<div class="checkbox">
		<?= $levelStr; ?>
		<label>
			<input type="checkbox" id="frm_perfil_permisos[]" name="frm_perfil_permisos" value="<?= $permiso["idpermiso"]; ?>" <?= (in_array($permiso["idpermiso"],$objeto->getPermisos())?'checked="checked"':''); ?> disabled="disabled" />
			(<?= $permiso["idpermiso"]; ?>) <?= $permiso["nombre"]; ?>
		</label>
	</div>
	<?php
	if($permiso["hijos"]!==false)
		foreach($permiso["hijos"] as $p)
			PrintPermiso($objeto,$p,$level+1);
}
?>