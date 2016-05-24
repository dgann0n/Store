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
				<button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm_delete; ?>') ? $('#form').submit() : false;"><i class="fa fa-trash-o"></i></button>
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
								<input type="text" name="filter_id_composition" value="<?php echo $filter_id_composition; ?>" placeholder="<?php echo $entry_id; ?>" id="input-id" class="form-control" />
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
									<td class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
									<td class="text-right"><?php echo $column_id_composition; ?></td>
									<td class="text-left"><?php if ($sort == 'c.name') { ?>
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
									<td class="text-right">
										<?php if ($sort == 'c.date_added') { ?>
										<a href="<?php echo $sort_date_added; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_added; ?></a>
										<?php } else { ?>
										<a href="<?php echo $sort_date_added; ?>"><?php echo $column_date_added; ?></a>
										<?php } ?>
									</td>
									<td class="text-right"><?php echo $column_action; ?></td>
								</tr>
							</thead>
							<tbody>
								<?php if ($compositions) { ?>
								<?php foreach ($compositions as $composition) { ?>
								<tr>
									<td class="text-center">
										<?php if ($composition['selected']) { ?>
										<input type="checkbox" name="selected[]" value="<?php echo $composition['id_composition']; ?>" checked="checked" />
										<?php } else { ?>
										<input type="checkbox" name="selected[]" value="<?php echo $composition['id_composition']; ?>" />
										<?php } ?>
									</td>
									<td class="text-right"><?php echo $composition['id_composition']; ?></td>
									<td class="text-left"><a href="<?php echo $composition['link']; ?>" target="_blank"><?php echo $composition['name']; ?></a></td>
									<td class="text-left"><?php echo $composition['status']; ?></td>
									<td class="text-left">
									  	<ul><?php foreach ($composition['categories'] as $category) { ?>
											<li><?php echo $category['description']; ?></li>
										<?php } ?></ul>
									</td>
									<td class="text-left">
										<ul><?php foreach ($composition['keywords'] as $keyword) { ?>
										<li><?php echo $keyword; ?></li>
										<?php } ?></ul>
									</td>
									<td class="text-center" valign="middle">
										  <a class="ui-widget-content" style="border-width: 0 0 1px 0; padding:3px; margin:1px; " id="a_<?php echo $composition['id_composition']; ?>" href="<?php echo $composition['images'][0]['original']; ?>" target="_new"><img border="0" id="img_<?php echo $composition['id_composition']; ?>" src="<?php echo $composition['images'][0]['large']; ?>" /></a>
										  <ul style="list-style:none; padding:0">
										  <?php foreach ($composition['images'] as $image) { ?>
											<li class="ui-widget-content" style="float:left; cursor:pointer; margin:2px;  " onclick="$('#img_<?php echo $composition['id_composition']; ?>').attr('src','<?php echo $image['large']; ?>'); $('#a_<?php echo $composition['id_composition']; ?>').attr('href','<?php echo $image['original']; ?>'); "><img src="<?php echo $image['thumb']; ?>" /></li>
											<?php } ?>
										  </ul>
									</td>
									<td class="text-right"><?php echo $composition['date_added']; ?></td>
									<td class="text-right">
										<a href="<?php echo $composition['edit']['href']; ?>" data-toggle="tooltip" title="<?php echo $composition['edit']['text']; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
									</td>
								</tr>
								<?php } ?>
								<?php } else { ?>
								<tr>
									<td class="text-center" colspan="9"><?php echo $text_no_results; ?></td>
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
$('#button-filter').on('click',function() {
	url = 'index.php?route=opentshirts/composition/_list&token=<?php echo $token; ?>';

	var filter_id_composition = $('input[name=\'filter_id_composition\']').attr('value');

	if (filter_id_composition) {
		url += '&filter_id_composition=' + encodeURIComponent(filter_id_composition);
	}

	var filter_name = $('input[name=\'filter_name\']').val();

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
<?php echo $footer; ?>