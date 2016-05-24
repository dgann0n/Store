<style>
li.layer {
	list-style:none;
}
</style>

<div class="form-group required">
	<label class="col-sm-2 control-label"><?php echo $entry_vector_file; ?></label>
	<div class="col-sm-10">
		<span id="text_vector_file"><?php echo $vector_file; ?></span>
		<input type="hidden" name="vector_file" id="vector_file" value="<?php echo $vector_file; ?>" /><br />
		<input id="vector_file_upload" name="vector_file_upload" type="file" />
		<?php if ($error_vector_file) { ?>
		<div class="text-danger"><?php echo $error_vector_file; ?></div>
		<?php } ?>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label"><?php echo $entry_vector_file_2; ?></label>
	<div class="col-sm-10">
		<span id="text_vector_file_2"><?php echo $vector_file_2; ?></span>
		<input type="hidden" name="vector_file_2" id="vector_file_2" value="<?php echo $vector_file_2; ?>" /><br />
		<input id="vector_file_2_upload" name="vector_file_2_upload" type="file" />
	</div>

</div>
<div class="form-group required">
	<label class="col-sm-2 control-label"><?php echo $entry_image_file; ?></label>
	<div class="col-sm-10">
		<span id="text_image_file"><?php echo $image_file; ?></span>
		<input type="hidden" name="image_file" id="image_file" value="<?php echo $image_file; ?>" /><br />
		<input id="image_file_upload" name="image_file_upload" type="file" />
		<img id="thumb" class="thumbnail" src="<?php echo $thumb; ?>" />
		<?php if ($error_image_file) { ?>
		<div class="text-danger"><?php echo $error_image_file; ?></div>
		<?php } ?>
	</div>
</div>

<div class="form-group required">
	<label class="col-sm-2 control-label"><?php echo $entry_swf_file; ?></label>
	<div class"col-sm-10">
		<span id="text_swf_file"><?php echo $swf_file; ?></span>
		<input type="hidden" name="swf_file" id="swf_file" value="<?php echo $swf_file; ?>" /><br />
		<input id="swf_file_upload" name="swf_file_upload" type="file" />
		<?php if ($error_swf_file) { ?>
		<div class="text-danger"><?php echo $error_swf_file; ?></div>
		<?php } ?>
	</div>
</div>

<div class="col-sm-4">
		<div id="clipart_sample"></div>
</div>
<div class="col-sm-8">
		<h4><?php echo $text_layers; ?></h4>
		<div class="table-responsive">
		<table class="ui_layers table table-striped table-bordered">
			<?php foreach ($layer_name as $key => $name) { ?>
			<tr class="layer">
				<td><input type="text" name="layer_name[]" value="<?php echo $name; ?>" class="form-control" style="width:175px;"/></td>
			  	<td>
					<select style="background-color:#<?php if(isset($colors[$layer_id_design_color[$key]]["hexa"])) { echo $colors[$layer_id_design_color[$key]]["hexa"]; } else { echo "FFFFFF"; } ?>" name="layer_id_design_color[]" onchange="updateColor(this)" class="form-control">
						<option value="0" style="background-color:#FFF" ><?php echo $text_select; ?></option>
						<?php foreach($colors as $color) { ?>
						<option <?php if($layer_id_design_color[$key]==$color["id_design_color"]) { ?> selected="selected" <?php } ?> value="<?php echo $color["id_design_color"]; ?>" style="background-color:#<?php echo $color["hexa"]; ?>" hexa="<?php echo $color["hexa"]; ?>" ><?php echo $color["name"]; ?></option>
						<?php }	?>
			  		</select>
				</td>
			</tr>
			<?php } ?>
		</table>
		</div>
		
		<?php if ($error_layer_name) { ?>
		<div class="text-danger"><?php echo $error_layer_name; ?></div>
		<?php } ?>
		
		<?php if ($error_layer_id_design_color) { ?>
		<div class="text-danger"><?php echo $error_layer_id_design_color; ?></div>
		<?php } ?>
		
		<div id="child_not_sprite" style="display:none;" class="text-warning"><?php echo $text_child_not_sprite; ?></div>
		<div class="text-warning"><?php echo $text_full_color; ?></div>

<script type="text/javascript">
var layerHTML = '<tr class="layer">';
	layerHTML += '<td><input type="text" name="layer_name[]" value="Layer"></td>';
	layerHTML += '<td><select style="background-color:#FFFFFF" name="layer_id_design_color[]" onchange="updateColor(this)">';
	layerHTML += '<option value="0" style="background-color:#FFF" ><?php echo $text_select; ?></option>';
	<?php
	foreach($colors as $color) { ?>
	layerHTML += '<option value="<?php echo $color["id_design_color"]; ?>" style="background-color:#<?php echo $color["hexa"]; ?>" hexa="<?php echo $color["hexa"]; ?>" ><?php echo $color["name"]; ?></option>';
	<?php
	}
	?>
	layerHTML += '</select></td>';
	layerHTML += '</tr>';


