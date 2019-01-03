jQuery(document).ready(function($) {
    var results = {
        'city': 'San Francisco',
        'country': 'us',
    };

    var ajax_request = function() {
        $.ajax({
            type: 'post',
            url: '/wp-admin/admin-ajax.php',
            dataType: 'html',
            data: {action: 'get_weather_for_widget', 'city': results.city, 'country': results.country},
            success: function(data) {
                $('.output-weather').html(data);
            }
        });
    };

    if(confirm("Confirm your location")){
        $.get("http://ip-api.com/json/", function(response) {
            results.city = response.city;
            results.country = response.country;
            ajax_request();
        }, "jsonp");
    }
    else {
        ajax_request();
    }

});





