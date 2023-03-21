<?php

namespace Inc;

class Nm
{
    static string $activation_option_field_name = "p_nerd_plugin_settings_activation";
    static string $rest_base = "p-nerd/v1";
    static array $activation_option_field_default_data = [
        "cpt" => true,
        "taxonomy" => true,
        "mediaWidget" => true,
        "general" => true,
    ];
}