<?php

function xmlsitemap () {
  return tpl::load(__DIR__ . DS . 'template.php', array('pages' => kirby()->site()->pages()));
}
