<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'qbabit_ajse');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'qbabit_ajse');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', '8huxQt+eOq_u');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8mb4');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'LRodR#D/Zod9g1,*{u;0@ZkQ3t%3zk0=|o3&yZ}&_v#+)p9iP,:Q8W<4`Fq4ao_r');
define('SECURE_AUTH_KEY', 'yAR4rn@w_2.M?9MHeB?ann0@)iQr,7JA+J J[z&U%e%j|:,E6~/,z{>xF!x~;CL|');
define('LOGGED_IN_KEY', '+Xi<[ZUuHI2)pV]:a88E)Q6P5Q{^jC%QmSz}XXJ;m`w?L-pZLd(=%Z#ww;oJ<Jq&');
define('NONCE_KEY', 'u|sgjb,{1sC(>,vd[}Xn;|g9k!i-J&!%tbYz+}=yXU`[@!fay~r2B9[dJb%tF>n.');
define('AUTH_SALT', '`}U}=w#Vv13o6EM,Mm*3g@Xf;z=WNV}4ZC]I?kw.3/!s1k1RjE!oe}RgjtDx$>[]');
define('SECURE_AUTH_SALT', '0{ae7c41mcfRDYZ ZRd.y!$^;hS{K*DkFsrRHiKuVL}Pi5n:_R[M;WeND!>[rIoz');
define('LOGGED_IN_SALT', '+UA=78BPGdWN&!F6cDBa_oi-{a2%S/#)${S9kXrPSU~s#}4GR=5-~FS~TlP=(a1p');
define('NONCE_SALT', '`tuuHWW[x.D8iAq`,Y}EK<.Y<dD2Gug^3A;/v6,Ik/Ui.HbyPc5bOcS4XX@4>h:B');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

