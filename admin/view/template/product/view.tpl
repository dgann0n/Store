<div class="row">
	<div class="col-sm-4"><a onclick="$('#view-help-text').toggle();" class="btn btn-default"><i class="fa fa-info"></i> <?php echo $text_help_create_views_header; ?></a>
	<br/>
	<div id="view-help-text" style="display:none"><?php echo $text_help_create_views_body; ?></div>
	</div>
	<div class="col-sm-4"><a class="btn btn-primary" onclick="addView()"><i class="fa fa-plus"></i> <?php echo $button_add_view; ?></a>
	</div>
</div>
<br/>
<?php if ($error_views) { ?>
<div class="text-danger"><?php echo $error_views; ?></div>
<?php } ?>
<?php if ($error_view_fills) { ?>
<div class="text-danger"><?php echo $error_view_fills; ?></div>
<?php } ?>
<?php if ($error_view_shade_underfill) { ?>
<div class="text-danger"><?php echo $error_view_shade_underfill; ?></div>
<?php } ?>
<?php if ($error_view_regions) { ?>
<div class="text-danger"><?php echo $error_view_regions; ?></div>
<?php } ?>
<?php if ($error_default_region) { ?>
<div class="text-danger"><?php echo $error_default_region; ?></div>
<?php } ?>

<div id="view-container">
	<ul class="nav nav-tabs" id="views-ul">
		<?php $v = 0; ?>
		<?php foreach($views as $view) { ?>
		<li id="view-li-<?php echo $view['view_index']; ?>" <?php echo $v == 0 ? 'class="active"' : ''; ?>>
			<a href="#view_<?php echo $view['view_index']; ?>" data-toggle="tab"><?php echo $view['name']; ?></a>
		</li>
		<?php $v++; ?>
		<?php } ?>
		
	</ul>
	<div id="views" class="tab-content">
	<?php foreach($view_tabs as $view) { ?>
	
	<?php echo $view; ?>
	<?php } ?>
	<script>
		$(document).ready(function(e) {
			$('#views .view-tab:first').addClass('active');
		});
	</script>
	</div>
</div>
<script language="javascript">
function changeViewTabName(view_index){
	view_name = $('#view_'+view_index+' .view_name').val();
	$('#view-li-'+view_index+' a').text(view_name);
}

var add_view_index = '';
function addView() {
	
	$.ajax({
		url: 'index.php?route=product/view/form',
		data: {
			token: '<?php echo $token; ?>'
		},
		cache: false
	})
	.done(function(html){
		// add tab data
		$('#views').append(html);
		// add tab button
		add_view_index = $('.view-tab:last .view_index').val();
		view_name = $('.view-tab:last .view_name').val();
		$('#views-ul').append('<li id="view-li-'+add_view_index+'"><a href="#view_'+add_view_index+'" data-toggle="tab">'+view_name+'</a></li>');
		// set number of colors
		setNumColors($('input[name="colors_number"]:checked').val());
		// select new view tab
		//$('.view-tab').removeClass('active');
		$('#view-li-'+add_view_index+' a').tab('show');
		//$('#view_'+add_view_index).show();
	});
}
function removeView(view_index) {
	$('#view_' + view_index).remove();
	$('#view-li-' + view_index).remove();
	
	if ( $('#views-ul li').length > 0 ) {
		$('#views-ul li a:first').click();
	}
}
//---------------------------------
function addRegion(view_index) {
	var data = {
		token: "<?php echo $token; ?>",
		product_id: "<?php echo $product_id; ?>",
		view_index: view_index
	};
	
	$.ajax({
		url: 'index.php?route=product/region/form',
		data: data,
		cache: false
	})
	.done(function(html){
		$('#regions_' + view_index).append(html);
	});;
}
function updateRegion(view_index, region_index) {
	var name = $('input[name="views[' + view_index + '][regions][' + region_index + '][name]"]').val();
	var width = $('input[name="views[' + view_index + '][regions][' + region_index + '][width]"]').val();
	var height = $('input[name="views[' + view_index + '][regions][' + region_index + '][height]"]').val();
	swfobject.getObjectById("view_drawer_" + view_index).updateRegion(region_index, width, height, name);
}
function removeRegion(view_index, region_index) {
	$('#region_' + view_index + '_' + region_index).remove();
	swfobject.getObjectById("view_drawer_" + view_index).removeRegion(region_index);
}
function addFill(view_index) {
	var timestamp = Date.now();
	var url = 'index.php?route=product/view/fill';
	var data = {
		token: "<?php echo $token; ?>",
		view_index: view_index
	};
	$.ajax({
		url: url,
		data: data,
		cache: false
	})
	.done(function(html) {
	   $('#fills_' + view_index).append(html);
	});
	
}
function removeFill(view_index) {
	$('#fills_' + view_index + ' > tr:last').remove();
}
//------------------------------------

//callbacks from actionscript
function drawerCreationComplete(view_index) {
	$('#button_add_region_' + view_index).show();
	swfobject.getObjectById("view_drawer_" + view_index).updateScale($('input[name="views[' + view_index + '][regions_scale]"]').val());
	swfobject.getObjectById("view_drawer_" + view_index).setShade($('#shade_url_' + view_index).val());
	swfobject.getObjectById("view_drawer_" + view_index).setUnderfill($('#underfill_url_' + view_index).val());
	
	//trigger event for add previous created regions
	$(document).trigger('creation_complete_' + view_index);
}
function onScaleUpdated(view_index, scale) {
	$('input[name="views[' + view_index + '][regions_scale]"]').val(scale);
	$('#span_scale_' + view_index).html(scale);
}
function onRegionPositionUpdated(view_index, region_index, x, y) {
	$('input[name="views[' + view_index + '][regions][' + region_index + '][x]"]').val(x);
	$('input[name="views[' + view_index + '][regions][' + region_index + '][y]"]').val(y);
	
	$('#span_x_' + view_index + '_' + region_index).html(x);
	$('#span_y_' + view_index + '_' + region_index).html(y);

}
</script>
