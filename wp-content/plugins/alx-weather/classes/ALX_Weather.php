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

    public static function getGeoLocation()
    {
        $ip = '109.87.189.40';
        $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip.'?lang=ru'));
        if($query && $query['status'] == 'success') {
            return $query;
        } else {
           return false;
        }
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

        if(!$country_cod) {
            $url  = self::getUrl() . $city . self::$api_key;
        }
        else {
            $url  = self::getUrl() . $city . ',' . $country_cod . self::$api_key;
        }

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
        $tempCelsium = floor($data->main->temp - 273.15);
        $weather = $data->weather[0];
        $html .= '<div class="weather-info-wrapper">
                    <div class="weather-forecast-list__items-today">';

        $html .= '<div class="weather-forecast-list__item"> <img src="https://openweathermap.org/img/w/' . $weather->icon . '.png" alt="forecast" width="50" height="50">
                <span class="weather-forecast-list__day"> <span class="temperature-font">' . $tempCelsium . ' °C</span></span>
                <div class="weather-forecast-list__today-label">' . date('M d H:i') . ' <span class="cityName"> ' . $data->name . '</span></div>
                <div class="weather-forecast_description"> description: ' . $weather->description . '</div>
                </div>';
        $html .= '<div class="weather-forecast-list__item">
           
       <p class="weather-forecast-list__card">wind: ' . $data->wind->speed . ' m/s&nbsp;
       </div>
       <p><a class="toggle-form" href="#">Wrong location?</a></p>
       <div class="input-city-form">
       <input type="text" class="alx-city-name" name="city" placeholder="Enter your city"><input class="set-city" type="button" value="Submit">
       </div>';
        $html .= '</div></div>';

        return $html;
    }

}