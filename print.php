<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
   <title>Google Maps V3</title>
   <meta http-equiv="content-type" content="text/html; charset=utf-8" />
   <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
   <script type="text/javascript" src="./js/index.js"></script>
</head>
<body>
   <div id="gmap" style="width: 500px; height: 370px; border: 1px solid Gray;">
   </div>
</body>
</html> -->

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Faceboot - A Facebook style template for Bootstrap</title>
    <meta name="generator" content="Bootply" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link href="./css/styles.css" rel="stylesheet">
    <link href="./css/print.css" rel="stylesheet">
    <!-- script references -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/scripts.js"></script>
    <script type="text/javascript" src="./js/jquery.jPrintArea.js"></script>
<?php

require_once('./system/require.php');

$inst = new SYS_Placeinfo();
// $result = $inst->addGenre("testMain", "testSub");
//$post = array('genreMain'=>'main', 'genreSub'=>'sub');
$result = $inst->getAllPlaceinfo();

?>


    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
   <script type="text/javascript">

        var markerObj; 
        var mapObj; 
         markers = [];

       google.maps.event.addDomListener(window, 'load', function()
       {
           window.openedWindow = null
           var lng = 136.617477;
           var lat = 36.503212;

           var latlng = new google.maps.LatLng(lat, lng);
           var mapOptions = {
               zoom: 15,
               center: latlng,
               mapTypeId: google.maps.MapTypeId.ROADMAP,
               scaleControl: true,
               keyboardShortcuts: false,
               scrollwheel: false,
               draggable: false,
           };
           var mapObj = new google.maps.Map(document.getElementById('gmap'), mapOptions);


           // // マーカー画像を作成
           // var markerImg = new google.maps.MarkerImage(
           //     // マーカーの画像URL
           //     "http://blog-imgs-44.fc2.com/p/c/r/pcrice/mark2.png",

           //     // マーカーのサイズ
           //     new google.maps.Size(20, 24),
           //     // 画像の基準位置
           //     new google.maps.Point(0, 0),
           //     // Anchorポイント
           //     new google.maps.Point(10, 24)
           // );

           // TODO: DBから値が撮れるようになったら以下のダミーデータは削除する
           // ダミーデータ(JSON形式、JavaScriptオブジェクト形式)
           var places = [];
           places = <?php echo json_encode($result, JSON_PRETTY_PRINT);?>
//           places = [
//             {id: 0, name: "テストデータ1", latitude: 36.535706,  longitude: 136.631087, genre_id: 1 },
//              {id: 1, name: "テストデータ2", latitude: 36.532131,  longitude: 136.624884, genre_id: 2 },
//              {id: 2, name: "テストデータ3", latitude: 36.529412,  longitude: 136.634395, genre_id: 3 },
//              {id: 3, name: "テストデータ4", latitude: 36.529406,  longitude: 136.629721, genre_id: 4 },
//           ];

            // dbのデータからマーカーを落とす
             var i, j, len, place, icon;
             markers = [];
            var infoWindows = [];
            for (i = j = 0, len = places.length; j < len; i = ++j) {
              place = places[i];
              console.log(places[i]);

              icon = {
                url: "./image/icons/"+ place.genre_GenreId + ".png",
                scaledSize : new google.maps.Size(24, 24)
              };
              markers[i] = new google.maps.Marker({
                position: new google.maps.LatLng(place.Latitude, place.Longitude),
                map: mapObj,
                icon: icon,
                visible: true
              });

　　　　　　　　　　　 // GoogleMapの情報ウィンドウに表示するコンテンツ
              content ='<div class="info"><div class="place_name">' + place.Name + '</div>' +
                       '<div class="postcode">〒 ' + place.Postalcode + '</div>' +
                       '<div class="address">住所: ' + place.Address + '</div>' +
                       '<div class="info">情報: ' + place.Summary + '</div>' +  '</div>';

              infoWindows[i] = new google.maps.InfoWindow({
                content: content,
                maxWidth: 300
              });

              // マーカーにクリックイベント（情報ウィンドウ開閉）を追加
              var addEvent;
              addEvent = function(i, place) {
                return google.maps.event.addListener(markers[i], 'click', function(e) {
                  if (window.openedWindow) {
                    infoWindows[window.openedWindow].close();
                  }
                  infoWindows[i].open(mapObj, markers[i]);
                  return window.openedWindow = i;
                });
              };

              addEvent(i, place);
           };



           // マーカーを作成
           var marker = new google.maps.Marker({
               position: latlng,
               map: mapObj,
               icon: markerImg,
               title: '富士山'
           });            // クリックした場所にマーカーを追加
           google.maps.event.addListener(mapObj, 'click', function(e)
           {
               markerObj = new google.maps.Marker({
                   position: e.latLng,
                   map: mapObj,
                   icon: markerImg,
               title: '富士山'
               });
                           })        });



        // 地図からマーカーを削除 
        function deleteMarker() 
        { 
            console.log(markers[0]);
            for(tmp = 0;tmp<markers.length;tmp++){
            markers[tmp].setVisible(false);
            } 
        } 
 
        // 地図のマーカーを追加 
        function addMarker() 
        { 
            for(tmp = 0;tmp<markers.length;tmp++){
            markers[tmp].setVisible(true);
            } 
        } 

        $(document).on('click','.print-preview',function(){
          doPrintPreview();
        });

        doPrintPreview = (function(){
          //現在のURLに'print'パラメータを付加し、新しいウィンドウで表示させる。
          window.open(location.href+'?print=true');
        });
   </script>
  </head>
  <body>
    <div class="notice rm-print">
      <span>地図の画面外を右クリックして『印刷』あるいは『印刷プレビュー』を選択してください。</span>
      <span>印刷プレビューで地図が正しく印刷されることを確認してから印刷することをお勧めします。</span>
    </div>
    <div id="printarea"><div id="gmap" style="width: 100%; height: 100%; border: 1px solid Gray;"></div></div>
  </body>
</html>