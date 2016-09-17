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
		$db->query("INSERT INTO presentations (code, secret, datetime, title, speaker, link) VALUES('$code', '$secret', $time, '$title', '$speaker', '$link')") or die('Database error 148');

		$id = $db->insert_id;
		$types = [];
		foreach ($_POST['type'] as $type) {
			$types[] = $type;
		}
		$questionNumber = 0;
		foreach ($_POST['question'] as $question) {
			$type = intval($types[$questionNumber]);
			$question = $db->escape_string($question);
			$db->query("INSERT INTO presentation_questions (presentationid, sequenceNumber, question, type) VALUES($id, $questionNumber, '$question', $type)") or die('Database error 4184');
			$questionNumber++;
		}

		$publink = "$email_url?code=$code";
		$privlink = "$email_url?secret=$secret";
		$email = "Your audience code: $code<br>The direct link: <a href='$publink'>$publink</a><br><br>"
			. "Your private link to view the results: <a href='$privlink'>$privlink</a>";

		if (!empty($_POST['email'])) {
			$addr = md5($_POST['email'] . round($time / 60));
			$t = time();
			$db->query("INSERT INTO presentation_maillimit (emailaddress, datetime)
				VALUES('$addr', $t)")
				or die('Error 51. Did you email to this address within the last minute? If so, try again in a minute.');
			if (!mail($_POST['email'], 'Your presentation feedback codes', $email,
					"Content-Type: text/html\r\nFrom: " . $email_from)) {
				echo "Sending the email failed.";
			}
			else {
				echo 'A copy of this page has been emailed to you.<br><br>';
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
			<b>Information to show visitors</b><br>
			<br>
			Presentation title<br>
			<input name=title value="<?php echo htmlspecialchars($_POST['title']); ?>" maxlength=255><br>
			<br>
			Your name<br>
			<input name=name maxlength=255><br>
			<br>
			A link, e.g. your website or Twitter account<br>
			<input name=link maxlength=255><br>
			<br>
			<b>Questions</b><br>
			<br>
			<div id="questions"></div>
			<input type=button value='Add question' onclick='addQuestion();'><br>
			<br>
			<hr>
			<br>
			After clicking 'create', you will be given a public code (to give your audience, valid for 2 weeks) and a private code (to view the results).
			If you want to email these to yourself, enter your email address here (optional). The address will be used once and is not stored.<br>
			<br>
			Email address<br>
			<input name=email type=email maxlength=255><br>
			<br>
			<input type=submit value=Create>
		<script>
			function $(q) {
				return document.querySelector(q);
			}
			function addQuestion() {
				qcounter++;
				var question = document.createElement('div');
				question.innerHTML = 'Question ' + qcounter.toString() + '<br><input maxlength=255 name="question[]"><br>'
					+ '<select name="type[]"><option value=1>Star rating</option><option value=2>Text field</option></select><br><br>';
				$("#questions").appendChild(question);
			}
			qcounter = 0;
			addQuestion();
		</script>
		<?php 
	}
?>
</section>

