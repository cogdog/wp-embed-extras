<?php
/*
Plugin Name: Cogdog Auto Embed Extras
Plugin URI: https://github.com/cogdog/embed-extras
Description: Enables a few more auto embeds for padlet, Internet Archive audio/video, Vocaroo, Sodphonic, Mastodon
Version: 0.4
License: GPLv2
Author: Alan Levine
Author URI: https://cog.dog
*/


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define('EMBED_EXTRAS_PLUGIN_VERSION', '0.2');

// scripts and styles get in the queue
add_action('wp_enqueue_scripts', 'embed_extras_enqueue_stuff');

function embed_extras_enqueue_stuff() {
	wp_enqueue_style( 'embed-extras' , plugin_dir_url( __FILE__ ) . 'css/embed-extras.css', null, EMBED_EXTRAS_PLUGIN_VERSION);

	wp_register_script( 'h5p-resizer', plugin_dir_url( __FILE__ ) . 'js/h5p-resizer.js' );
	wp_enqueue_script( 'h5p-resizer' );
}

add_action( 'init', 'embed_extras_register_embeds' );

function embed_extras_register_embeds() {

	// enable padlet as an oembed provider
	wp_oembed_add_provider( "https://padlet.com/*", "https://padlet.com/oembed/", false );

	// enable internet archive
	wp_embed_register_handler(
		'archive_org',
		'#^https://archive\.org\/details\/(.*)$#i',
		'embed_extras_handler_archive_org'
	);
	
	// handler for vocaroo audio
	wp_embed_register_handler(
		'vocaroo',
		'#^https?:\/\/(vocaroo\.com|voca\.ro)\/([a-zAA-Z0-9]+)$#i',
		'embed_extras_handler_vocaroo'
	);
	
	// handler for sodaphonic boombox audio
		
	wp_embed_register_handler(
		'sodaphonic',
		'#^https?:\/\/sodaphonic.com\/audio\/([a-zAA-Z0-9]+)(.*)$#i',
		'embed_extras_handler_sodaphonic'
	);


	// handler for mastodons
		
	wp_embed_register_handler(
		'mastodon',
		'#^https?:\/\/((?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9])\/@([a-zA-Z0-9\_]+)\/(\d+)$#i',
		'embed_extras_handler_mastodon'
	);


}


function embed_extras_handler_archive_org( $matches, $attr, $url, $rawattr ) {

	$embed = sprintf(
		'<div class="archive-org-embed"><iframe src="https://archive.org/embed/%1$s" width="640" height="480" style="border:none" frameborder="0" allowTransparency="true"></iframe>',
		esc_attr($matches[1])
	);

	return $embed;
}


function embed_extras_handler_vocaroo( $matches, $attr, $url, $rawattr ) {

	$embed = '<iframe  width="100%" height="60" src="https://vocaroo.com/embed/' . esc_attr($matches[2]) .' ?autoplay=0" frameborder="0" allow="autoplay"></iframe>';

	return $embed;
}

function embed_extras_handler_sodaphonic( $matches, $attr, $url, $rawattr ) {

	$embed = '<iframe width="100%" height="156" scrolling="no" frameborder="no" allow="autoplay" src="https://sodaphonic.com/embed/' . esc_attr($matches[1]) .'"></iframe>';
	
	return $embed;
}

function embed_extras_handler_mastodon( $matches, $attr, $url, $rawattr ) {

	$embed = '<iframe src="https://' . esc_attr($matches[1]) . '/@' . esc_attr($matches[2]) . '/' . esc_attr($matches[3]) . '/embed" class="mastodon-embed" style="max-width: 100%; border: 0" width="400" allowfullscreen="allowfullscreen"></iframe><script src="https://' . esc_attr($matches[1]) . '/embed.js" async="async"></script>';

	return $embed;
}



?>