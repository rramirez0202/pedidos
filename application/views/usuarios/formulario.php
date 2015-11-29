<?= $menumain; ?>
<?php
if(!isset($clienteIdPerfil)) $clienteIdPerfil=false;
if(!isset($idCliente)) $idCliente=0;
?>
<div class="container">
	<table class="contenidos">
		<tr>
			<td class="primero">
				<div class="notePostIt" style="background-image: url('<?= base_url("project_files/img/sistema/post-it.png"); ?>');" onclick="location.href='<?= base_url("usuarios"); ?>'">
					<h1>Usuarios</h1>
				</div>
			</td>
			<td>
				<form class="form-horizontal" role="form" id="frm_usuarios">
			        <input type="hidden" id="frm_usuario_idusuario" name="frm_usuario_idusuario" value="<?= $objeto->getIdusuario(); ?>" />
			        <input type="hidden" id="frm_usuario_idcliente" name="frm_usuario_idcliente" value="<?= $idCliente; ?>" />
			        <div class="form-group">
        				<label for="frm_usuario_nombre" class="col-sm-2 control-label">Nombre <abbr class="text-danger" title="Campo Obligatorio">(*)</abbr></label>
        				<div class="col-sm-10">
        					<input type="text" class="form-control" id="frm_usuario_nombre" name="frm_usuario_nombre" value="<?= $objeto->getNombre(); ?>" placeholder="Nombre del usuario" maxlength="250" />
        				</div>
			        </div>
			        <div class="form-group">
        				<label for="frm_usuario_apaterno" class="col-sm-2 control-label">Apellido Paterno</label>
        				<div class="col-sm-4">
        					<input type="text" class="form-control" id="frm_usuario_apaterno" name="frm_usuario_apaterno" value="<?= $objeto->getApaterno(); ?>" placeholder="Apellido Paterno" maxlength="250" />
        				</div>
        				<label for="frm_usuario_amaterno" class="col-sm-2 control-label">Apellido Materno</label>
        				<div class="col-sm-4">
        					<input type="text" class="form-control" id="frm_usuario_amaterno" name="frm_usuario_amaterno" value="<?= $objeto->getAmaterno(); ?>" placeholder="Apellido Materno" maxlength="250" />
        				</div>
			        </div>
			        <div class="form-group">
        				<label for="frm_usuario_usuario" class="col-sm-2 control-label">Usuario <abbr class="text-danger" title="Campo Obligatorio">(*)</abbr></label>
        				<div class="col-sm-4">
        					<input type="text" class="form-control" id="frm_usuario_usuario" name="frm_usuario_usuario" value="<?= $objeto->getUsuario(); ?>" placeholder="Usuario" maxlength="250" />
        				</div>
        				<label for="frm_usuario_email" class="col-sm-2 control-label">Correo Electrónico <abbr class="text-danger" title="Campo Obligatorio">(*)</abbr></label>
        				<div class="col-sm-4">
        					<input type="email" class="form-control" id="frm_usuario_email" name="frm_usuario_email" value="<?= $objeto->getEmail(); ?>" placeholder="Correo Electrónico" maxlength="250" />
        				</div>
			        </div>
			        <div class="form-group">
			        	<label for="frm_usuario_idwinapp" class="col-sm-2 control-label">Id WinApp</label>
			        	<div class="col-sm-4">
			        		<input type="text" class="form-control" id="frm_usuario_idwinapp" name="frm_usuario_idwinapp" value="<?= $objeto->getIdwinapp(); ?>" placeholder="Id WinApp" maxlength="255" />
			        	</div>
				        <div class="col-sm-6">
        					<div class="checkbox">
        						<label>
        							<input type="checkbox" value="1" id="frm_usuario_activo" name="frm_usuario_activo" <?= ($objeto->getActivo()==1?'checked="checked"':''); ?> />
        							Activo
        						</label>
        					</div>
				        </div>
			        </div>
			        <?php
			        if($clienteIdPerfil===false)
			        {
						?>
						<div class="col-sm-12">
        					<fieldset>
        						<legend>Perfiles</legend>
        						<?php if($perfiles!==false) foreach($perfiles as $perfil): ?>
        							<div class="checkbox">
        								<label>
        									<input type="checkbox" value="<?= $perfil["idperfil"]; ?>" id="frm_usuario_perfiles[]" name="frm_usuario_perfiles[]" <?= (in_array($perfil["idperfil"],$objeto->getPerfiles())?' checked="checked"':''); ?> />
        									<?= $perfil["nombre"]; ?>
        								</label>
        							</div>
        						<?php endforeach; ?>
        					</fieldset>
				        </div>
						<?php
			        }
			        else
			        {
						?>
						<input type="hidden" value="<?= $clienteIdPerfil; ?>" id="frm_usuario_perfiles[]" name="frm_usuario_perfiles[]" />
						<?php
			        }
			        ?>
			        <div class="form-group">
						<div class="col-sm-8"></div>
						<div class="col-sm-2">
			                <button type="button" class="btn btn-success" onclick="Usuario.Enviar(<?= ($objeto->getIdusuario()!="" && $objeto->getIdusuario()!=0?'false':'true'); ?>)" >Guardar</button>
			            </div>
			            <div class="col-sm-2">
			                <button type="button" class="btn btn-danger" onclick="location.href='<?= base_url('usuarios'); ?>'">Cancelar</button>
			            </div>
					</div>
				</form>
			</td>
		</tr>
	</table>
</div>
<?php
if($clienteIdPerfil!==false && $idCliente>0)
{
	?>
	<script type="text/javascript">
	var IDCLIENTE = <?= $idCliente; ?>;
	</script>
	<?php
}
?>