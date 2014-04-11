<?php
/**
 * 404 error for protect file.
 *
 * Taken from WPUtilities by @Darklg
 * https://github.com/Darklg/WPUtilities
 *
 */
if ( !defined( 'TEMPLATEPATH' ) ) {
    header( $_SERVER["SERVER_PROTOCOL"]." 404 Not Found" );
    exit( 'Nope!' );
}
