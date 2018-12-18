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

class ALX_Weather
{
    protected $api_key = '&APPID=6d42fe5e407536a60abd6077b2095c55';

    protected $url     = 'http://api.openweathermap.org/data/2.5/weather';

    /**
     * @param string $template
     * @return mixed
     */
    public function getMapTemplate($template = 'TA2')
    {
        return $this->type_maps[$template];
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->api_key;
    }

    public static function test()
    {
        return PLUGIN_PATH;
    }

    public static function getDataApi()
    {
        $weather = new self;

        $city = '?q=San Francisco';
        $country_cod = 'us';

        $url  = $weather->getUrl() . $city . $country_cod . $weather->api_key;

        $content = file_get_contents($url);

        var_dump($content);
    }

}