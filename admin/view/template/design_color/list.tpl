<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
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
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
	
	<div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">
	  	<div class="well">
          <div id="filterdiv" class="row">
            <div class="col-sm-3">
              <div class="form-group">
                <label class="control-label" for="input-id"><?php echo $entry_id; ?></label>
				<input type="text" name="filter_id_design_color" value="<?php echo $filter_id_design_color; ?>" placeholder="<?php echo $entry_id; ?>" id="input-id" class="form-control" />
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
                <label class="control-label" for="input-filter_code"><?php echo $entry_code; ?></label>
				<input type="text" name="filter_code" value="<?php echo $filter_code; ?>" placeholder="<?php echo $entry_code; ?>" id="input-filter_code" class="form-control" />
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label class="control-label" for="input-filter_status"><?php echo $entry_status; ?></label>
				<select id="input-filter_status" name="filter_status" class="form-control">
				  <?php foreach ($statuses as $status) { ?>
					  <?php if ($status['val'] === $filter_status) { ?>
					  <option value="<?php echo $status['val']; ?>" selected="selected"><?php echo $status['description']; ?></option>
					  <?php } else { ?>
					  <option value="<?php echo $status['val']; ?>"><?php echo $status['description']; ?></option>
					  <?php } ?>
				  <?php } ?>
				</select>
              </div>
			  <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
            </div>
          </div>
        </div>
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
		
		<div class="table-responsive">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<td class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
						<td class="text-right">
							<?php if ($sort == 'id_design_color') { ?>
							<a href="<?php echo $sort_id_design_color; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_id_design_color; ?></a>
							<?php } else { ?>
							<a href="<?php echo $sort_id_design_color; ?>"><?php echo $column_id_design_color; ?></a>
							<?php } ?>
						</td>
						<td class="text-left">
							<?php if ($sort == 'name') { ?>
							<a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
							<?php } else { ?>
							<a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
							<?php } ?>
						</td>
						<td class="text-left">
							<?php if ($sort == 'code') { ?>
							<a href="<?php echo $sort_code; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_code; ?></a>
							<?php } else { ?>
							<a href="<?php echo $sort_code; ?>"><?php echo $column_code; ?></a>
							<?php } ?>
						</td>
						<td class="text-left"><?php echo $column_hexa; ?></td>
						<td class="text-left"><?php if ($sort == 'need_white_base') { ?>
						<a href="<?php echo $sort_need_white_base; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_need_white_base; ?></a>
						<?php } else { ?>
						<a href="<?php echo $sort_need_white_base; ?>"><?php echo $column_need_white_base; ?></a>
						<?php } ?></td>
						<td class="text-left"><?php echo $column_status; ?></td>
						<td class="text-left"><?php if ($sort == 'sort') { ?>
						<a href="<?php echo $sort_sort; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_sort; ?></a>
						<?php } else { ?>
						<a href="<?php echo $sort_sort; ?>"><?php echo $column_sort; ?></a>
						<?php } ?></td>
						<td class="text-right"><?php echo $column_action; ?></td>
					</tr>
				</thead>
				<tbody>
					<?php if ( ! $colors) { ?>
					<tr>
			  			<td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
					</tr>
					<?php } else { ?>
				  	<?php $i=0; ?>
					<?php foreach ($colors as $color) { ?>
					<tr>
						<td class="text-center">
					 		<?php if (!$color['isdefault']) { ?>
							<?php if ($color['selected']) { ?>
							<input type="checkbox" name="selected[]" value="<?php echo $color['id_design_color']; ?>" checked="checked" />
							<?php } else { ?>
							<input type="checkbox" name="selected[]" value="<?php echo $color['id_design_color']; ?>" />
							<?php } ?>
			  				<?php } ?>
						</td>
						<td class="text-right"><?php echo $color['id_design_color']; ?></td>
						<td><?php if ($color['isdefault']) { ?><?php echo $text_default; ?> <?php } ?><?php echo $color['name']; ?></td>
						<td class="text-left"><?php echo $color['code']; ?></td>
						<td class="text-center"><span title="<?php echo $color['hexa']; ?>" class="ui-widget-content" style="display:block; width:20px; height:20px; background: #<?php echo $color['hexa']; ?>">&nbsp;</span></td>
						<td class="text-left"><?php echo $color['need_white_base']; ?></td>
						<td class="text-left"><?php echo $color['status']; ?></td>
						<td width="75" class="text-center">
							<input type="hidden" name="sorting[<?php echo $i; ?>][id]" value="<?php echo $color['id_design_color']; ?>" />
							<input type="text" name="sorting[<?php echo $i; ?>][sort]" value="<?php echo $color['sort']; ?>" class="form-control" />
						</td>
						<td class="text-right">
							<a href="<?php echo $color['edit']['href']; ?>" class="btn btn-primary"><?php echo $color['edit']['text']; ?></a>
						</td>
					</tr>
					<?php $i++; ?>
					<?php } ?>
					<?php } ?>
				</tbody>
			</table>
			<?php if ( $colors ) { ?>
			<div>
				<a onclick="$('#form').attr('action', '<?php echo $save_order; ?>'); $('#form').attr('target', '_self'); $('#form').submit();" class="btn btn-primary"><?php echo $button_save_order; ?></a>
			</div>
			
			
			<?php } ?>
      </form>
      <div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>
      </div>
    </div>
  </div>
<script type="text/javascript"><!--
$('#button-filter').on('click', function(){
	filter()
});

function filter(){
	url = 'index.php?route=design_color/design_color/_list&token=<?php echo $token; ?>';
	
	var filter_id_design_color = $('input[name=\'filter_id_design_color\']').attr('value');
	
	if (filter_id_design_color) {
		url += '&filter_id_design_color=' + encodeURIComponent(filter_id_design_color);
	}
	
	var filter_name = $('input[name=\'filter_name\']').val();
	
	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}
	
	var filter_code = $('input[name=\'filter_code\']').val();
	
	if (filter_code != '') {
		url += '&filter_code=' + encodeURIComponent(filter_code);
	}
	
	var filter_status = $('select[name=\'filter_status\']').val();
	
	if (filter_status != '') {
		url += '&filter_status=' + encodeURIComponent(filter_status);
	}
		
	var limit = $('input[name=\'limit\']').val();
	
	if (limit) {
		url += '&limit=' + encodeURIComponent(limit);
	}
				
	location = url;
}
//--></script>
<script type="text/javascript"><!--
$('#filterdiv input').keydown(function(e) {
	if (e.keyCode == 13) {
		filter();
	}
});
</div>
<?php echo $footer; ?>