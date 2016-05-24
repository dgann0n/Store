<style>
#matrix_list .input-price {
	margin:2px 0;
	width:65px;
	display:inline;
}
#matrix_list .quantity-column {
	min-width:225px;
}

#matrix_list .pricing-labels {
	height:36px;
}
</style>

	
	<?php if ($error_quantities) { ?>
	<div class="text-danger"><?php echo $error_quantities; ?></div>
	<?php } ?>
	<?php if ($error_price) { ?>
	<div class="text-danger"><?php echo $error_price; ?></div>
	<?php } ?>
	
	<div class="well">
		<div class="row">
			<div class="col-sm-5">
				<div class="form-group"> 
					<label class="col-sm-3 control-label" for="quantity_increment"><?php echo $text_increment; ?></label>
					<div class="col-sm-3">
						<input type="text" id="quantity_increment" value="12" style="width:55px;" class="form-control" />
				<?php //echo $text_decrement; ?><!-- <input type="text" id="price_decrement" value="2.5"  /><br /> -->
					</div>
					<div class="col-sm-6">
						<a class="btn btn-primary" onclick="addColumn()"><?php echo $text_add_quantity; ?></a>
					</div>
				</div>

			</div>
			
			<div class="col-sm-5">
				<div class="form-group">
					<label class="col-sm-3 control-label" for="input-area_size"><?php echo $text_areas; ?></label>
					<div class="col-sm-4">
						<input type="text" id="input-area_size" name="area_size" class="form-control" value="" style="width:65px; display:inline;"/> <?php echo $length_unit; ?><sup>2</sup>
					</div>
					<div class="col-sm-5">
					<a class="btn btn-primary" onclick="addRow($('#input-area_size').val())"><?php echo $text_add_area; ?></a>
					</div>
				</div>
				<div class="text-center">
					<span style="font-size: .8em"><?php echo $text_sort; ?></span>
				</div>
			</div>
		</div>
	</div>
	
	<div class="table-responsive">
	<table id="matrix_list" class="table table-striped table-bordered">
		<tbody>
			<tr class="pricing-row">
				<td style="width:150px; min-width:150px;" id="label-column">
					<table>
						<tbody class="label-column-tbody">
							<tr><td class="text-right pricing-labels"><label class="control-label"><?php echo $text_minimum_quantity; ?></label></td></tr>
							<tr><td>&nbsp;</td></tr>
							
							<?php foreach($areas as $area) { ?>
							<tr class="price-label-row row-<?php echo $area; ?>"><td class="text-right pricing-labels">
							<label class="control-label">
								<?php if($area>0) { ?>
								<a onclick="$('.row-<?php echo $area; ?>').remove();" class="btn btn-danger btn-xs"><i class="fa fa-close"></i></a>
								<?php } ?>
								<?php echo $text_areas; ?> <?php echo $area; ?> <?php echo $length_unit; ?><sup>2</sup>
							</label>
							</td></tr>
	                         
							<?php } ?>
							
							
						</tbody>
					</table>
				</td>
				<?php if($quantities) : ?>
				<?php foreach($quantities as $index=>$quantity) : ?>
				<td class="quantity-column">
					<table>
						<tbody class="quantity-column-tbody">
							<tr><td colspan="3">
								<input type="text" name="quantities[]" value="<?php echo $quantity; ?>" title="quantity" class="form-control input-price" /> <a class="btn btn-danger btn-xs" role="button" onclick="removeClick($(this).parents('.quantity-column'));"><i class="fa fa-close"></i></a>
							</td></tr>
							<tr><td class="text-center">*</td><td class="text-center">**</td><td class="text-center">***</td></tr>
							<?php foreach($price as $area=>$array_quantity) : ?>
							<tr class="price-table-row row-<?php echo $area; ?>">
								<td><div class="price"><?php echo $symbol_left; ?> <input type="text" name="price[<?php echo $area; ?>][]" value="<?php echo $price[$area][$index]; ?>" class="form-control input-price" /> <?php echo $symbol_right; ?></div></td>
								<td><div class="price_1"><?php echo $symbol_left; ?> <input type="text" name="price_1[<?php echo $area; ?>][]" value="<?php echo $price_1[$area][$index]; ?>" class="form-control input-price" /> <?php echo $symbol_right; ?></div></td>
								<td><div class="price_2"><?php echo $symbol_left; ?> <input type="text" name="price_2[<?php echo $area; ?>][]" value="<?php echo $price_2[$area][$index]; ?>" class="form-control input-price" /> <?php echo $symbol_right; ?></div></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</td>
				<?php endforeach; ?>
				<?php else : ?>
				<td class="quantity-column">
					<table>
						<tbody class="quantity-column-tbody">
							<tr><td>
								<input type="text" name="quantities[]" value="0" title="quantity" class="form-control input-price" /> <a class="btn btn-default btn-xs" onclick="removeClick($(this).parents('.quantity-column'));"><i class="fa fa-close"></i></a>
							</td></tr>
							<tr><td class="text-center">*</td><td class="text-center">**</td><td class="text-center">***</td></tr>
							<?php foreach($price as $area=>$array_quantity) : ?>
							<tr class="price-table-row row-<?php echo $area; ?>">
								<td><div class="price"><?php echo $symbol_left; ?> <input type="text" name="price[<?php echo $area; ?>][]" value="0" class="form-control input-price" /> <?php echo $symbol_right; ?></div></td>
								<td><div class="price_1"><?php echo $symbol_left; ?> <input type="text" name="price_1[<?php echo $area; ?>][]" value="0" class="form-control input-price" /> <?php echo $symbol_right; ?></div></td>
								<td><div class="price_2"><?php echo $symbol_left; ?> <input type="text" name="price_2[<?php echo $area; ?>][]" value="0" class="form-control input-price" /> <?php echo $symbol_right; ?></div></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</td>
				<?php endif; ?>
			</tr>
		</tbody>
	</table>
    </div>
	
	<div class="alert alert-warning">
		<div class="list-group">
			<div class="list-group-item">* <?php echo $text_no_whitebase; ?></div>
			<div class="list-group-item">** <?php echo $text_whitebase_1; ?></div>
			<div class="list-group-item">*** <?php echo $text_whitebase_2; ?></div>
		</div>
	</div>
	
	
	<div id="dialog_error_row" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="<?php echo $button_close; ?>"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="error-dialog-label"><?php echo $text_error_dialog_label; ?></h4>
				</h4>
				</div>
				<div class="modal-body">
					<div class="alert alert-danger" id="error_text"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $button_close; ?></button>
				</div>
			</div>
		</div>
	</div>

