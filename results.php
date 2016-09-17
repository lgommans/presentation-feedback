<?php 
	if (!$included) {
		exit;
	}
?>
<section style="display: inline-block; width: 710px;">
	<style>
		h1 {
			font-size: 18pt;
			margin: 0;
		}
		.star {
			font-size: 14pt;
		}
	</style>
<?php 
	$result = $db->query('SELECT p.id, p.title, p.speaker, p.link, COUNT(pq.id)
		FROM presentations p
		INNER JOIN presentation_questions pq ON pq.presentationid = p.id
		WHERE secret = "' . $db->escape_string($_GET['secret']) . '"')
		or die('Database error 58148. Please try again in a minute.');
	
	if ($result->num_rows == 0) {
		die('Presentation secret not found. <a href="./">Go to the homepage</a>');
	}

	$row = $result->fetch_row();
	$presentationid = $row[0];
	$title = $row[1];
	$speaker = $row[2];
	$link = $row[3];
	$questionCount = $row[4];

	echo "Results of feedback on...";
	echo '<h1>' . htmlspecialchars($title) . '</h1>';
	echo '&mdash; <i>' . htmlspecialchars($speaker) . '</i>';
	if (!empty($link)) {
		if (substr($link, 0, 4) !== 'http') {
			$reallink = 'http://' . $link;
			$reallink = htmlspecialchars($reallink);
		}
		else {
			$reallink = htmlspecialchars($link);
		}
		echo ", <a href='$reallink'>$link</a>";
	}
	echo "<br><br>";

	if (isset($_GET['question'])) {
		$question_n = intval($_GET['question']);
	}
	else {
		$question_n = 0;
	}

	if ($question_n > 0) {
		echo "<input type=button value='Previous question' onclick='location=\"?secret="
			. htmlspecialchars($_GET['secret']) . "&question=" . ($question_n - 1) . "\";'>";
	}

	if ($question_n < $questionCount - 1) {
		echo "<input type=button value='Next question' onclick='location=\"?secret="
			. htmlspecialchars($_GET['secret']) . "&question=" . ($question_n + 1) . "\";'>";
	}

	echo "<br><br>";

	$dbSecret = $db->escape_string($_GET['secret']);
	$result = $db->query("SELECT pq.question, pq.type, pqr.response, pf.id
		FROM presentations p
		INNER JOIN presentation_questions pq ON pq.presentationid = p.id
		INNER JOIN presentation_feedback pf ON pf.presentationid = p.id
		INNER JOIN presentation_question_responses pqr ON pqr.feedbackid = pf.id
		WHERE p.secret = '$dbSecret' AND pq.sequenceNumber = $question_n
		ORDER BY pf.id")
		or die('Database error 285. Please try again in a minute.');

	if ($result->num_rows == 0) {
		die('Question not found');
	}
	$responses = [];
	$avg = 0;
	while ($row = $result->fetch_row()) {
		list($question, $type, $response, $responseID) = $result->fetch_row();
		$responses[$responseID] = $response;
		if ($type == 1) {
			// 5-star rating
			$avg += intval($response);
		}
	}

	echo "Question " . ($question_n + 1) . ": '<i>" . htmlspecialchars($question) . "</i>'<br>";

	if ($type == 1) {
		// 5-star rating
		echo "Average rating: " . ($avg / count($responses)) . " out of 5. Individual ratings:<br>";
		$wstar = '&#9734;'; // white star
		$bstar = '&#9733;'; // black star
		foreach ($responses as $responseID=>$response) {
			echo "#$responseID: ";
			$response = intval($response);
			$i = 0;
			while ($i < 5) {
				echo "<span class='star'>" . ($response - 1 <= $i ? $wstar : $bstar) . "</span>";
				$i++;
			}
			echo "<br>";
		}
	}
	
	else if ($type == 2) {
		foreach ($responses as $responseID=>$response) {
			echo "#$responseID: " . htmlspecialchars($response) . '<hr>';
		}
	}
?>
</section>
