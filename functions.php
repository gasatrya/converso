<?php
/**
 * Functions for the Converso WordPress theme.
 *
 * @package	Converso
 * @author	Ga Satrya
 * @license	GNU General Public License v3
 */

/**
 * Auto-load PHP files.
 */
foreach ( glob( __DIR__ . '/inc/*.php' ) as $file ) {
	require_once $file;
}
