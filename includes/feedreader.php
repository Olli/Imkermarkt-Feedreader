<?php

if ( !function_exists('sys_get_temp_dir')) {
  function sys_get_temp_dir() {
    if( $temp=getenv('TMP') )        return $temp;
    if( $temp=getenv('TEMP') )        return $temp;
    if( $temp=getenv('TMPDIR') )    return $temp;
    $temp=tempnam(__FILE__,'');
    if (file_exists($temp)) {
      unlink($temp);
      return dirname($temp);
    }
    return null;
  }
}

/* für das Script wird CURL Unterst端tzung und PHP5 benötigt */
/* ----- Data Functions ----- */
function parseFeed($location) {
  global $picasa_user;
  $absolutePath = dirname(__FILE__);
  $cache = $absolutePath.'/../cache/yws_'.md5($location);

  //The cached material should only last for 2 hours, 
  //so you need the current time.
  $currentTime = microtime(true);
  $tempdir = sys_get_temp_dir()."/upload/";
//  $tempdir = '/home/www/web0/phptmp';

  //First check for an existing version of the time, and then check
  //to see whether or not it's expired.
  if(file_exists($cache) && filemtime($cache) > (time()-7200)) {

    error_log("cached...");
    //If there's a valid cache file, load its data.
    $feedXml = file_get_contents($cache);
  }
  else {
    error_log("NOT cached...");
    //If there's no valid cache file, grab a live version of the
    //data and save it to a temporary file.  Once the file is complete,
    //copy it to a permanent file.  (This prevents concurrency issues.)
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$location);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $feedXml = curl_exec($ch);
    curl_close($ch);
    $tempName = tempnam($tempdir,'YWS');
    file_put_contents($tempName, $feedXml);
    rename($tempName, $cache);
  }

  $feed = simplexml_load_string($feedXml);
  $feed->registerXPathNamespace('atom', 'http://www.w3.org/2005/Atom');
  $feed_arr = array();
  $i = 0;

  $feed_arr['feed']['id'] = (string)$feed->id;
  $feed_arr['feed']['websitelink'] = $feed->xpath('/atom:feed/atom:link[@rel="alternate"]');
  $feed_arr['feed']['lastupdate'] = $feed->updated;
  $feed_arr['feed']['title'] = (string)$feed->title;


  foreach ($feed->entry as $entry) {
    $feed_arr['entry'][$i]['title'] = (string)$entry->title;
    $feed_arr['entry'][$i]['summary'] = (string)$entry->summary;
    $feed_arr['entry'][$i]['published'] = $entry->published;
    $feed_arr['entry'][$i]['link'] = $entry->link;
    $feed_arr['entry'][$i]['author'] = (string)$entry->author->name;
    $ns_myadv = $entry->children('http://www.imkermarkt.de/2009/myadv');
    $feed_arr['entry'][$i]['zip'] = (string)$ns_myadv->zip;
    $feed_arr['entry'][$i]['city'] = (string)$ns_myadv->city;
    $feed_arr['entry'][$i]['country'] = (string)$ns_myadv->country;
    $i++;
  }

  return $feed_arr;
}

?>
