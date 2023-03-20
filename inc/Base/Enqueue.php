<?php

namespace Inc\Base;

final class Enqueue extends \Inc\Super
{
    function register()
    {
        add_action("admin_enqueue_scripts", [$this, "enqueue_admin_stuff"], 99);
    }
    function enqueue_admin_stuff()
    {
        $this->enqueue_admin_style();
        $this->enqueue_admin_scripts();
    }
    function enqueue_admin_style()
    {
        $handle = $this->admin_ui_name;
        $src    = $this->url . "admin/build/index.css";
        $deps   = [];
        $media  = "all";

        wp_enqueue_style($handle, $src, $deps, $media);
    }
    function enqueue_admin_scripts()
    {
        $handle    = $this->admin_ui_name;
        $src       = $this->url . "admin/build/index.js";
        $deps      = ["wp-element"];
        $random    = rand();
        $in_footer = true;

        wp_enqueue_script($handle, $src, $deps, $random, $in_footer);

        wp_localize_script($handle, 'appLocalizer', [
            'apiUrl' => home_url("/wp-json/$this->rest_base"),
            'nonce' => wp_create_nonce('wp_rest'),
        ]);
    }
}