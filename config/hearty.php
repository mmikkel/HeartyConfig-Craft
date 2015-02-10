<?php

// What be yer environment URLs, matey?
$envs = array(
    'dev' => 'dev.example1.com,dev.example2.com',
    'stage' => 'stage.example1.com',
    'prod' => 'example.com,www.example.com',
);

// Sets yer environment. Yarr!
if ( ! defined( 'CRAFT_ENVIRONMENT' ) ) {

    if ( file_exists( dirname( __FILE__) . '/config.local.php' ) ) {

        // Here be local config file – assume local env
        define( 'CRAFT_ENVIRONMENT', 'local' );

    } else {

        $host = $_SERVER[ 'SERVER_NAME' ];

        foreach ( $envs as $env => $hosts ) {
            $hosts = explode( ',', preg_replace( '/\s+/', '', $hosts ) );
            if ( in_array( $host, $hosts ) ) {
                define( 'CRAFT_ENVIRONMENT', $env );
                break;
            }
        }

    }

    if ( ! defined( 'CRAFT_ENVIRONMENT' ) ) {
        die( 'No environment defined in ' . __FILE__ );
    }

}

// Set yer config path to the containing folder. Arr!
define( 'CRAFT_CONFIG_PATH', dirname( __FILE__ ) . '/' );

// Where do ye want yer templates and plugins, matey?
//define( 'CRAFT_PLUGINS_PATH', '../plugins' );
//define( 'CRAFT_TEMPLATES_PATH', '../templates' );

// Ensure our urls have the right scheme
define( 'URI_SCHEME', ( isset( $_SERVER[ 'HTTPS' ] ) ) ? 'https://' : 'http://' );

// The site url
define( 'CRAFT_SITE_URL', URI_SCHEME . $_SERVER[ 'SERVER_NAME' ] . '/' );

// The site basepath
define( 'BASEPATH', realpath( dirname( __FILE__ ) . '/../' ) . '/' );

// The site's public basepath - usually set in index.php, if not then just use the basepath yep
if ( isset( $publicPath ) ) {
    define( 'PUBPATH', rtrim( $publicPath, '/' ) . '/' );
} else {
    define( 'PUBPATH', BASEPATH );
}