$(document).ready(function() {
	var flashvars = {swf_file:"<?php echo $swf_file; ?>", clipart_dir:"<?php echo $clipart_dir; ?>"};
	var params = {wmode:"transparent", menu: "false", allowfullscreen:"true", allowScriptAccess:"always"};
	var attributes = {};
	swfobject.embedSWF("view/template/clipart/clipart_sample.swf", "clipart_sample", "300", "300", "10.0.0", '', flashvars, params, attributes);    


	 $('#vector_file_upload').uploadify({
		'uploader'  : 'view/javascript/uploadify/uploadify.swf',
		'script'    : 'index.php?route=clipart/clipart/upload_vector&token=<?php echo $token; ?>',
		'cancelImg' : 'view/javascript/uploadify/cancel.png',
		'scriptData'  : {session_id: "<?php echo session_id(); ?>"},
		'buttonText': '<?php echo $button_upload; ?>',
		'auto'      : true,
		'fileDataName' : 'file',
		'method'      : 'POST',
		'fileExt'     : '*.svg;*.cdr;*.ai;*.eps',
		'fileDesc'    : 'Vector Files',
		'onComplete'  : function(event, ID, fileObj, response, data) {
			var obj = jQuery.parseJSON( response );
			if(!obj.error) {
				$('#vector_file').val(obj.filename);
				$('#text_vector_file').text(obj.filename);
			} else {
				alert(obj.error);
			}
		},
		'onError'     : function (event,ID,fileObj,errorObj) {
		  alert(errorObj.type + ' Error: ' + errorObj.info);
		}
	});
	 $('#vector_file_2_upload').uploadify({
		'uploader'  : 'view/javascript/uploadify/uploadify.swf',
		'script'    : 'index.php?route=clipart/clipart/upload_vector&token=<?php echo $token; ?>',
		'cancelImg' : 'view/javascript/uploadify/cancel.png',
		'scriptData'  : {session_id: "<?php echo session_id(); ?>"},
		'buttonText': '<?php echo $button_upload; ?>',
		'auto'      : true,
		'fileDataName' : 'file',
		'method'      : 'POST',
		'fileExt'     : '*.svg;*.cdr;*.ai;*.eps',
		'fileDesc'    : 'Vector Files',
		'onComplete'  : function(event, ID, fileObj, response, data) {
			var obj = jQuery.parseJSON( response );
			if(!obj.error) {
				$('#vector_file_2').val(obj.filename);
				$('#text_vector_file_2').text(obj.filename);
			} else {
				alert(obj.error);
			}
		},
		'onError'     : function (event,ID,fileObj,errorObj) {
		  alert(errorObj.type + ' Error: ' + errorObj.info);
		}
	});
	 $('#image_file_upload').uploadify({
		'uploader'  : 'view/javascript/uploadify/uploadify.swf',
		'script'    : 'index.php?route=clipart/clipart/upload_image&token=<?php echo $token; ?>',
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
	 $('#swf_file_upload').uploadify({
		'uploader'  : 'view/javascript/uploadify/uploadify.swf',
		'script'    : 'index.php?route=clipart/clipart/upload_swf&token=<?php echo $token; ?>',
		'cancelImg' : 'view/javascript/uploadify/cancel.png',
		'scriptData'  : {session_id: "<?php echo session_id(); ?>"},
		'buttonText': '<?php echo $button_upload; ?>',
		'auto'      : true,
		'fileDataName' : 'file',
		'method'      : 'POST',
		'fileExt'     : '*.swf;',
		'fileDesc'    : 'SWF Files',
		'onComplete'  : function(event, ID, fileObj, response, data) {
			var obj = jQuery.parseJSON( response );
			if(!obj.error) {
				$('#swf_file').val(obj.filename);
				$('#text_swf_file').text(obj.filename);
				$('#child_not_sprite').hide();
				swfobject.getObjectById("clipart_sample").setSource(obj.filename);
			} else {
				alert(obj.error);
			}
		},
		'onError'     : function (event,ID,fileObj,errorObj) {
		  alert(errorObj.type + ' Error: ' + errorObj.info);
		}
	});
});
function onChildNotMC() {
	$('#child_not_sprite').show();
}
function onLayersChange(num) {
	var current = $('li.layer').length;
	var dif = num - current;
	if(dif>0) {
		for(var i=current+1; i<=num; i++) {
			$('ul.ui_layers').append(layerHTML);
		}
	} else {
		for(var i=current; i>num; i--) {
			$('li.layer:last').remove();
		}
	}
	/*if(num>2) {
		setFullColor()
	} else {
		clearFullColor()
	}*/
	tintClipart();
}
/*function setFullColor() {
	$('select[name="layer_id_design_color[]"]:first').attr('hexa','FFFFFF')
	$('select[name="layer_id_design_color[]"]:first').attr('disabled', true);
	
}
function clearFullColor() {
	$('select[name="layer_id_design_color[]"]:first').attr('disabled', false);
}*/
function updateColor(obj) {
	obj.style.backgroundColor = obj.options[obj.selectedIndex].style.backgroundColor;
	tintClipart();
}
function tintClipart() {
	$('select[name="layer_id_design_color[]"]').each(function(index) {
		var hexa = $(this).children("option:selected").attr("hexa");
		swfobject.getObjectById("clipart_sample").setLayerColor(index, hexa);
		
	});	
}
	
	
</script> 
