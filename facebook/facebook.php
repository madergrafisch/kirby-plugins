<?php

class Facebook {

  public static $graph_scheme = 'https';
  public static $graph_host = 'graph.facebook.com';

  public static function latest_post () {
    $cache = kirby()->cache()->get('facebook.latest.post');
    if (!is_null($cache)) return response::json($cache);

    $response = remote::get(url::build(array(
      'scheme' => static::$graph_scheme,
      'host' => static::$graph_host,
      'fragments' => array(
        c::get('facebook.id'),
        'posts',
      ),
      'query' => array(
        'access_token' => c::get('facebook.accesstoken'),
        'limit' => 1,
      ),
    )));

    if ($response->content) {
      // parse json string
      $data = str::parse($response->content)['data'][0];

      $return = array(
        'text' => $data['message'],
        'picture' => $data['picture'],
        'timestamp' => strtotime($data['updated_time']),
        'time_formatted' => strftime('%d. %B %G', strtotime($data['updated_time'])),
        'link' => $data['link'],
      );

      // set cache for 10 minutes
      kirby()->cache()->set('facebook.latest.post', $return, 10);
    }
    else {
      return false;
    }

    return $return;
  }

}
