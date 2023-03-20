<?php

namespace Inc;

final class Plugin extends Super
{
    private $services = [];

    function __construct()
    {
        parent::__construct();
        $this->services = [
            Pages\Admin::class,
            Base\Enqueue::class,
            Base\SettingsLinks::class,
        ];
    }
    function activate_plugin()
    {
        Base\Activator::activate();
    }

    function deactivate_plugin()
    {
        Base\Deactivator::deactivate();
    }
    function register_services()
    {
        register_activation_hook($this->file, [$this, 'activate_plugin']);
        register_deactivation_hook($this->file, [$this, 'deactivate_plugin']);

        foreach ($this->services as $class) {
            $service = new $class();
            if (method_exists($service, "register")) {
                $service->register();
            }
        }
    }
}