<?php
// Your database configuration
$db_host = 'p:localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'feedbacktool';

// Link to use in emails to link to this site. MUST include the final slash (/).
// Using https is recommended! For localhost testing, the example shows http only.
$email_url = 'http://localhost/presentation-feedback/';

// Where should emails appear to come from?
$email_from = 'presentation-feedback-tool@example.org';

// How long are presentation codes valid for?
$code_validity = 14; // Days

// Display language of the site. See translation.php for supported values.
$language = 'en';

// URL where the source code can be found
$repo_url = 'https://github.com/lgommans/presentation-feedback';

// How long may freeform answers be?
// This limit is used in feedback.php and dbsetup.php. If the database was already set up and you change this limit, you need to manually update the database table as well!
$max_answer_size = 15000; // Unicode characters

