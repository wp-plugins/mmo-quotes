<?php
/*
Plugin Name: MMO Quotes
Plugin URI: http://www.letsgoachieve.com/mmo-quotes/
Description: MMO Block Quotes
Version: 0.2
Date: September 22, 2012
Author: Tenda
Author URI: http://www.letsgoachieve.com
License: GPL3
*/

function wowquote_func($atts, $content) {

    extract(shortcode_atts(array(
        'author' => '',
        'title' => '',
        'url' => '',),$atts));

    $bpurl = plugins_url('/bp.gif', __FILE__);

    $format = array(
    "BlockOpen" => "<blockquote style='background-color:#333;color:#00C0FF; padding:1em 1.5em;margin:0.5em 1.5em 1em;-moz-border-radius:5px;border-radius:5px;-webkit-border-radius:5px;'>",
    "PosterOpen" => "<img border='0' alt='Blizzard Poster' src='".$bpurl."' /><strong>",
    "PosterClose" => "</strong>",
    "TitleOpen" => "<span style='font-weight:bold; color:white;'>",
    "TitleClose" => "</span>",
    "URLOpen" => " (<a style='color:orange;' href='",
    "CloseAtts" => "<p>",
    "BlockClose" => "</p></blockquote>");

    $content = quoteIt($atts, $content, $format);

    return $content;
}

function lolquote_func($atts, $content) {

	extract(shortcode_atts(array(
		'author' => '',
		'title' => '',
		'url' => '',),$atts));
		
	$rpurl = plugins_url('/rp.gif',__FILE__);
	
	$format = array(
	"BlockOpen" => "<blockquote style='background-color:#F8F0D0;color:#000; padding:1em 1.5em;margin:0.5em 1.5em 1em;-moz-border-radius:5px;border-radius:5px;-webkit-border-radius:5px;'>",
	"PosterOpen" => "<img border='0' alt='Riot Poster' src='".$rpurl."' /><strong><span style='color:#F00;'>",
    "PosterClose" => "</span></strong>",
    "TitleOpen" => "<span style='font-weight:bold; color:black;'>",
    "TitleClose" => "</span>",
    "URLOpen" => " (<a style='color:#0058C6;' href='",
    "CloseAtts" => "<p>",
    "BlockClose" => "</p></blockquote>");

    $content = quoteIt($atts, $content, $format);

    return $content;
}

function quoteIt($atts, $content, $format) {

    $return = $format["BlockOpen"];
    if ($atts["author"] != '') {
        $return = $return . $format["PosterOpen"] . esc_html($atts["author"]) . $format["PosterClose"];
    }
    if ($atts["author"] != '' && $atts["title"] != '') { 
        $return = $return . " on ";
    }
    if ($atts["title"] != '') {
        $return = $return . $format["TitleOpen"] . esc_html($atts["title"]) . $format["TitleClose"];
    }
    if ($atts["url"] != '') {
        $return = $return . $format["URLOpen"] . esc_url($atts["url"]) . "'>Source</a>)";
    }
    
    $return = $return . $format["CloseAtts"] . $content . $format["BlockClose"];

    return $return;
}

add_shortcode('wowquote', 'wowquote_func');
add_shortcode('lolquote', 'lolquote_func');

?>