<?php
/*
Plugin Name: Embed Extras
Plugin URI: https://github.com/cogdog/embed-extras
Description: Enables a few more auto embeds for posts, pages, and SPLOTs.
Version: 0.15
License: GPLv2
Author: Alan Levine
Author URI: https://cog.dog
*/


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define('EMBED_EXTRAS_PLUGIN_VERSION', '0.15');

// scripts and styles get in the queue
add_action('wp_enqueue_scripts', 'embed_extras_enqueue_stuff');

function embed_extras_enqueue_stuff() {
	wp_enqueue_style( 'embed-extras' , plugin_dir_url( __FILE__ ) . 'css/embed-extras.css', null, EMBED_EXTRAS_PLUGIN_VERSION);

	wp_register_script( 'h5p-resizer', plugin_dir_url( __FILE__ ) . 'js/h5p-resizer.js' );
	wp_enqueue_script( 'h5p-resizer' );
}

add_action( 'init', 'embed_extras_register_embeds' );

// enable all available auto embeds, comment out any that you don't want allowed
//    as I am being lazy setting up options
function embed_extras_register_embeds() {

	// enable padlet as an oembed provider
	wp_oembed_add_provider( "https://padlet.com/*", "https://padlet.com/oembed/", false );

	// enable H5P.com content
	embed_extras_register_h5pcom();

	// enable eCampusOntario H5P studio
	embed_extras_register_h5p_ecampusontario();

	// enable internet archive
	embed_extras_register_archive_org();
}

// register embed handler for fpr H5P.com
function embed_extras_register_h5pcom() {

	$regex_url = '#^https://([a-z0-9]+)\.h5p\.com/content/([0-9]+)$#i';

	wp_embed_register_handler(
			'h5pcom',
			$regex_url,
			'embed_extras_handler_h5p_h5pcom'
	);
}

function embed_extras_handler_h5p_h5pcom( $matches, $attr, $url, $rawattr ) {

	$embed = sprintf(
		'<div class="h5p-embed"><iframe src="https://%1$s.h5p.com/content/%2$s/embed" width="700" height="577" frameborder="0" allowfullscreen="allowfullscreen"></iframe></div>', esc_attr($matches[1]) ,  esc_attr($matches[2])
	);

	return $embed;
}

// register embed handler for eCampusOntario H5P studio
function embed_extras_register_h5p_ecampusontario() {

	$regex_url = '#^https://h5pstudio\.ecampusontario\.ca/content/([0-9]+)$#i';

	wp_embed_register_handler(
			'h5p-ecampusontario',
			$regex_url,
			'embed_extras_handler_h5p_ecampusontario'
	);
}

function embed_extras_handler_h5p_ecampusontario( $matches, $attr, $url, $rawattr ) {

	$embed = sprintf(
		'<div class="h5p-embed"><iframe src="https://h5pstudio.ecampusontario.ca/h5p/%1$s/embed" width="894" height="314" frameborder="0" allowfullscreen="allowfullscreen"></iframe></div>',
		esc_attr($matches[1])
	);

	return $embed;
}

// register embed handler for Internet Archive Content
function embed_extras_register_archive_org(){

	$regex_url = '#^https://archive\.org/details/(.*)$#i';

	wp_embed_register_handler(
			'archive_org',
			$regex_url,
			'embed_extras_handler_archive_org'
	);
}

function embed_extras_handler_archive_org( $matches, $attr, $url, $rawattr ) {

	$embed = sprintf(
		'<div class="archive-org-embed"><iframe src="https://archive.org/embed//%1$s" width="640" height="480" style="border:none" frameborder="0" allowTransparency="true"></iframe>',
		esc_attr($matches[1])
	);

	return $embed;
}


add_action( 'admin_menu', 'embed_extras_add_page' );

function embed_extras_add_page() {
	// add to a new menu item Dashboard under Tools
	add_submenu_page( 'tools.php',  'About Embed Extras', 'Embed Extras', 'manage_options', 'embed-extras', 'embed_extras_admin_page');
}

