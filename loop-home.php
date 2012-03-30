<?php
/**
 * The loop that displays events on the index page.
 *
 * @package WordPress
 * @subpackage UNHYPED
 */

$wall_count   = 5;
$list_count   = 5;
$query_count  = 5 + $wall_count + $list_count;

$events = eo_get_events( array('numberposts'=>$query_count) );

if( $events ):

  $results_count = count($events);

  $return = '';
  
  // loop through all events to print the wall and list view
  foreach ($events as $key => $event):
    
    // open events wall before first item
    if ( $key == 0 )
      $return .= '<ul class="eo-events-wall">';
    
    // close events wall at the count
    if ( $key == $wall_count )
      $return .= '</ul><!-- .eo-events-wall -->';

    // open events list after count, if there are more items than fit in the events wall
    if ( $key == $wall_count && $results_count > $wall_count )
      $return .= '<ul class="eo-events-list"><h2>Upcoming</h2>';

    // set date string
    $date_format = ($event->event_allday) ? get_option('date_format') : get_option('date_format').' '.get_option('time_format');

    // get venue info
    $address = eo_get_venue_address( (int)$event->Venue );

    // return event
    if ( $key < $wall_count ):
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
    //if ( $key >= $wall_count && $key == ( $wall_count + $list_count - 1 ) ) :
    if ( $key >= count($events) - 1 ) :
      $return .= '</ul><!-- .eo-events-list -->';
      break;
    endif;

  endforeach;

  $return .= '<figure class="eo-events-map"><div id="map_canvas" style="height:100%;width:100%;"></div></figure><!-- .eo-events-map ?> -->';

  // reset array pointer and re-loop all events to print the map
  reset($events);
  foreach ( $events as $key => $event ):
    // add event to google maps dataprovider
  endforeach;

  echo $return;
endif;
