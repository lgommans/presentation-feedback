<?php 
	if (!$included) {
		exit;
	}

	?>
<section style="display: inline-block; width: 320px;">
	<b>Give feedback on a presentation</b>
	<form>
		Presentation code<br>
		<input name=code><br>
		<input type=submit value=Start>
	</form>
</section>
<section style="display: inline-block; width: 320px; float: right; border-left: 1px solid black; padding-left: 55px;">
	<b>Get feedback on your presentation</b>
	<form method=post>
		Presentation title<br>
		<input name=title><br>
		<input type=submit value=Next>
	</form>
</section>

