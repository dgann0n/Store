<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="page-header">
		<div class="container-fluid">
			<div class="pull-right">
				<a href="<?php echo $link_autoselect; ?>" title="<?php echo $button_autoselect; ?>" class="btn btn-primary"><?php echo $button_autoselect; ?></a>
			</div>
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
		<div class="alert alert-danger">
			<i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
			<button type="button" class="close" data-dismiss="alert">&times;</button>
		</div>
		<?php } ?>
		<?php if ($success) { ?>
		<div class="alert alert-success">
			<i class="fa fa-check-circle"></i> <?php echo $success; ?>
			<button type="button" class="close" data-dismiss="alert">&times;</button>
		</div>
		<?php } ?>
	
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<td class="text-left"><?php echo $column_name; ?></td>
								<td class="text-left"><?php echo $column_status; ?></td>
								<td class="text-right"><?php echo $column_sort_order; ?></td>
								<td class="text-right"><?php echo $column_action; ?></td>
							</tr>
						</thead>
						<tbody>
						<?php if ($extensions) { ?>
						<?php foreach ($extensions as $extension) { ?>
						<tr>
							<td class="text-left"><?php echo $extension['name']; ?></td>
							<td class="text-left"><?php echo $extension['status'] ?></td>
							<td class="text-right"><?php echo $extension['sort_order']; ?></td>
							<td class="text-right">
								<div class="btn-group">
								<?php foreach ($extension['action'] as $action) { ?>
								<a href="<?php echo $action['href']; ?>" class="btn btn-primary"><?php echo $action['text']; ?></a>
								<?php } ?>
								</div>
							</td>
						</tr>
						<?php } ?>
						<?php } else { ?>
						<tr>
							<td class="text-center" colspan="5"><?php echo $text_no_results; ?></td>
						</tr>
						<?php } ?>
					</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo $footer; ?>