<?php

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our theme. We will simply require it into the script here so that we
| don't have to worry about manually loading any of our classes later on.
|
*/

if (!file_exists($composer = __DIR__ . '/vendor/autoload.php')) {
    wp_die(__('Error locating autoloader. Please run <code>composer install</code>.', 'sage'));
}

require $composer;

/*
|--------------------------------------------------------------------------
| Register The Bootloader
|--------------------------------------------------------------------------
|
| The first thing we will do is schedule a new Acorn application container
| to boot when WordPress is finished loading the theme. The application
| serves as the "glue" for all the components of Laravel and is
| the IoC container for the system binding all of the various parts.
|
*/

if (!function_exists('\Roots\bootloader')) {
    wp_die(
        __('You need to install Acorn to use this theme.', 'sage'),
        '',
        [
            'link_url' => 'https://roots.io/acorn/docs/installation/',
            'link_text' => __('Acorn Docs: Installation', 'sage'),
        ]
    );
}

\Roots\bootloader()->boot();

/*
|--------------------------------------------------------------------------
| Register Sage Theme Files
|--------------------------------------------------------------------------
|
| Out of the box, Sage ships with categorically named theme files
| containing common functionality and setup to be bootstrapped with your
| theme. Simply add (or remove) files from the array below to change what
| is registered alongside Sage.
|
*/

collect(['setup', 'filters'])
    ->each(function ($file) {
        if (!locate_template($file = "app/{$file}.php", true, true)) {
            wp_die(
                /* translators: %s is replaced with the relative file path */
                sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file)
            );
        }
    });


// function get_coingecko_data()
// {
//     $api_url = 'https://api.coingecko.com/api/v3/coins/list';

//     $response = wp_remote_get($api_url);

//     if (is_array($response) && !is_wp_error($response)) {
//         $data = json_decode($response['body'], true);

//         return $data;
//     } else {
//         return false;
//     }
// }


function get_coingecko_data()
{
    // Path to the JSON file relative to functions.php
    $json_file_path = get_template_directory() . '/resources/db/coins.json';

    // Check if the file exists
    if (file_exists($json_file_path)) {
        // Read the contents of the JSON file
        $json_data = file_get_contents($json_file_path);

        // Decode the JSON data
        $data = json_decode($json_data, true);

        // Return the decoded data
        return $data;
    } else {
        // If the file doesn't exist, return false or handle it as needed
        return false;
    }
}


function get_top_10_cryptos()
{
    $api_url = 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=eur&order=market_cap_desc&per_page=10&page=1&sparkline=false&locale=en';

    $response = wp_remote_get($api_url);

    if (is_array($response) && !is_wp_error($response)) {
        $data = json_decode($response['body'], true);

        return $data;
    } else {
        return false;
    }
}
