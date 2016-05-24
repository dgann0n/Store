<style>
#matrix_list .input-price {
	margin:2px 0;
	width:65px;
	display:inline;
}
#matrix_list .quantity-column {
	min-width:125px;
}

#matrix_list .pricing-labels {
	height:39px;
}
</style>

  <?php if ($error_quantities) { ?>
  <div class="text-danger"><?php echo $error_quantities; ?></div>
  <?php } ?>
  <?php if ($error_price) { ?>
  <div class="text-danger"><?php echo $error_price; ?></div>
  <?php } ?>
  <?php if ($error_screen_charges) { ?>
  <div class="text-danger"><?php echo $error_screen_charges; ?></div>
  <?php } ?>
	<div class="well">
		<div class="row">
			<div class="col-sm-4">
				<div class="form-group">
					<label class="col-sm-6 control-label" for="quantity_increment"><?php echo $text_increment; ?></label>
					<div class="col-sm-6">
						<input type="text" id="quantity_increment" value="12" style="width:55px;" class="form-control" />
				<?php //echo $text_decrement; ?><!-- <input type="text" id="price_decrement" value="2.5"  /><br /> -->
					</div>

				</div>
				<a class="btn btn-primary" onclick="addColumn()"><?php echo $text_add_quantity; ?></a>
			</div>

			<div class="col-sm-4">
				<label class="control-label" for="input-max_colors"><?php echo $text_max_colors; ?></label>
					<select id="input-max_colors" name="max_colors" onchange="updateNumColors()" class="form-control">
						<?php for($i=1; $i<=$opentshirts_printing_colors_limit; $i++) { ?>
						<option value="<?php echo $i; ?>" <?php if($i==$max_colors) { ?> selected="selected" <?php } ?>><?php echo $i; ?></option>
						<?php } ?>
					</select>
				<?php echo $text_max_colors_help; ?>
			</div>
			<div class="col-sm-4">
			</div>
		</div>
	</div>

	<div class="table-responsive">
		<style>
			.pricing-labels{
				padding: 8px;
			}
			.pricing-labels .control-label {
				margin:0 0 22px 0;
				height:17px;
			}
		</style>
		<table id="matrix_list" class="table table-striped table-bordered">
			<tbody>
				<tr class="pricing-row">
					<td style="width:150px; min-width:150px;" id="label-column">
						<table class="table">
							<tbody class="label-column-tbody">
								<tr><td class="text-right pricing-labels"><label class="control-label"><?php echo $text_minimum_quantity; ?></label></td></tr>
								<tr style="background-color: yellowgreen;"><td class="text-right pricing-labels">
									<label class="control-label"><span data-toggle="tooltip" title="<?php echo $text_screen_charge_help; ?>"><?php echo $text_screen_charge; ?></span></label>
								</td></tr>
								<?php foreach($price as $num_colors=>$array_quantity) { ?>
								<tr class="price-label-row"><td class="text-right pricing-labels"><label class="control-label"><?php echo $num_colors; ?> <?php echo $text_colors; ?></label></td></tr>
								<?php } ?>
							</tbody>
						</table>
					</td>
					<?php if($quantities) : ?>
					<?php foreach($quantities as $index=>$quantity) : ?>
					<td class="quantity-column">
						<table class="table">
							<tbody class="quantity-column-tbody">
								<tr><td>
									<input type="text" name="quantities[]" value="<?php echo $quantity; ?>" title="quantity" class="form-control input-price" /> <div class="pull-right"><a class="btn btn-danger" onclick="removeClick($(this).parents('.quantity-column'));"><i class="fa fa-close"></i></a></div>
								</td></tr>
								<tr><td><?php echo $symbol_left; ?>  <input type="text" name="screen_charges[]" value="<?php echo $screen_charges[$index]; ?>" title="screens" class="form-control input-price" />  <?php echo $symbol_right; ?></td></tr>


								<?php foreach($price as $num_colors=>$array_quantity) : ?>
								<tr class="price-table-row"><td>
									<div class="price"><?php echo $symbol_left; ?> <input type="text" name="price[<?php echo $num_colors; ?>][]" value="<?php echo $price[$num_colors][$index]; ?>" class="form-control input-price" /> <?php echo $symbol_right; ?></div>
								</td></tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</td>
					<?php endforeach; ?>
					<?php else : ?>
					<td class="quantity-column">
						<table class="table">
							<tbody class="quantity-column-tbody">
								<tr><td>
									<input type="text" name="quantities[]" value="0" title="quantity" class="form-control input-price" /><a class="btn btn-default" onclick="removeClick($(this).parents('.quantity-column'));"><i class="fa fa-close"></i></a>
								</td></tr>
								<tr><td><?php echo $symbol_left; ?>  <input type="text" name="screen_charges[]" value="0" title="screens" class="form-control input-price" />  <?php echo $symbol_right; ?></td></tr>


								<?php foreach($price as $num_colors=>$array_quantity) : ?>
								<tr class="price-table-row"><td>
									<div class="price"><?php echo $symbol_left; ?> <input type="text" name="price[<?php echo $num_colors; ?>][]" value="0" class="form-control input-price" /> <?php echo $symbol_right; ?></div>
								</td></tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</td>
					<?php endif; ?>
				</tr>
			</tbody>
		</table>
    </div>

<script type="text/javascript"><!--
function removeClick(td)
{
	if($(".quantity-column").length > 1) {
		td.slideUp(300, function() {
			$(this).remove();
		});
	}
}
function addColumn()
{
	var current = parseInt($(".quantity-column").length);
	var tbl = $(".pricing-row:last > td:last-child").clone();
	tbl.appendTo(".pricing-row:last").slideDown(300);
	var last_value = parseInt(tbl.find('input[name=\'quantities[]\']').val());
	if (!isNaN(last_value)) {
		tbl.find('input[name=\'quantities[]\']').val(last_value+parseInt($("#quantity_increment").val()));
	}
	//li.find('input[name=\'price[1][]\']').val(parseFloat(li.find('input[name=\'price[1][]\']').val())-parseFloat($("#price_decrement").val()));
}
function updateNumColors()
{
	var num = $("select[name='max_colors']").val();

	$(".quantity-column-tbody").each(function(index) {
		var current = parseInt($(this).find('tr.price-table-row').length) ;
		var dif = num - current;
		if(dif>0) {
			for(var i=current+1; i<=num; i++) {
				$(this).find('tr.price-table-row:last').clone().appendTo(this).find('input.input-price').attr('name','price['+ i +'][]');
			}
		} else {
			for(var i=current; i>num; i--) {
				$(this).find('tr.price-table-row:last').remove();
			}
		}
	});

	var current = parseInt($(".price-label-row").length) ;
	var dif = num - current;
	if(dif>0) {
		for(var i=current+1; i<=num; i++) {
			$(".price-label-row:last").clone().appendTo($(".label-column-tbody")).html('<td class="text-right pricing-labels"><label class="control-label">' + i +' <?php echo $text_colors; ?></label></td>');
		}
	} else {
		for(var i=current; i>num; i--) {
			$(".price-label-row:last").remove();
		}
	}

}

//--></script>