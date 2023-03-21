<?php

use Inc\Nm;

final class Uninstall
{
    function __construct()
    {
        delete_option(Nm::$activation_option_field_name);
    }
}

new Uninstall();