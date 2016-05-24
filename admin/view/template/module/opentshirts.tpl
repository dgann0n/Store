<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="page-header">
		<div class="container-fluid">
			<div class="pull-right">
				<button type="submit" form="form-opentshirts" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
				<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
			</div>
			<h1><?php echo $heading_title; ?></h1>
			<ul class="breadcrumb">
			<?php foreach ($breadcrumbs as $breadcrumb) { ?>
        		<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
			<?php } ?>
			</ul>
		</div>
	</div>
	<div class="container-fluid">
		<?php if ($error_warning) { ?>
		<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
			<button type="button" class="close" data-dismiss="alert">&times;</button>
		</div>
		<?php } ?>
		<?php if ($success) { ?>
		<div class="alert alert-success">
			<i class="fa fa-check-circle"></i> <?php echo $success; ?>
			<button type="button" class="close" data-dismiss="alert">&times;</button>
		</div>
		<?php } ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
			</div>
			<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-opentshirts" class="form-horizontal">
			<input type="hidden" name="opentshirts_max_product_color_combination" value="5" />
			<div class="panel-body">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#tab-data" data-toggle="tab"><?php echo $tab_data; ?></a></li>
					<li><a href="#tab-downloads" data-toggle="tab"><?php echo $tab_downloads; ?></a></li>
					<li><a href="#tab-upgrade" data-toggle="tab"><?php echo $tab_upgrade; ?></a></li>
					<li><a href="#tab-about" data-toggle="tab"><?php echo $tab_about; ?></a></li>
				</ul>



				<div class="tab-content">


					<div class="tab-pane active" id="tab-data">
						<div class="form-group">
							<label class="col-sm-2 control-label" for="ipnut-opentshirts_config_logo"><span data-toggle="tooltip" title="<?php echo $help_logo; ?>"><?php echo $entry_logo; ?></span></label>
							<div class="col-sm-10">
								<a href="" id="thumb-opentshirts_config_logo" data-toggle="image" class="img-thumbnail"><img src="<?php echo $ot_logo; ?>" alt="" title="" data-placeholder="<?php echo $no_image; ?>" /></a>
								<input type="hidden" name="opentshirts_config_logo" value="<?php echo $opentshirts_config_logo; ?>" id="input-opentshirts_config_logo" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-model"><?php echo $entry_video_tutorial_link; ?></label>
							<div class="col-sm-10">
								<textarea name="opentshirts_video_tutorial_embed" id="input_opentshirts_video_tutorial_embed" placeholder="" class="form-control"><?php echo $opentshirts_video_tutorial_embed; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="opentshirts_home_button_link"><span data-toggle="tooltip" title="<?php echo $help_home_button_link; ?>"><?php echo $entry_home_button_link; ?></span></label>
							<div class="col-sm-10">
								<input type="text" name="opentshirts_home_button_link" id="opentshirts_home_button_link" value="<?php echo $opentshirts_home_button_link; ?>" placeholder="<?php echo $entry_home_button_link; ?>" class="form-control" />
							</div>
						</div>
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-opentshirts_printing_colors_limit"><?php echo $entry_printing_colors_limit; ?></label>
							<div class="col-sm-10">
								<input type="text" id="input-opentshirts_printing_colors_limit" name="opentshirts_printing_colors_limit" value="<?php echo $opentshirts_printing_colors_limit; ?>" placeholder="<?php echo $entry_printing_colors_limit; ?>" class="form-control" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-opentshirts_template_disabled"><?php echo $entry_template; ?></label>
							<div class="col-sm-10">
								<input id="input-opentshirts_template_disabled" type="text" class="form-control" readonly value="<?php echo $config_template; ?>" />
							</div>
						</div>
						<?php if(isset($themes_warning)) { ?>
						<div class="form-group">
							<label class="col-sm-2 control-label"><?php echo $entry_theme; ?></label>
							<div class="col-sm-10 warning">
								<?php echo $themes_warning; ?>
							</div>
						</div>
						<?php } else { ?>
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-opentshirts_printing_colors_limit"><?php echo $entry_theme; ?></label>
							<div class="col-sm-10">
								<select name="opentshirts_theme" onchange="$('#template').load('index.php?route=module/opentshirts/theme_thumb&token=<?php echo $token; ?>&template=' + encodeURIComponent('<?php echo $config_template; ?>') + '&theme=' + encodeURIComponent(this.value)); " class="form-control">
									<?php foreach ($themes as $theme) { ?>
									<?php if ($theme == $opentshirts_theme) { ?>
									<option value="<?php echo $theme; ?>" selected="selected"><?php echo $theme; ?></option>
									<?php } else { ?>
									<option value="<?php echo $theme; ?>"><?php echo $theme; ?></option>
									<?php } ?>
									<?php } ?>
								</select>
							</div>
						</div>
						<?php } ?>
						<div class="form-group">
							<span class="col-sm-2"></span>
							<div class="col-sm-10" id="template">
							</div>
						</div>
					</div>
					<div class="tab-pane" id="tab-upgrade">
					<?php echo $upgrade_tab; ?>
					</div>


					<div class="tab-pane" id="tab-downloads" align="left">
						<div class="well">
							<div class="col-sm-6">
								<h3><?php echo $purchase_packs_title; ?></h3>
								<p><?php echo $purchase_packs; ?></p>
							</div>

							<div class="col-sm-6">
								<h3><?php echo $purchase_m7_title; ?></h3>
								<p><?php echo $purchase_m7; ?></p>
							</div>
							<div class="clearfix"></div>
						</div>

						<div class="col-sm-6">
							<p><?php echo $other_instr; ?></p>
							<table class="table table-bordered">
								<?php foreach ( $other_downloads as $download ) { ?>
								<tr>
									<td><a class="btn btn-primary" href="<?php echo $download['link']; ?>" target="_blank"><?php echo $button_download; ?></a> <?php echo $download['name']; ?></td>
								</tr>
								<?php } ?>
							</table>
							<a class="btn btn-primary" href="<?php echo $install_packs_link; ?>"><?php echo $button_install; ?></a>
						</div>

						<div class="col-sm-6">
							<p><?php echo $products_instr; ?></p>
							<table class="table table-bordered">
								<?php foreach ( $product_downloads as $download ) { ?>
								<tr>
									<td><a class="btn btn-primary" href="<?php echo $download['link']; ?>" target="_blank"><?php echo $button_download; ?></a> <?php echo $download['name']; ?></td>
								</tr>
								<?php } ?>
							</table>
							<a class="btn btn-primary" href="<?php echo $product_import_link; ?>"><?php echo $button_products; ?></a>
						</div>

					</div>


					<div class="tab-pane" id="tab-about" align="center">
					<table style=" border: solid 1px #5CC4BA; padding: 20px; margin: 20px; text-align: center;">
					  <tr><td><img src="../image/about_header.png"></td></tr>
					  <tr><td><p style="color: #0094BA; padding: 20px; margin: 20px; ">Opentshirts V1.3.0</p>
						<p><a href="http://www.opentshirts.com" target="_blank">http://www.opentshirts.com</a></p>
					</td></tr>
					</table>

					</div>

				</div>
			</div>
			</form>
		</div>
	</div>

