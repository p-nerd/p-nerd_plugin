<?php

/**
 * PNerd Plugin
 *
 * @package           PNerdPlugin
 * @author            Shihab Mahamud
 * @copyright         2023 Shihab Mahamud
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       PNerd Plugin
 * Plugin URI:        https://github.com/p-nerd/p-nerd-plugin
 * Description:       I will be learn Wordpress plugin development with this plugin
 * Version:           1.0.0
 * Requires at least: 6.0
 * Requires PHP:      8.0
 * Author:            Shihab Mahamud
 * Author URI:        https://github.com/p-nerd
 * Text Domain:       p-nerd-plugin
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Update URI:        https://github.com/p-nerd/p-nerd-plugin
 */

/*
PNerd Plugin is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
PNerd Plugin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with PNerd Plugin. If not, see http://www.gnu.org/licenses/gpl-2.0.txt.
*/

defined("ABSPATH") || die();

if (file_exists(dirname(__FILE__) . "/vendor/autoload.php")) {
    require_once dirname(__FILE__) . "/vendor/autoload.php";
}

define("P_NERD_PLUGIN_BASENAME", plugin_basename(__FILE__));
define("P_NERD_PLUGIN__FILE__", __FILE__);

if (class_exists("Inc\\Plugin")) {
    $plugin = new Inc\Plugin();
    $plugin->register_services();
}