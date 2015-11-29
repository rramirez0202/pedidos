<?php
if(!isset($breadcumbs)||(!is_array($breadcumbs))) $breadcumbs=array();
if(!isset($title)) $title="";
if(!isset($next)||(!is_array($next))||(!isset($next["label"]))||(!isset($next["href"]))) $next=array("label"=>"","href"=>"");
if(!isset($prev)||(!is_array($prev))||(!isset($prev["label"]))||(!isset($prev["href"]))) $prev=array("label"=>"","href"=>"");
if(!isset($video_url)) $video_url="";
if(!isset($extra)) $extra="";
if(!isset($show_top_bar_view)) $show_top_bar_view=true;
if(!isset($imagen)) $imagen="";
if($show_top_bar_view)
{
	?>
		<ol class="breadcrumb pull-left">
			<?php
				foreach($breadcumbs as $breadcumb)
					if(is_array($breadcumb) && isset($breadcumb["label"]) && isset($breadcumb["href"]))
					{
						?>
						<li><a href="<?= base_url($breadcumb["href"]); ?>"><?= $breadcumb["label"]; ?></a></li>
						<?php
					}
			?>
			<li class="active"><?= $title; ?></li>
		</ol>
		<div class="btn-toolbar pull-right" role="toolbar">
			<div class="btn-group">
				<?php
				if($prev["label"]!="" && $prev["href"]!="")
				{
					?>
					<button type="button" class="btn btn-default" title="Tema anterior: <?= $prev["label"]?>" onclick="location.href='<?= base_url($prev["href"]); ?>';">
						<span class="glyphicon glyphicon-chevron-left"></span>
					</button>
					<?php
				}
				else
				{
					?>
					<button type="button" class="btn btn-default disabled">
						<span class="glyphicon glyphicon-chevron-left"></span>
					</button>
					<?php
				}
				if($next["label"]!="" && $next["href"]!="")
				{
					?>
					<button type="button" class="btn btn-default" title="Tema Sigiente: <?= $next["label"]?>" onclick="location.href='<?= base_url($next["href"]); ?>';">
						<span class="glyphicon glyphicon-chevron-right"></span>
					</button>
					<?php
				}
				else
				{
					?>
					<button type="button" class="btn btn-default disabled">
						<span class="glyphicon glyphicon-chevron-right"></span>
					</button>
					<?php
				}
				?>
			</div>
		</div>
		<div style="clear: both;"></div>
	<?php
}
?>
<h3><?= $title; ?></h3>
<?php
	if($imagen!="")
	{
		?>
		<center>
			<img src="<?= base_url($imagen)?>" />
		</center>
		<?php
	}
?>
<center>
	<iframe width="560" height="315" src="<?= $video_url; ?>" frameborder="0" allowfullscreen></iframe>
</center>
<?php
if($extra!="")
{
	?>
		<div class="well"><?= $extra; ?></div>
	<?php
}
?>