<?php

function load_scripts()
{
  // STYLES
  // wp_enqueue_style(
  //   "style",
  //   get_template_directory_uri()."/style/css/main.css",
  //   array(),
  //   '1.0',
  //   "all"
  // );

  // SCRIPTS
  // wp_enqueue_script(
  //   'jquery-3',
  //   get_template_directory_uri()."/js/jquery.min.js",
  //   array("wp-embed"),
  //   '3.4.1',
  //   true // true = footer, false = header
  // );
}
add_action("wp_enqueue_scripts", "load_scripts");



add_filter('style_loader_tag', 'clean_style_tag');
add_filter('script_loader_tag', 'clean_script_tag');

/**
 * Clean up output of stylesheet <link> tags
 */
function clean_style_tag($input) {
  preg_match_all("!<link rel='stylesheet'\s?(id='[^']+')?\s+href='(.*)' type='text/css' media='(.*)' />!", $input, $matches);
  if (empty($matches[2])) {
      return $input;
  }
  // Only display media if it is meaningful
  $media = ($matches[3][0] !== '' && $matches[3][0] !== 'all')? ' media="' . $matches[3][0] . '"' : '';
  return '<link rel="stylesheet" href="' . $matches[2][0] . '"' . $media . '>' . "\n";
}

/**
 * Clean up output of script <script> tags
 */
function clean_script_tag($input) {
  $input = str_replace("type='text/javascript' ", '', $input);
  return str_replace("'", '"', $input);
}

function theme_config()
{
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(450, 450);
}
add_action("after_setup_theme", "theme_config", 0);
