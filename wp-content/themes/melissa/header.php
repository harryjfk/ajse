<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
// header type
$header_type = get_theme_mod('general_header_type', 'simple-header');
if ($header_type == 'simple-header') {
  // simple header (without animation)
  get_template_part('templates/headers/header-simple');
} else {
  // header with animation (slider revolution)
  get_template_part('templates/headers/header-slider-revolution');
}
