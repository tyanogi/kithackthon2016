<!DOCTYPE html>
<?php
require_once('system/require.php');

?>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>gmapsサンプル</title>
    <style>
        @charset "utf-8";
        #map {
            height: 400px;
        }
    </style>
    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script src="./js/gmaps.js"></script>
    <script>
        window.onload = function(){
            var lat = 36.502931;
            var lng = 136.617579;
            var map = new GMaps({
                div: "#map",
                lat: 36.502931,
                lng: 136.617579,
                zoom: 15
            });
 
            map.addMarker({
                lat: lat,
                lng: lng,
                title: "LIG",
                icon: "./image/m.png",
                infoWindow: {
                    content: "<p>LIGは<br/>ココだよ!</p>"
                }
            });
        };
    </script>
</head>
<body>
<div id="map"></div>
</body>
</html>