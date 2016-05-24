<div class="row">
	<div class="form-group required">
		<label class="col-sm-2 control-label" for="input-colors_number"><?php echo $entry_num_colors; ?></label>
		<div class="col-sm-10">
			<?php if($colors_number_img) : ?>
			<input type="text" id="input-colors_number" name="colors_number" value="<?php echo $colors_number; ?>" class="form-control" readonly placeholder="<?php echo $entry_num_colors; ?>"/>
			<?php else : ?>
			<?php foreach($color_numbers_images as $i=>$image) : ?>
			<label class="radio-inline text-center">
				<input type="radio" <?php echo $colors_number==$i ? 'checked="checked"' : ''; ?> name="colors_number" value="<?php echo $i; ?>" onclick="setNumColors(<?php echo $i; ?>)" /> <?php echo $i; ?><br />
				<img src="<?php echo $image; ?>" />
			</label>
			<?php endforeach; ?>
			<?php endif; ?>
			
			<?php if ($error_colors_number) : ?>
			<div class="text-danger"><?php echo $error_colors_number; ?></div>
			<?php endif; ?>
		</div>
	</div>

	
	<?php if ($error_color_size) { ?>
	<div class="text-danger"><?php echo $error_color_size; ?></div>
	<?php } ?>
	<?php if ($error_default_color) { ?>
	<div class="text-danger"><?php echo $error_default_color; ?></div>
	<?php } ?>
</div>

<br/>

<div>
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
			<td></td>
			<td class="text-center"><?php echo $text_default_color; ?></td>
			<?php foreach ($sizes as $product_size) { ?>
				<td class="text-center"><a onclick="$('input[type=checkbox][product_size=<?php echo $product_size['id_product_size']; ?>]').click();"><?php echo $product_size['description']; ?></a></td>
			<?php } ?>
			</tr>
		</thead>
		
		<tbody>
		<?php foreach ($colors as $product_color) : ?>
		<tr num_colors="<?php echo $product_color['num_colors']; ?>">
		<td>
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td><a onclick="$('input[type=checkbox][product_color=<?php echo $product_color['id_product_color']; ?>]').click();"><?php echo $product_color['name']; ?></a></td>
				<td>
					<table height="100%" cellpadding="0" cellspacing="0" style="width:75px; border: solid 1px #000">
						<tr>
							<?php foreach($product_color["hexa"] as $hexa) { ?>
							<td style="background-color:#<?php echo $hexa; ?>;">&nbsp;</td>
							<?php } ?>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		</td>
		<td class="text-center">
			<input type="radio" name="default_color" value="<?php echo $product_color['id_product_color']; ?>" <?php echo $default_color==$product_color['id_product_color'] ? 'checked="checked"' : ''; ?> class="form-control"/>
		</td>
		<?php foreach ($sizes as $product_size) : ?>
		<td class="text-center">
			<input type="checkbox"
				id="color_size_<?php echo $product_color['id_product_color']; ?>_<?php echo $product_size['id_product_size']; ?>"
				name="color_size[<?php echo $product_color['id_product_color']; ?>][<?php echo $product_size['id_product_size']; ?>]" <?php echo isset($color_size[$product_color['id_product_color']][$product_size['id_product_size']]) ? 'checked="checked"' : ''; ?> 
				product_color="<?php echo $product_color['id_product_color']; ?>"
				product_size="<?php echo $product_size['id_product_size']; ?>" 
				value="<?php echo $product_color['id_product_color']; ?>_<?php echo $product_size['id_product_size']; ?>"
				/> <label for="color_size_<?php echo $product_color['id_product_color']; ?>_<?php echo $product_size['id_product_size']; ?>"><?php echo $product_size['initials']; ?></label>
		</td>
		<?php endforeach; ?>
		</tr>
		<?php endforeach; ?>
		</tbody>
	
	</table>
	</div>

</div>
<script type="text/javascript">
function setNumColors(num) {
	$('tr[num_colors]').hide(); 
	$('tr[num_colors=' + num + ']').show();
	$('tbody.fill_container').each(function(index) {
		var dif = num - $(this).children('.fill').length;
		var view_index = $(this).attr('view_index');
		if(dif<0) {
			for(var i=dif; i<0; i++) {
				removeFill(view_index);
			}
		} else if(dif>0) {
			for(var i=0; i<dif; i++) {
				setTimeout( addFill(view_index), 500);
				//addFill(view_index);
			}
		}
	});
}
$(document).ready(function() {
	setNumColors(<?php echo $colors_number; ?>);
});
</script>
