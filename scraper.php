<?
// This is a template for a PHP scraper on morph.io (https://morph.io)
// including some code snippets below that you should find helpful

require 'scraperwiki.php';
require 'scraperwiki/simple_html_dom.php';
//
// // Read in a page
$html = scraperwiki::scrape("http://point.md");
//
// // Find something on the page using css selectors
$dom = new simple_html_dom();
$dom->load($html);

$items = $dom->find('.post-list-wrap .post-list-container-item');
$posts = array();

foreach($items as $item) {
  $post = array();
  
  $post['title'] = $item->find('a[itemprop="URL"]')[0]->text();
  $post['id']    = $item->getAttribute('data-id');
  $post['image'] = $item->find('.post-list-container-item-img img')[0]->getAttribute('src');
  $post['description'] = $item->find('p[itemprop="description"]')[0]->text();
  $post['keywords'] = $item->find('div.post-list-container-item-text-info')[0]->find('span')[2]->text();
  
  print_r(json_encode($post));
  $posts[] = $post;
}

// print_r($dom->find("table.list"));
//
// // Write out to the sqlite database using scraperwiki library
// scraperwiki::save_sqlite(array('name'), array('name' => 'susan', 'occupation' => 'software developer'));
//
// // An arbitrary query against the database
// scraperwiki::select("* from data where 'name'='peter'")

// You don't have to do things with the ScraperWiki library.
// You can use whatever libraries you want: https://morph.io/documentation/php
// All that matters is that your final data is written to an SQLite database
// called "data.sqlite" in the current working directory which has at least a table
// called "data".
?>