<script type="text/javascript"><!--
    $(document).ready(function() {
      /*$('#menu_ot > ul').superfish({
        hoverClass   : 'sfHover',
        pathClass  : 'overideThisToUse',
        delay    : 0,
        animation  : {height: 'show'},
        speed    : 'normal',
        autoArrows   : false,
        dropShadows  : false,
        disableHI  : false,
        onInit     : function(){},
        onBeforeShow : function(){},
        onShow     : function(){},
        onHide     : function(){}
      });*/

      //$('#menu_ot a').attr('target','_new');

      $('#menu_ot > ul').css('display', 'block');
    });
//--></script>
<script type="text/javascript"><!--
$('#template').load('index.php?route=module/opentshirts/theme_thumb&token=<?php echo $token; ?>&template=' + encodeURIComponent('<?php echo $config_template; ?>') + '&theme=' + encodeURIComponent($('select[name=\'opentshirts_theme\']').val()));
//--></script>
<script type="text/javascript"><!--
function image_upload(field, thumb) {
  $('#dialog').remove();

  $('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');

  $('#dialog').dialog({
    title: '<?php echo $text_image_manager; ?>',
    close: function (event, ui) {
      if ($('#' + field).attr('value')) {
        $.ajax({
          url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).val()),
          dataType: 'text',
          success: function(data) {
            $('#' + thumb).replaceWith('<img src="' + data + '" alt="" id="' + thumb + '" />');
          }
        });
      }
    },
    bgiframe: false,
    width: 800,
    height: 400,
    resizable: false,
    modal: false
  });
};
//--></script>

</div>
<?php echo $footer; ?>