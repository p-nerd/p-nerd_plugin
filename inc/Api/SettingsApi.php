<?php

namespace Inc\Api;

final class SettingsApi extends \Inc\Super
{
    private $admin_pages = [];
    function add_admin_page(array $menu)
    {
        $this->admin_pages[] = $menu;
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
            $sub_menu_title = empty($page["sub_menu_title"])
                ? $page["menu_title"]
                : $page["sub_menu_title"];
            array_unshift($page["sub_menus"], [
                "menu_title" => $sub_menu_title,
                "page_title" => $page["page_title"],
                "menu_slug" => $page["menu_slug"],
                "option_field_key" => "general"
            ]);
            $activation_data = get_option($page["option_field"]);
            foreach ($page["sub_menus"] as $sub_page) {
                if ($activation_data[$sub_page["option_field_key"]]) {
                    $parent_slug = $page["menu_slug"];
                    $page_title  = $sub_page["page_title"];
                    $menu_title  = $sub_page["menu_title"];
                    $capability  = $page["capability"];
                    $menu_slug   = $sub_page["menu_slug"];
                    $callback    = $page["callback"];

                    add_submenu_page(
                        $parent_slug,
                        $page_title,
                        $menu_title,
                        $capability,
                        $menu_slug,
                        $callback
                    );
                }
            }
        }
    }
}