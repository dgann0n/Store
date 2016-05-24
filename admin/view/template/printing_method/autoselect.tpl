<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="page-header">
		<div class="container-fluid">
			<div class="pull-right">
				<button type="submit" form="form" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
				<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
					<div class="well">
						<div class="row">
							<div class="col-sm-6">
			                	<div class="form-group">
            			    		<label class="col-sm-4 control-label"><?php echo $text_enable_autoselect; ?></label>
									<div class="col-sm-8">
			                			<input type="checkbox" name="enable_autoselect" <?php if($enable_autoselect) { ?> checked <?php } ?> />
									</div>
								</div>
                			</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="quantity_increment" style="display:none;"><?php echo $text_increment; ?></label>
									<div class="col-sm-3" style="display:none;">
										<input type="text" id="quantity_increment" value="12" style="width:55px;" class="form-control"  />
									</div>
									<div class="col-sm-6">
										<a class="btn btn-primary" onclick="addColumn()"><?php echo $text_add_quantity; ?></a>
									</div>
								</div>
							</div>
						</div>
                	</div>

					<div class="alert alert-warning"><?php echo $text_autoselect_help; ?></div>

					<div class="row">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-title_text"><?php echo $text_popup_title; ?></label>
						<div class="col-sm-10">
							<input type="text" name="title_text" value="<?php echo $title_text; ?>" class="form-control" />
							<?php if ($error_quantities) { ?>
							<div class="alert alert-danger"><?php echo $error_quantities; ?></div>
							<?php } ?>
						</div>
					</div>
					</div>

					<br/>

					<div id="matrix_list" class="row">

						<?php if($quantities) { ?>
						<?php foreach($quantities as $quantity_index=>$quantity) { ?>
	                	<div class="col-sm-6 quantity-column">
							<div class="well">
								<div class="row">
									<div>
										<a class="btn btn-danger btn-xs" onclick="removeClick($(this).parents('.quantity-column'));"><i class="fa fa-close"></i></a>
									</div>
									<input type="hidden" style="width:100px;" class="form-control" name="quantities[]" value="<?php echo $quantity; ?>" title="quantity" />
									<div class="form-group">
										<label class="col-sm-4 control-label"><?php echo $text_description; ?></label>
										<div class="col-sm-8">
											<input type="text" name="descriptions[]" value="<?php echo $descriptions[$quantity_index]; ?>" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4"><?php echo $text_available_printing_methods; ?></label>
										<div class="col-sm-8">
											<?php foreach($printing_methods as $printing_method) { ?>
											<div class="checkbox">
											<label>
												<input type="checkbox" name="pm[<?php echo $printing_method['extension']; ?>][<?php echo $quantity_index; ?>]" <?php if(isset($pm[$printing_method['extension']][$quantity_index])) { ?> checked <?php } ?> /> <?php echo $printing_method['name']; ?>
												<!-- <input type="hidden" name="pm[<?php echo $printing_method['extension']; ?>][]" <?php if($pm[$printing_method['extension']][$quantity_index]) { ?> value="checked" <?php } ?>  > -->
											</label>

											</div>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
						<?php } ?>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript"><!--
function removeClick(div)
{
	if($("#matrix_list > div").length > 1) {
		div.slideUp(300, function() {
			$(this).remove();
		});
	}
}
function addColumn()
{
	var td = $(".quantity-column:last").clone();
	td.appendTo("#matrix_list").slideDown(300);
	/*var last_value = parseInt(li.find('input[name=\'quantities[]\']').val());
	if (!isNaN(last_value)) {
		li.find('input[name=\'quantities[]\']').val(last_value+parseInt($("#quantity_increment").val()));
	}*/
}

function validFloat(number)
{
    return (/^([0-9])*[.]?[0-9]*$/.test(number));
}

//--></script>
<?php echo $footer; ?>