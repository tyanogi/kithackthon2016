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
              $("#inputLat").val(e.latLng.lat().toFixed(6));
              $("#inputLng").val(e.latLng.lng().toFixed(6));

               markerObj.setMap(null);
               markerObj = new google.maps.Marker({
                   position: e.latLng,
                   map: mapObj,
                   animation: google.maps.Animation.DROP,
               });
           })
      });
