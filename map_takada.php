<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"> 
<html> 
<head> 
   <title>Google Maps V3</title> 
   <meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
   <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
   <script type="text/javascript" src="./js/jquery-1.12.2.min.js"></script>
   <script type="text/javascript">

       google.maps.event.addDomListener(window, 'load', function() 
       {

           var lng = 136.617477; 
           var lat = 36.503212; 

           var latlng = new google.maps.LatLng(lat, lng); 
           var mapOptions = { 
               zoom: 18, 
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
            

           // マーカーを作成 
           var marker = new google.maps.Marker({ 
               position: latlng, 
               map: mapObj, 
               icon: markerImg, 
               title: '富士山' 
           });

           // クリックした場所にマーカーを追加 
           google.maps.event.addListener(mapObj, 'click', function(e) 
           { 
               markerObj = new google.maps.Marker({ 
                   position: e.latLng, 
                   map: mapObj,
                   icon: markerImg, 
               title: '四十万小学校'
               });
               ajaxPostFunc(e.latLng.lat(),   e.latLng.lng());

           })
       });

function ajaxPostFunc(param1, param2){
    $.post("test.php", {ido:param1, keido:param2}
      //, function(json){alert("パラメータを2つPOSTしました");}
      );
}
   </script> 
</head> 
<body> 
   <div id="gmap" style="width: 500px; height: 370px; border: 1px solid Gray;"> 
   </div> 
</body> 
</html>