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
		<style>
		.jscolor_span {
		display: inline-block; 
		width:75px; height:25px; 
		border:solid 1px #333;
		}
		.jscolor_input {
		width:85px; margin-right:25px;
		}
		.color_picker_list {
		list-style:none;
		padding:0;
		}
		</style>

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
          			<label class="col-sm-2 control-label" for="input-code"><?php echo $entry_code; ?></label>
					<div class="col-sm-10">
						<input type="text" name="code" value="<?php echo $code; ?>" placeholder="<?php echo $entry_code; ?>" id="input-code" class="form-control" />
						<?php if ($error_name) { ?>
						<div class="text-danger"><?php echo $error_code; ?></div>
						<?php } ?>
					</div>
				</div>
			
				<div class="form-group">
          			<label class="col-sm-2 control-label" for="input-code"><?php echo $entry_status; ?></label>
					<div class="col-sm-10">
						<select id="input-status" name="status" class="form-control">
							<?php foreach ($statuses as $item) { ?>
							<?php if ($item['val'] === $status) { ?>
							<option value="<?php echo $item['val']; ?>" selected="selected"><?php echo $item['description']; ?></option>
							<?php } else { ?>
							<option value="<?php echo $item['val']; ?>"><?php echo $item['description']; ?></option>
							<?php } ?>
							<?php } ?>
						</select>
						<?php if ($error_status) { ?>
						<span class="error"><?php echo $error_status; ?></span>
						<?php } ?>
					</div>
				</div>
				
				<div class="form-group">
          			<label class="col-sm-2 control-label"><?php echo $entry_need_white_base; ?></label>
					<div class="col-sm-10">
						<label class="radio-inline">
							<input type="radio" value="1" name="need_white_base" <?php if ($need_white_base == '1') { ?> checked="checked" <?php } ?>><?php echo $text_yes; ?>
						</label><br/>
						<label class="radio-inline">
							<input type="radio" value="0" name="need_white_base" <?php if ($need_white_base == '0') { ?> checked="checked" <?php } ?>><?php echo $text_no; ?>
						</label>
					</div>
				</div>
				
				<div class="form-group">
          			<label class="col-sm-2 control-label" for="hexa"><?php echo $entry_hexa; ?></label>
					<div class="col-sm-10">
						<span class="jscolor_span" id="span_hexa"></span><input class="jscolor_input form-control" type="text" name="hexa" id="hexa" value="<?php echo $hexa; ?>" />
						
						<?php if ($error_hexa) { ?>
						<div class="text-danger"><?php echo $error_hexa; ?></div>
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
$(document).ready(function() {	
	
	
	new jscolor.color(document.getElementById('hexa'), {styleElement:'span_hexa'});
	
	//$("#hexa").val(value);
	//$("#span_hexa").css("backgroundColor", "#"+value); 

});
//--></script> 
</div>
<?php echo $footer; ?>