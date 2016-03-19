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
               draggableCursor: "crosshair"
           };
           var mapObj = new google.maps.Map(document.getElementById('gmap'), mapOptions);

           var markerObj = new google.maps.Marker({});
           google.maps.event.addListener(mapObj, 'click', function(e)
           {
  　　　　　　　　　drop_marker_and_set(e.latLng);
           });

           // 現在地を指定するボタンが押されたら現在地を取得する
           $("#set-loc-here").click(function(event) {
            console.log("hogehoge");
             if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                  center = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                  mapObj.panTo(center);
                  drop_marker_and_set(center);
                });
              } else {
                center = new google.maps.LatLng(36.503212, 136.617477);
                mapObj.panTo(center);
                drop_marker_and_set(center);
              };
          });

           // formの入力状況に応じてsubmitボタンを無効化・有効化する
           $(".form-control").change(function(event) {
             console.log($("#inputLng").val());
             console.log($("#inputName").val());

             if ( $("#inputLng").val() && $("#inputName").val()){
               // $("#new-place-btn").prop("disabled", false);
               $("#new-place-btn").removeClass('disabled');
             }else{
               // $("#new-place-btn").prop("disabled", true);
               $("#new-place-btn").addClass('disabled');
             }
           });

          // Enterによるsubmitを無効化(ただし入力必須事項が入力されている場合を除く)
          $('form').keypress(function(event) {
            if (event.keyCode == 13 && !($("#inputLng").val() && $("#inputName").val())) {
              target = event.target || event.srcElement;
              if (target.type != 'submit' && target.type != 'textarea') {
                return false;
              }
            }
          });

      // 指定された場所にマーカを設置し、緯度経度を設定する
      function drop_marker_and_set(center) {
        console.log(center.lat());
        console.log(center.lng());
        $("#inputLat").val(center.lat().toFixed(6));
        $("#inputLng").val(center.lng().toFixed(6)).trigger('change');

        markerObj.setMap(null);
        markerObj = new google.maps.Marker({
          position: center,
          map: mapObj,
          animation: google.maps.Animation.DROP,
        });
      }
      });

