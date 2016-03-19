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
    <link href="./css/view.css" rel="stylesheet">
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
         genre_markers = [];
         flag_group = [];

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
             genre_markers = [];
             flag_group = [];
            var infoWindows = [];
            for (i = j = 0, len = places.length; j < len; i = ++j) {
              place = places[i];
              console.log(places[i]);
              genre_markers[i] = place.genre_GenreId;
              flag_group[i] = 1;
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



        });



        // 地図からマーカーを削除 
        function deleteMarker() 
        { 
            console.log(markers[0]);
            for(tmp = 0;tmp<markers.length;tmp++){
            markers[tmp].setVisible(false);
            console.log(genre_markers[tmp]);
            } 
        } 
 
        // 地図のマーカーを追加 
        function addMarker() 
        { 
            for(tmp = 0;tmp<markers.length;tmp++){
            markers[tmp].setVisible(true);
            } 
        } 

function deleteMarker__(x)
        {
            for(tmp = 0;tmp<markers.length;tmp++){
              flag_group[tmp] = 1 - flag_group[tmp];
              if(genre_markers[tmp] == x && flag_group[tmp] == 1){
                markers[tmp].setVisible(true);
              }
              else if(genre_markers[tmp] == x && flag_group[tmp] == 0){
                markers[tmp].setVisible(false);
              }
            } 
        }


   </script>
  </head>
  <body>
<div class="wrapper">
    <div class="box">
        <div class="row row-offcanvas row-offcanvas-left">

            <!-- sidebar -->
            <div class="column col-sm-2 col-xs-1 sidebar-offcanvas" id="sidebar">

                <ul class="nav">
                <li><a href="#" data-toggle="offcanvas" class="visible-xs text-center"><i class="glyphicon glyphicon-chevron-right"></i></a></li>
              </ul>

                <ul class="nav hidden-xs" id="lg-menu">
                    <li class="active"><a href="./view.php"><i class="glyphicon glyphicon-list-alt"></i>　すべての場所を見る</a></li>
                    <li><a href="./new.php"><i class="glyphicon glyphicon-plus"></i>　あたらしい場所を追加する</a></li>
                    <li><a href="./print.php"><i class="glyphicon glyphicon-print"></i>　印刷する</a></li>
<!--                     <li><a href="#"><i class="glyphicon glyphicon-refresh"></i> Refresh</a></li> -->
                </ul>
                <ul class="list-unstyled hidden-xs" id="sidebar-footer">
                    <li>
                      <a href="http://www.bootply.com"><h3>SecureMap</h3> <i class="glyphicon glyphicon-heart-empty"></i>AGITO</a>
                    </li>
                </ul>

                <!-- tiny only nav-->
              <ul class="nav visible-xs" id="xs-menu">
                    <li><a href="./view.php" class="text-center"><i class="glyphicon glyphicon-list-alt"></i></a></li>
                    <li><a href="./new.php" class="text-center"><i class="glyphicon glyphicon-plus"></i></a></li>
                    <li><a href="./print.php" class="text-center"><i class="glyphicon glyphicon-print"></i></a></li>
                    <!-- <li><a href="#" class="text-center"><i class="glyphicon glyphicon-refresh"></i></a></li> -->
                </ul>
              
            </div>
            <!-- /sidebar -->
          
            <!-- main right col -->
            <div class="column col-sm-10 col-xs-11" id="main">
                
                <!-- top nav -->
                <div class="navbar navbar-blue navbar-static-top">  
                    <div class="navbar-header">
                      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle</span>
                        <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                      </button>
                      <a href="/" class="navbar-brand logo">b</a>
                    </div>
                    <nav class="collapse navbar-collapse" role="navigation">
                    <form class="navbar-form navbar-left">
                        <div class="input-group input-group-sm" style="max-width:360px;">
                          <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
                          <div class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                          </div>
                        </div>
                    </form>
                    <ul class="nav navbar-nav">
                      <li>
                        <a href="#"><i class="glyphicon glyphicon-home"></i> Home</a>
                      </li>
                      <li>
                        <a href="#postModal" role="button" data-toggle="modal"><i class="glyphicon glyphicon-plus"></i> Post</a>
                      </li>
                      <li>
                        <a href="#"><span class="badge">badge</span></a>
                      </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i></a>
                        <ul class="dropdown-menu">
                          <li><a href="">More</a></li>
                          <li><a href="">More</a></li>
                          <li><a href="">More</a></li>
                          <li><a href="">More</a></li>
                          <li><a href="">More</a></li>
                        </ul>
                      </li>
                    </ul>
                    </nav>
                </div>
                <!-- /top nav -->

                <div class="padding">
                    <div class="full col-sm-9">

                        <!-- content -->
                        <div class="row">

                         <!-- main col left -->
