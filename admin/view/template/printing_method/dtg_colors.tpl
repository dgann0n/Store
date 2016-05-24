<div class="alert alert-warning"><?php echo $text_help_colors; ?></div>
<div class="table-responsive">
<style>
.color-box {
	display:block;
	width:20px;
	height:20px;
	border:solid 1px #cccccc;
}
</style>
<table class="table table-bordered table-hover">
  <thead>
	<tr>
	  <td class="text-center"><input type="checkbox" onclick="$('input[name*=\'data[dtg_colors]\']').attr('checked', this.checked);" /></td>
	  <?php /*<td width="300" class="right"><?php echo $column_id_design_color; ?></td>*/?>
	  <td class="text-left"><?php echo $column_name; ?></td>
	  <td class="text-left"><?php echo $column_code; ?></td>
	  <td class="text-left"><?php echo $column_hexa; ?></td>
	  <td class="text-left"><?php echo $column_need_white_base; ?></td>
	  <td class="text-left"><?php echo $column_status; ?></td>
	</tr>
  </thead>
  <tbody>
	<?php if (!$colors) { ?>
	<tr>
	  <td class="text-center" colspan="5"><?php echo $text_no_results; ?></td>
	</tr>
	<?php } else { ?>
		<?php foreach ($colors as $color) { ?>
		<tr>
			<td class="text-center">
			<?php if (!$color['isdefault']) { ?>
				<?php if ($color['selected']) { ?>
				<input type="checkbox" name="data[dtg_colors][]" value="<?php echo $color['id_design_color']; ?>" checked="checked" class="form-control" />
				<?php } else { ?>
				<input type="checkbox" name="data[dtg_colors][]" value="<?php echo $color['id_design_color']; ?>" class="form-control" />
				<?php } ?>
			<?php } ?>
			</td>
			<?php /*<td width="300" class="right"><?php echo $color['id_design_color']; ?></td> */?>
			<td><?php if ($color['isdefault']) { ?><?php echo $text_default; ?> <?php } ?><?php echo $color['name']; ?></td>
			<td class="text-left"><?php echo $color['code']; ?></td>
			<td class="text-center"><span title="<?php echo $color['hexa']; ?>" class="color-box" style="background: #<?php echo $color['hexa']; ?>">&nbsp;</span></td>
			<td class="text-left"><?php echo $color['need_white_base']; ?></td>
			<td class="text-left"><?php echo $color['status']; ?></td>
		</tr>
		<?php } ?>
	<?php } ?>
  </tbody>
</table>
</div>
