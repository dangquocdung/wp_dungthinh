<?php
/*
 * All Eunice Theme Related Functions Files are Linked here
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */

/* Theme All Basic Setup */
require_once( EUNICE_FRAMEWORK . '/theme-support.php' );
require_once( EUNICE_FRAMEWORK . '/backend-functions.php' );
require_once( EUNICE_FRAMEWORK . '/frontend-functions.php' );
require_once( EUNICE_FRAMEWORK . '/enqueue-files.php' );
require_once( EUNICE_CS_FRAMEWORK . '/custom-style.php' );
require_once( EUNICE_CS_FRAMEWORK . '/config.php' );

/* Bootstrap Menu Walker */
require_once( EUNICE_FRAMEWORK . '/core/vt-mmenu/wp_bootstrap_navwalker.php' );

/* Install Plugins */
require_once( EUNICE_FRAMEWORK . '/plugins/notify/activation.php' );

/* Breadcrumbs */
require_once( EUNICE_FRAMEWORK . '/plugins/breadcrumb-trail.php' );

/* Aqua Resizer */
require_once( EUNICE_FRAMEWORK . '/plugins/aq_resizer.php' );

/* Sidebars */
require_once( EUNICE_FRAMEWORK . '/core/sidebars.php' );