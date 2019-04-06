<?php 
	if (!$included) {
		exit;
	}

	$db = new mysqli($db_host, $db_user, $db_pass, $db_name);
	if ($db->connect_error) {
		die(translate('dbconnerr'));
	}

	$result = $db->query('SHOW TABLES LIKE "presentations"') or die(translate('dberr') . '41.');
	if ($result->num_rows == 0) {
		$db->query('CREATE TABLE presentations (
			id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
			datetime INT UNSIGNED NOT NULL,
			code VARCHAR(100) NOT NULL UNIQUE,
			secret VARCHAR(100) NOT NULL,
			title VARCHAR(255),
			speaker VARCHAR(255),
			link VARCHAR(255)
			)') or die(translate('dberr') . '5189');

		$db->query('CREATE TABLE presentation_feedback (
			id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
			presentationid INT NOT NULL
			)') or die(translate('dberr') . '65719');

		$db->query('CREATE TABLE presentation_questions (
			id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
			presentationid INT NOT NULL,
			sequenceNumber INT NOT NULL,
			question VARCHAR(255),
			type TINYINT
			)') or die(translate('dberr') . '71598');

		$db->query('CREATE TABLE presentation_question_responses (
			id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
			feedbackid INT NOT NULL,
			sequenceNumber INT NOT NULL,
			response VARCHAR(35000)
			)') or die(translate('dberr') . '14717');

		$db->query('CREATE TABLE presentation_maillimit (
			id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
			emailaddress VARCHAR(32) NOT NULL UNIQUE,
			datetime INT UNSIGNED
			)') or die(translate('dberr') . '34150');
	}

