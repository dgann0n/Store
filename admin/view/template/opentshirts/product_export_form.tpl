<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <!--<div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="submit" form="form-product" formaction="<?php echo $copy; ?>" data-toggle="tooltip" title="<?php echo $button_copy; ?>" class="btn btn-default"><i class="fa fa-copy"></i></button>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-product').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>-->
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <div class="alert alert-warning"><i class="fa fa-exclamation-circle"></i> <?php echo $text_backup_warning; ?>
    </div>
	
	
	<div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-upload"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
	  	<div class="col-sm-8">
			<div>
				<input id="upload" name="upload" type="file" />
			</div>
			<br/>
			<div id="loading" class="well text-center" style="display:none;">
				<i class="fa fa-spinner fa-spin fa-4x"></i><br/><?php echo $text_wait; ?>
			</div>
			<div id="notification" class="alert" style="display:none;"><i class="fa"></i> <span id="message"></span>
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			</div>
		
		  </div>
		  <div class="col-sm-4">
		  	<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<td></td>
							<td><?php echo $column_current; ?></td>
							<td><?php echo $column_minimum; ?></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo $text_upload_max_filesize; ?></td>
							<td><?php echo ini_get('upload_max_filesize'); ?></td>
							<td>64M</td>
						</tr>
						<tr>
							<td><?php echo $text_post_max_size; ?></td>
							<td><?php echo ini_get('post_max_size'); ?></td>
							<td>64M</td>
						</tr>
						<tr>
							<td><?php echo $text_memory_limit; ?></td>
							<td><?php echo ini_get('memory_limit'); ?></td>
							<td>64M</td>
						</tr>
						<tr>
							<td><?php echo $text_max_execution_time; ?></td>
							<td><?php echo ini_get('max_execution_time'); ?></td>
							<td>18000</td>
						</tr>
						<tr><td colspan="3"><?php echo $text_php_modify; ?></td></tr>
					</tbody>
			  </table>
			</div>
		</div>
		  
	  </div>
    </div>
  </div>
<script type="text/javascript">
$(document).ready(function() {
	
	 $('#upload').uploadify({
		'uploader'  : 'view/javascript/uploadify/uploadify.swf',
		'script'    : 'index.php?route=opentshirts/product_export/import&token=<?php echo $token; ?>',
		'cancelImg' : 'view/javascript/uploadify/cancel.png',
		'scriptData'  : {session_id: "<?php echo session_id(); ?>"},
		'buttonText': '<?php echo $button_upload; ?>',
		'auto'      : true,
		'method'      : 'POST',
		'fileExt'     : '*.zip;',
		'fileDesc'    : 'Zip Files',
		'onComplete'  : function(event, ID, fileObj, response, data) {
		 	$('#message').text(response)
			$('#notification').addClass('alert-success').show();
			$('#notification i').addClass('fa-check-circle');
			$('#loading').hide();
		},
		'onSelectOnce'  : function(event, data) {
			$('#loading').show();
			$('#notification').hide().removeClass('alert-danger').removeClass('alert-success');
			$('#notification i').removeClass('fa-exclamation-circle').removeClass('fa-check-circle');
		},
		'onCancel'  : function(event, ID, fileObj, data, remove, clearFast) {
			$('#loading').hide();
		},
		'onError'     : function (event,ID,fileObj,errorObj) {
			$('#message').text(errorObj.type + ' Error: ' + errorObj.info);
			$('#notification').addClass('alert-danger');
			$('#notification i').addClass('fa-exclamation');
			$('#notification').show();
			$('#loading').hide();
		}
		
		
	});
});

</script></div>
<?php echo $footer; ?>