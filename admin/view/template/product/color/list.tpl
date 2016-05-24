<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="page-header">
		<div class="container-fluid">
			<div class="pull-right">
				<a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
				<!--<button type="submit" form="form-product" formaction="<?php echo $copy; ?>" data-toggle="tooltip" title="<?php echo $button_copy; ?>" class="btn btn-default"><i class="fa fa-copy"></i></button>-->
				<button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form').submit() : false;"><i class="fa fa-trash-o"></i></button>
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
		<div class="alert alert-danger">
			<i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
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
				<h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
			</div>
			<div class="panel-body">
				<div class="well">
					<div class="row">
						<div class="col-sm-3">
							<div class="form-group">
								<label class="control-label" for="input-id"><?php echo $entry_id; ?></label>
								<input type="text" name="filter_id_product_color" value="<?php echo $filter_id_product_color; ?>" placeholder="<?php echo $entry_id; ?>" id="input-id" class="form-control" />
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<label class="control-label" for="input-name"><?php echo $entry_name; ?></label>
								<input type="text" name="filter_name" value="<?php echo $filter_name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<label class="control-label" for="input-filter_num_colors"><?php echo $entry_num_colors; ?></label>
								<input type="text" name="filter_num_colors" value="<?php echo $filter_num_colors; ?>" placeholder="<?php echo $entry_num_colors; ?>" id="input-filter_num_colors" class="form-control" />
							</div>
						</div>
						<div class="col-sm-3">
						<div class="form-group">
							<label class="control-label" for="input-id_product_color_group"><?php echo $entry_color_group; ?></label>
							<select name="filter_id_product_color_group" id="input-id_product_color_group" class="form-control">
								<option value="">---None---</option>
								<?php foreach ( $color_groups as $color_group ) { ?>
								<option<?php echo $filter_id_product_color_group == $color_group['id_product_color_group'] ? ' selected="selected"' : ''; ?> value="<?php echo $color_group['id_product_color_group']; ?>"><?php echo $color_group['description']; ?></option>
								<?php } ?>
							</select>
						</div>
						<button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
						</div>
					</div>
				</div>
					
				<form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
					<div class="table-responsive">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<td width="1" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
									<td class="text-left"><?php echo $column_id_product_color; ?></td>
									<td class="text-left" width="40%">
										<?php if ($sort == 'pc.name') { ?>
										<a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
										<?php } else { ?>
										<a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
										<?php } ?>
									</td>
									<td class="text-right">
										<?php if ($sort == 'pc.num_colors') { ?>
										<a href="<?php echo $sort_num_colors; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_num_colors; ?></a>
										<?php } else { ?>
										<a href="<?php echo $sort_num_colors; ?>"><?php echo $column_num_colors; ?></a>
										<?php } ?>
									</td>
									<td class="text-left"><?php echo $column_hexa; ?></td>
									<td class="text-left"><?php echo $column_need_white_base; ?></td>
									<td class="text-left">
										<?php if ($sort == 'pc.id_product_color_group') { ?>
										<a href="<?php echo $sort_id_product_color_group; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_id_product_color_group; ?></a>
										<?php } else { ?>
										<a href="<?php echo $sort_id_product_color_group; ?>"><?php echo $column_id_product_color_group; ?></a>
										<?php } ?>
									</td>
									<td class="right"><?php echo $column_action; ?></td>
								</tr>
							</thead>
							<tbody>
								<?php if ($colors) { ?>
								<?php foreach ($colors as $color) { ?>
								<tr>
									<td class="text-center">
										<?php if ($color['selected']) { ?>
										<input type="checkbox" name="selected[]" value="<?php echo $color['id_product_color']; ?>" checked="checked" />
										<?php } else { ?>
										<input type="checkbox" name="selected[]" value="<?php echo $color['id_product_color']; ?>" />
										<?php } ?>
									</td>
									<td class="text-left"><?php echo $color['id_product_color']; ?></td>
									<td class="text-left"><?php echo $color['name']; ?></td>
									<td class="text-right"><?php echo $color['num_colors']; ?></td>
									<td class="text-left">
										<table  style="width:75px; height:10px;"  cellpadding="0" cellspacing="0">
											<tr>
												<?php foreach($color["hexa"] as $hexa) { ?>
												<td style="background-color:#<?php echo $hexa; ?>;">&nbsp;</td>
												<?php } ?>
											</tr>
										</table>
									</td>
									<td class="text-left"><?php echo $color['need_white_base']; ?></td>
									<td class="text-left" style="background-color:#<?php echo $color_groups[$color['id_product_color_group']]['color']; ?>"><?php echo $color_groups[$color['id_product_color_group']]['description']; ?></td>
									<td class="text-right">
										<a href="<?php echo $color['edit']['href']; ?>" data-toggle="tooltip" title="<?php echo $color['edit']['text']; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
									</td>
								</tr>
								<?php } ?>
								<?php } else { ?>
								<tr>
									<td align="center" colspan="7"><?php echo $text_no_results; ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</form>
				<div class="row">
					<div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
					<div class="col-sm-6 text-right"><?php echo $results; ?></div>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript"><!--
$('#button-filter').on('click', function filter() {
	url = 'index.php?route=product/color/_list&token=<?php echo $token; ?>';
	
	var filter_id_product_color = $('input[name=\'filter_id_product_color\']').val();
	
	if (filter_id_product_color) {
		url += '&filter_id_product_color=' + encodeURIComponent(filter_id_product_color);
	}
	
	var filter_name = $('input[name=\'filter_name\']').val();
	
	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}
	
	var filter_num_colors = $('input[name=\'filter_num_colors\']').val();
	
	if (filter_num_colors != '') {
		url += '&filter_num_colors=' + encodeURIComponent(filter_num_colors);
	}
	
	var filter_id_product_color_group = $('select[name=\'filter_id_product_color_group\']').val();
	
	if (filter_id_product_color_group != '') {
		url += '&filter_id_product_color_group=' + encodeURIComponent(filter_id_product_color_group);
	}
		
	var limit = $('input[name=\'limit\']').attr('value');
	
	if (limit) {
		url += '&limit=' + encodeURIComponent(limit);
	}
				
	location = url;
});
//--></script></div>
<?php echo $footer; ?>