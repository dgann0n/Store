<style>
.jscolor_span {
	display: inline-block; 
	width:15px; height:15px; 
	border:solid 1px #333;
}
.jscolor_input {
	width:55px; margin-right:25px;
}
.color_picker_list {
	list-style:none;
	padding:0;
}
</style>
<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-color" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-color" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-data" data-toggle="tab"><?php echo $tab_data; ?></a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-data">
        		<div class="form-group required">
          			<label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
					<div class="col-sm-10">
					<input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
					<?php if ($error_name) { ?>
					<div class="text-danger"><?php echo $error_name; ?></div>
					<?php } ?>
					</div>
				</div>
            	
				<div class="form-group">
              		<label class="col-sm-2 control-label" for="input-num_colors"><?php echo $entry_num_colors; ?></label>
					<div class="col-sm-10">
	          	<?php if ($editable_num_colors) { ?>
					<?php foreach($color_numbers_images as $i=>$image) { ?>
					
						<label class="radio-inline text-center">
							<input type="radio" <?php if($num_colors==$i) { ?> checked="checked" <?php } ?> name="num_colors" value="<?php echo $i; ?>" onclick="setNumColors(<?php echo $i; ?>)"  />
							<?php echo $i; ?><br/>
							<img src="<?php echo $image; ?>" />
						</label>
						
					
					<?php } ?>
				<?php } else { ?>
						<?php echo $num_colors; ?><input type="hidden" name="num_colors" value="<?php echo $num_colors; ?>"  />
						<img src="<?php echo $color_numbers_images[$num_colors]; ?>" />
				<?php } ?>
						<div style="clear:both;"></div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-color_group"><?php echo $entry_color_group; ?></label>
					<div class="col-sm-10">
						<select name="id_product_color_group" id="input-color_group" class="form-control">
						  <?php foreach ($color_groups as $color_group) { ?>
							  <?php if ($color_group['id_product_color_group'] == $id_product_color_group) { ?>
							  <option value="<?php echo $color_group['id_product_color_group']; ?>" selected="selected"><?php echo $color_group['description']; ?></option>
							  <?php } else { ?>
							  <option value="<?php echo $color_group['id_product_color_group']; ?>"><?php echo $color_group['description']; ?></option>
							  <?php } ?>
						  <?php } ?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo $entry_need_white_base; ?></label>
					<div class="col-sm-10">
						<label class="radio-inline">
							<input type="radio" value="1" name="need_white_base" <?php if ($need_white_base == '1') { ?> checked="checked" <?php } ?> class="form-control"/>
							<?php echo $text_yes; ?>
						</label><br/>
						<label class="radio-inline">
							<input type="radio" value="0" name="need_white_base" <?php if ($need_white_base == '0') { ?> checked="checked" <?php } ?> class="form-control" />
							<?php echo $text_no; ?>
						</label>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo $entry_hexa; ?></label>
					<div class="col-sm-10">
						<ul class="color_picker_list">
						</ul>
						<?php if ($error_hexa) { ?>
						<span class="error"><?php echo $error_hexa; ?></span>
						<?php } ?>
					</div>
			  	</div>
				
        </div>
    </div>
	        </form>
      </div>
    </div>
  </div>
<script type="text/javascript"><!--
$('#tabs a').tabs(); 
//--></script> 
<script type="text/javascript"><!--
$(document).ready(function() {	
	<?php foreach ($hexa as $hexa_value) { ?>
	  appendColorPicker('<?php echo $hexa_value; ?>');
  	<?php } ?>

});
function setNumColors(num) {
	var dif = num - $('ul.color_picker_list').children('li').length;
	if(dif<0) {
		for(var i=dif; i<0; i++) {
			removeLastColorPicker();
		}
	} else if(dif>0) {
		for(var i=0; i<dif; i++) {
			appendColorPicker('FFFFFF');
		}
	}
}

function appendColorPicker(value) {
	var i = Math.random()*100000000000000000;
	var html  = '<li>';
		html += 	'<span class="jscolor_span" id="span_hexa_' + i + '"></span> ';
		html += 	'<input class="ui-widget-content ui-corner-all jscolor_input" type="text" name="hexa[]" id="hexa_' + i + '" />';
		html += '</li>';
	$(html).appendTo('ul.color_picker_list');
	
	new jscolor.color(document.getElementById('hexa_'+i), {styleElement:'span_hexa_'+i});
	
	$("#hexa_"+i).val(value);
	$("#span_hexa_"+i).css("backgroundColor", "#"+value); 

}
function removeLastColorPicker() {
	$('ul.color_picker_list li:last-child').remove();
}
//--></script></div>
<?php echo $footer; ?>