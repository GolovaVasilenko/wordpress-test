<?php

/**
Plugin Name: ALX Weather
Plugin URI: http://lanars.com
Description: Отображение погоды на странице сайта.
Version: 1.0
Author: Aleksej Vasilenko
Author URI: http://lanars.com
*/

define("PLUGIN_PATH", __DIR__);

include_once PLUGIN_PATH . "/classes/ALX_Weather.php";
include_once PLUGIN_PATH . "/classes/ALX_Widget.php";

add_action( 'wp_enqueue_scripts', 'alx_weather_scripts' );

add_action('wp_ajax_get_weather_for_widget', 'alx_get_weather_for_widget');
add_action('wp_ajax_nopriv_get_weather_for_widget', 'alx_get_weather_for_widget');

add_action('wp_ajax_get_weather_for_form', 'alx_get_weather_for_form');
add_action('wp_ajax_nopriv_get_weather_for_form', 'alx_get_weather_for_form');

function alx_weather_scripts()
{
    wp_enqueue_style('alx-weather-style', plugin_dir_url(__FILE__) . 'assets/css/style.css');
    wp_enqueue_script('alx-weather-script', plugin_dir_url(__FILE__) . 'assets/js/scripts.js', array( 'jquery' ), time(), true );
}

function alx_register_widget() {
    register_widget( 'ALX_Widget' );
}

add_action( 'widgets_init', 'alx_register_widget' );

function alx_get_weather_for_widget()
{
    if(empty($_POST))
        return false;

    $post = $_POST;

    $apiData = ALX_Weather::getDataApi($post['city'], $post['country']);
    echo $apiData;
    wp_die();
}

function alx_get_weather_for_form()
{
    if(empty($_POST))
        return false;

    $post = $_POST;

    $apiData = ALX_Weather::getDataApi($post['city'], null);
    echo $apiData;
    wp_die();
}