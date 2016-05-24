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
            <li class="active"><a href="#tab-data" data-toggle="tab"><?php echo $tab_data; ?></a></li>
			<?php foreach ( $extra_tabs as $extra_tab ) { ?>
			<li><a href="#<?php echo $extra_tab['id']; ?>" data-toggle="tab"><?php echo $tab_data['label']; ?></a></li>
			<?php } ?>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-data">
        		<div class="form-group required">
          			<label class="col-sm-2 control-label" for="input-parent"><?php echo $entry_parent; ?></label>
              		<div class="col-sm-10">
      				<select id="input-parent" name="parent_category" class="form-control">
      				  <option value="" selected="selected"><?php echo $text_root; ?></option>
      				  <?php foreach ($categories as $category) { ?>
      					  <?php if ($category['id_category'] == $parent_category) { ?>
      					  <option value="<?php echo $category['id_category']; ?>" selected="selected"><?php echo $category['description']; ?></option>
      					  <?php } else { ?>
      					  <option value="<?php echo $category['id_category']; ?>"><?php echo $category['description']; ?></option>
      					  <?php } ?>
      				  <?php } ?>
      				</select>
					</div>
				</div>
            	<div class="form-group required">
					<label class="col-sm-2 control-label" for="input-description"><?php echo $entry_description; ?></label>
					<div class="col-sm-10">
						<input id="input-description" type="text" name="description" value="<?php echo $description; ?>" placeholder="<?php echo $entry_description; ?>" class="form-control" />
					</div>
					<?php if ($error_description) { ?>
					<div class="text-danger"><?php echo $error_description; ?></div>
					<?php } ?>
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