<?php
/**
 * The loop that displays events on the index page.
 *
 * @package WordPress
 * @subpackage UNHYPED
 */

$events = eo_get_events( array('numberposts'=>15) );

if( $events ):

  $events_wall_count = 5;
  $events_total_count = count($events);

  $return = '';
  
  foreach ($events as $key => $event):
    
    // open events wall before first item
    if ( $key == 0 )
      $return .= '<ul class="eo-events-wall">';
    
    // close events wall at the count
    if ( $key == $events_wall_count )
      $return .= '</ul><!-- .eo-events-wall -->';

    // open events list after count, if there are more items than fit in the events wall
    if ( $key == $events_wall_count && $events_total_count > $events_wall_count )
      $return .= '<ul class="eo-events-list">';

    // set date string
    $date_format = ($event->event_allday) ? get_option('date_format') : get_option('date_format').' '.get_option('time_format');

    // get venue info
    $address = eo_get_venue_address( (int)$event->Venue );

    // return event
    if ( $key < $events_wall_count ):
      // wall formatting
      $return .= '<li id="eo-event-'.$event->ID.'" class="eo-event eo-event-key'.$key.'">';
      $return .= '<figure class="eo-event-thumbnail">'.get_the_post_thumbnail($event->ID);
      $return .= '<figcaption class="eo-event-details"><a class="eo-event-link" title="'.$event->post_title.'" href="'.get_permalink($event->ID).'"><span class="eo-event-title">'.$event->post_title.'</span><br>';
      $return .= '<span class="eo-event-datetime">'.eo_format_date($event->StartDate.' '.$event->StartTime, $date_format).' at '.eo_get_venue_name( (int)$event->Venue ).'</span></a></figcaption></figure>';
      $return .= '</li><!-- #eo-event-'.$event->ID.' -->';
    else:
      // list formatting
      $return .= '<li id="eo-event-'.$event->ID.'" class="eo-event eo-event-key'.$key.'">';
      $return .= '<a class="eo-event-link" title="'.$event->post_title.'" href="'.get_permalink($event->ID).'"><span class="eo-event-title">'.$event->post_title.'</span>';
      $return .= '<span class="eo-event-datetime">'.eo_format_date($event->StartDate.' '.$event->StartTime, $date_format).' at '.eo_get_venue_name( (int)$event->Venue ).'</span></a>';
      $return .= '</li><!-- #eo-event-'.$event->ID.' -->';
    endif;

    // close events list after last item
    if ( $key >= $events_wall_count && $key == $events_total_count-1 ) :
      $return .= '</ul><!-- .eo-events-list -->';
    endif;

  endforeach;

  echo $return;
endif;

?>