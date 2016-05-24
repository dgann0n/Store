<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="page-header">
		<div class="container-fluid">
			<div class="pull-right">
				<button type="submit" form="form-product" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
			</div>
			<div class="panel-body">
				<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-product" class="form-horizontal">
					<ul class="nav nav-tabs" id="">
						<li class="active"><a href="#tab-data" data-toggle="tab"><?php echo $tab_data; ?></a></li>
						<li><a href="#tab-appearance" data-toggle="tab"><?php echo $tab_appearance; ?></a></li>
						<li><a href="#tab-views" data-toggle="tab"><?php echo $tab_views; ?></a></li>
						<li><a href="#tab-price" data-toggle="tab"><?php echo $tab_price; ?></a></li>
					</ul>
					
					<div class="tab-content">
						<div class="tab-pane active" id="tab-data">
							<ul class="nav nav-tabs" id="language">
								<?php foreach ($languages as $language) { ?>
								<li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
								<?php } ?>
							</ul>
							<div class="tab-content">
								<?php foreach ($languages as $language) { ?>
								<div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
									<div class="form-group">
										<label class="col-sm-2 control-label"><?php echo $entry_name; ?></label>
										<div class="col-sm-10">
											<?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['name'] : ''; ?>
										</div>
									</div>
								</div>
								<?php } ?>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_model; ?></label>
								<div class="col-sm-10"><?php echo $model; ?></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_image; ?></label>
								<div class="col-sm-10"><img src="<?php echo $thumb; ?>" alt="" id="thumb" /><br />
								<input type="hidden" name="image" value="<?php echo $image; ?>" id="image" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_status; ?></label>
								<div class="col-sm-10">
									<?php if ($status) { ?>
									<?php echo $text_enabled; ?>
									<?php } else { ?>
									<?php echo $text_disabled; ?>
									<?php } ?>
								</div>
							</div>
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="input-printable_status"><?php echo $entry_printable_status; ?></label>
								<div class="col-sm-10">
									<select id="input-printable_status" name="printable_status" class="form-control">
										<?php if ($printable_status) { ?>
										<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
										<option value="0"><?php echo $text_disabled; ?></option>
										<?php } else { ?>
										<option value="1"><?php echo $text_enabled; ?></option>
										<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
									  <?php } ?>
									</select>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tab-appearance">
						  <?php echo $color_size_tab; ?>
						</div>
						<div class="tab-pane" id="tab-views">
						  <?php echo $view_tab; ?>
						</div>
						<div class="tab-pane" id="tab-price">
						  <?php echo $price_tab; ?>
						</div>
					
					</div>
				</form>
			</div>
		</div>
	</div>
<script type="text/javascript"><!--
//$('#language a:first').tab('show');
//--></script></div>
<?php echo $footer; ?>