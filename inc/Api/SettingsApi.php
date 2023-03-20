<?php

namespace Inc\Api;

use Inc\Super;

final class SettingsApi extends Super
{
    private $admin_pages = [];
    private $admin_sub_pages = [];
    function add_admin_pages(array $admin_pages)
    {
        $this->admin_pages = $admin_pages;
        foreach ($admin_pages as $page) {
            $this->admin_sub_pages[] = [
                "parent_slug" => $page["menu_slug"],
                "page_title" => $page["page_title"],
                "menu_title" => empty($page["sub_menu_title"]) ? $page["menu_title"] : $page["sub_menu_title"],
                "capability" => $page["capability"],
                "menu_slug" => $page["menu_slug"],
                "callback" => $page["callback"],
                "option_key" => "general"
            ];
        }
        return $this;
    }
    function add_admin_sub_pages(array $admin_sub_pages)
    {
        $this->admin_sub_pages = array_merge(
            $this->admin_sub_pages,
            $admin_sub_pages
        );
        return $this;
    }
    function render_admin_pages()
    {
        if (!empty($this->admin_pages)) {
            add_action("admin_menu", [$this, "add_admin_menu"]);
        }
        return $this;
    }
    function add_admin_menu()
    {
        foreach ($this->admin_pages as $page) {
            add_menu_page(
                $page["page_title"],
                $page["menu_title"],
                $page["capability"],
                $page["menu_slug"],
                $page["callback"],
                $page["icon_url"]
            );
        }
        if (!empty($this->admin_sub_pages)) {
            $activation_data = get_option("p_nerd_plugin_settings_activation");
            foreach ($this->admin_sub_pages as $sub_page) {
                if ($activation_data[$sub_page["option_key"]])
                    add_submenu_page(
                        $sub_page["parent_slug"],
                        $sub_page["page_title"],
                        $sub_page["menu_title"],
                        $sub_page["capability"],
                        $sub_page["menu_slug"],
                        $sub_page["callback"]
                    );
            }
        }
    }
}