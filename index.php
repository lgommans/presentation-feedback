<?php
	$included = true;
	require('config.php');
	require('translation.php');

	if (isset($_GET['code'])) {
		// Someone is giving feedback
		$title = translate('Feedback') . ' :: ';
		$state = 1;
	}
	else if (isset($_GET['secret'])) {
		// The presentation owner is viewing the results
		$title = translate('Results') . ' :: ';
		$state = 2;
	}
	else if (isset($_POST['title'])) {
		// A new presentation is being created
		$title = translate('Create') . ' :: ';
		$state = 3;
	}
	else {
		$title = '';
		$state = 0;
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'/>
		<title><?php echo $title . translate('projtitle'); ?></title>
	</head>
	<body style="margin: 0 auto 0 auto; width: 720px; margin-top: 100px;">
		<?php 
			if ($state > 0) {
				require('dbsetup.php');
			}

			if ($state == 3) {
				require('register.php');
			}
			else if ($state == 1) {
				require('feedback.php');
			}
			else if ($state == 2) {
				require('results.php');
			}
			else {
				require('frontpage.php');
			}
		?>
		<footer style="display: block; margin-top: 125px; margin-bottom: 75px; color: #555;">
			<?php echo translate('this site is'); ?>
			<a style="color: #555;" href="<?php echo $repo_url; ?>"><?php echo translate('free software'); ?>.</a>
		</footer>
	</body>
</html>

