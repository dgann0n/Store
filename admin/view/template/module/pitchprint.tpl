<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-pitchprint" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
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
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $heading_title; ?></h3>
      </div>
      <div class="panel-body">
			<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-pitchprint" class="form-horizontal">
				<div class="form-group">
					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-code"><span data-toggle="tooltip" data-html="true" data-trigger="click" title="API Key from PitchPrint Domains"><?php echo $api_label; ?></span></label>
						<div class="col-sm-10">
						  <input style="width:270px" name="pitchprint_api_value" class="form-control" value="<?php echo $pitchprint_api_value; ?>" >
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-code"><span data-toggle="tooltip" data-html="true" data-trigger="click" title="Secret Key from PitchPrint Domains"><?php echo $secret_label; ?></span></label>
						<div class="col-sm-10">
						  <input style="width:270px" name="pitchprint_secret_value" class="form-control" value="<?php echo $pitchprint_secret_value; ?>" >
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-code"><span data-toggle="tooltip" data-html="true" data-trigger="click" title="Provide the element selector if you want the app to show inline, not as a popup"><?php echo $inline_label; ?></span></label>
						<div class="col-sm-10">
						  <input name="pitchprint_inline_value" style="width:270px" class="form-control" value="<?php echo $pitchprint_inline_value; ?>" >
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-code"><span data-toggle="tooltip" data-html="true" data-trigger="click" title="Show Editor when the page is loaded"><?php echo $show_onstartup_label; ?></span></label>
						<div class="col-sm-10">
							<select name="pitchprint_showonstartup_value" style="width:270px" class="form-control" >
								<option <?php echo ($pitchprint_showonstartup_value == 'true' ? 'selected="selected"' : '') ?> value="false"><?php echo $disabled_label; ?></option>
								<option <?php echo ($pitchprint_showonstartup_value == 'true' ? 'selected="selected"' : '') ?> value="true"><?php echo $enabled_label; ?></option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-code"><span data-toggle="tooltip" data-html="true" data-trigger="click" title="Maintain product images?"><?php echo $maintain_images_label; ?></span></label>
						<div class="col-sm-10">
							<select name="pitchprint_maintain_images_value" style="width:270px" class="form-control" >
								<option <?php echo ($pitchprint_maintain_images_value == 'true' ? 'selected="selected"' : '') ?> value="false"><?php echo $disabled_label; ?></option>
								<option <?php echo ($pitchprint_maintain_images_value == 'true' ? 'selected="selected"' : '') ?> value="true"><?php echo $enabled_label; ?></option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-code"><span data-toggle="tooltip" data-html="true" data-trigger="click" title="Add your custom Javascript to run once the app loads"><?php echo $custom_js_label; ?></span></label>
						<div class="col-sm-10">
						  <textarea name="pitchprint_custom_js_value" rows="5" style="width:500px" class="form-control" ><?php echo $pitchprint_custom_js_value; ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-code"></label>
						<div class="col-sm-10">
						  <i><p>Access your <a target="_blank" href="https://pitchprint.net" >PitchPrint Panel</a></p></i>
						</div>
					</div>
			</form>
		
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>