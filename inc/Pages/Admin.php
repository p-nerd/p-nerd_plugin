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
                "page_title" => "p-nerd Plugin",
                "menu_title" => "p-nerd",
                "capability" => "manage_options",
                "menu_slug" => "p-nerd-plugin-settings",
                "callback" => [$this, "admin_dashboard"],
                "icon_url" => "dashicons-menu",
                "sub_menu_title" => "General"
            ],
        ];
        $sub_menus = [
            [
                "parent_slug" => $menus[0]["menu_slug"],
                "page_title" => "sub menu page",
                "menu_title" => "sub menu menu title",
                "capability" => "manage_options",
                "menu_slug" => "p-nerd-plugin-settings-sub",
                "callback" => [$this, "admin_dashboard"]
            ]
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