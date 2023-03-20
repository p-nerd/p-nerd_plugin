<?php

namespace Inc;

class Super
{
    protected string $name;
    protected string $admin_ui_name;
    protected string $path;
    protected string $url;
    protected string $basename;
    protected string $file;
    protected string $rest_base;
    protected function __construct()
    {
        $this->path          = plugin_dir_path(dirname(__FILE__, 1));
        $this->url           = plugin_dir_url(dirname(__FILE__, 1));
        $this->basename      = P_NERD_PLUGIN_BASENAME;
        $this->file          = P_NERD_PLUGIN__FILE__;
        $this->name          = "p-nerd-plugin";
        $this->admin_ui_name = $this->name . "-admin";
        $this->rest_base     = "p-nerd/v1";
    }
    protected function render(string $template_name)
    {
        require_once $this->path . "templates/$template_name.php";
    }
}