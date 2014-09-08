<?php
/*
    Plugin Name: WP Twitter Cards Shop
    Plugin Script: twittercards.php
    Plugin URI: https://www.websecuritydev.com
    Description: Add Cards Twitter Shop
    Author: Dylan Irzi
    Donate Link: 
    License: GPL    
    Version: 0.1 Beta
    Author URI: https://www.websecuritydev.com
    Text Domain: WebSecurityDev
    Domain Path: languages/
*/

/*  Copyright 2014 Dylan Irzi  (https://www.websecuritydev.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
add_action('wp_head', 'meta_twitter_card_shop');

include ('twitter-class.php');


function meta_twitter_card_shop(){
	$postid = get_the_ID(); 
    $title = get_the_title() ." &lsaquo; ". get_bloginfo( "name", "display" );
	$options = get_option( 'cards_options' );
	$value = $options['twitter_username'];
    $src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), array( 90,55 ), false, "" ); 

    $face_metad = get_post_meta(get_the_ID(), "metadescription", true);

    $twitter_metad = get_post_meta(get_the_ID(), "metadescription140", true);
	
	$prices = get_post_meta($postid, '_price', true); 
	
	$domain = get_site_url();
	$domain_filter = str_replace("http://", "", $domain);
	
    if (empty($twitter_metad)) 
        $twitter_metad = $face_metad;

    //Close PHP tags 
    ?>    
	<!-- Twitter Cards Shops -->
	<meta name="twitter:card" content="product">
	<meta name="twitter:site" content="<?php echo $value; ?>">
	<meta name="twitter:creator" content="<?php echo $value; ?>">
	<meta name="twitter:domain" content="<?php echo $domain_filter; ?>">
	<meta name="twitter:title" content="<?php echo esc_attr($title); ?>" />
	<meta name="twitter:image" content="<?php echo esc_attr($src[0]); ?>" />
	<meta name="twitter:label1" content="Precio">
	<meta name="twitter:data1" content="<?php echo $prices; ?>">
	<meta name="twitter:label2" content="Marca">
	<meta name="twitter:data2" content="<?php echo esc_attr($title); ?>">
	<meta name="twitter:url" content="<?php the_permalink(); ?>" />
	<meta name="twitter:description" content="<?php if (!empty($twitter_metad)) echo esc_attr($twitter_metad); else the_excerpt(); ?>" />
	<!-- Twitter Cards Shops -->
    <?php 
}
?>