<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'mkthgrdsccsimplo' );

/** Database username */
define( 'DB_USER', 'mkthgrdsccsimplo' );

/** Database password */
define( 'DB_PASSWORD', 'MakethegradeSimplon35BDD' );

/** Database hostname */
define( 'DB_HOST', 'mkthgrdsccsimplo.mysql.db' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}


define('AUTH_KEY',         'n38GoYl0n9mH9J00lTyzhDF17Fnv2mnnCLMsveIhtLgcd8bpJP8NTFaG8KXWnPDCYoJfnHsrP5AJGFwFrCthlQ==');
define('SECURE_AUTH_KEY',  '6TdWrhvQCzgcykuDtlszd3/6UUtidKpHyrraBOO4IFfx1do/fyEdmcIUyOQVNavM5lUkEpqVuEErf3H0FQIy1Q==');
define('LOGGED_IN_KEY',    '00DcQDPGCfW4iJYzdkLkehDd+ZfmqUSTt98vXwrD3PMdXVV34rvbxVMNDQYHmxxRPTjyuPIuiDRLvF6L6zXEbw==');
define('NONCE_KEY',        'KR6FmskmUurMBFC4eMopEEZoaIJ8CIwIifrK9K225I6Su6cavmwVWu6TBa1m9RzfXlMDHEroB+JVLIRS2/9k8w==');
define('AUTH_SALT',        'Qga24Y6eqVDf49/oiEQgoJlW8qfG0z3lHs3lHRtc9PX++9qlxQevWykX3x4U6H5Dgfjd3IIrsCfCfBgTtXLA/A==');
define('SECURE_AUTH_SALT', 'EmroZ7nigN8rrlrbVzbBYPwXagwvL9s6x9XZHUMbazIeILtPDFrdgTAdI5ETat39pfLKIUk6b/baYJ40C3KIfQ==');
define('LOGGED_IN_SALT',   'KuEKh0nM+K30dy3fT0As3floPhYEcbpxJ4gyjQ9i3doXp/zoksv0u7wLeZdlhjBNm+NLGe7IeuGJEnmSAj2OWQ==');
define('NONCE_SALT',       'so+g2RrNX3FpbdlI3BrdgxNz97C+jFihk3uhex5TAvBa5wMl5wcd3oKaLnM2U3ud+DvIP6o0+InhQc7APAQd6w==');
define( 'WP_ENVIRONMENT_TYPE', 'development' );

define('WP_HOME','http://www.simplon.mkthgrd.space/');
define('WP_SITEURL','http://www.simplon.mkthgrd.space/');

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
