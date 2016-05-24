<?php
function showCategoriesRecursive($array, $selected) {
	if($array) { ?>
		<ul style="list-style:none;">
		<?php	
		foreach($array as $category) {
			?>
			<li class="category">
			<div class="row">
			<!--<div class="col-sm-1 expand-div"></div>
			<div class="col-sm-10">-->
			<label for="input-<?php echo $category['id_category']; ?>" class="checkbox">
			<input type="checkbox" value="<?php echo $category['id_category']; ?>" <?php if(in_array($category['id_category'],$selected)) { ?> checked="checked" <?php } ?> id="input-<?php echo $category['id_category']; ?>" name="selected_categories[]"/>
			<?php echo $category['description']; ?></label>
			<!--</div>-->
			</div>
			<?php showCategoriesRecursive($category['children'], $selected); ?>
			
			</li>
		<?php
		}
		?>
		</ul>
	<?php
	}
}
?>

<!--
<div class="row">
	<div class="btn-group col-sm-4">
		<a onclick="$('li.category').find('input[type=checkbox]').attr('checked','checked');" class="btn btn-default"><?php echo $text_select_all; ?></a> 
		<a onclick="$('li.category').find('input[type=checkbox]').removeAttr('checked');" class="btn btn-default"><?php echo $text_unselect_all; ?></a> 
	</div>
	<div class="col-sm-8 btn-group" data-toggle="buttons">
		<!--<label for="cat_autoselect" class="btn btn-default active"><?php echo $text_autoselect_parent; ?><input type="checkbox" id="cat_autoselect" checked="checked" autocomplete="off" /></label>
	</div>
</div>
<hr/>
-->
<div>
	<ul>
		<li><?php echo $text_root; ?><br/>
		<?php showCategoriesRecursive($categories, $selected_categories); ?>
		</li>
	</ul>
</div>
<script type="text/javascript"><!--
$(document).ready(function() {	
	/*
    $('li.category > ul').each(function(i) {
        var parent_li = $(this).parent('li');
        var sub_ul = $(this).remove();
        parent_li.find('div.expand-div').append('<a class="btn btn-default btn-xs"><i class="fa fa-plus"></i></a>').find('a').click(function() {
            sub_ul.toggle(300);
			$(this).children('i').toggleClass('fa-plus');
			$(this).children('i').toggleClass('fa-minus');
        }).addClass('expand');
        parent_li.append(sub_ul);
		sub_ul.hide();
	
    });
	*/

    // Hide all lists except the outermost.
    //$('ul.categories ul').hide();
});

function selectCategory(checkbox){
	if( $('#cat_autoselect').is(':checked') ) {
		checkboxChecked = checkbox.is(':checked');
		if ( checkboxChecked ) {
			newChecked = 'checked';
		} else {
			newChecked = '';
		}
		console.log(newChecked);
		checkbox.parents('li.category').find('input[type=checkbox]').attr('checked',newChecked);
	}

}
//--></script> 

