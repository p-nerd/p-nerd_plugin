<?php

namespace Inc\Api;

final class ProductsPostType
{
    function register()
    {
        add_action("init", [$this, "register_products_post_type"]);
    }
    function register_products_post_type()
    {
        $post_type = "products";
        $args      = [
            "labels" => [
                "name" => "Products",
                "singular_name" => "Product",
            ],
            "public" => true,
            "has_archive" => true,
        ];

        register_post_type($post_type, $args);
    }
}