<!--                         <div class="col-sm-5">

                              <div class="well">
                                   <form class="form-horizontal" role="form">
                                    <h4>New location</h4>
                                     <div class="form-group" style="padding: 0 24px;">
-->                                      <!-- <textarea class="form-control" placeholder="Name"></textarea> -->
<!--                                      <input type="text" name="name" class="form-control" placeholder="Name"></input>
                                    </div>
                                    <div class="form-group" style="padding: 0 24px;">
                                      <input type="text" name="name" class="form-control" placeholder="Something..."></input>
                                    </div>
                                    <fieldset class="form-group" style="padding: 0 24px;">
                                      <label for="exampleSelect1">Category</label>
                                      <select class="form-control" id="exampleSelect1">
                                        <option>車に注意</option>
                                        <option>用水に注意</option>
                                        <option>踏切注意</option>
                                        <option>夜道注意</option>
                                        <option>見通しが悪い</option>
                                        <option>などなど適当</option>
                                      </select>
                                    </fieldset>
                                    <button class="btn btn-primary pull-right" type="button">New Location</button><ul class="list-inline"><li><a href=""><i class="glyphicon glyphicon-upload"></i></a></li><li><a href=""><i class="glyphicon glyphicon-camera"></i></a></li><li><a href=""><i class="glyphicon glyphicon-map-marker"></i></a></li></ul>
                                  </form>
                              </div>
-->
                              <!-- <div class="panel panel-default">
                                 <div class="panel-heading"><a href="#" class="pull-right">View all</a> <h4>More Templates</h4></div>
                                  <div class="panel-body">
                                    <img src="//placehold.it/150x150" class="img-circle pull-right"> <a href="#">Free @Bootply</a>
                                    <div class="clearfix"></div>
                                    There a load of new free Bootstrap 3 ready templates at Bootply. All of these templates are free and don't require extensive customization to the Bootstrap baseline.
                                    <hr>
                                    <ul class="list-unstyled"><li><a href="http://www.bootply.com/templates">Dashboard</a></li><li><a href="http://www.bootply.com/templates">Darkside</a></li><li><a href="http://www.bootply.com/templates">Greenfield</a></li></ul>
                                  </div>
                              </div> -->

<!--                              <div class="panel panel-default">
                                <div class="panel-heading"><h4>What Is Bootstrap?</h4></div>
                                <div class="panel-body">
                                  Bootstrap is front end frameworkto build custom web applications that are fast, responsive &amp; intuitive. It consist of CSS and HTML for typography, forms, buttons, tables, grids, and navigation along with custom-built jQuery plug-ins and support for responsive layouts. With dozens of reusable components for navigation, pagination, labels, alerts etc..                          </div>
                              </div>


                          </div>
-->
                          <!-- main col right -->
                          <div class="col-sm-12">
                               <div class="panel panel-default">
                                 <div class="panel-heading">
                                    <a href="#" class="pull-right">View all</a> 
                                    <h4>表示させたい項目を選択しよう！！ &amp; Choose the selection!!</h4>
                                 </div>

                    
                                  <div class="panel-body">
                                  <a href="#" class="pull-right"><button type="button" class="btn btn-danger"  onclick="deleteMarker()" >Clear</button></a>
                                    <a href="#" class="pull-right"><button type="button" class="btn btn-danger" onclick="addMarker()">All</button></a> 
