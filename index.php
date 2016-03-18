<?php
/*
 * Plugin Name: Event Management Json
 * Text Domain: eventmanagementjson event-cron
 * Version: 1.9
*/


//////////// Activation Hook ///////////

register_activation_hook( __FILE__, 'eventsTrashing_activation' );

function eventsTrashing_activation() {
	wp_schedule_event( time(), 'hourly', 'old_events_trashing' );
}

////////// END Activation Hook /////////

define('MYABSPATH', dirname(__FILE__) );
require_once(MYABSPATH.'/class/class-event-post-type.php');
require_once(MYABSPATH.'/class/class-event-post-meta.php');
require_once(MYABSPATH.'/class/event-taxonomy.php');
require_once(MYABSPATH.'/inc/template-hook.php');
require_once(MYABSPATH.'/inc/event-cron.php');
require_once(MYABSPATH.'/inc/duplicate-event.php');


//wp_schedule_event(time(),'hourly','old_events_trashing');


add_action('admin_enqueue_scripts','event_adminscripts');
function event_adminscripts(){
	wp_enqueue_script('admin-js', plugins_url( '/js/admin.js', __FILE__ ));
	wp_enqueue_script('online-Key-googleMAP', '//maps.google.com/maps?file=api&amp;v=2.133d&amp;key=ABQIAAAAjU0EJWnWPMv7oQ-jjS7dYxSPW5CJgpdgO_s4yyMovOaVh_KvvhSfpvagV18eOyDWu7VytS6Bi1CWxw',array('jquery'));
	wp_enqueue_script('admin-js-googleMAP', plugins_url( '/js/longLatitude.js', __FILE__ ),array('jquery'));
} //close function


add_action('wp_enqueue_scripts','event_frontendscripts');
function event_frontendscripts(){
	wp_enqueue_style('event-bootstrap',plugins_url('/css/bootstrap.css',__FILE__));
	wp_enqueue_style('event-frontend',plugins_url('/css/frontend.css',__FILE__));
	wp_enqueue_style('event-fontawsome','//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css');
	wp_enqueue_style('google-font','http://fonts.googleapis.com/css?family=Dosis');
	
	wp_enqueue_script('google-api','http://maps.googleapis.com/maps/api/js',array('jquery'));
	wp_enqueue_script('script-api',plugins_url('/js/front-end.js',__FILE__));
} //close function

/* add_action('admin_footer','gamespot_footer');
function gamespot_footer(){ ?>
<script type='text/javascript' src='<?php echo plugins_url( '/js/admin.js', __FILE__ ) ?>?ver=4.1'></script>
<?php } */ ?>