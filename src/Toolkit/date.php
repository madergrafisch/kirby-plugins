<?php

namespace mgf\Toolkit;

class Date {

  public static $formats = array();

  public static function format($timestamp, $format = 'short') {
    return strftime(static::$formats[$format], $timestamp);
  }

}

Date::$formats['long'] = "%A, %d. %B %G";
Date::$formats['short'] = "%d. %B %G";
Date::$formats['iso8601'] = "%Y-%m-%dT%H:%M:%S%z";
Date::$formats['iso'] = Date::$formats['iso8601'];
