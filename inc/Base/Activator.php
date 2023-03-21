<?php

namespace Inc\Base;

use Inc\Nm;

final class Activator
{
    static function activate()
    {
        if (!get_option(Nm::$activation_option_field_name)) {
            add_option(Nm::$activation_option_field_name, Nm::$activation_option_field_default_data);
        }
    }
}