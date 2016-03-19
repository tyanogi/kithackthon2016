       google.maps.event.addDomListener(window, 'load', function()
       {
           window.openedWindow = null
           var lng = 136.617477;
           var lat = 36.503212;

           var latlng = new google.maps.LatLng(lat, lng);
           var mapOptions = {
               zoom: 14,
               center: latlng,
               mapTypeId: google.maps.MapTypeId.ROADMAP,
               scaleControl: true
           };
           var mapObj = new google.maps.Map(document.getElementById('gmap'), mapOptions);


           // マーカー画像を作成
           var markerImg = new google.maps.MarkerImage(
               // マーカーの画像URL
               "http://blog-imgs-44.fc2.com/p/c/r/pcrice/mark2.png",

               // マーカーのサイズ
               new google.maps.Size(20, 24),
               // 画像の基準位置
               new google.maps.Point(0, 0),
               // Anchorポイント
               new google.maps.Point(10, 24)
           );

           // TODO: DBから値が撮れるようになったら以下のダミーデータは削除する
           // ダミーデータ(JSON形式、JavaScriptオブジェクト形式)
           var places = [];
           places = [
              {id: 0, name: "テストデータ1", latitude: 36.535706,  longitude: 136.631087, genre_id: 1 },
              {id: 1, name: "テストデータ2", latitude: 36.532131,  longitude: 136.624884, genre_id: 2 },
              {id: 2, name: "テストデータ3", latitude: 36.529412,  longitude: 136.634395, genre_id: 3 },
              {id: 3, name: "テストデータ4", latitude: 36.529406,  longitude: 136.629721, genre_id: 4 },
           ];

            // dbのデータからマーカーを落とす
            var i, j, len, place, icon;
            var markers = [];
            var infoWindows = [];
            for (i = j = 0, len = places.length; j < len; i = ++j) {
              place = places[i];

              icon = {
                url: "./image/icons/"+ place.genre_id + ".png",
                scaledSize : new google.maps.Size(24, 24)
              };
              markers[i] = new google.maps.Marker({
                position: new google.maps.LatLng(place.latitude, place.longitude),
                map: mapObj,
                icon: icon
              });

　　　　　　　　　　　 // GoogleMapの情報ウィンドウに表示するコンテンツ
              // TODO: 表示するコンテンツについて吟味
              content ='<div class="place_name">' + place.name + '</div>';

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