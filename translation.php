<?php
	$translations = [
		'en' => [
			'dbconnerr'           => 'Could not connect to database. Did you setup config.php?',
			'dberr'               => 'Database error ',
			'thanks for feedback' => 'Thank you for your feedback!',
			'code not found'      => 'Presentation code not found or the code has expired. <a href="./">Enter a different one</a>',
			'Feedback'            => 'Feedback',
			'Results'             => 'Results',
			'Create'              => 'Create',
			'projtitle'           => 'Presentation Feedback Tool',
			'this site is'        => 'This website is',
			'free software'       => 'free software',
			'give feedback'       => 'Give feedback on a presentation',
			'get feedback'        => 'Get feedback on your presentation',
			'Presentation code'   => 'Presentation code',
			'Presentation title'  => 'Presentation title',
			'Start'               => 'Start',
			'Next'                => 'Next',
			'secret not found'    => 'Presentation secret not found.',
			'goto home'           => 'Go to the homepage',
			'results for...'      => 'Results of feedback on...',
			'Previous question'   => 'Previous question',
			'Next question'       => 'Next question',
			'question not found'  => 'Question not found. Maybe there are no responses yet?',
			'Question'            => 'Question',
			'avg rating'          => 'Average rating:',
			'out of 5.'           => 'out of 5.',
			'Individual ratings:' => 'Individual ratings:',
			'blank'               => 'blank',
			'mailed copy'         => 'A copy of this page has been emailed to you.',
			'failed sending mail' => 'Sending the email failed.',
			'your feedback codes' => 'Your presentation feedback codes',
			'mailing too fast'    => 'Did you email to this address within the last minute? If so, try again in a minute.',
			'Your audience code:' => 'Your audience code:',
			'The direct link:'    => 'The direct link:',
			'Results link:'       => 'Your private link to view the results:',
			'Your name'           => 'Your name',
			'Questions'           => 'Questions',
			'Add question'        => 'Add question',
			'creation info'       => "After clicking 'create', you will be given a public code (to give your audience, valid for 2 weeks) and a private code (to view the results).\n"
			                       . "If you want to email these to yourself, enter your email address here (optional). The address will be used once and is not stored.",
			'Email address'       => 'Email address',
			'A link'              => 'A link, e.g. your website or Twitter account',
			'info for visitors'   => 'Information to show visitors',
			'Star rating'         => 'Star rating',
			'Text field'          => 'Text field',
		],
	];

	function translate($str) {
		global $language, $translations;

		if (!isset($translations[$language])) {
			die('Language not found or not configured.');
		}

		return $translations[$language][$str];
	}

