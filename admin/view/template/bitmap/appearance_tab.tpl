<style type="text/css">
.colorbox {
	width: 24px; 
	height:24px; 
	display: inline-block;
	margin: 5px;
	border:solid 1px #333;
}
</style>
<div class="form-group required">
	<label class="col-sm-2 control-label"><?php echo $entry_image_file; ?></label>
	<div class="col-sm-10">
		<span id="text_image_file"><?php echo $image_file; ?></span>
		<input type="hidden" name="image_file" id="image_file" value="<?php echo $image_file; ?>" /><br />
		<input id="image_file_upload" name="image_file_upload" type="file" />
		<img id="thumb" src="<?php echo $thumb; ?>" />
		<?php if ($error_image_file) { ?>
		<div class="text-danger"><?php echo $error_image_file; ?></div>
		<?php } ?>
	</div>
</div>

<div class="form-group required">
		<label class="col-sm-2 control-label"><?php echo $entry_colors; ?></label>
		<div class="col-sm-10">
			<div>
			<?php echo $text_selected_colors; ?><span id="num_selected_colors"><?php echo count($colors); ?></span>
			</div>
			<?php if ($error_colors) { ?>
			<div class="text-danger"><?php echo $error_colors; ?></div>
			<?php } ?>
		</div>
	</div>
	
<div>
	<div class="colors btn-group" data-toggle="buttons">
		<?php foreach ($design_colors as $color_detail) { ?>
		<label class="btn btn-default <?php echo in_array($color_detail['id_design_color'], $colors) ?'active' : ''; ?>">
			<input type="checkbox" name="colors[]" <?php echo in_array($color_detail['id_design_color'], $colors) ?'checked' : ''; ?> onchange="updateSelectedColors();" value="<?php echo $color_detail['id_design_color'] ?>" />
			<span class="colorbox" style="background-color: #<?php echo $color_detail['hexa'] ?>; " title="<?php echo $color_detail['name'] ?>" color="<?php echo $color_detail['id_design_color'] ?>" >&nbsp;</span>
			
			<span><?php echo $color_detail['name'] ?></span>
		</label>
		
		<?php } ?>
	</div>
</div>
<script type="text/javascript">
function updateSelectedColors() {
	$("#colors_field_container").html('');
	var num_sel = 0;
	$('.colors :checkbox').each(function (i) {
		if ( this.checked ) {
			num_sel++;
		}
	});
	$('#num_selected_colors').text(num_sel);
}
$(document).ready(function() {
	
	 $('#image_file_upload').uploadify({
		'uploader'  : 'view/javascript/uploadify/uploadify.swf',
		'script'    : 'index.php?route=bitmap/bitmap/upload_image&token=<?php echo $token; ?>',
		'cancelImg' : 'view/javascript/uploadify/cancel.png',
		'scriptData'  : {session_id: "<?php echo session_id(); ?>"},
		'buttonText': '<?php echo $button_upload; ?>',
		'auto'      : true,
		'fileDataName' : 'file',
		'method'      : 'POST',
		'fileExt'     : '*.jpg;*.png;*.gif',
		'fileDesc'    : 'Image Files',
		'onComplete'  : function(event, ID, fileObj, response, data) {
			var obj = jQuery.parseJSON( response );
			if(!obj.error) {
				$('#image_file').val(obj.filename);
				$('#text_image_file').text(obj.filename);
				$('#thumb').attr('src', obj.file);
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
