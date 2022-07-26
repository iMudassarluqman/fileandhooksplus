<?php

/**
 * @package Files And Hooks Plus
 * @version 1.0
 */
/*
Plugin Name: Files And Hooks Plus
Description: This is plugin is made for developer which shows current page that you are on and also show hooks that current page is using..
Author:Mudassar Luqman
Version: 1.0
Author URI: https://www.linkedin.com/in/mudassar-luqman-b880531b8



This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2022 Automattic, Inc.

*/

defined('ABSPATH') || die();

class FileAndHooksPlus
{

  public function __construct()
  {
    add_filter('admin_bar_menu', array($this, 'adminBarMenu'), 99);
    // add_filter('admin_bar_menu', array($this, 'list_hooks'));
  }

  public function adminBarMenu()
  {
    global $wp_admin_bar;
    global $wp_filter;
    global $template;
    $template_name = "Template: " . basename($template);
    $detailedInfo = $template; //shows the directory of current template
    // // * shows current template args
    $args = array(
      'id'    => 'file-hooks-plus',
      'title' =>  $template_name,
      "meta" => array(
        'title' => __("Show Current Template")
      ),
    );
    $detailed_info = array(
      'parent' => 'file-hooks-plus',
      'title' => __("Full Path: " . $detailedInfo),
      'id' => 'detailed-info',

    );
    $theme_name = array(
      'parent' => 'file-hooks-plus',
      'title' => __("Theme Name: " . wp_get_theme()),
      'id' => 'theme-info',

    );
    $total_pages = array(
      'parent' => 'file-hooks-plus',
      'title' => __("Total Published Pages: " . count(get_pages())),
      'id' => 'total-pages',
    );

    $php_ver = array(
      'parent' => 'file-hooks-plus',
      'title' => __("Current Php Version: " . "<span style='color:lime';font:bold>" . phpversion() . "</span>"),
      'id' => 'php-ver',
    );

    if (!is_admin()) {
      $wp_admin_bar->add_menu($args);
      $wp_admin_bar->add_menu($detailed_info);
      $wp_admin_bar->add_menu($theme_name);
      $wp_admin_bar->add_menu($total_pages);
      $wp_admin_bar->add_menu($php_ver);
    }
  }
}

$fileandhooksplus = new FileAndHooksPlus;
