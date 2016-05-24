<?php
function showOptionRecursive($array, $selected, $level) {
	foreach($array as $option) {
		?>
		<option value="<?php echo $option['id_category'];?>" <?php if($option['id_category']==$selected) { echo 'selected="selected"'; } ?> >
			<?php for($i=0; $i<$level; $i++) { echo "&nbsp;---&nbsp;"; } ?>
			<?php echo $option['description']; ?>
		</option>
		<?php
		
		showOptionRecursive($option['children'], $selected, $level + 1);
	}
}
?>
<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="page-header">
		<div class="container-fluid">
			<div class="pull-right">
				<a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add_bitmap; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
				<!--<button type="submit" form="form-product" formaction="<?php echo $copy; ?>" data-toggle="tooltip" title="<?php echo $button_copy; ?>" class="btn btn-default"><i class="fa fa-copy"></i></button>-->
				<button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-product').submit() : false;"><i class="fa fa-trash-o"></i></button>
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
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label" for="input-id"><?php echo $entry_id; ?></label>
								<input type="text" name="filter_id_bitmap" value="<?php echo $filter_id_bitmap; ?>" placeholder="<?php echo $entry_id; ?>" id="input-id" class="form-control" />
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label" for="input-name"><?php echo $entry_name; ?></label>
								<input type="text" name="filter_name" value="<?php echo $filter_name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label" for="input-filter_status"><?php echo $entry_status; ?></label>
								<select name="filter_status" id="input-filter_status" onchange="filter();" class="form-control">
									<?php foreach ($statuses as $status) { ?>
									<?php if ($status['val'] === $filter_status) { ?>
									<option value="<?php echo $status['val']; ?>" selected="selected"><?php echo $status['description']; ?></option>
									<?php } else { ?>
									<option value="<?php echo $status['val']; ?>"><?php echo $status['description']; ?></option>
									<?php } ?>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label" for="input-filter_keyword"><?php echo $entry_keyword; ?></label>
								<input type="text" id="input-filter_keyword" name="filter_keyword" value="<?php echo $filter_keyword; ?>" placeholder="<?php echo $entry_keyword; ?>" class="form-control" />
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label" for="input-category"><?php echo $entry_category; ?></label>
								<select name="filter_id_category" id="input-category" onchange="filter();" class="form-control">
									<option value=""><?php echo $text_none; ?></option>
									<?php showOptionRecursive($categories, $filter_id_category, 0); ?>
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
						</div>
					</div>
				</div>
      			<form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
					<div class="table-responsive">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<td width="1" class="text-center">
										<input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
									</td>
									<td class="text-right"><?php echo $column_id; ?></td>
									<td class="text-left">
										<?php if ($sort == 'c.name') { ?>
										<a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
										<?php } else { ?>
										<a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
										<?php } ?>
				  					</td>
									<td class="text-left">
										<?php if ($sort == 'c.status') { ?>
										<a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
										<?php } else { ?>
										<a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
										<?php } ?>
									</td>
									<td class="text-left"><?php echo $column_categories; ?></td>
									<td class="text-left"><?php echo $column_keywords; ?></td>
									<td align="text-center"><?php echo $column_thumb; ?></td>
									<td class="text-right" nowrap="nowrap"><?php if ($sort == 'c.date_added') { ?>
										<a href="<?php echo $sort_date_added; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_added; ?></a>
										<?php } else { ?>
										<a href="<?php echo $sort_date_added; ?>"><?php echo $column_date_added; ?></a>
										<?php } ?>
									</td>
									<td class="text-right"><?php echo $column_action; ?></td>
								</tr>
							</thead>
							<tbody>
								<?php if ($bitmaps) { ?>
									<?php foreach ($bitmaps as $bitmap) { ?>
								<tr>
									<td style="text-align: center;">
										<?php if ($bitmap['selected']) { ?>
										<input type="checkbox" name="selected[]" value="<?php echo $bitmap['id_bitmap']; ?>" checked="checked" />
										<?php } else { ?>
										<input type="checkbox" name="selected[]" value="<?php echo $bitmap['id_bitmap']; ?>" />
										<?php } ?>
									</td>
									<td width="20" class="right"><?php echo $bitmap['id_bitmap']; ?></td>
									<td class="left"><?php echo $bitmap['name']; ?></td>
									<td class="left"><?php echo $bitmap['status']; ?></td>
									<td class="left">
										<ul>
											<?php foreach ($bitmap['categories'] as $category) { ?>
											<li><?php echo $category['description']; ?></li>
											<?php } ?>
										</ul>
									</td>
									<td class="left">
										<ul>
											<?php foreach ($bitmap['keywords'] as $keyword) { ?>
											<li><?php echo $keyword; ?></li>
											<?php } ?>
										</ul>
									</td>
									<td align="center" valign="middle"><img src="<?php echo $bitmap['thumb']; ?>" /></td>
									<td class="right"><?php echo $bitmap['date_added']; ?></td>
									<td class="right">
										<a href="<?php echo $bitmap['edit']['href']; ?>" data-toggle="tooltip" title="<?php echo $bitmap['edit']['text']; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
									</td>
								</tr>
									<?php } ?>
								<?php } else { ?>
								<tr>
									<td align="center" colspan="9"><?php echo $text_no_results; ?></td>
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
	url = 'index.php?route=bitmap/bitmap/_list&token=<?php echo $token; ?>';
	
	var filter_id_bitmap = $('input[name=\'filter_id_bitmap\']').attr('value');
	
	if (filter_id_bitmap) {
		url += '&filter_id_bitmap=' + encodeURIComponent(filter_id_bitmap);
	}
	
	var filter_name = $('select[name=\'filter_name\']').val();
	
	if (filter_name != '') {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}
	
	var filter_status = $('select[name=\'filter_status\']').val();
	
	if (filter_status != '') {
		url += '&filter_status=' + encodeURIComponent(filter_status);
	}
	
	var filter_id_category = $('select[name=\'filter_id_category\']').val();
	
	if (filter_id_category != '') {
		url += '&filter_id_category=' + encodeURIComponent(filter_id_category);
	}
	
	var filter_keyword = $('input[name=\'filter_keyword\']').val();
	
	if (filter_keyword) {
		url += '&filter_keyword=' + encodeURIComponent(filter_keyword);
	}
	
	var filter_date_added = $('input[name=\'filter_date_added\']').attr('value');
	
	if (filter_date_added) {
		url += '&filter_date_added=' + encodeURIComponent(filter_date_added);
	}
	
	var limit = $('input[name=\'limit\']').attr('value');
	
	if (limit) {
		url += '&limit=' + encodeURIComponent(limit);
	}
				
	location = url;
});
//--></script>  
<script type="text/javascript"><!--
$('#form input').keydown(function(e) {
	if (e.keyCode == 13) {
		filter();
	}
});
//--></script> 
<?php echo $footer; ?>