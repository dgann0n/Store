<div id="region_<?php echo $view_index; ?>_<?php echo $region_index; ?>">
	<input type="hidden" style="width:50px;" name="views[<?php echo $view_index; ?>][regions][<?php echo $region_index; ?>][region_index]" value="<?php echo $region_index; ?>" />
	<input type="hidden" style="width:50px;" name="views[<?php echo $view_index; ?>][regions][<?php echo $region_index; ?>][x]" value="<?php echo $x; ?>" />
	<input type="hidden" style="width:50px;" name="views[<?php echo $view_index; ?>][regions][<?php echo $region_index; ?>][y]" value="<?php echo $y; ?>" />
	<table class="table table-striped table-bordered">
		<tbody>
			<tr>
				<td class="text-right"><label class="control-label"><?php echo $entry_name; ?></label></td>
				<td>
				<input type="text" name="views[<?php echo $view_index; ?>][regions][<?php echo $region_index; ?>][name]" value="<?php echo $name; ?>" onchange="updateRegion(<?php echo $view_index; ?>,<?php echo $region_index; ?>)" class="form-control" />
				</td>
			</tr>
			<tr>
				<td class="text-right"><label class="control-label"><?php echo $entry_width; ?></label></td>
				<td>
					<input type="text" name="views[<?php echo $view_index; ?>][regions][<?php echo $region_index; ?>][width]" value="<?php echo $width; ?>" onchange="updateRegion(<?php echo $view_index; ?>,<?php echo $region_index; ?>)" class="form-control" />
				</td>
			</tr>
			<tr>
				<td class="text-right"><label class="control-label"><?php echo $entry_height; ?></label></td>
				<td>
					<input style="width:50px;" type="text" name="views[<?php echo $view_index; ?>][regions][<?php echo $region_index; ?>][height]" value="<?php echo $height; ?>" onchange="updateRegion(<?php echo $view_index; ?>,<?php echo $region_index; ?>)" class="form-control" />
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<?php echo $text_x; ?><span id="span_x_<?php echo $view_index; ?>_<?php echo $region_index; ?>"><?php echo $x; ?></span>
					<?php echo $text_y; ?><span id="span_y_<?php echo $view_index; ?>_<?php echo $region_index; ?>"><?php echo $y; ?></span>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<label class="radio-inline">
					<input type="radio" name="default_region" value="<?php echo $view_index; ?>_<?php echo $region_index; ?>" <?php if($default_region == $view_index.'_'.$region_index) { ?> checked="checked" <?php } ?> /> <?php echo $text_default; ?>
					</label>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="hidden" name="views[<?php echo $view_index; ?>][regions][<?php echo $region_index; ?>][mask]" value="<?php echo $mask; ?>" />
					<input type="hidden" id="mask_url_<?php echo $view_index; ?>_<?php echo $region_index; ?>" value="<?php echo $mask_url; ?>" />
					<div>
					<img id="thumb_mask_<?php echo $view_index; ?>_<?php echo $region_index; ?>" src="<?php echo $thumb_mask; ?>" />
					</div>
					<div><input id="region_mask_upload_<?php echo $view_index; ?>_<?php echo $region_index; ?>" type="file" />
					</div>
					<a onclick="$('#thumb_mask_<?php echo $view_index; ?>_<?php echo $region_index; ?>').attr('src', '<?php echo $no_image; ?>'); $('#mask_url_<?php echo $view_index; ?>_<?php echo $region_index; ?>').attr('value', '');$(&quot;input[name='views[<?php echo $view_index; ?>][regions][<?php echo $region_index; ?>][mask]']&quot;).attr('value', ''); swfobject.getObjectById('view_drawer_<?php echo $view_index; ?>').updateRegionImage(<?php echo $region_index; ?>,'');" class="btn btn-danger" title="<?php echo $text_clear; ?>"><i class="fa fa-close"></i></a></div>
						
				</td>
			</tr>
			<tr>
				<td colspan="2">
				<a class="btn btn-danger" onclick="removeRegion(<?php echo $view_index; ?>, <?php echo $region_index; ?>)"><i class="fa fa-close"></i><?php echo $button_remove; ?></a>
				</td>
			</tr>
		</tbody>
	</table>
	<br/>
<script type="text/javascript">
$(document).ready(function() {
	if(swfobject.getObjectById("view_drawer_<?php echo $view_index; ?>")) {
		swfobject.getObjectById("view_drawer_<?php echo $view_index; ?>").addRegion(<?php echo $region_index; ?>,'<?php echo $name; ?>',<?php echo $width; ?>,<?php echo $height; ?>,<?php echo $x; ?>,<?php echo $y; ?>);
		swfobject.getObjectById("view_drawer_<?php echo $view_index; ?>").updateRegionImage(<?php echo $region_index; ?>,'<?php echo $mask_url; ?>');
	} else {
		$(document).bind('creation_complete_<?php echo $view_index; ?>', function() {
			swfobject.getObjectById("view_drawer_<?php echo $view_index; ?>").addRegion(<?php echo $region_index; ?>,'<?php echo $name; ?>',<?php echo $width; ?>,<?php echo $height; ?>,<?php echo $x; ?>,<?php echo $y; ?>);
			swfobject.getObjectById("view_drawer_<?php echo $view_index; ?>").updateRegionImage(<?php echo $region_index; ?>,'<?php echo $mask_url; ?>');

		});
	}
});
</script>
<script type="text/javascript">
$(document).ready(function() {

	 $('#region_mask_upload_<?php echo $view_index; ?>_<?php echo $region_index; ?>').uploadify({
		'uploader'  : 'view/javascript/uploadify/uploadify.swf',
		'script'    : 'index.php?route=product/region/upload_mask&token=<?php echo $token; ?>',
		'cancelImg' : 'view/javascript/uploadify/cancel.png',
		'scriptData'  : {session_id: "<?php echo session_id(); ?>"},
		'buttonText': '<?php echo $button_mask; ?>',
		'auto'      : true,
		'fileDataName' : 'file',
		'method'      : 'POST',
		'fileExt'     : '*.jpg;*.png;*.gif;',
		'fileDesc'    : 'Image Files',
		'onComplete'  : function(event, ID, fileObj, response, data) {
			var obj = jQuery.parseJSON( response );
			if(!obj.error) {
				$('input[name=\'views[<?php echo $view_index; ?>][regions][<?php echo $region_index; ?>][mask]\']').val(obj.filename);
				$('#mask_url_<?php echo $view_index; ?>_<?php echo $region_index; ?>').val(obj.image);
				$('#thumb_mask_<?php echo $view_index; ?>_<?php echo $region_index; ?>').attr('src', obj.thumb);
				swfobject.getObjectById("view_drawer_<?php echo $view_index; ?>").updateRegionImage(<?php echo $region_index; ?>,obj.image);
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