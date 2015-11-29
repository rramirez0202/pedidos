<?= $menumain; ?>
<div class="container">
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
        				<label for="frm_perfil_nombre" class="col-sm-2 control-label">Nombre <abbr class="text-danger" title="Campo Obligatorio">(*)</abbr></label>
        				<div class="col-sm-10">
        					<input type="text" class="form-control" id="frm_perfil_nombre" name="frm_perfil_nombre" value="<?= $objeto->getNombre(); ?>" placeholder="Nombre del perfil" maxlength="250" />
        				</div>
			        </div>
			        <div class="form-group">
        				<label for="frm_perfil_observaciones" class="col-sm-2 control-label">Observaciones</label>
        				<div class="col-sm-10">
        					<textarea rows="3" class="form-control" id="frm_perfil_observaciones" name="frm_perfil_observaciones"><?= $objeto->getObservaciones(); ?></textarea>
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
					<div class="form-group">
						<div class="col-sm-8"></div>
						<div class="col-sm-2">
			                <button type="button" class="btn btn-success" onclick="Perfil.Enviar(<?= ($objeto->getIdperfil()!="" && $objeto->getIdperfil()!=0?'false':'true'); ?>)" >Guardar</button>
			            </div>
			            <div class="col-sm-2">
			                <button type="button" class="btn btn-danger" onclick="location.href='<?= base_url('perfiles'); ?>'">Cancelar</button>
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
			<input type="checkbox" id="frm_perfil_permisos[]" name="frm_perfil_permisos[]" value="<?= $permiso["idpermiso"]; ?>" <?= (in_array($permiso["idpermiso"],$objeto->getPermisos())?'checked="checked"':''); ?> />
			(<?= $permiso["idpermiso"]; ?>) <?= $permiso["nombre"]; ?>
		</label>
	</div>
	<?php
	if($permiso["hijos"]!==false)
		foreach($permiso["hijos"] as $p)
			PrintPermiso($objeto,$p,$level+1);
}
?>