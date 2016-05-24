<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab-data" data-toggle="tab"><?php echo $text_data_tab; ?></a></li>
				<?php foreach ( $extra_tabs as $extra_tab ) { ?>
				<li><a href="#<?php echo $extra_tab['id']; ?>" data-toggle="tab"><?php echo $extra_tab['label']; ?></a></li>
				<?php } ?>
			</ul>
			<div class="tab-content">
				<div id="tab-data" class="tab-pane active">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
						<div class="col-sm-10">
							<select id="input-status" name="data[screenprinting_status]" class="form-control">
								<?php if ($data['screenprinting_status']) { ?>
								<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
								<option value="0"><?php echo $text_disabled; ?></option>
								<?php } else { ?>
								<option value="1"><?php echo $text_enabled; ?></option>
								<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-sort_order"><?php echo $entry_sort_order; ?></label>
						<div class="col-sm-10">
							<input type="text" id="input-sort_order" name="data[screenprinting_sort_order]" value="<?php echo $data['screenprinting_sort_order']; ?>" size="1" class="form-control" />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-description"><?php echo $entry_description; ?></label>
						<div class="col-sm-10">
							<textarea id="input-description" name="data[screenprinting_description]" class="form-control"><?php echo $data['screenprinting_description']; ?></textarea>
						</div>
					</div>
				</div>
				<?php foreach ( $extra_tabs as $extra_tab ) { ?>
				<div class="tab-pane" id="<?php echo $extra_tab['id']; ?>">
					<?php echo $extra_tab['content']; ?>
				</div>
				<?php } ?>
			
			</div>
      </form>
    </div>
  </div>
</div>
</div>
<?php echo $footer; ?> 