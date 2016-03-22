<!doctype html>
<html class="no-js" lang="es">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0" />
		<title><?= $this->config->item("sitename"); ?></title>
		<link rel="stylesheet" href="<?= base_url('project_files/css/acceso/style.css'); ?>" />
		<link rel="shortcut icon" href="<?= base_url('project_files/img/acceso/favicon.png'); ?>" type="image/x-icon" />
		<link rel="apple-touch-icon" href="<?= base_url('project_files/img/acceso/favicon.png'); ?>" />
		<link rel="apple-touch-icon" sizes="57x57" href="<?= base_url('project_files/img/acceso/favicon.png'); ?>" />
		<link rel="apple-touch-icon" sizes="72x72" href="<?= base_url('project_files/img/acceso/favicon.png'); ?>" />
		<link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('project_files/img/acceso/favicon.png'); ?>" />
		<link rel="apple-touch-icon" sizes="114x114" href="<?= base_url('project_files/img/acceso/favicon.png'); ?>" />
		<link rel="apple-touch-icon" sizes="120x120" href="<?= base_url('project_files/img/acceso/favicon.png'); ?>" />
		<link rel="apple-touch-icon" sizes="144x144" href="<?= base_url('project_files/img/acceso/favicon.png'); ?>" />
		<link rel="apple-touch-icon" sizes="152x152" href="<?= base_url('project_files/img/acceso/favicon.png'); ?>" />
		<meta name="apple-mobile-web-app-title" content="<?= $this->config->item("appname"); ?>">
		<script src="<?= base_url('project_files/js/jquery-2.1.4.min.js'); ?>"></script>
		<script src="<?= base_url('project_files/js/acceso/vendor/modernizr.js'); ?>"></script>
		<!-- jQuery MSG plugin -->
		<script type="text/javascript" src="<?= base_url('project_files/msg/jquery.center.min.js'); ?>"></script>
		<script type="text/javascript" src="<?= base_url('project_files/msg/jquery.msg.min.js'); ?>"></script>
		<link media="screen" href="<?= base_url('project_files/msg/jquery.msg.css'); ?>" rel="stylesheet" type="text/css">
		<script src="<?= base_url('project_files/js/app.js'); ?>"></script>
		<script type="text/javascript">
			var baseURL='<?= base_url(); ?>';
		</script>
	</head>
	<body class="home" style="background-image: url('<?= base_url('project_files/img/acceso/bg.jpg'); ?>');">
		<ul id="cbp-bislideshow" class="cbp-bislideshow">
			<li><img src="<?= base_url('project_files/img/acceso/bg-1.jpg'); ?>"/></li>
			<li><img src="<?= base_url('project_files/img/acceso/bg-2.jpg'); ?>"/></li>
			<li><img src="<?= base_url('project_files/img/acceso/bg-3.jpg'); ?>"/></li>
		</ul>
		<div class="row homebrand">
			<div class="large-12">
				<div class="page-canvas">
					<form id="frm_acceso" class="form-signin" role="form" onsubmit="return false;">
						<a href="<?= base_url(); ?>">
							<img src="<?= base_url('project_files/img/acceso/login.png'); ?>" width="336" height="82" class="brand animated fadeInDown">
						</a>
						<div class="contenedorForma">
							<p style="text-align: justify;">Iniciarás el proceso de restauración de contraseña, para ello es necesario que ingreses tu <strong>usuario</strong> y en breve recibirás un correo electrónico con tu nueva contraseña.</p>
							<label class="label" for="usr"> Usuario </label>
							<input class="form-control" id="usr" name="usr" placeholder="Nombre de usuario" required="required" >
							<label>&nbsp;</label>
							<button class="btnlog" type="" onclick="Usuario.GetData()">Recuperar Contraseña</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<script src="<?= base_url('project_files/js/acceso/jquery.imagesloaded.min.js'); ?>"></script>
		<script src="<?= base_url('project_files/js/acceso/cbpBGSlideshow.min.js'); ?>"></script>
		<script>
			$(function() {
				cbpBGSlideshow.init();
			});
		</script>
		<script src="<?= base_url('project_files/js/acceso/foundation.min.js'); ?>"></script>
		<script>
			$(document).foundation();
		</script>
	</body>
</html>
