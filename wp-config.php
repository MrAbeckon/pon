<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'pon' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '+~/VgrT3B^Zf^]5L4xdQlsvy,h,i~H.IYL-Gs3;Mr,NZu1qG9|OWIw7}hNLR*z>P' );
define( 'SECURE_AUTH_KEY',  '`s!B;f~oG^EL&lLOkE6s,Fl^?}wC<j~5o&ldxiMJo}+,[#|oxgDKh24!a~JmOa(c' );
define( 'LOGGED_IN_KEY',    'Ae.Jx~KEt0<+OKUsPM#6W)Id@ytBs)sO}iIoutjCIfFa93M@*#SWa+]V2c<.V,54' );
define( 'NONCE_KEY',        'U}Ku#MWwcXy/GbY>$a<nrM60d.s0=ljEA#74^V!/_M0%|1K=zK0PffbHBqDRe7+f' );
define( 'AUTH_SALT',        'h6Dk,5vj*`_-f_{BqoZ(pPKVRv1;exQz1[*w$hR?#V N?c/Pr%9R`=j`CICPI|p#' );
define( 'SECURE_AUTH_SALT', 'Wur~,S5D?.8VDFp64>7mVXhx)SG&*OfkFH>wD4itA4`~ 3f3cPiKcsjKGCSmBJEL' );
define( 'LOGGED_IN_SALT',   'Dtl[_})Cm{o.(MwH~#&kw8s3u|TV;!Q%Gng~i;oGUnxN@T9StG6(<9r8jSC_iMWz' );
define( 'NONCE_SALT',       'G;2=l!4RePr92v6Z~[g(,{s;]Sj#RB/4!)7p45_8<_B:5>{oXmGF!^|1&ZiQx)f4' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
