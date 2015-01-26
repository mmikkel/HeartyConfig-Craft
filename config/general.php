<?php

/**
 * General Configuration
 *
 * All of your system's general configuration settings go in here.
 * You can see a list of the default settings in craft/app/etc/config/defaults/general.php
 */

// Shouldnt really have to touch this file ever – these are defaults and can/should be overridden in the config.{CRAFT_ENVIRONMENT}.php files

// All Craft config settings are found here: http://buildwithcraft.com/docs/config-settings

$customConfig = array(

	// General settings
	'*' => array(

		/* Hide index.php */
		'omitScriptNameInUrls' => true,

		/* Environment */
		'env' => CRAFT_ENVIRONMENT,
		'environmentVariables' => array(
			'siteUrl'  => CRAFT_SITE_URL,
			'basePath' => BASEPATH,
			'pubPath' => PUBPATH,
			// 'uploadPath' => PUBPATH . 'uploads',
			// 'uploadUrl' => CRAFT_SITE_URL . 'uploads',
			// 'imagePath' => PUBPATH . 'uploads/images',
			// 'imageUrl' => CRAFT_SITE_URL . 'uploads/images',
			// 'assetsPath' => PUBPATH . 'assets',
			// 'assetsUrl' => CRAFT_SITE_URL . 'assets',
	  	),

	    /* Triggers */
	   	// 'cpTrigger'       => 'manage',
	    // 'pageTrigger'     => 'page',

	    /* Custom vars */
	 	// 'assetsUri' => '/assets/',
		// 'assetsUrl' => CRAFT_SITE_URL . 'assets/',
		// 'assetsPath' => PUBPATH . 'assets/',

		/* Misc */
		// 'limitAutoSlugsToAscii' => true,
		'cache' => true, // Note: this doesn't actually do anything, but is used for conditional caching in templates. See http://craftcms.stackexchange.com/questions/105/what-are-the-best-practices-for-using-the-cache-tag/106#106

	),

	// LOCAL settings
	'local' => array(

		'devMode' => true,
		'cache' => false,

		// Some settings helpful for debugging
        'phpMaxMemoryLimit'          => '256M',
        'backupDbOnUpdate'           => true,
        'translationDebugOutput'     => false,
        'useCompressedJs'            => false,
        'cacheDuration'              => 'P1D',

		// Member login info duration
		// http://www.php.net/manual/en/dateinterval.construct.php
		'userSessionDuration'           => 'P101Y',
		'rememberedUserSessionDuration' => 'P101Y',
		'rememberUsernameDuration'      => 'P101Y',

	),

	// DEV settings
	'dev' => array(

		'devMode'	=> true,
		'cache' => false,

	),

	// Add additional environments as need be

);

// If an environment config file exists, merge settings.
if ( is_array( $customEnvConfig = @include( CRAFT_CONFIG_PATH . 'config.' . CRAFT_ENVIRONMENT . '.php' ) ) ) {
	if ( isset( $customEnvConfig[ 'db' ] ) ) {
		unset( $customEnvConfig[ 'db' ] );
	}
	$customConfig[ CRAFT_ENVIRONMENT ] = array_merge( $customConfig[ CRAFT_ENVIRONMENT ] ? $customConfig[ CRAFT_ENVIRONMENT ] : array(), $customEnvConfig );
}

return $customConfig;