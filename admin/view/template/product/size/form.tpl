<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-color" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-size" class="form-horizontal">
	  	<ul class="nav nav-tabs">
            <li class="active"><a href="#tab-data" data-toggle="tab"><?php echo $tab_data; ?></a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-data">
				<div class="form-group required">
					<label class="col-sm-2 control-label" for="input-description"><?php echo $entry_description; ?></label>
					<div class="col-sm-10">
						<input type="text" id="input-description" name="description" value="<?php echo $description; ?>" class="form-control" placeholder="<?php echo $entry_description; ?>"/>
						<?php if ($error_description) { ?>
						<div class="text-danger"><?php echo $error_description; ?></div>
						<?php } ?>
					</div>
				</div>
				<div class="form-group required">
					<label class="col-sm-2 control-label" for="input-initials"><?php echo $entry_initials; ?></label>
					<div class="col-sm-10">
						<input type="text" id="input-initials" name="initials" value="<?php echo $initials; ?>" class="form-control" placeholder="<?php echo $entry_initials; ?>"/>
						<?php if ($error_initials) { ?>
						<div class="text-danger"><?php echo $error_initials; ?></div>
						<?php } ?>
					</div>
				</div>
				<div class="form-group required">
					<label class="col-sm-2 control-label" for="input-upcharge"><?php echo $entry_upcharge; ?></label>
					<div class="col-sm-10">
						<select name="apply_additional_cost" id="input-upcharge" class="form-control">
							<?php foreach ($apply_additional_cost_status as $item) { ?>
							<?php if ($item['val'] === $apply_additional_cost) { ?>
							<option value="<?php echo $item['val']; ?>" selected="selected"><?php echo $item['description']; ?></option>
							<?php } else { ?>
							<option value="<?php echo $item['val']; ?>"><?php echo $item['description']; ?></option>
							<?php } ?>
							<?php } ?>
						</select>
					</div>
				</div>
        	</div>
      </form>
    </div>
  </div>
</div>
</div>
<?php echo $footer; ?>