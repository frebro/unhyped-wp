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

    $return .= '<li id="eo-event-'.$event->ID.'" class="eo-event"><a title="'.$event->post_title.'" href="'.get_permalink($event->ID).'"><figure class="eo-event-thumbnail">'.get_the_post_thumbnail($event->ID).'</figure><span class="eo-event-title">'.$event->post_title.'</span></a> on '.eo_format_date($event->StartDate.' '.$event->StartTime, $format).'</li>';
  endforeach;

  $return.='</ul>';
  echo $return;
endif;

echo '<!--';
print_r($events);
echo '-->';

?>
