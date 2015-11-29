<?php
if(!isset($usr)) $usr="";
if(!isset($pwd)) $pwd="";
?><!doctype html>
<html class="no-js" lang="es">
	<head>
		<meta charset="utf-8" />
		<title>..:: Lili - Cremería y Salchichoneria ::..</title>
		<style type="text/css">
			.dataaccessContenedor
			{
				width: 1280px;
				height: 500px;
				position: absolute;
				top:0px;
				left: 50%;
				margin-left: -640px;
				background-image: url('<?= base_url('project_files/img/acceso/bg-'.rand(1,3).'.jpg'); ?>');
			}
			.dataaccessDatos
			{
				width: 500px;
				position: absolute;
				top: 50px;
				left: 50%;
				margin-left: -300px;
				padding: 25px;
				background-color: rgba(255,255,255, 0.55);
				font-family: Arial, sans-serif;
				font-size: 14pt;
				border: 1px solid silver;
			}
			.dataaccessDatos div
			{
				margin: 5px 10px;
				padding: 5px;
			}
			.dataaccessDatos a
			{
				background-color: transparent;
			}
			.dataaccessInfo
			{
				background-color: #580058;
				color: #fff;
			}
			.dataaccessCentro
			{
				text-align: center;
			}
		</style>
	</head>
	<body>
		<div class="dataaccessContenedor">
			<div class="dataaccessDatos">
				<a href="<?= base_url(); ?>">
					<img src="<?= base_url('project_files/img/acceso/laroca-login.png'); ?>" />
				</a>
				<div>Tus datos de acceso al sistema son:</div>
				<hr />
				<div>Usuario:</div>
				<div class="dataaccessInfo"><?= $usr; ?></div>
				<div>Contraseña:</div>
				<div class="dataaccessInfo"><?= $pwd; ?></div>
				<div class="dataaccessCentro">
					<a href="<?= base_url(); ?>">
						Da clic aquí para ir al sistema.
					</a>
				</div>
			</div>
		</div>
	</body>
</html>