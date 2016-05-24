<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-data" data-toggle="tab"><?php echo $tab_data; ?></a></li>
			<?php foreach ( $extra_tabs as $extra_tab ) { ?>
			<li><a href="#<?php echo $extra_tab['id']; ?>" data-toggle="tab"><?php echo $extra_tab['label']; ?></a></li>
			<?php } ?>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-data">
				<div class="form-group required">
					<label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
					<div class="col-sm-10">
						<input type="text" name="name" id="input-name" value="<?php echo $name; ?>" class="form-control" />
						<?php if ($error_name) { ?>
						<div class="text-danger"><?php echo $error_name; ?></div>
						<?php } ?>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
					<div class="col-sm-10">
						<select id="input-status" name="status" class="form-control">
							<?php foreach ($statuses as $item) : ?>
							<?php if ($item['val'] === $status) : ?>
							<option value="<?php echo $item['val']; ?>" selected="selected"><?php echo $item['description']; ?></option>
							<?php else : ?>
							<option value="<?php echo $item['val']; ?>"><?php echo $item['description']; ?></option>
							<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-keywords"><?php echo $entry_keywords; ?></label>
					<div class="col-sm-10">
						<input id="input-keywords" name="keywords" type="text" value="<?php echo $keywords; ?>" class="form-control" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo $entry_image; ?></label>
					<div class="col-sm-10">
						<img id="thumb" src="<?php echo $thumb; ?>" class="thumbnail" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo $entry_ttf_file; ?></label>
					<div class="col-sm-10">
						<span id="text_ttf_file"><?php echo $ttf_file; ?></span>
						<input type="hidden" name="ttf_file" id="ttf_file" value="<?php echo $ttf_file; ?>" /><br />
			    		<input id="ttf_file_upload" name="ttf_file_upload" type="file" />
						<?php if ($error_ttf_file) { ?>
						<div class="text-danger"><?php echo $error_ttf_file; ?></div>
						<?php } ?>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo $entry_swf_file; ?></label>
					<div class="col-sm-10">
						<span id="text_swf_file"><?php echo $swf_file; ?></span>
						<input type="hidden" name="swf_file" id="swf_file" value="<?php echo $swf_file; ?>" /><br />
						<input id="swf_file_upload" name="swf_file_upload" type="file" /></a>
						<?php if ($error_swf_file) { ?>
						<div class="text-danger"><?php echo $error_swf_file; ?></div>
						<?php } ?>
					</div>
				</div>	
			</div>
			
        <?php foreach ( $extra_tabs as $extra_tab ) { ?>
			<div class="tab-pane" id="<?php echo $extra_tab['id']; ?>">
				<?php echo $extra_tab['content']; ?>
			</div>
			<?php } ?>
       </div>
      </form>
    </div>
  </div>
</div>


<script type="text/javascript">
$(document).ready(function() {
	 $('#ttf_file_upload').uploadify({
		'uploader'  : 'view/javascript/uploadify/uploadify.swf',
		'script'    : 'index.php?route=font/font/upload_ttf&token=<?php echo $token; ?>',
		'cancelImg' : 'view/javascript/uploadify/cancel.png',
		'scriptData'  : {session_id: "<?php echo session_id(); ?>"},
		'buttonText': '<?php echo $button_upload; ?>',
		'auto'      : true,
		'fileDataName' : 'file',
		'method'      : 'POST',
		'fileExt'     : '*.ttf;*.otf;',
		'fileDesc'    : 'Font Files',
		'onComplete'  : function(event, ID, fileObj, response, data) {
			var obj = jQuery.parseJSON( response );
			if(!obj.error) {
				$('#ttf_file').val(obj.filename);
				$('#text_ttf_file').text(obj.filename);
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
		'script'    : 'index.php?route=font/font/upload_swf&token=<?php echo $token; ?>',
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
</div>
<?php echo $footer; ?>