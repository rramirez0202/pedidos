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
					<a href="<?= base_url("cambiopassword"); ?>" class="list-group-item active">Cambiar Contraseña</a>
					<?php endif;
					if($this->modsesion->hasPermisoHijo(7)): ?>
					<a href="<?= base_url("reseteopassword"); ?>" class="list-group-item">Resetar Contraseña</a>
					<?php endif;
					if($this->modsesion->hasPermisoHijo(8)): ?>
					<a href="<?= base_url("catalogos"); ?>" class="list-group-item">Catalogos</a>
					<?php endif;
					if($this->modsesion->hasPermisoHijo(10)): ?>
					<a href="<?= base_url("perfiles"); ?>" class="list-group-item">Perfiles</a>
					<?php endif;
					if($this->modsesion->hasPermisoHijo(11)): ?>
					<a href="<?= base_url("permisos"); ?>" class="list-group-item">Permisos</a>
					<?php endif; ?>
				</div>
			</td>
			<td>
				<div class="interespaciado"></div>
				<form class="form-horizontal" role="form" id="frm_data">
					<div class="form-group">
						<label class="col-sm-5 control-label" for="frm_data_actual">Contraseña Actual:</label>
						<div class="col-sm-7">
        					<input type="password" class="form-control" id="frm_data_actual" name="frm_data_actual" maxlength="250" />
        				</div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label" for="frm_data_nueva">Contraseña Nueva:</label>
						<div class="col-sm-7">
        					<input type="password" class="form-control" id="frm_data_nueva" name="frm_data_nueva" maxlength="250" />
        				</div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label" for="frm_data_confirmacion">Confirmar Contraseña Nueva:</label>
						<div class="col-sm-7">
        					<input type="password" class="form-control" id="frm_data_confirmacion" name="frm_data_confirmacion" maxlength="250" />
        				</div>
					</div>
					<div class="form-group">
						<div class="col-sm-9"></div>
						<div class="col-sm-3">
			                <button type="button" class="btn btn-success" onclick="Usuario.CambiarPwd()" >Cambiar Contraseña</button>
			            </div>
					</div>
				</form>
			</td>
		</tr>
	</table>
</div>