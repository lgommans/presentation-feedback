<?php 
	if (!$included) {
		exit;
	}

	?>
<section style="display: inline-block; width: 320px;">
	<b><?php echo translate('give feedback'); ?></b>
	<form>
		<?php echo translate('Presentation code'); ?><br>
		<input name=code><br>
		<input type=submit value="<?php echo translate('Start'); ?>">
	</form>
</section>
<section style="display: inline-block; width: 320px; float: right; border-left: 1px solid black; padding-left: 55px;">
	<b><?php echo translate('get feedback'); ?></b>
	<form method=post>
		<?php echo translate('Presentation title'); ?><br>
		<input name=title><br>
		<input type=submit value="<?php echo translate('Next'); ?>">
	</form>
</section>

