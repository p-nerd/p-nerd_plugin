<?php

namespace Inc\Rest;

use Inc\Nm;

final class SettingActivator
{
    function register()
    {
        add_action('rest_api_init', [$this, 'create_rest_routes']);
    }
    function create_rest_routes()
    {
        $route_url = "/settings-activations";
        register_rest_route(Nm::$rest_base, $route_url, [
            'methods' => 'GET',
            'callback' => [$this, 'get_settings_activations_options'],
            'permission_callback' => [$this, 'get_settings_activations_permission'],
        ]);
        register_rest_route(Nm::$rest_base, $route_url, [
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
        $data     = get_option(Nm::$activation_option_field_name);
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
        update_option(Nm::$activation_option_field_name, $data);
        return rest_ensure_response($data);
    }
}