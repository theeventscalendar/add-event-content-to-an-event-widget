<?php
/**
 * Plugin Name: The Events Calendar — Add Event Excerpt to an Event Widget
 * Description: Adds the event excerpt to the "listed" events in The Events Calendar's list widgets and Events Calendar Pro's mini calendar widget.  
 * Version: 1.0.0
 * Author: Modern Tribe, Inc.
 * Author URI: http://m.tri.be/1x
 * License: GPLv2 or later
 */
 
defined( 'WPINC' ) or die;

/**
 * Echo the event excerpt beneath the widget event's title and meta.
 *
 * @since 1.0.0
 *
 * @return void
 */
function tribe_add_event_excerpt_to_an_event_widget() {

	echo apply_filters( 'the_content', get_the_excerpt( get_the_ID() ) );
	
	echo sprintf( '<a href="%s">View Event</a>', get_permalink( get_the_ID() ) );
}

add_action( 'tribe_events_list_widget_after_the_meta', 'tribe_add_event_excerpt_to_an_event_widget' );

/**
 * Echo some CSS at the top of the widget to ensure the excerpts display.
 *
 * @since 1.0.0
 *
 * @return void
 */
function tribe_add_event_excerpt_to_an_event_widget_css() {
	?>
		<style>.tribe-mini-calendar-event .list-info p { display: inline-block; }</style>
	<?php
}

add_action( 'tribe_events_list_widget_before_the_event_title', 'tribe_add_event_excerpt_to_an_event_widget_css' );
