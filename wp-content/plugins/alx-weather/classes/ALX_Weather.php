<?php


class ALX_Weather
{
    protected static $api_key = '&APPID=6d42fe5e407536a60abd6077b2095c55';

    protected static $url     = 'http://api.openweathermap.org/data/2.5/weather';


    /**
     * @return string
     */
    public static function getUrl()
    {
        return self::$url;
    }

    /**
     * @return string
     */
    public static function getApiKey()
    {
        return self::$api_key;
    }

    /**
     * @param $dataCity
     * @param $dataCountry
     * @return bool|string
     */
    public static function getDataApi($dataCity, $dataCountry)
    {
        $city = '?q=' . $dataCity;
        $country_cod = $dataCountry;

        $url  = self::getUrl() . $city . ',' . $country_cod . self::$api_key;

        $content = json_decode(stripslashes(file_get_contents($url)));

        return self::displayWeather($content);

    }

    /**
     * @param $jsonData
     * @return string
     */
    public static function displayWeather($data)
    {
        $html = '';
        /* [°C] = [K] − 273.15 */
        //$tempCelsium = ceil($data->temp - 273.15, 0);
        /*var html = '<div class="weather-info-wrapper">';
        /*<div class="weather-forecast-list__items-today">
                <div class="weather-forecast-list__item">Sat 29 Dec<img src="//openweathermap.org/img/w/13d.png" alt="forecast">
                <div class="weather-forecast-list__today-label">Today</div>
                </div>
                <td class="weather-forecast-list__item">
                <p class="weather-forecast-list__card">
                <span class="weather-forecast-list__day">-1 °C</span>
            <span class="weather-forecast-list__night">-3.2 °C</span>&nbsp;&nbsp;<i class="weather-forecast-list__naturalPhenomenon">light snow</i>
            </p>
            <p class="weather-forecast-list__card">3.51 m/s&nbsp;
        <br>clouds: 92 %,&nbsp;&nbsp;1018.47 hpa</p>
            </td>
            </div>*/
        /*html += '</div>';*/
        $html = $data;
        return $html;
    }

}