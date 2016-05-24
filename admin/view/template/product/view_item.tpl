<div class="tab-pane view-tab" id="view_<?php echo $view_index; ?>">
	<input type="hidden" class="view_index" name="views[<?php echo $view_index; ?>][view_index]" value="<?php echo $view_index; ?>" />
	<input type="hidden" name="views[<?php echo $view_index; ?>][regions_scale]" value="<?php echo $regions_scale; ?>" />
	
	
	<div>
		
		<div class="form-group required">
			<label class="col-sm-2 control-label"><?php echo $entry_name; ?></label>
			<div class="col-sm-6">
				<input type="text" name="views[<?php echo $view_index; ?>][name]" value="<?php echo $name; ?>" class="form-control view_name" onchange="changeViewTabName(<?php echo $view_index; ?>);" />
			</div>
			<div class="col-sm-4 text-right">
				<a class="btn btn-danger" onclick="removeView(<?php echo $view_index; ?>)"><i class="fa fa-close"></i> <?php echo $button_remove; ?></a>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label"><?php echo $text_scale; ?></label>
			<div class="col-sm-10">
				<span id="span_scale_<?php echo $view_index; ?>"><?php echo $regions_scale; ?></span>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-4">
				<ul class="nav nav-tabs" id="view-setup-tabs-<?php echo $view_index; ?>">
					<li class="active"><a href="#product-appearance-<?php echo $view_index; ?>" data-toggle="tab"><?php echo $text_image_setup; ?></a></li>
					<li><a href="#print-areas-<?php echo $view_index; ?>" data-toggle="tab"><?php echo $text_regions; ?></a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="product-appearance-<?php echo $view_index; ?>">
						<div><h4><?php echo $text_view_setup; ?></h4></div>
						
						<div class="panel-group" id="color-accordion-<?php echo $view_index; ?>" role="tablist" aria-multiselectable="true">
						
							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="color-collapse2-<?php echo $view_index; ?>-label">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#color-accordion-<?php echo $view_index; ?>" href="#color-collapse2-<?php echo $view_index; ?>" aria-expanded="true" aria-controls="color-collapse2-<?php echo $view_index; ?>"><?php echo $text_underfill; ?></a>
									</h4>
								</div>
								<div id="color-collapse2-<?php echo $view_index; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="color-collapse2-<?php echo $view_index; ?>-label">
									<div class="panel-body">
										<div class="table-responsive">
											<table class="table table-striped table-bordered">
												<tr><td><?php echo $text_no_coloreable_pros_cons; ?></td></tr>
												<tr>
													<td>
														<div>
														<input type="hidden" name="views[<?php echo $view_index; ?>][underfill]" value="<?php echo $underfill; ?>" />
														<input type="hidden" id="underfill_url_<?php echo $view_index; ?>" value="<?php echo $underfill_url; ?>" />
														</div>
														<div>
														<table>
															<tr>
																<td><img id="thumb_underfill_<?php echo $view_index; ?>" src="<?php echo $thumb_underfill; ?>" /></td>
															</tr>
															<tr>
																<td>
																	<div><input id="underfill_upload_<?php echo $view_index; ?>" type="file" /></div>
																	<div><a onclick="$('#thumb_underfill_<?php echo $view_index; ?>').attr('src', '<?php echo $no_image; ?>'); $('input[name=\'views[<?php echo $view_index; ?>][underfill]\']').attr('value', ''); swfobject.getObjectById('view_drawer_<?php echo $view_index; ?>').setUnderfill('');" class="btn btn-remove"><?php echo $text_clear; ?></a></div>
																</td>
															</tr>
														</table>
														</div>
													</td>
												</tr>
											</table>	
										</div>
									</div>
								</div>
							</div>
							
							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="color-collapse1-<?php echo $view_index; ?>-label">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#color-accordion-<?php echo $view_index; ?>" href="#color-collapse1-<?php echo $view_index; ?>" aria-expanded="true" aria-controls="color-collapse1-<?php echo $view_index; ?>"><?php echo $text_coloreable; ?></a>
									</h4>
								</div>
								<div id="color-collapse1-<?php echo $view_index; ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="color-collapse1-<?php echo $view_index; ?>-label">
									<div class="panel-body">
										<div class="table-responsive">
											<table class="table table-striped table-bordered">
												<tr><td colspan="2"><?php echo $text_coloreable_pros_cons; ?></td></tr>
												<tr>
													<td><label class="control-label"><span data-toggle="tooltip" title="<?php echo $help_shade; ?>"><?php echo $text_shade; ?></span></label></td>
													<td>
														<div>
														<input type="hidden" name="views[<?php echo $view_index; ?>][shade]" value="<?php echo $shade; ?>" />
														<input type="hidden" id="shade_url_<?php echo $view_index; ?>" value="<?php echo $shade_url; ?>" />
														<img id="thumb_shade_<?php echo $view_index; ?>" src="<?php echo $thumb_shade; ?>" />
														</div>
														<div>
														<input id="shade_upload_<?php echo $view_index; ?>" type="file" /></div>
														<div>
														
														<a class="btn btn-danger" onclick="$('#thumb_shade_<?php echo $view_index; ?>').attr('src', '<?php echo $no_image; ?>'); $('input[name=\'views[<?php echo $view_index; ?>][shade]\']').attr('value', ''); swfobject.getObjectById('view_drawer_<?php echo $view_index; ?>').setShade('');"><i class="fa fa-close"></i> <?php echo $text_clear; ?></a>
														</div>
													</td>
												</tr>
												<tr>
													<td><label class="control-label"><span data-toggle="tooltip" title="<?php echo $help_fills; ?>"><?php echo $text_fills; ?></span></label></td>
													<td>
														<table class="table table-striped">
															<tbody class="fill_container" view_index="<?php echo $view_index; ?>" id="fills_<?php echo $view_index; ?>">
															<?php foreach($fills as $fill) { ?>
																<?php echo $fill; ?>
															<?php } ?>
															</tbody>
														</table>
													</td>
												</tr>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="print-areas-<?php echo $view_index; ?>">
						<div class="table-responsive">
							<h3><?php echo $text_regions; ?></h3>
							<div>
								<a id="button_add_region_<?php echo $view_index; ?>" class="btn btn-primary" onclick="addRegion(<?php echo $view_index; ?>)"><i class="fa fa-plus"></i> <?php echo $button_add_region; ?></a>
							</div>
							<hr/>
							<div>
								<div id="regions_<?php echo $view_index; ?>">
									<?php foreach($regions as $region) { ?>
										<?php echo $region; ?>
									<?php } ?>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	
		
		<div class="col-sm-8">
			<div id="view_drawer_<?php echo $view_index; ?>"></div>
		</div>
		</div>
	</div>