function embed_extras_admin_page() {
	// displays info page for dashboard

?>
	<div class="wrap">
		<h2>About Embed Extras</h2>

		<p>This plugin (available at <a href="https://github.com/cogdog/wp-embed-extras" target="_blank">https://github.com/cogdog/wp-embed-extras</a>) extends the capabilities of automatic embedding of media content form external sites simply by pasting the URL in an editor. The sites supported are listed and described below; note that a few will work in the WordPress 5 Block Editor; others will only work in the classic editor (or classic block) or a front-end editor like <a href="http://splot.ca/">SPLOTs</a>. </p>

		<p>Current support exists for auto embedding content from (see notes below) <strong>Padlet</strong> (<a href="http://padlet.com/" target="_blank">padlet.com</a>), <strong>H5P.com</strong> (<a href="http://h5p.com/" target="_blank">h5p.com</a>), <strong>eCampusOntario H5P Studio</strong> (<a href="http://h5pstudio.ecampusontario.ca/" target="_blank">h5pstudio.ecampusontario.ca</a>), and the <strong>Internet Archive</strong> (<a href="http://archive.org/" target="_blank">archive.org</a>)</p>

		<p>If you want to see more sites supported, <a href="https://github.com/cogdog/wp-embed-extras/issues" target="_blank">submit an issue in GitHub</a>... If this kind of stuff has any value to you, please consider supporting me so I can do more!</p><p style="text-align:center"><a href="https://patreon.com/cogdog" target="_blank"><img src="https://cogdog.github.io/images/badge-patreon.png" alt="donate on patreon"></a> &nbsp; <a href="https://paypal.me/cogdog" target="_blank"><img src="https://cogdog.github.io/images/badge-paypal.png" alt="donate on paypal"></a></p> '

		<h3>Testing Embeds </h3>
		<form>

		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row">
						<label for="test">Test Area</label>

					</th>

					<td>
					<p class="description">Use the rich text editor to test the embedding capability.</p>
					<?php

						// set up for inserting the WP post editor
						$settings = array(
							'textarea_name' => 'embed_test',
							'teeny'			=> false,
							'media_buttons' => FALSE,
							'quicktags'		=> false,
						);

						wp_editor(  '', 'embed_test', $settings );
					?>
					</td>
				</tr>

			</tbody>
		</table>
		</form>
	</div>


		<h3>Services Supported in All Editors (including the Block Editor)</h3>

		<h4>Padlet (padlet.com)</h4>
		<p>All content published on Padlet can be automatically embedded by pasting in the URL for any published, public padlet content, for example <code>https://padlet.com/beckydono/48x1o4i4gi1s</code></p>

		<h3>Services Supported in Classic Editors Only</h3>
		<p>Content below is embedded directly only in the Classic Editor (or Classic Block). They will work as well in SPLOTs (after saving and on preview).</p>

		<h4>H5P</h4>

		<p>H5P content can be generated on many different sites, support for each must be added individually. Currently, this plugin supports:</p>

		<ul>
			<li>H5P.com via URLs like: <code>https://lumenlearning.h5p.com/content/1290512849455705778</code></li>
			<li>eCampusOntario's H5P Studio e.g. <code>https://h5pstudio.ecampusontario.ca/content/184</code> </li>
		</ul>
		<h4>Internet Archive (archive.org)</h4>
		<p>Embeds support for Audio, Video, Texts, even their collection of software.</p>

		<ul>
			<li><code>https://archive.org/details/atari_2600_frogger_1982_parker_brothers_ed_english_david_lamkins_pb5300</code></li>
		<li><code>https://archive.org/details/artofknitting00butt</code></li>
		<li><code>https://archive.org/details/Jolly_Fish_1932</code></li>
		<li><code>https://archive.org/details/AMFM2019-02-09</code></li>
		</ul>

	<?php
}

