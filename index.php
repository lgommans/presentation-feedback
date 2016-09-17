<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'/>
		<title>Presentation Feedback Tool</title>
	</head>
	<body style="margin: 0 auto 0 auto; width: 720px; margin-top: 100px;">
		<?php 
			$included = true;
			if (isset($_POST['title']) || isset($_GET['code']) || isset($_GET['secret'])) {
				require('config.php');
				require('dbsetup.php');
			}

			if (isset($_POST['title'])) {
				require('register.php');
			}
			else if (isset($_GET['code'])) {
				require('feedback.php');
			}
			else if (isset($_GET['secret'])) {
				require('results.php');
			}
			else {
				require('frontpage.php');
			}
		?>
		<footer style="display: block; margin-top: 125px; margin-bottom: 75px; color: #555;">
			This website is
			<a style="color: #555;" href="https://github.com/lgommans/presentation-feedback">free software.</a>
		</footer>
	</body>
</html>
