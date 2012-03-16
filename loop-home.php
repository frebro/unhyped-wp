<?php
/**
 * The loop that displays events on the index page.
 *
 * @package WordPress
 * @subpackage UNHYPED
 */

$events = eo_get_events( array('numberposts'=>5) );

if( $events ) :
  $return= '<ul class="eo-events">';

  foreach ($events as $key => $event):
    
    if($event->event_allday) :
      $date_format = get_option('date_format');
    else :
      $date_format = get_option('date_format').' '.get_option('time_format');
    endif;

    $address = eo_get_venue_address( (int)$event->Venue );

    $return .= '<li id="eo-event-'.$event->ID.'" class="eo-event"><a class="eo-event-link" title="'.$event->post_title.'" href="'.get_permalink($event->ID).'">';
    $return .= '<figure class="eo-event-thumbnail">'.get_the_post_thumbnail($event->ID);
    $return .= '<figcaption class="eo-event-details"><span class="eo-event-title">'.$event->post_title.'</span></figcaption>';
    $return .= '<span class="eo-event-datetime">'.eo_format_date($event->StartDate.' '.$event->StartTime, $date_format).' at '.eo_get_venue_name( (int)$event->Venue ).'</span></figure>';
    $return .= '<div class="eo-event-meta"><span class="eo-event-description">'.$event->post_content.'</span></div>';
    $return .= '</a></li><!-- #eo-event-'.$event->ID.' -->';

  endforeach;

  $return.='</ul>';
  echo $return;
endif;

echo '<!-- $events=';
print_r($events);
echo '-->';

?>