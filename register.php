<?php 
	if (!$included) {
		exit;
	}
?>
<section style="display: inline-block; width: 710px;">
<?php 
	if (isset($_POST['name'])) {
		$code = bin2hex(openssl_random_pseudo_bytes(3));
		$secret = bin2hex(openssl_random_pseudo_bytes(5));
		$title = $db->escape_string($_POST['title']);
		$speaker = $db->escape_string($_POST['name']);
		$link = $db->escape_string($_POST['link']);
		$time = time();
		$db->query("INSERT INTO presentations (code, secret, datetime, title, speaker, link) VALUES('$code', '$secret', $time, '$title', '$speaker', '$link')") or die(translate('dberr') . '148');

		$id = $db->insert_id;
		$types = [];
		foreach ($_POST['type'] as $type) {
			$types[] = $type;
		}
		$questionNumber = 0;
		foreach ($_POST['question'] as $question) {
			$type = intval($types[$questionNumber]);
			$question = $db->escape_string($question);
			$db->query("INSERT INTO presentation_questions (presentationid, sequenceNumber, question, type) VALUES($id, $questionNumber, '$question', $type)") or die(translate('dberr') . '4184');
			$questionNumber++;
		}

		$publink = "$email_url?code=$code";
		$privlink = "$email_url?secret=$secret";
		$email = sprintf("%s $code<br>%s <a href='$publink'>$publink</a><br><br>%s <a href='$privlink'>$privlink</a>",
			translate('Your audience code:'),
			translate('The direct link:'),
			translate('Results link:'));

		if (!empty($_POST['email'])) {
			// Clean up the database while we're at it
			$db->query('DELETE FROM presentation_maillimit WHERE `datetime` < ' . (time() - (3600 * 24 * 99)))
				or die(translate('dberr') . '14904');

			$addr = substr(hash('sha256', $_POST['email'] . round($time / 60)), 0, 32);
			$db->query("INSERT INTO presentation_maillimit (emailaddress, datetime)
				VALUES('$addr', $time)")
				or die(translate('Error') . ' 51. ' . translate('mailing too fast'));
			if (!mail($_POST['email'], translate('your feedback codes'), $email,
					"Content-Type: text/html\r\nFrom: " . $email_from)) {
				echo translate('failed sending mail');
			}
			else {
				echo translate('mailed copy') . '<br><br>';
			}
		}

		echo nl2br($email);
	}
	else {
		?>
		<style>
			input {
				width: 400px;
			}
		</style>
		<form method=post>
			<b><?php echo translate('info for visitors'); ?></b><br>
			<br>
			<?php echo translate('Presentation title'); ?><br>
			<input name=title value="<?php echo htmlspecialchars($_POST['title']); ?>" maxlength=255><br>
			<br>
			<?php echo translate('Your name'); ?><br>
			<input name=name maxlength=255><br>
			<br>
			<?php echo translate('A link'); ?><br>
			<input name=link maxlength=255 placeholder='https://example.com'><br>
			<br>
			<b><?php echo translate('Questions'); ?></b><br>
			<br>
			<div id="questions"></div>
			<input type=button value='<?php echo translate('Add question'); ?>' onclick='addQuestion();'><br>
			<br>
			<hr>
			<br>
			<?php echo translate('creation info'); ?><br>
			<br>
			<?php echo translate('Email address'); ?><br>
			<input name=email type=email maxlength=255><br>
			<br>
			<input type=submit value='<?php echo translate('Create'); ?>'>
		</form>
		<script>
			function $(q) {
				return document.querySelector(q);
			}
			function addQuestion() {
				qcounter++;
				var question = document.createElement('div');
				question.innerHTML = 'Question ' + qcounter.toString() + '<br><input maxlength=255 name="question[]"><br>'
					+ '<select name="type[]"><option value=1><?php echo translate('Star rating'); ?></option><option value=2><?php echo translate('Text field'); ?></option></select><br><br>';
				$("#questions").appendChild(question);
			}
			qcounter = 0;
			addQuestion();
		</script>
		<?php 
	}
?>
</section>

