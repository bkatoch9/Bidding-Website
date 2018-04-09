
<?php session_start(); require_once('clogs/db_connect.php'); require_once('clogs/functions.php');?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="/mini-project-2017/css/style_front_page.css">
            <link rel="stylesheet" href="/mini-project-2017/css/style.css">
            <link rel="stylesheet" type="text/css" href="/mini-project-2017/css/profile-styles.css">
                <script src="/mini-project-2017/scripts/script_.js"></script>


    <style type="text/css">
      body {
        background: none;
      }
    </style>
</head>

<body>
	<header>
	<?php require_once('site_header.php');?>
  </header>
 
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <div class="carousel-inner" role="listbox" style="max-height: 400px;">
    <div class="item active">
      <img src="img/books.jpg" alt="books">
     
    </div>

    <div class="item">
      <img src="img/appliances.jpg" alt="appliances">
        
    </div>

    <div class="item">
      <img src="img/mobile-group.png" alt="mobile phones">
      
    </div>
  </div>

  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<br><br>
<div class="bg-1">
	<div class="container">
		<div class="text-center" style="font-size: 24px">
			<h2>Live bids</h2>
			<p>Go, place your own bid now.</p>
		</div>
    <br>
     <div class="text-center" style="font-size: 23px">
      
        <h3>Electronics</h3>
    </div>
		<?php

        $today = date('Y-m-d H:i');
        $cat = "xx-1";
        $items_ = get_active_items($link,$cat,$today);
        $i = 0;
        if ($items_ != null) {
          while ($item = mysqli_fetch_object($items_)) {
            $i++;
            ?>

            <div class="col-md-4">
            <div class="panel panel-info"  style="margin-left: 30px, margin-right: 30px">
               <div class="panel-heading">
                    <h3 class="panel-title"><?=ucwords($item->name)?></h3>
               </div>
                <div class="panel-body">
                  <div class="thumbnail">
                    
                      <img src="/mini-project-2017/clogs/<?=$item->img?>" alt="books" style="text-align: center;">
                    
                   <!--  <p style="font-size: 16px"><strong>AUCTION ID: </strong>113</p>
                     -->  <div class="panel panel-footer">
                      <div class="bid-money">
                        <p class="bid-money">MRP: <?=$item->bid_min_amt?></p>
                        </div>
                      <div>
                       <small style="color: #FF8C00">Time left: </small>
                       <p id="xs-demo-<?=$i;?>"></p>
                      </div>
                    </div>
                  
                    <a class="btn btn-block" href="/mini-project-2017/item/<?=$item->id?>/<?=$item->item_url_name?>"><strong>PLACE BID</strong></a>
                  </div>
                </div>
              </div>
        </div>  
        <script type="text/javascript">
          var x = <?=$i?>;
          var time = '<?=addDayswithdate($item->auction_date,$item->auction_dur)?>';
          setTimer('xs-demo-'+x, time);
        </script>

            <?php
          }
        }
        else
          echo "<h2>No active items found!</h2>";

    ?>
            <a href="/mini-project-2017/category/xx-1" class="pull-right btn but">VIEW ALL</a> 

  </div>

     <br><br>
     <div class="container">
        <div class="text-center" style="font-size: 23px">
      
        <h3>Mobile Phones</h3>
    </div>

    <?php

        $today = date('Y-m-d H:i');
        $cat = "xx-3";
        $items_ = get_active_items($link,$cat,$today);
        $i = 0;
        if ($items_ != null) {
          while ($item = mysqli_fetch_object($items_)) {
            $i++;
            ?>

            <div class="col-md-4">
            <div class="panel panel-info"  style="margin-left: 30px, margin-right: 30px">
               <div class="panel-heading">
                    <h3 class="panel-title"><?=ucwords($item->name)?></h3>
               </div>
                <div class="panel-body">
                  <div class="thumbnail">
                    
                      <img src="/mini-project-2017/clogs/<?=$item->img?>" alt="books" style="text-align: center;">
                    
                    <!-- <p style="font-size: 16px"><strong>AUCTION ID: </strong>113</p>
                      --> <div class="panel panel-footer">
                      <div class="bid-money">
                        <p class="bid-money">MRP: <?=$item->bid_min_amt?></p>
                        </div>
                      <div>
                       <small style="color: #FF8C00">Time left: </small>
                       <p id="demo-<?=$i;?>"></p>
                      </div>
                    </div>
                  
                    <a class="btn btn-block" href="/mini-project-2017/item/<?=$item->id?>/<?=$item->item_url_name?>"><strong>PLACE BID</strong></a>
                  </div>
                </div>
              </div>
        </div>  
        <script type="text/javascript">
          var x = <?=$i?>;
          var time = '<?=addDayswithdate($item->auction_date,$item->auction_dur)?>';
          setTimer('demo-'+x, time);
        </script>

            <?php
          }
        }
        else
          echo "<h2>No active items found!</h2>";

    ?>
     
            <a href="/mini-project-2017/category/xx-3" class="pull-right btn but">VIEW ALL</a> 
	   </div>
     <br><br>
      <div class="container">
        <div class="text-center" style="font-size: 23px">
      
        <h3>Books</h3>
    </div>
    
    <?php

        $today = date('Y-m-d H:i');
        $cat = "xx-2";
        $items = get_active_items($link,$cat,$today);
        $i = 0;
        if ($items != null) {
          while ($item = mysqli_fetch_object($items)) {
            $i++;
            ?>

            <div class="col-md-4">
            <div class="panel panel-info"  style="margin-left: 30px, margin-right: 30px">
               <div class="panel-heading">
                    <h3 class="panel-title"><?=ucwords($item->name)?></h3>
               </div>
                <div class="panel-body">
                  <div class="thumbnail">
                    
                      <img src="/mini-project-2017/clogs/<?=$item->img?>" alt="books" style="text-align: center;">
                    
                     <div class="panel panel-footer">
                      <div class="bid-money">
                                                <p class="bid-money">MRP: <?=$item->bid_min_amt?></p>

                        </div>
                      <div>
                       <small style="color: #FF8C00">Time left: </small>
                       <p id="xss-demo-<?=$i;?>"></p>
                      </div>
                    </div>
                  
                    <a class="btn btn-block" href="/mini-project-2017/item/<?=$item->id?>/<?=$item->item_url_name?>"><strong>PLACE BID</strong></a>
                  </div>
                </div>
              </div>
        </div>  
        <script type="text/javascript">
          var x = <?=$i?>;
          var time = '<?=addDayswithdate($item->auction_date,$item->auction_dur)?>';
          setTimer('xss-demo-'+x, time);
        </script>

            <?php
          }
        }
        else
          echo "<h2>No active items found!</h2>";

    ?>                <a href="/mini-project-2017/category/xx-2" class="pull-right btn but">VIEW ALL</a> 
 
     </div>
   </div>
     <br><br>
     <div class="border-line"></div>
	<div class="container">
    <div class="text-center" style="font-size: 24px">
      
        <h2>Upcoming bids</h2>
        <p>Dont't miss any of the hot deals</p>
    </div>
    <br>
    
    <div class="row">
  <div class="col-md-3">
            <div class="panel panel-info" style="margin-left: 30px, margin-right: 30px">
               <div class="panel-heading">
                    <h3 class="panel-title">iPhone 7</h3>
               </div>
                <div class="panel-body">
                  <p>MRP: Rs. 30000</p>
                  <div class="thumbnail">
                    <img src="/mini-project-2017/clogs/item_img/396502iphone6_1.jpeg" alt="iphone">
                     
            
                  </div>
                </div>
                <div class="panel-footer upcoming">
                  <p><strong>Open after 5 days</strong></p>
                </div>
            </div>
      </div>
      <div class="col-md-3">
            <div class="panel panel-info" style="margin-left: 30px, margin-right: 30px">
               <div class="panel-heading">
                    <h3 class="panel-title">iPhone 7</h3>
               </div>
                <div class="panel-body">
                  <p>MRP: Rs. 30000</p>
                  <div class="thumbnail" >
                    <img src="/mini-project-2017/clogs/item_img/90795phone1_1.jpeg" alt="iphone">
                      
                  </div>

                </div>
                <div class="panel-footer upcoming">
                  <p><strong>Open after 8 days</strong></p>
                </div>
            </div>
      </div>
      <div class="col-md-3">
            <div class="panel panel-info" style="margin-left: 30px, margin-right: 30px">
               <div class="panel-heading">
                    <h3 class="panel-title">iPhone 7</h3>
               </div>
                <div class="panel-body">
                  <p>MRP: Rs. 30000</p>
                  <div class="thumbnail" >
                    <img src="/mini-project-2017/clogs/item_img/152214lenevo_yoga3_tab_3.jpeg" alt="iphone">
     

                  </div>
                </div>
                <div class="panel-footer upcoming">
                  <p><strong>Open after 10 days</strong></p>
                </div>
            </div>
      </div>
      <div class="col-md-3">
            <div class="panel panel-info" style="margin-left: 30px, margin-right: 30px">
               <div class="panel-heading">
                    <h3 class="panel-title">iPhone 7</h3>
               </div>
                <div class="panel-body">
                  <p>MRP: Rs. 30000</p>
                  <div class="thumbnail" >
                    <img src="img/iphone.jpg" alt="iphone">
                  
                </div>

            </div>
            <div class="panel-footer upcoming">
                  <p><strong>Open after 3 days</strong></p>
                </div>
          </div>
      </div>
    </div>
  </div>
  <br>
  <div class="row" style="margin-top: 60px">
    <div class="container wrapper">
    <div class="col-sm-5" style="text-align: left; height: 213px">
      <h3 style="height: 36px">Auction Bay bidding rules :</h3>
      <div class="small-border"></div>
      <ul style="margin-left: -30px">
        <br>
        <i class="fa fa-caret-right" style="font-size: 20px;"></i>
        One User Account Per Person / IP Address / House is allowed1<br>
        <i class="fa fa-caret-right" style="font-size: 20px;"></i>
        Group Bidding is strictly not allowed<br>
        <i class="fa fa-caret-right" style="font-size: 20px;"></i>
        Do not use any 3rd party bidding softwares of bots for bidding<br>
        <i class="fa fa-caret-right" style="font-size: 20px;"></i>
        Violation of rules will result in Suspension of your account<br>
       <br>
      </ul>
    </div>
    <div class="col-sm-1 middle-border"></div>
    <div class="col-sm-1"></div>
    <div class="col-sm-5" style="text-align: left;">
      <h3>Protected Online Shopping</h3>
      <div class="small-border"></div>
      <ul style="margin-left: -30px;">
        <br>
        <p style="font-size: 20px;"></>Auction is protected and safe</p>
      </ul>
    </div>
  </div>
</div>
        <?php require_once('site_footer.php');?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</html>
