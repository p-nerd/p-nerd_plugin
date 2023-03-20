<?php

namespace Inc\Pages;

use Inc\Api\SettingsApi;
use Inc\Super;

final class Admin extends Super
{
    private SettingsApi $settings_api;
    function __construct()
    {
        parent::__construct();
        $this->settings_api = new SettingsApi;
    }
    function register()
    {
        $menus     = [
            [
                "page_title" => "PNerd Plugin",
                "menu_title" => "p-nerd",
                "capability" => "manage_options",
                "menu_slug" => "p-nerd-plugin-settings",
                "callback" => [$this, "admin_dashboard"],
                "icon_url" => "dashicons-menu",
                "sub_menu_title" => "General",
                "option_field" => "p_nerd_plugin_settings_activation"
            ],
        ];
        $sub_menus = [
            [
                "parent_slug" => $menus[0]["menu_slug"],
                "menu_title" => "CPT",
                "page_title" => "Custom Post Type Settings",
                "capability" => "manage_options",
                "menu_slug" => "p-nerd-plugin-settings-cpt",
                "callback" => [$this, "admin_dashboard"],
                "option_key" => "cpt"
            ],
            [
                "parent_slug" => $menus[0]["menu_slug"],
                "menu_title" => "Taxonomies",
                "page_title" => "Taxonomies Settings",
                "capability" => "manage_options",
                "menu_slug" => "p-nerd-plugin-settings-taxonomies",
                "callback" => [$this, "admin_dashboard"],
                "option_key" => "taxonomy"
            ],
            [
                "parent_slug" => $menus[0]["menu_slug"],
                "menu_title" => "Widgets",
                "page_title" => "Widgets Settings",
                "capability" => "manage_options",
                "menu_slug" => "p-nerd-plugin-settings-widgets",
                "callback" => [$this, "admin_dashboard"],
                "option_key" => "mediaWidget"
            ],
        ];
        $this->settings_api
            ->add_admin_pages($menus)
            ->add_admin_sub_pages($sub_menus)
            ->render_admin_pages();
    }
    function admin_dashboard()
    {
        require_once $this->path . "admin/html.php";
    }
}