<?php

require_once('./system/require.php');

function funcOptionLoop() {
   $genreIns = new SYS_Genre();
   $genreResult = $genreIns->getAllGenre();

   foreach ($genreResult as $k => $v) {
      $num = $k+1;
      echo "<option value=\"{$num}\">{$v['GenreMain']}</option>\n";
   }
}
?>
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
    <link href="./css/new.css" rel="stylesheet">
    <script type="text/javascript" src="./js/jquery-1.12.2.min.js"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
   <script type="text/javascript" src="./js/new.js"></script>
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
                </ul>
                <ul class="list-unstyled hidden-xs" id="sidebar-footer">
                    <li>
                      <a href="http://www.bootply.com"><h3>SecureMap</h3> <i class="glyphicon glyphicon-heart-empty"></i> AGITO</a>
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
<!--                    <div class="navbar-header">
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
<?php ?>

                          <li><a href="">More</a></li>
                          <li><a href="">More</a></li>
                          <li><a href="">More</a></li>
                          <li><a href="">More</a></li>
                          <li><a href="">More</a></li>

                        </ul>
                      </li>
                    </ul>
                    </nav>
-->                </div>
                <!-- /top nav -->

                <div class="padding">
                    <div class="full col-sm-9">

                        <!-- content -->
                        <div class="row">

                         <!-- main col left -->
                         <div class="col-sm-5">

                              <div class="well">
                                   <form method="POST" class="form-horizontal" action="./system/request.php" role="form">
<input type="hidden" name="requestType" value="placeinfo">
                                    <h4>新しい危険個所を追加</h4>
                                     <div class="form-group" style="padding: 0 24px;">
                                       <label for="inputName">場所の名前</label>
                                       <input type="text" name="name" class="form-control" id="inputName" placeholder="例）四十万小学校" required="required"></input>
                                     </div>
<!--
                                     <div class="form-group" style="padding: 0 24px;">
                                       <label for="inputLat">緯度</label> -->
                                       <input type="hidden" name="latitude" class="form-control" id="inputLat"></input>
<!--                                        <p class="help-block red">※緯度と経度の入力はマップをクリックして下さい</p> -->
                                     <!-- </div> -->
                                     <!-- <div class="form-group" style="padding: 0 24px;">
                                       <label for="inputLng">経度</label> -->
                                       <input type="hidden" name="longitude" class="form-control" id="inputLng"></input>
                                     <!-- </div> -->
                                     <div class="form-group" style="padding: 0 24px;">
                                       <label for="inputDisc">概要</label>
                                        <textarea name="description" class="form-control" id="inputDesc" rows="3" placeholder="例) 車通りが多く交通事故が発生しやすい"></textarea>
                                     </div>

                                     <div class="form-group" style="padding: 0 24px;">
                                       <label for="genreSelect">ジャンル</label>
                                       <select class="form-control" id="genreSelect" name="genre">
<?php funcOptionLoop(); ?>
<!--
                                         <option>車に注意</option>
                                         <option>用水に注意</option>
                                         <option>踏切注意</option>
                                         <option>夜道注意</option>
                                         <option>見通しが悪い</option>
-->
                                       </select>
                                     </div>
                                     <p class="help-block">※ 『場所の名前』 の入力と地図上のクリックは必須です</p>
                                    <button class="btn btn-primary pull-right disabled" id="new-place-btn" type="submit"><div id="sense_hover">この場所を登録する！</div></button>
                                    <ul class="list-inline"><li><a href=""><i class="glyphicon glyphicon-upload"></i></a></li><li><a href=""><i class="glyphicon glyphicon-camera"></i></a></li><li><a href=""><i class="glyphicon glyphicon-map-marker"></i></a></li></ul>
                                  </form>
                              </div>
<!-- 
                              <div class="panel panel-danger" id="warning">
                                <div class="panel-heading">
                                  <h3 class="panel-title">未入力事項があります</h3>
                                </div>
                                <div class="panel-body">
    　　　　　　　　　　　　　　　　　　　　　　　　　　
  　　　　　　　　　　　　　　　　　　　　　　　　　</div>
                              </div> -->

                          </div>

                          <!-- main col right -->
                          <div class="col-sm-7">
                               <div class="panel panel-default">
                                 <div class="panel-heading"><button type="button" class="btn btn-success pull-right" id="set-loc-here">現在地を指定する</button><h4 class="bold">追加する場所をクリック!</h4></div>
                                  <div class="panel-body">
                                    <div id="gmap" style="width: 100%; height: 400px; border: 1px solid Gray;">
                                  </div>
                               </div>
                               </div>
                          </div>
                       </div>


                        <div class="row" id="footer">
                          <div class="col-sm-6">

                          </div>
                          <div class="col-sm-6">
                            <p>
                            <a href="#" class="pull-right">©Copyright 2013</a>
                            </p>
                          </div>
                        </div>
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
