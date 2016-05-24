<style type="text/css">
#upcharge_list {
	list-style:none;
	margin:0;
}
#matrix_list {
	list-style:none;
	margin:0;
}
#matrix_list li {
	float:left;
	width:80px;
	cursor:move;
}
#matrix_list li div {
	line-height:25px;
}

#product-pricing .input-price {
	margin:2px 0;
	width:65px;
	display:inline;
}
#product-pricing .quantity-column {
	min-width:125px;
}

#product-pricing .pricing-labels {
	height:39px;
}
</style>
<?php if ($error_quantities) { ?>
<div class="text-danger"><?php echo $error_quantities; ?></div>
<?php } ?>
<?php if ($error_price) { ?>
<div class="text-danger"><?php echo $error_price; ?></div>
<?php } ?>


<div class="form-group">

	<div class="col-sm-2">
		<a onclick="addColumnNew()" class="btn btn-primary"><i class="fa fa-plus"></i> <?php echo $text_add_quantity; ?></a>
	</div>
	<div class="col-sm-10">
		<label for="quantity_increment"><?php echo $text_increment; ?></label>
		<input type="text" id="quantity_increment" value="12" class="form-control" style="width:75px;"/>
	</div>
</div>

<div class="table-responsive">
	<table id="product-pricing" class="table table-striped table-bordered">
		<thead>
			<tr><td id="pricing-header" colspan="2"><h3><?php echo $text_matrix; ?></h3></td></tr>
		</thead>
		<tbody>
			<tr id="pricing-row">
				<td style="width:150px; min-width:150px;">
					<table>
						<tr><td class="text-right pricing-labels"><label class="control-label"><?php echo $text_minimum_quantity; ?></label></td></tr>
						<?php foreach($color_groups as $color_group) { ?>
						<tr>
							<td class="text-right pricing-labels"><label class="control-label"><?php echo $color_group["description"]; ?></label></td>
						</tr>
						<?php } ?>
						
					</table>
				</td>
				<?php if($quantities) : ?>
				<script>$(document).ready(function(e) {
				resizeMatrixHeader();
				});
				</script>
				<?php foreach($quantities as $index=>$quantity) : ?>
				<td class="quantity-column">
					<table>
						<tr>
							<td>
								<input type="text" name="quantities[]" value="<?php echo $quantity; ?>" title="quantity" class="form-control input-price" /><a class="btn btn-default" onclick="removeClick($(this).parents('.quantity-column'));"><i class="fa fa-close"></i></a>
							</td>
						</tr>
						
				
				<?php foreach($color_groups as $color_group) : ?>
						<tr>
							<td>
					<div style="background-color:#<?php echo $color_group["color"]?>; white-space:nowrap;"><?php echo $symbol_left; ?> <input type="text" name="price[<?php echo $color_group["id_product_color_group"]; ?>][]" value="<?php echo $price[$color_group["id_product_color_group"]][$index]; ?>" class="form-control input-price" /> <?php echo $symbol_right; ?></div>
							</td>
						</tr>
				<?php endforeach; ?>
					</table>
				</td>
				<?php endforeach; ?>
				<?php else : ?>
				<td class="quantity-column">
					<table>
						<tr>
							<td>
								<input type="text" name="quantities[]" value="0" title="quantity" class="form-control input-price"/><a class="btn btn-default" onclick="removeClick($(this).parents('.quantity-column'));"><i class="fa fa-close"></i></a>
							</td>
						</tr>
						<?php foreach($color_groups as $color_group) : ?>
						<tr>
							<td>
			<div style="background-color:#<?php echo $color_group["color"]?>; white-space:nowrap;"><?php echo $symbol_left; ?> <input type="text" name="price[<?php echo $color_group["id_product_color_group"]; ?>][]" value="0" class="form-control input-price" /> <?php echo $symbol_right; ?></div>
							</td>
						</tr>
						<?php endforeach; ?>
					</table>
				</td>
				<?php endif; ?>
			</tr>
		</tbody>
	</table>
</div>



	<div class="table-responsive">
		<table id="product-pricing" class="table table-striped table-bordered">
			<thead>
				<tr><td colspan="2"><h3><?php echo $text_upcharge; ?></h3></td></tr>
				<?php if ($error_upcharge) { ?>
				<tr><td colspan="2"><div class="text-danger"><?php echo $error_upcharge; ?></div></td></tr>
				<?php } ?>
			</thead>
			<tbody>
				<?php foreach($sizes_upcharge as $size) : ?>
				<tr>
					<td style="width:75px;" class="text-right"><label class="control-label"><?php echo $size['initials']; ?>:</label></td>
					<td><?php echo $symbol_left; ?> <input type="text" style="width:50px;" data="upcharge" name="upcharge[<?php echo $size["id_product_size"]; ?>]" value="<?php echo isset($upcharge[$size["id_product_size"]]) ? $upcharge[$size["id_product_size"]] :'0'; ?>" class="form-control input-price"/> <?php echo $symbol_right; ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>

<script type="text/javascript"><!--
function resizeMatrixHeader(){
	var colsize = $('.quantity-column').length + 1;
	$('#pricing-header').attr('colspan',colsize);
}

function removeClick(td)
{
	if($(".quantity-column").length > 1) {
		td.remove();
		resizeMatrixHeader();
	}
}
function addColumnNew()
{
	var tbl = $("#pricing-row > td:last-child").clone();
	tbl.appendTo("#pricing-row").slideDown(300);
	var last_value = parseInt(tbl.find('input[name=\'quantities[]\']').val());
	if (!isNaN(last_value)) {
		tbl.find('input[name=\'quantities[]\']').val(last_value+parseInt($("#quantity_increment").val()));
	}
	resizeMatrixHeader();
	//li.find('input[name=\'price[1][]\']').val(parseFloat(li.find('input[name=\'price[1][]\']').val())-parseFloat($("#price_decrement").val()));	
}

function addColumn()
{
	var li = $("#matrix_list > li:last-child").clone();
	li.appendTo("#matrix_list").slideDown(300);
	var last_value = parseInt(li.find('input[name=\'quantities[]\']').val());
	if (!isNaN(last_value)) {
		li.find('input[name=\'quantities[]\']').val(last_value+parseInt($("#quantity_increment").val()));
	}
	//li.find('input[name=\'price[1][]\']').val(parseFloat(li.find('input[name=\'price[1][]\']').val())-parseFloat($("#price_decrement").val()));
}
$(document).ready(function() {	
	if($( "#product-pricing" ).children().length==0)
	{
		addColumn();
		addColumn();
		addColumn();
	}
});
//--></script> 

