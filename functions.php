<?php
$composer_autoload = __DIR__ . '/vendor/autoload.php';
if ( file_exists( $composer_autoload ) ) {
	require_once $composer_autoload;
	$timber = new Timber\Timber();
}
include __DIR__ . '/includes/class-theme.php';
include __DIR__ . '/includes/class-ajax.php';