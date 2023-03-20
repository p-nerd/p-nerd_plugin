<?php

namespace Inc\Rest;

class SettingActivator extends \Inc\Super
{
    public string $option_name = "p_nerd_plugin_settings_activation";
    function register()
    {
        add_action('rest_api_init', [$this, 'create_rest_routes']);
        add_option($this->option_name, [
            "cpt" => true,
            "taxonomy" => true,
            "mediaWidget" => true,
            "general" => true,
        ]);

    }
    function create_rest_routes()
    {
        $url = "/settings-activations";
        register_rest_route($this->rest_base, $url, [
            'methods' => 'GET',
            'callback' => [$this, 'get_settings_activations_options'],
            'permission_callback' => [$this, 'get_settings_activations_permission'],
        ]);
        register_rest_route($this->rest_base, $url, [
            'methods' => 'POST',
            'callback' => [$this, 'save_settings_activations_options'],
            'permission_callback' => [$this, 'save_settings_activations_permission'],
        ]);
    }
    function get_settings_activations_permission()
    {
        return current_user_can('publish_posts');
    }
    function get_settings_activations_options()
    {
        $data     = get_option("p_nerd_plugin_settings_activation");
        $response = $data;
        return rest_ensure_response($response);
    }
    function save_settings_activations_permission()
    {
        return current_user_can('publish_posts');
    }
    function save_settings_activations_options($req)
    {

        $data = array_map('rest_sanitize_boolean', $req['data']);
        update_option($this->option_name, $data);
        return rest_ensure_response($data);
    }
}