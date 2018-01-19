$(document).ready(function () {
    var geo = $('#map').attr('data-geo');
    var latlng = geo.split('|');
    if (latlng[0]) {
        var myLatlng1 = new google.maps.LatLng(latlng[0], latlng[1]);
        function initialize() {
            var mapOptions = {
                disableDefaultUI: true,
                zoom: 16,
                center: myLatlng1,
                scrollwheel: true,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
            }
            var map = new google.maps.Map(document.getElementById('map'), mapOptions);
            var marker = new google.maps.Marker({
                position: map.getCenter(),
                map: map,
                animation: google.maps.Animation.DROP,
            });
            var contentString = '<h2>' + latlng[2] + '</h2>';
            var infowindow = new google.maps.InfoWindow({
                content: contentString,
                maxWidth: 300
            });
            google.maps.event.addListener(marker, 'click', function () {
                infowindow.open(map, marker);
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    }
});
