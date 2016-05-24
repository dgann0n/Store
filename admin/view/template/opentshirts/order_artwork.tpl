<?php if(!empty($comps)) { ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-tint"></i> <?php echo $text_artwork; ?></h3>
		</div>
		<div class="panel-body">

			<?php $i = 1; ?>
			<ul class="nav nav-tabs" role="tablist">
			<?php foreach ($comps as $comp) : ?>
				<li role="presentation"<?php echo $i == 1 ? ' class="active"' : ''; ?>><a href="#art-tab-<?php echo $i; ?>" aria-controls="art-tab-<?php echo $i; ?>" role="tab" data-toggle="tab"><?php echo $comp['name']; ?></a></li>
				<?php $i++; ?>
			<?php endforeach; ?>
			</ul>

			<div class="tab-content">
				<?php $i = 1; ?>
				<?php foreach ($comps as $comp) : ?>
				<div role="tabpanel" class="tab-pane<?php echo $i == 1 ? ' active' : ''; ?>" id="art-tab-<?php echo $i; ?>">
					<h3><?php echo $comp['name']; ?></h3>
					<h4><a href="<?php echo $comp['product']['link']; ?>"><?php echo $comp['product']['name']; ?></a></h4>
					<div class="row">
					<div>
						<?php foreach ($comp['designs'] as $design) : ?>
						<div class="col-sm-4">
							<div class="well">
								<a href="<?php echo $design['images']['original']; ?>" target="_new"><img class="img-responsive" src="<?php echo $design['images']['large']; ?>" /></a><br />
								<a href="<?php echo $design['images']['png']; ?>" target="_new"><?php echo $text_png; ?></a>
							</div>
						<?php if(!empty($design['design_elements'])) : ?>
							<table class="table table-bordered">
								<tbody>
							<?php echo $text_assets; ?>
								<?php foreach ($design['design_elements'] as $design_element) : ?>
									<?php $e = 1; ?>
									<?php foreach ($design_element['source'] as $source) : ?>
									<tr>
									<td>
									<?php if ( $e == 1 ) { ?>
									<strong><?php echo $source['element_name']; ?></strong>
									<?php } ?>
									</td>
									<td>
									<a href="<?php echo $source['link']; ?>" target="_blank"><?php echo $source['description']; ?></a>
									</td>
									<?php $e++; ?>
									<?php endforeach; ?>
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
						<?php endif; ?>
						</div>
						<?php endforeach; ?>
					</div>
					</div>
				</div>
				<?php $i++; ?>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
<?php } ?>