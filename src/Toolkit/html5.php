<?php

namespace mgf\Toolkit;

use Brick;
use Html;

class Html5 extends Html {

  static public function time($timestamp, $format = 'short', $classes = '') {
    $brick = new Brick('time');
    $brick->datetime = Date::format($timestamp, 'iso');
    $brick->text(Date::format($timestamp, $format));
    $brick->addClass($classes);
    return $brick;
  }

}
