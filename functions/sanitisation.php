<?php
/**
 * Sanitisation
 */

namespace Launchpad\Sanitisation;

add_filter(
	'wp_kses_allowed_html',
	function ( $tags ) {
		$tags['a']['aria-selected'] = array();
		$tags['section']['tabindex'] = array();
		$tags['svg'] = array(
			'xmlns' => array(),
			'fill' => array(),
			'viewbox' => array(),
			'role' => array(),
			'aria-hidden' => array(),
			'focusable' => array(),
			'class' => array(),
			'height' => array(),
			'width' => array(),
			'stroke' => array(),
			'stroke-width' => array(),
			'stroke-linecap' => array(),
			'stroke-linejoin' => array(),
		);
		$tags['path'] = array(
			'd' => array(),
			'fill' => array(),
		);
		$tags['use'] = array(
			'href' => array(),
			'xlink:href' => array(),
		);
		$tags['circle'] = array(
			'cx' => array(),
			'cy' => array(),
			'r' => array(),
		);
		$tags['polygon'] = array(
			'points' => array(),
		);
		$tags['iframe'] = array(
			'title' => array(),
			'allow' => array(),
			'src' => array(),
			'height' => array(),
			'width' => array(),
			'frameborder' => array(),
			'allowfullscreen' => array(),
			'referrerpolicy' => array(),
		);
		$tags['img']['draggable'] = array();
		return $tags;
	},
	10,
	2
);