<script type="text/javascript">
$(document).ready(function() {
	var flashvars = {id_view:"<?php echo $view_index; ?>"};
	var params = {wmode:"transparent", menu: "false", allowfullscreen:"true", allowScriptAccess:"always"};
	var attributes = {};
	swfobject.embedSWF("view/template/product/drawer.swf", "view_drawer_<?php echo $view_index; ?>", "600", "800", "10.0.0", '', flashvars, params, attributes);    

	 $('#shade_upload_<?php echo $view_index; ?>').uploadify({
		'uploader'  : 'view/javascript/uploadify/uploadify.swf',
		'script'    : 'index.php?route=product/view/upload_shade&token=<?php echo $token; ?>',
		'cancelImg' : 'view/javascript/uploadify/cancel.png',
		'scriptData'  : {session_id: "<?php echo session_id(); ?>"},
		'buttonText': '<?php echo $button_shade; ?>',
		'auto'      : true,
		'fileDataName' : 'file',
		'method'      : 'POST',
		'fileExt'     : '*.jpg;*.png;*.gif;',
		'fileDesc'    : 'Image Files',
		'onComplete'  : function(event, ID, fileObj, response, data) {
			var obj = jQuery.parseJSON( response );
			if(!obj.error) {
				$('input[name=\'views[<?php echo $view_index; ?>][shade]\']').val(obj.filename);
				$('#shade_url_<?php echo $view_index; ?>').val(obj.image);
				$('#thumb_shade_<?php echo $view_index; ?>').attr('src', obj.thumb);
				swfobject.getObjectById("view_drawer_<?php echo $view_index; ?>").setShade(obj.image);
			} else {
				alert(obj.error);
			}
		},
		'onError'     : function (event,ID,fileObj,errorObj) {
		  alert(errorObj.type + ' Error: ' + errorObj.info);
		}
	});

	$('#underfill_upload_<?php echo $view_index; ?>').uploadify({
		'uploader'  : 'view/javascript/uploadify/uploadify.swf',
		'script'    : 'index.php?route=product/view/upload_shade&token=<?php echo $token; ?>',
		'cancelImg' : 'view/javascript/uploadify/cancel.png',
		'scriptData'  : {session_id: "<?php echo session_id(); ?>"},
		'buttonText': '<?php echo $button_underfill; ?>',
		'auto'      : true,
		'fileDataName' : 'file',
		'method'      : 'POST',
		'fileExt'     : '*.jpg;*.png;*.gif;',
		'fileDesc'    : 'Image Files',
		'onComplete'  : function(event, ID, fileObj, response, data) {
			var obj = jQuery.parseJSON( response );
			if(!obj.error) {
				$('input[name=\'views[<?php echo $view_index; ?>][underfill]\']').val(obj.filename);
				$('#underfill_url_<?php echo $view_index; ?>').val(obj.image);
				$('#thumb_underfill_<?php echo $view_index; ?>').attr('src', obj.thumb);
				swfobject.getObjectById("view_drawer_<?php echo $view_index; ?>").setUnderfill(obj.image);
			} else {
				alert(obj.error);
			}
		},
		'onError'     : function (event,ID,fileObj,errorObj) {
		  alert(errorObj.type + ' Error: ' + errorObj.info);
		}
	});

});
</script>

</div>
