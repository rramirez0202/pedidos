<!doctype html>
<html class="no-js" lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0" />
    <title>..:: Lili - Cremería y Salchichoneria ::..</title>
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
    <meta name="apple-mobile-web-app-title" content="Cremería y Salchichonería Lili">
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
        	<input type="hidden" name="url" id="url" value="<?= base_url('inicio/login'); ?>" />
           <a href="#">
          <img src="<?= base_url('project_files/img/acceso/laroca-login.png'); ?>" width="336" height="82" class="brand animated fadeInDown">
        </a>
            <div class="contenedorForma">
          <label class="label" for="usr"> Usuario </label>
          <input class="form-control" id="usr" name="usr" placeholder="Nombre de usuario" required="required" >
          <label class="label" for="pwd"> Contraseña</label>
          <input type="password" id="pwd" name="pwd" class="form-control" placeholder="Contraseña" required="required">
               <label><a href="<?= base_url("inicio/recuperarcontrasena"); ?>" class="contra">¿Olvidaste tu contraseña?</a></label> 
        <button class="btnlog" type="" onclick="Usuario.GetAcceso()">Iniciar sesión</button>
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
    <script type="text/javascript">
    	(function(){
    		if(location.host.indexOf("dev")>-1)
    			return true;
    		if(location.host.indexOf("www")>-1)
    			return true;
    		location.href=location.protocol+"//www."+location.host+location.pathname;
    	})();
    </script>
  </body>
</html>
