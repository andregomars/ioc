<?php

/**
* Display the page where the slugs could be regenerated or replaced
*/
class Permalink_Manager_Upgrade extends Permalink_Manager_Class {

	public function __construct() {
		if(!defined('PERMALINK_MANAGER_PRO')) {
			add_filter( 'permalink-manager-sections', array($this, 'add_upgrade_section'), 1 );
		}
	}

	public function add_upgrade_section($admin_sections) {
		$admin_sections['upgrade'] = array(
			'name'				=>	__('Upgrade to PRO', 'permalink-manager'),
			'function'    => array('class' => 'Permalink_Manager_Upgrade', 'method' => 'output')
		);

		return $admin_sections;
	}

	public function output() {
		$output = sprintf("<h3>%s</h3>", __("Permalink Manager Pro features", "permalink-manager"));
		$output .=	sprintf("<p class=\"lead\">%s</p>", __('Take full control of your permalinks. Easily edit terms permalinks, use custom fields inside the URLs and automatically remove "stop words" from your web addresses!', 'permalink-manager'));

		$output .= "<div class=\"columns-container\">";
		$output .= "<div class=\"column-1_3\">";
		$output .= sprintf("<h5>%s</h5>", __("Full Taxonomy Support", "permalink-manager"));
		$output .= wpautop(__("With Permalink Manager Pro you can easily alter the default taxonomies’ permastructures & edit the full permalink of all the categories, tags and custom taxonomies terms!", "permalink-manager"));
		$output .= wpautop(__("You can also bulk edit the taxonomies permalinks with bulk tools (“Find & replace” and “Regnerate/reset”) and remove “stop words” from their default URIs!", "permalink-manager"));
		$output .= "</div>";
		$output .= "<div class=\"column-1_3\">";
		$output .= sprintf("<h5>%s</h5>", __("Full WooCommerce Support", "permalink-manager"));
		$output .= wpautop(__("Adjust your shop, product category, single product permalinks to suit your needs!", "permalink-manager"));
		$output .= wpautop(__("Remove <em>product-category</em>, <em>product-tag</em> and <em>product</em> or replace them with any tailored permastructures. Set completely custom permalinks for each product &#038; product taxonomies individually.", "permalink-manager"));
		$output .= "</div>";
		$output .= "<div class=\"column-1_3\">";
		$output .= sprintf("<h5>%s</h5>", __("Stop words & custom fields inside permalinks", "permalink-manager"));
		$output .= wpautop(__("Set your own list of stop words or use a predefined one available in 21 languages. All the words will be automatically removed from default URIs.", "permalink-manager"));
		$output .= wpautop(__("Would you like to automatically embed your custom fields value inside the permalinks? Now, it is easy - all you need to do is to insert the tag with the custom field key name to the permastructure.", "permalink-manager"));
		$output .= "</div>";
		$output .= "</div>";

		$output .= sprintf("<p><a class=\"button button-default margin-top\" href=\"%s\" target=\"_blank\">%s</a>&nbsp;&nbsp;<a class=\"button button-primary margin-top\" href=\"%s\" target=\"_blank\">%s</a></p>", PERMALINK_MANAGER_WEBSITE, __("More info about Permalink Manager Pro"), "https://gumroad.com/l/permalink-manager", __("Buy Permalink Manager Pro"));

		return $output;
	}

}
