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
    <script src="<?= base_url('project_files/js/app.js?time='.time()); ?>"></script>
    <link rel="stylesheet" type="text/css" href="<?= base_url('project_files/css/catalogoproductos.css?time='.time()); ?>">  
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
           	<a href="<?= base_url('inicio'); ?>">
          		<img src="<?= base_url('project_files/img/acceso/login.png'); ?>" width="336" height="82" class="brand animated fadeInDown">
        	</a>
        	<hr />
        	<table style="width: 100%;">
            	<tr>
            		<td style="width: 50%;">
            			<button class="btnlog" type="button" style="width: 100%;" onclick="location.href='<?= base_url('nuestrosproductos'); ?>'">
            				Nuestros Productos
            			</button>
            		</td>
            		<td style="width: 50%;">
            			<button class="btnlog" type="button" style="width: 100%;" onclick="location.href='<?= base_url('inicio'); ?>'">
            				Acceso al Sistema
            			</button>
            		</td>
            	</tr>
            </table>
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
    <div class="container">
    <?php foreach($data as $cat): ?>
    	<table class="categoryTitle"><tr><td></td><th><?= $cat["descripcion"]?></th><td></td></tr></table>
    	<table class="categories"><tr>
    	<?php foreach($cat["marcas"] as $k=>$mar): ?>
    		<td>
    			<?php if($mar["displaytitle"]):
    				if($mar["titlepicture"]!="")
    				{
						?><img src="<?= base_url($mar["titlepicture"]); ?>" class="marcaTitle" ><?php
    				}
    				else
    				{
						?><table class="marcaTitle"><tr><td></td><th><?= $mar["descripcion"]; ?></th><td></td></tr></table><?php
    				}
    				?>
    			<?php
    			endif;
    			if($mar["displaybody"]):
    				if($mar["bodypicture"]!="")
    				{
						?><img src="<?= base_url($mar["bodypicture"]); ?>" class="marcaBody" ><?php
    				}
    				?>
    				<table class="products">
    					<tr class="top"><th></th><td></td><th></th></tr>
    					<tr class="middle"><th></th><td>
    						<?php foreach($mar["prods"] as $prod): ?>
    						<?= $prod["nombre"]; ?><br />
    						<?php endforeach ?>
    					</td><th></th></tr>
    					<tr class="bottom"><th></th><td></td><th></th></tr>
    				</table>
    			<?php endif; ?>
    		</td>
    	<?php 
    	if(($k+1)%3==0)
    	{
			?></tr><tr><?php
    	}
    	endforeach; ?>
    	</td></tr></table>
    <?php endforeach?>
    </div>
  </body>
</html>
