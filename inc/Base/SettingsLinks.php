<?php

namespace Inc\Base;

final class SettingsLinks extends \Inc\Super
{
    function register()
    {
        add_filter("plugin_action_links_$this->basename", [$this, "setting_link"]);
    }
    function setting_link($links)
    {
        $menu_slug    = "p-nerd-plugin-settings";
        $setting_link = "<a href='admin.php?page=$menu_slug'>Settings</a>";
        $contact_me   = "<a href='mailto:shihab4t@gmail.com'>Mail</a>";

        $links[] = $setting_link;
        $links[] = $contact_me;

        return $links;
    }
}