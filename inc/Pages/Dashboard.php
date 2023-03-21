<?php

namespace Inc\Pages;

use Inc\Api\SettingsApi;

final class Dashboard extends \Inc\Super
{
    private SettingsApi $settings_api;
    function __construct()
    {
        parent::__construct();
        $this->settings_api = new SettingsApi();
    }
    function register()
    {
        $menus =
            [
                "page_title" => "PNerd Plugin",
                "menu_title" => "p-nerd",
                "capability" => "manage_options",
                "menu_slug" => "p-nerd-plugin-settings",
                "callback" => [$this, "admin_dashboard"],
                "icon_url" => "dashicons-menu",
                "sub_menu_title" => "General",
                "option_field" => "p_nerd_plugin_settings_activation",
                "sub_menus" => [
                    [
                        "menu_title" => "CPT",
                        "page_title" => "Custom Post Type Settings",
                        "menu_slug" => "p-nerd-plugin-settings-cpt",
                        "option_field_key" => "cpt"
                    ],
                    [
                        "menu_title" => "Taxonomies",
                        "page_title" => "Taxonomies Settings",
                        "menu_slug" => "p-nerd-plugin-settings-taxonomies",
                        "option_field_key" => "taxonomy"
                    ],
                    [
                        "menu_title" => "Widgets",
                        "page_title" => "Widgets Settings",
                        "menu_slug" => "p-nerd-plugin-settings-widgets",
                        "option_field_key" => "mediaWidget"
                    ],
                ]
            ];
        $this->settings_api
            ->add_admin_page($menus)
            ->render_admin_pages();
    }
    function admin_dashboard()
    {
        require_once $this->path . "dashboard/html.php";
    }
}