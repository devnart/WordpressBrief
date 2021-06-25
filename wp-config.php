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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_b' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'b7hoP5+cxb98zVFF<btKL)&:C{eq~CNxah%&QU})h5 ZiZ=$R;JU&6}d1%hI)Ga}' );
define( 'SECURE_AUTH_KEY',  '[8#F3:(W$Xmc8,im57iT/9=J{g*O5S^57r,1Wib Pr~q,Yd8X/|J4O?./qw2qbk$' );
define( 'LOGGED_IN_KEY',    'LbH8.JV%{!x615 -_5eba- Q6A%5A8Rn)gWg9g2?FhUI8)|..Pyq^.zZSqA]23:D' );
define( 'NONCE_KEY',        'TFigex-,OsLv1sK)pIV;n7npB-i_]{CCx$>}wW7hmh` tB$xb*WSVy@%:re1{/DL' );
define( 'AUTH_SALT',        'lZyk>W5 B12^r =e6UUBTpO9em`Il!/f?~U?L2H#OrD3Q1>}a5B:6{/v +S=S9u)' );
define( 'SECURE_AUTH_SALT', 'G]BS:-]fa7u{IF(*KcQwSE 28)QAzA{$c6OY4`5g4Awj*k,MS4x@jR]nvNkhz<Lp' );
define( 'LOGGED_IN_SALT',   '4w:Db4;6<8o7M~~Ubai5{9*1Hi<d+}p(F/$?`Slw4&$.hRS`GFgIH~6a}/MibT>/' );
define( 'NONCE_SALT',       'O$8Cd${amdEQ4$}q#ce^-]cdrshT9wEvNnhx2(zCW~hMabQKm%U&:@D r^:D^$4B' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
