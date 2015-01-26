<?php

/**
 * Database Configuration
 *
 * All of your system's database configuration settings go in here.
 * You can see a list of the default settings in craft/app/etc/config/defaults/db.php
 */

$customConfig = array(

	'*' => array(
        'tablePrefix' => 'craft',
    ),

    // Add environtments as need be

);

// If an environment config file exists, merge settings.
if ( is_array( $customEnvConfig = @include( CRAFT_CONFIG_PATH . 'config.' . CRAFT_ENVIRONMENT . '.php' ) ) && isset( $customEnvConfig[ 'db' ] ) ) {
	$customConfig[ CRAFT_ENVIRONMENT ] = array_merge( $customConfig[ CRAFT_ENVIRONMENT ] ? $customConfig[ CRAFT_ENVIRONMENT ] : array(), $customEnvConfig[ 'db' ] );
}

return $customConfig;