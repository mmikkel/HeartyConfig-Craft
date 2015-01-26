<?php

// What be yer environment URLs, matey?
$envs = array(
    'dev.example1.com,dev.example2.com' => 'dev',
    'stage.example1.com' => 'stage',
    'example.com,www.example.com' => 'prod',
);

// Sets yer environment. Yarr!
if ( ! defined( 'CRAFT_ENVIRONMENT' ) ) {

    if ( file_exists( dirname( __FILE__) . '/config.local.php' ) ) {

        // Here be local config file – assume local env
        define( 'CRAFT_ENVIRONMENT', 'local' );

    } else {

        $host = $_SERVER[ 'SERVER_NAME' ];

        foreach ( $envs as $hosts => $env ) {
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
