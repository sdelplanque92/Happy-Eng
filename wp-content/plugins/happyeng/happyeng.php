<?php
/**
 * Happy Eng
 *
 * @package           Happyeng
 * @author            Happy-Eng (Sébastien Delplanque)
 * @license           GPL-3.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Happyeng
 * Plugin URI:        https://happy-eng.fr
 * Description:       Adds custom functions
 * Version:           1.0
 * Requires at least: 6.2
 * Requires PHP:      7.2
 * Author:            Sébastien Delplanque
 * Author URI:        https://happy-eng.fr
 * Text Domain:       happyeng
 * License:           GPL v3 or later
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.txt
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 */

if (!defined('ABSPATH')) exit;

add_action('init', function () {
    register_block_type(__DIR__ . '/blocks/image-text');
    register_block_type(__DIR__ . '/blocks/text-image');
    register_block_type(__DIR__ . '/blocks/bullet-list');
    register_block_type(__DIR__ . '/blocks/hero');
});