<button type="button" class="btn btn-danger" onclick="deleteMarker__(1)">避難所</button>
<button type="button" class="btn btn-danger" onclick="deleteMarker__(2)">AED</button>
<button type="button" class="btn btn-danger" onclick="deleteMarker__(7)">車に注意</button>
<button type="button" class="btn btn-danger" onclick="deleteMarker__(8)">用水に注意</button>
<button type="button" class="btn btn-danger" onclick="deleteMarker__(9)">踏切に注意</button>
<button type="button" class="btn btn-danger" onclick="deleteMarker__(10)">夜道に注意</button>
<button type="button" class="btn btn-danger" onclick="deleteMarker__(11)">見通しが悪い</button>

                                    <div id="gmap" style="width: 100%; height: 500px; border: 1px solid Gray;">
                                  </div>
                               </div>
                               </div>
                               <div class="panel panel-primary">
                                <div class="panel-heading">
                                   アイコンの説明
                                </div>
                                <div class="panel-body">
    　　　　　　　　　　　　　　　　　　　　　　　　　 <ul class="list-inline">
                                     <li class="icon-desc"><img src="./image/icons/2.png" width="38px" height="38px"><span class="desc">AED</span></li>
                                     <li class="icon-desc"><img src="./image/icons/1.png" width="38px" height="38px"><span class="desc">避難所</span></li>
                                     <li class="icon-desc"><img src="./image/icons/3.png" width="38px" height="38px"><span class="desc">110番の家</span></li>
                                     <li class="icon-desc"><img src="./image/icons/7.png" width="38px" height="38px"><span class="desc">車に注意</span></li>
                                     <li class="icon-desc"><img src="./image/icons/8.png" width="38px" height="38px"><span class="desc">用水に注意</span></li>
                                     <li class="icon-desc"><img src="./image/icons/9.png" width="38px" height="38px"><span class="desc">踏切注意</span></li>
                                     <li class="icon-desc"><img src="./image/icons/10.png" width="38px" height="38px"><span class="desc">夜道が暗い</span></li>
                                     <li class="icon-desc"><img src="./image/icons/11.png" width="38px" height="38px"><span class="desc">見通しが悪い</span></li>
                                   </ul>
  　　　　　　　　　　　　　　　　　　　　　　　　　</div>
                               </div>

<!--
                               <div class="panel panel-default">
                                 <div class="panel-heading"><a href="#" class="pull-right">View all</a> <h4>Portlet Heading</h4></div>
                                  <div class="panel-body">
                                    <ul class="list-group">
                                    <li class="list-group-item">Modals</li>
                                    <li class="list-group-item">Sliders / Carousel</li>
                                    <li class="list-group-item">Thumbnails</li>
                                    </ul>
                                  </div>
                               </div> -->
                            <!--
                               <div class="panel panel-default">
                                <div class="panel-thumbnail"><img src="/assets/example/bg_4.jpg" class="img-responsive"></div>
                                <div class="panel-body">
                                  <p class="lead">Social Good</p>
                                  <p>1,200 Followers, 83 Posts</p>

                                  <p>
                                    <img src="https://lh6.googleusercontent.com/-5cTTMHjjnzs/AAAAAAAAAAI/AAAAAAAAAFk/vgza68M4p2s/s28-c-k-no/photo.jpg" width="28px" height="28px">
                                    <img src="https://lh4.googleusercontent.com/-6aFMDiaLg5M/AAAAAAAAAAI/AAAAAAAABdM/XjnG8z60Ug0/s28-c-k-no/photo.jpg" width="28px" height="28px">
                                    <img src="https://lh4.googleusercontent.com/-9Yw2jNffJlE/AAAAAAAAAAI/AAAAAAAAAAA/u3WcFXvK-g8/s28-c-k-no/photo.jpg" width="28px" height="28px">
                                  </p>
                                </div>
                              </div>
                             -->
                          </div>
                       </div><!--/row-->

<!--                         <div class="row">
                          <div class="col-sm-6">
                            <a href="#">Twitter</a> <small class="text-muted">|</small> <a href="#">Facebook</a> <small class="text-muted">|</small> <a href="#">Google+</a>
                          </div>
                        </div> -->

                        <div class="row" id="footer">
                          <div class="col-sm-6">

                          </div>
                          <div class="col-sm-6">
                            <p>
                            <a href="#" class="pull-right">cCopyright 2013</a>
                            </p>
                          </div>
                        </div>

                      <!-- <hr> -->

<!--                       <h4 class="text-center">
                      <a href="http://bootply.com/96266" target="ext">Download this Template @Bootply</a>
                      </h4> -->

                      <!-- <hr> -->


                    </div><!-- /col-9 -->
                </div><!-- /padding -->
            </div>
            <!-- /main -->

        </div>
    </div>
</div>


<!--post modal-->
<div id="postModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      Update Status
      </div>
      <div class="modal-body">
          <form class="form center-block">
            <div class="form-group">
              <textarea class="form-control input-lg" autofocus="" placeholder="What do you want to share?"></textarea>
            </div>
          </form>
      </div>
      <div class="modal-footer">
          <div>
          <button class="btn btn-primary btn-sm" data-dismiss="modal" aria-hidden="true">Post</button>
            <ul class="pull-left list-inline"><li><a href=""><i class="glyphicon glyphicon-upload"></i></a></li><li><a href=""><i class="glyphicon glyphicon-camera"></i></a></li><li><a href=""><i class="glyphicon glyphicon-map-marker"></i></a></li></ul>
      </div>  
      </div>
  </div>
  </div>
</div>
  <!-- script references -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>

    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/scripts.js"></script>
  </body>
</html>