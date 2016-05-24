<tr class="fill">
		<td>
			<div>
		<input type="hidden" name="views[<?php echo $view_index; ?>][fills][<?php echo $view_fill_index; ?>]" value="<?php echo $fill_file; ?>" />
		<input type="hidden" id="fill_url_<?php echo $view_index; ?>_<?php echo $view_fill_index; ?>" value="<?php echo $image; ?>" />
		<img id="thumb_fill_<?php echo $view_index; ?>_<?php echo $view_fill_index; ?>" src="<?php echo $thumb; ?>" /></div>
		
		<div><input id="fill_upload_<?php echo $view_index; ?>_<?php echo $view_fill_index; ?>" type="file" /></div>
		<div>
			<a onclick="$('#thumb_fill_<?php echo $view_index; ?>_<?php echo $view_fill_index; ?>').attr('src', '<?php echo $no_image; ?>'); $('input[name=\'views[<?php echo $view_index; ?>][fills][<?php echo $view_fill_index; ?>]\']').attr('value', ''); " class="btn btn-danger"><i class="fa fa-close"></i><?php echo $text_clear; ?></a><br/>
		</div>
		</td>

	<script type="text/javascript">
	$(document).ready(function() {
		$('#fill_upload_<?php echo $view_index; ?>_<?php echo $view_fill_index; ?>').uploadify({
			'uploader'  : 'view/javascript/uploadify/uploadify.swf',
			'script'    : 'index.php?route=product/view/upload_fill&token=<?php echo $token; ?>',
			'cancelImg' : 'view/javascript/uploadify/cancel.png',
			'scriptData'  : {session_id: "<?php echo session_id(); ?>"},
			'buttonText': '<?php echo $button_fill; ?>',
			'auto'      : true,
			'fileDataName' : 'file',
			'method'      : 'POST',
			'fileExt'     : '*.png;*.gif;',
			'fileDesc'    : 'Image Files',
			'onComplete'  : function(event, ID, fileObj, response, data) {
				var obj = jQuery.parseJSON( response );
				if(!obj.error) {
					$('input[name=\'views[<?php echo $view_index; ?>][fills][<?php echo $view_fill_index; ?>]\']').val(obj.filename);
					$('#fill_url_<?php echo $view_index; ?>_<?php echo $view_fill_index; ?>').val(obj.image);
					$('#thumb_fill_<?php echo $view_index; ?>_<?php echo $view_fill_index; ?>').attr('src', obj.thumb);
					//swfobject.getObjectById("view_drawer_<?php echo $view_index; ?>").setFill(obj.image);
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
</tr>