<script type="text/javascript"><!--
function removeClick(td)
{
	if($(".quantity-column").length > 1) {
		td.slideUp(300, function() {
			$(this).remove();
		});
	} else {
		$('#error_text').html('<?php echo $text_error_remove_column; ?>');
        $('#dialog_error_row').modal('show');
        return;
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
}

function addRow(area) {
    if(area=="" || !validFloat(area)) {
		$('#error_text').html('<?php echo $text_error_row; ?>');
        $('#dialog_error_row').modal('show');
        return;
    }
	
	$(".quantity-column-tbody").each(function(index) {	
		var new_col = $(this).find('tr.price-table-row:last').clone();
		new_col.appendTo(this);
		new_col.attr('class','').addClass('price-table-row').addClass('row-'+area);
		new_col.find('div.price input.input-price').attr('name','price['+ area +'][]');
		new_col.find('div.price_1 input.input-price').attr('name','price_1['+ area +'][]');
		new_col.find('div.price_2 input.input-price').attr('name','price_2['+ area +'][]');
	});
	
	var row_html = '<tr class="price-label-row row-' + area + '"><td class="text-right pricing-labels">';
	row_html += '<label class="control-label">';
	row_html += '<a onclick="$(\'.row-' + area + '\').remove();" class="btn btn-danger btn-xs"><i class="fa fa-close"></i></a> ';
	row_html += '<?php echo $text_areas; ?> ' + area + ' <?php echo $length_unit; ?><sup>2</sup>';
	row_html += '</label></td></tr>';


	var new_div = $(row_html);
    new_div.appendTo($(".label-column-tbody"));	
}
function validFloat(number)
{
    return (/^([0-9])*[.]?[0-9]*$/.test(number));
}

//--></script> 