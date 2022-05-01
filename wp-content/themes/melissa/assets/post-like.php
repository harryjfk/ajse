<?php
/*
Name: WordPress Post Like System
Description: A simple and efficient post like system for WordPress.
Version: 0.2
Author: Jon Masterson
Author URI: http://jonmasterson.com/

License:
Copyright (C) 2014 Jon Masterson

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/


/**
 * (1) Save like data
 */
add_action('wp_ajax_nopriv_jm-post-like', 'melissa_jm_post_like');
add_action('wp_ajax_jm-post-like', 'melissa_jm_post_like');

function melissa_jm_post_like() {

  $nonce = $_POST['nonce'];
  if (!wp_verify_nonce($nonce, 'ajax-nonce')) {
    die ('Nope!');
  }

  if (isset($_POST['jm_post_like'])) {

    $post_id = $_POST['post_id']; // post id
    $post_like_count = get_post_meta($post_id, "_melissa_post_like_count", true); // post like count
    $ip = $_SERVER['REMOTE_ADDR']; // user IP address
    $meta_IPS = get_post_meta($post_id, "_melissa_user_IP"); // stored IP addresses
    $liked_IPS = ""; // set up array variable

    if (count($meta_IPS) != 0) { // meta exists, set up values
      $liked_IPS = $meta_IPS[0];
    }

    if (!is_array($liked_IPS)) { // make array just in case
      $liked_IPS = array();
    }

    if (!in_array($ip, $liked_IPS)) { // if IP not in array
      $liked_IPS['ip-'.$ip] = $ip; // add IP to array
    }

    if (!melissa_AlreadyLiked($post_id)) { // like the post

      update_post_meta($post_id, "_melissa_user_IP", $liked_IPS); // Add user IP to post meta
      update_post_meta($post_id, "_melissa_post_like_count", ++$post_like_count); // +1 count post meta
      echo intval($post_like_count); // update count on front end

    } else { // unlike the post

      $ip_key = array_search($ip, $liked_IPS); // find the key
      unset($liked_IPS[$ip_key]); // remove from array
      update_post_meta($post_id, "_melissa_user_IP", $liked_IPS); // Remove user IP from post meta
      update_post_meta($post_id, "_melissa_post_like_count", --$post_like_count); // -1 count post meta
      echo "already".intval($post_like_count); // update count on front end

    }

  }

  exit;
}

/**
 * (2) Test if user already liked post
 */
function melissa_AlreadyLiked($post_id) { // test if user liked before
  $meta_IPS = get_post_meta($post_id, "_melissa_user_IP"); // get previously voted IP address
  $ip = $_SERVER["REMOTE_ADDR"]; // Retrieve current user IP
  $liked_IPS = ""; // set up array variable

  if (count($meta_IPS) != 0) { // meta exists, set up values
    $liked_IPS = $meta_IPS[0];
  }

  if (!is_array($liked_IPS)) // make array just in case
    $liked_IPS = array();

  if (in_array($ip, $liked_IPS)) { // True is IP in array
    return true;
  }

  return false;
}

/**
 * (3) Front end button
 */
function melissa_getPostLikeLink($post_id) {
  $like_count = get_post_meta($post_id, "_melissa_post_like_count", true); // get post likes

  if ((!$like_count) || ($like_count && $like_count == "0")) { // no votes, set up empty variable
    $likes = '0';
  } elseif ($like_count && $like_count != "0") { // there are votes!
    $likes = intval($like_count);
  }

  $output = '<span class="jm-post-like">';
  $output .= '<a rel="nofollow" href="#" data-post_id="'.$post_id.'">';

  if (melissa_AlreadyLiked($post_id)) { // already liked, set up unlike addon
    $output .= '<span class="like prevliked"><i class="fa fa-heart"></i></span>';
    $output .= '<span class="count alreadyliked">'.$likes.'</span></a></span>';
  } else { // normal like button
    $output .= '<span class="like"><i class="fa fa-heart-o"></i></span>';
    $output .= '<span class="count">'.$likes.'</span></a></span>';
  }

  return $output;
}

/**
 * (4) Get count
 */
function melissa_getPostLikeCount($post_id) {
  $like_count = get_post_meta($post_id, "_melissa_post_like_count", true);
  return $like_count;
}
