<?php

/**
 * Plugin Name:       SB Category Based Free Shipping
 * Plugin URI:        n/a
 * Description:       Allows certain WooCommerce product categories to be flagged for free shipping. All products in said categories will be assigned free shipping on checkout.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Werner C. Bessinger
 * Author URI:        https://silverbackdev.co.za/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */

//  security check
if (!defined('ABSPATH')) :
    exit();
endif;

// constants
define('CBFS_PATH', plugin_dir_path(__FILE__));
define('CBFS_URL', plugin_dir_url(__FILE__));

// plugin load
add_action('plugins_loaded', 'cbfs_init');

function cbfs_init()
{
    // register polylang strings
    pll_register_string('cbfs_plugin', 'Offer free shipping for this category?');
    pll_register_string('cbfs_plugin', 'Specify whether or not free shipping should be offered on products in this category.');
    pll_register_string('cbfs_plugin', 'This product comes with free shipping!');
    pll_register_string('cbfs_plugin', 'Free Shipping');
    pll_register_string('cbfs_plugin', 'Yes');
    pll_register_string('cbfs_plugin', 'No');
    pll_register_string('cbfs_plugin', 'Please select...');

    // classes
    require_once CBFS_PATH.'classes/back.php';
    require_once CBFS_PATH.'classes/front.php';
}
