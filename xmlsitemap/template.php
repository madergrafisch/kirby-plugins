<?php

$ignore = array('error', 'slider');
$ignoretpl = array('');

// send the right header
header('Content-type: text/xml; charset="utf-8"');

// echo the doctype
echo '<?xml version="1.0" encoding="utf-8"?>';

?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <?php foreach($pages->visible()->index() as $p): ?>

  <?php // if($p->depth() > 2) continue ?>
  <?php if(in_array($p->template(), $ignoretpl)) continue ?>
  <?php if(in_array($p->uri(), $ignore)) continue ?>
  <url>
    <loc><?php echo html($p->url()) ?></loc>
    <lastmod><?php echo $p->modified('c') ?></lastmod>
    <priority><?php echo ($p->isHomePage()) ? 1 : number_format(0.5/$p->depth(), 1) ?></priority>
  </url>
  <?php endforeach ?>
</urlset>
