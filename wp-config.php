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
define( 'DB_NAME', 'dirbble-selun_db' );

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
define( 'AUTH_KEY',         '*;5bv(3AO@DJ)hMF/YX Ta@Zm#vQdka^HNgJ;w%ykP1@BH=wEn&N]0,0{n[3wiLW' );
define( 'SECURE_AUTH_KEY',  ':BWQb{y<7o(Do_!pYv`~c4W}oOF_]/?nFQ6C<*Ov6RpOp|wgA5Xi^6~K{M2A(W6t' );
define( 'LOGGED_IN_KEY',    '[<rO~>w&3ei+h]vKAE{IHyw0g4[KK;vok@]Iq$!)yVf|Dz_2!v}|$!}wat3BR4j$' );
define( 'NONCE_KEY',        'f+]bAo9dxrc+N@mN6Lg]8IWTk5I[2kK>:~RK$j;{[7>,St1]D_:RX7D4[a+)]!Bn' );
define( 'AUTH_SALT',        ',W@&<M^U~DU3rfjgPY/pvc6rr%]LoCj=C{q0z _R_CYu{(|RL_8YKZuQz(,`B`7c' );
define( 'SECURE_AUTH_SALT', 'n~O3er:b}1FqLm~eQzv&_DVtzne1Vs+qnx*~)(lA 8{o;SVQS.!k.zQ(fUv)X!lm' );
define( 'LOGGED_IN_SALT',   'Y@`:V_Szfkbr!kx9*h.L{T<Ek`hB,f{}ho2EDhK>v@d-2nIL&iL*5:7<lcOb)h^{' );
define( 'NONCE_SALT',       '%7QN9NoLw?3;dr_7Nce+S!M$C93sqb]y|UnTwQE,j5_%&y9YCV-h@w7n.l|H+(WO' );

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
