jQuery(document).ready(function($) {
    var results = {
        'city': 'San Francisco',
        'country': 'us',
    };

    if(confirm("Confirm your location")){
        $.get("https://ipinfo.io", function(response) {
            results.city = response.city;
            results.country = response.country;
        }, "jsonp");
    }

    $.ajax({
        type: 'post',
        url: '/wp-admin/admin-ajax.php',
        dataType: 'json',
        data: {action: 'get_weather_for_widget', 'city': results.city, 'country': results.country},
        success: function(data) {
            console.log(data);
        }
    });
});





