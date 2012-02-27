<?php
/**
 * The loop that displays events on the index page.
 *
 * @package WordPress
 * @subpackage UNHYPED
 */

$events = eo_get_events();

if( $events ) :
  $return= '<ul class="eo-events">';
  foreach ($events as $event):
    //Check if all day, set format accordingly
    if($event->event_allday) :
      $format = get_option('date_format');
    else :
      $format = get_option('date_format').'  '.get_option('time_format');
    endif;

    $address = eo_get_venue_address( (int)$event->Venue );

    $return .= '<li id="eo-event-'.$event->ID.'" class="eo-event"><a title="'.$event->post_title.'" href="'.get_permalink($event->ID).'">';
    $return .= '<figure class="eo-event-thumbnail">'.get_the_post_thumbnail($event->ID);
    $return .= '<figcaption class="eo-event-details"><span class="eo-event-title">'.$event->post_title.'</span>';
    $return .= '<span class="eo-event-description">'.$event->post_content.'</span></figcaption></figure>';
    $return .= '<span class="eo-event-meta">'.eo_format_date($event->StartDate.' '.$event->StartTime, $format).' at '.eo_get_venue_name( (int)$event->Venue ).'</span>';
    $return .= '</a></li>';
  endforeach;

  $return.='</ul>';
  echo $return;
endif;

echo '<!--';
print_r($events);
echo '-->';

?>
