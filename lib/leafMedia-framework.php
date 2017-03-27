<?php
/**
 * Theme dependencies
 * @since 1.0.0a
 * ================================================== */

$library = array(
	'clean-up.php',
	'debug.php',
	'editor.php',
	'nav-walker.php',
	'security.php',
	'utilities.php',
	'social.php',
	'analytics.php',
	'search.php',
	'leafMedia-helpers.php',
	'leafMedia-layout.php',
	'html-compression.php'
);

foreach ($library as $file) {

	$filepath = __DIR__ . '/' . $file;

	if ( !file_exists($filepath) ) {
		trigger_error( sprintf('Error locating %s for inclusion', $file), E_USER_ERROR );
	}
	require_once $filepath;
}

unset($file, $filepath);

?>
