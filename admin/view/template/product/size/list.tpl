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
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-id"><?php echo $entry_id; ?></label>
				<input type="text" name="filter_id_product_size" value="<?php echo $filter_id_product_size; ?>" placeholder="<?php echo $entry_id; ?>" id="input-id" class="form-control" />
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
                <label class="control-label" for="input-filter_add_cost"><?php echo $entry_upcharge; ?></label>
				<select id="input-filter_add_cost" name="filter_apply_additional_cost" class="form-control">
				  <?php foreach ($apply_additional_cost_status as $status) { ?>
					  <?php if ($status['val'] === $filter_apply_additional_cost) { ?>
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
		<style>
		/*#sortable { list-style-type: none; margin: 0; padding: 0; width: 100%; }
		#sortable li { margin: 0px; padding: 0px; cursor:move; }*/
		.ui-state-highlight { height: 1.5em; line-height: 1.2em; }
		</style>
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
		<input type="hidden" name="limit" value="<?php echo $limit; ?>" />		
		<div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
			<tr>
				<td width="1" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
			  <td width="200" class="text-left"><?php echo $column_id_product_size; ?></td>
			  <td width="300" class="text-left" width="90%"><?php if ($sort == 'description') { ?>
				<a href="<?php echo $sort_description; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_description; ?></a>
				<?php } else { ?>
				<a href="<?php echo $sort_description; ?>"><?php echo $column_description; ?></a>
				<?php } ?>
			  </td>
			  <td width="50" class="text-left"><?php echo $column_initials; ?></td>
			  <td width="100" class="text-left"><?php if ($sort == 'apply_additional_cost') { ?>
				<a href="<?php echo $sort_apply_additional_cost; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_apply_additional_cost; ?></a>
				<?php } else { ?>
				<a href="<?php echo $sort_apply_additional_cost; ?>"><?php echo $column_apply_additional_cost; ?></a>
				<?php } ?></td>
			  <td width="50" class="text-left"><?php if ($sort == 'sort') { ?>
				<a href="<?php echo $sort_sort; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_sort; ?></a>
				<?php } else { ?>
				<a href="<?php echo $sort_sort; ?>"><?php echo $column_sort; ?></a>
				<?php } ?></td>
			  <td class="text-right"><?php echo $column_action; ?></td>
			</tr>
		  </thead>
		  <tbody>
			<?php if (!$sizes) { ?>
			<tr>
			  <td class="text-center" colspan="7"><?php echo $text_no_results; ?></td>
			</tr>
			<?php } else { ?>
			<?php $i=0; ?>
			<?php foreach ($sizes as $size) { ?>
			<tr>
			  <td width="10" class="text-center"><?php if ($size['selected']) { ?>
			<input type="checkbox" name="selected[]" value="<?php echo $size['id_product_size']; ?>" checked="checked" />
			<?php } else { ?>
			<input type="checkbox" name="selected[]" value="<?php echo $size['id_product_size']; ?>" />
			<?php } ?></td>
			  <td width="200" class="text-left"><span style="display:block; width:200px; overflow:hidden"><?php echo $size['id_product_size']; ?></span></td>
			  <td width="300" class="text-left"><?php echo $size['description']; ?></td>
			  <td width="50" class="text-left"><?php echo $size['initials']; ?></td>
			  <td width="100" class="text-left"><?php echo $size['apply_additional_cost']; ?></td>
			  <td width="75" class="text-center">
			  	<input type="hidden" name="sorting[<?php echo $i; ?>][id]" value="<?php echo $size['id_product_size']; ?>" />
				<input type="text" name="sorting[<?php echo $i; ?>][sort]" value="<?php echo $size['sort']; ?>" class="form-control" />
			  </td>
			  <td class="text-right">
				<a href="<?php echo $size['edit']['href']; ?>" data-toggle="tooltip" title="<?php echo $size['edit']['text']; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
			  </td>
			</tr>
			<?php $i++; ?>
			<?php } ?>
			<?php } ?>
		</tbody>
		</table>
			<div align="center" style="padding:10px;">
			<a onclick="$('#form').attr('action', '<?php echo $save_order; ?>'); $('#form').attr('target', '_self'); $('#form').submit();" class="btn btn-default"><?php echo $button_save_order; ?></a>
			</div>
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
$('#button-filter').on('click', function() {
	url = 'index.php?route=product/size/_list&token=<?php echo $token; ?>';
	
	var filter_id_product_size = $('input[name=\'filter_id_product_size\']').val();
	
	if (filter_id_product_size) {
		url += '&filter_id_product_size=' + encodeURIComponent(filter_id_product_size);
	}
	
	var filter_name = $('input[name=\'filter_name\']').val();
	
	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}
	
	var filter_apply_additional_cost = $('select[name=\'filter_apply_additional_cost\']').val();
	
	if (filter_apply_additional_cost != '') {
		url += '&filter_apply_additional_cost=' + encodeURIComponent(filter_apply_additional_cost);
	}
		
	/*	
	var limit = $('input[name=\'limit\']').attr('value');
	
	if (limit) {
		url += '&limit=' + encodeURIComponent(limit);
	}
	*/
				
	location = url;
});
//--></script>  
</div>
<?php echo $footer; ?>