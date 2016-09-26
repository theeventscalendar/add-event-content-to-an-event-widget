<?php
/**
 * Plugin Name: The Events Calendar Extension: Add Event Excerpt to an Event Widget
 * Description: Adds the event excerpt to the "listed" events in The Events Calendar's list widgets and Events Calendar Pro's mini calendar widget.  
 * Version: 1.0.0
 * Author: Modern Tribe, Inc.
 * Author URI: http://m.tri.be/1971
 * License: GPLv2 or later
 */
 
defined( 'WPINC' ) or die;

class Tribe__Extension__Add_Excerpt_to_Event_Widget {

	/**
	 * The semantic version number of this extension; should always match the plugin header.
	 */
	const VERSION = '1.0.0';

	/**
	 * Each plugin required by this extension
	 *
	 * @var array Plugins are listed in 'main class' => 'minimum version #' format.
	 */
	public $plugins_required = array(
		'Tribe__Events__Main'      => '4.2',
		'Tribe__Events__Pro__Main' => '4.2',
	);

	/**
	 * The constructor; delays initializing the extension until all other plugins are loaded.
	 */
	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'init' ), 100 );
	}

	/**
	 * Extension hooks and initialization; exits if the extension is not authorized by Tribe Common to run.
	 */
	public function init() {
	
		// Exit early if our framework is saying this extension should not run.
		if ( ! function_exists( 'tribe_register_plugin' ) || ! tribe_register_plugin( __FILE__, __CLASS__, self::VERSION, $this->plugins_required ) ) {
		    return;
		}

		add_action( 'tribe_events_list_widget_after_the_meta', array( $this, 'tribe_add_event_excerpt_to_an_event_widget' ) );
		add_action( 'tribe_events_list_widget_before_the_event_title', array( $this, 'tribe_add_event_excerpt_to_an_event_widget_css' ) );
	}

	/**
	 * Echo the event excerpt beneath the widget event's title and meta.
	 *
	 * @return void
	 */
	public function tribe_add_event_excerpt_to_an_event_widget() {
		echo apply_filters( 'the_content', get_the_excerpt( get_the_ID() ) );
		echo sprintf( '<a href="%s">View Event</a>', get_permalink( get_the_ID() ) );
	}
	
	/**
	 * Echo some CSS at the top of the widget to ensure the excerpts display.
	 *
	 * @return void
	 */
	public function tribe_add_event_excerpt_to_an_event_widget_css() {
		?><style>.tribe-mini-calendar-event .list-info p { display: inline-block; }</style><?php
	}
}

new Tribe__Extension__Add_Excerpt_to_Event_Widget();
