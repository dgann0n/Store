<?php echo $header; ?>
<div class="container">
	<ul class="breadcrumb">
    	<?php foreach ($breadcrumbs as $breadcrumb) { ?>
		<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
	    <?php } ?>
	</ul>
	<div class="row"><?php echo $column_left; ?>
	    <?php if ($column_left && $column_right) { ?>
	    <?php $class = 'col-sm-6'; ?>
	    <?php } elseif ($column_left || $column_right) { ?>
	    <?php $class = 'col-sm-9'; ?>
	    <?php } else { ?>
	    <?php $class = 'col-sm-12'; ?>
	    <?php } ?>
		<div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
			<h1><?php echo $heading_title; ?></h1>

			<div class="well">
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-design_filter"><?php echo $label_filter; ?></label>
					<div class="col-sm-4">
						<select id="input-design_filter" class="form-control" onchange="filter_design_change(this.value)">
							<option value=""><?php echo $text_all; ?></option>
							<option value="saved_designs"><?php echo $text_templates; ?></option>
							<option value="ordered_designs"><?php echo $text_ordered; ?></option>
						</select>
					</div>
				</div>
			</div>

			<div id="saved_designs">
				<h2><?php echo $text_templates; ?></h2>

				<div>
					<?php if ($templates) { ?>
					<?php foreach ($templates  as $i=>$template) { ?>
					<div class="col-sm-3">
						<div class="product-thumb">
							<div class="image">
								<?php if ( count($template['images']) > 1 ) { ?>
								<table>
								<?php foreach ($template['images'] as $images) { ?>
								<td><img class="img-responsive" src="<?php echo $images['large']; ?>" border="0" title="<?php echo $template['name']; ?>" alt="<?php echo $template['name']; ?>" /></td>
								<?php } ?>
								</table>
								<?php } else { ?>
								<?php foreach ($template['images'] as $images) { ?>
								<img class="img-responsive" src="<?php echo $images['large']; ?>" border="0" title="<?php echo $template['name']; ?>" alt="<?php echo $template['name']; ?>" />
								<?php } ?>
								<?php } ?>
							</div>

							<div class="text-center">
								<h4><?php echo $template['name']; ?></h4>
								<div id="button-row-<?php echo $i; ?>" class="design-button-row btn-group">
									<?php if ($template['link_edit']) { ?>
									<a class="btn btn-primary" href="<?php echo $template['link_edit']; ?>" target="_blank"><span class="glyphicon glyphicon-edit"></span> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_edit_design; ?></span></a>
									<?php } ?>
									<a class="btn btn-success" href="<?php echo $template['link_import']; ?>" target="_blank" title="<?php echo $text_new_design; ?>"><span class="glyphicon glyphicon-duplicate" aria-hidden="true"></span></a>
									<?php if ($template['link_remove']) { ?>
									<a class="btn btn-danger" onclick="confirmDelete(<?php echo $i; ?>); return false;" title="<?php echo $text_remove; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
									<?php } ?>
								</div>
								<div id="confirm-delete-<?php echo $i; ?>" style="display:none;" class="design-delete-row">
									<span><?php echo $text_promp_delete; ?></span><br/>
									<a class="btn btn-danger" href="<?php echo $template['link_remove']; ?>"><span class="glyphicon glyphicon-trash"></span></a>
									<a class="btn btn-default" onclick="cancelDelete(); return false;"><?php echo $button_cancel; ?></a>
								</div>
								<div class="clearfix"></div>
								<br/>
							</div>
						</div>
					</div>
					<?php } ?>
					<?php } else { ?>
					<div><?php echo $text_empty_templates; ?></div>
					<?php } ?>
				</div>
			</div>
			<div class="clearfix"></div>

			<br/><br/>

			<div id="ordered_designs">
				<h2><?php echo $text_ordered; ?></h2>


				<div>
					<?php if ($ordered) { ?>
					<?php foreach ($ordered  as $template) { ?>
					<div class="col-sm-3">
						<div class="product-thumb">
							<div class="image">
								<?php if ( count($template['images']) > 1 ) { ?>
								<table>
								<?php foreach ($template['images'] as $images) { ?>
								<td><img class="img-responsive" src="<?php echo $images['large']; ?>" border="0" title="<?php echo $template['name']; ?>" alt="<?php echo $template['name']; ?>" /></td>
								<?php } ?>
								</table>
								<?php } else { ?>
								<?php foreach ($template['images'] as $images) { ?>
								<img class="img-responsive" src="<?php echo $images['large']; ?>" border="0" title="<?php echo $template['name']; ?>" alt="<?php echo $template['name']; ?>" />
								<?php } ?>
								<?php } ?>
							</div>

							<div class="text-center">
								<h4><?php echo $template['name']; ?></h4>
								<div>
									<a class="btn btn-success" href="<?php echo $template['link_import']; ?>"><span class="glyphicon glyphicon-duplicate" aria-hidden="true"></span> <?php echo $text_new_design; ?></a>
								</div>
								<div class="clearfix"></div>
								<br/>
							</div>
						</div>
					</div>
					<?php } ?>
					<?php } else { ?>
					<div class="warning"><?php echo $text_empty_ordered; ?></div>
					<?php } ?>
				</div>
			</div>


		</div>
		<div class="buttons">
			<div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
		</div>

<script type="text/javascript"><!--
function confirmDelete(key) {
	cancelDelete();
	$('#button-row-'+key).hide();
	$('#confirm-delete-'+key).show();
}

function cancelDelete(){
	$('.design-delete-row').hide();
	$('.design-button-row').show();
}

function filter_design_change(value) {
	if(value=="") {
		$('#saved_designs').show();
		$('#ordered_designs').show();
	} else if(value=="saved_designs") {
		$('#saved_designs').show();
		$('#ordered_designs').hide();
	} else if(value=="ordered_designs") {
		$('#saved_designs').hide();
		$('#ordered_designs').show();
	}
}
//--></script>
	<?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>