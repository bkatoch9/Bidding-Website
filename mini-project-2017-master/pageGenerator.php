<?php
	
	function show_login() {

		?>

		<div class="top-content">
            <div class="inner-bg" style="padding : 0px;">
                <div class="container">
                    <div class="row col-md-offset-1 ">
                        <div class="col-sm-5">
                            <div class="form-box">
                                <div class="overlay-div"></div>
                                <div class="form-top">
                                    <div class="form-top-left">
                                        <h3>Login</h3>
                                        <p>Enter username and password</p>
                                        <p class="failed_mssg"></p>
                                    </div>
                                    <!-- gif_show -->
                                    <div class="form-top-right" id="sign_in_gif">

                                        <i class="fa fa-lock" id="sign_in_lock"></i>
                                    </div>
                                </div>
                                <div class="form-bottom">
                                    <form role="form" class="login-form" id="sign_in_form">
                                        <div class="form-group">
                                            <label class="sr-only" for="form-username">Username</label>
                                            <input type="text" name="username_" placeholder="Username..." class="form-username form-control" id="form-username">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="form-password">Password</label>
                                            <input type="password" name="pass_" placeholder="Password..." class="form-password form-control" id="form-password">
                                        </div>

                                        <button type="submit" class="btn">
                                        
                                        Login
                                    
                                    </button>
                                    </form>
                                </div>
                            </div>
                            <div class="social-login">
                                <h3>...or login with</h3>
                                <div class="social-login-buttons">
                                    <a class="btn btn-link-1 btn-link-1-facebook" href="#">
                                        <i class="fa fa-facebook"></i>
                                        Facebook
                                    
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1 middle-border" style="max-width: 30px"></div>
                        <div class="col-sm-1" style="max-width: 30px;"></div>
                        <div class="col-sm-5">
                            <div class="form-box">
                                <div class="form-top">
                                    <div class="form-top-left">
                                        <h3>Hurry up! Register now</h3>
                                        <p>Fill in the form below to sign up</p>
                                    </div>
                                    <div class="form-top-right" id="sign_up_gif" >
                                        <i class="fa fa-tag" id="sign_up_lock"></i>
                                    </div>
                                </div>
                                <div class="form-bottom">
                                    <form role="form" class="registration-form" id="sign_up_form">
                                        <div class="form-group">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label class="sr-only" for="form-email">First Name</label>
                                            <input type="text" name="f_name" placeholder="First Name..." class="form-email form-control" id="form-f-name" required="required">
                                                </div>
                                            </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label class="sr-only" for="form-email">Last Name</label>
                                            <input type="text" name="l_name" placeholder="Last Name..." class="form-email form-control" id="form-l-name" required="required">
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="form-username">Email</label>
                                            <input type="text" name="email" placeholder="Email..." class="form-username form-control" id="form-username-register" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="form-password">Password</label>
                                            <input type="password" name="pass" placeholder="Password..." class="form-password form-control" id="form-password-register" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="form-confirm-password">Confirm Password</label>
                                            <input type="password" name="form-confirm-password" onkeyup="check_pass()" placeholder="Confirm Password..." class="form-about-yourself form-control" id="form-confirm-password-register" required="required">
                                        </div>
                                        <button type="submit" class="btn" id="sign_up_btn">Sign me up!</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function check_pass(){
                var x = $('#form-password-register').val();
                var y = $('#form-confirm-password-register').val();

                
                if (x != y)
                    $('#form-confirm-password-register').addClass(' failed_inp');
                else
                    $('#form-confirm-password-register').removeClass(' failed_inp');
            }

           
            $('#sign_up_form').on('submit', function(e) {
                e.preventDefault();
                var form_d = $('#sign_up_form').serializeArray();
                
                var x = $('#form-password-register').val();
                var y = $('#form-confirm-password-register').val();

                if (x != y){
                    alert ('Passwords do not match!');
                    return false;
                }

                else{
                    $.ajax({
                        type : 'POST',
                        url : 'clogs/register.php',
                        data : form_d,
                        beforeSend : function() {
                            $('#sign_up_lock').remove();
                            $('#sign_up_gif').addClass(' gif_show');
                        },
                        success : function(res) {
                            
                            $('#sign_up_gif').removeClass(' gif_show');
                            if (res == 666)
                              window.location = "verify";
                        },
                        error : function(a,b,c) {
                            alert('Could not connect to the server!');
                        }
                    })
                }
            })

            $('#sign_in_form').on('submit', function(e) {
                e.preventDefault();
                var form_d = $('#sign_in_form').serializeArray();
                
                
                    $.ajax({
                        type : 'POST',
                        url : 'clogs/login.php',
                        data : form_d,
                        beforeSend : function() {
                            $('#sign_in_lock').remove();
                            $('#sign_in_gif').addClass(' gif_show');
                        },
                        success : function(res) {
                         if (res == 1)
                            window.location = "/mini-project-2017/user/";
                         else {
                            $('.failed_mssg').html(res);
                            $('#sign_in_gif').removeClass(' gif_show');
                          }
                        },
                        error : function(a,b,c) {
                            alert('Could not connect to the server!');
                        }
                    })
                
            })
        </script>
        

		<?php
	}


  function show_verify() {
    ?>

        <div class="container text-center" style="min-height : 100vh;">
          <div class="row">
            <div class="col-md-12">
              <i class="fa fa-envelope extra-large"></i>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <p id="a-little-big">Congratulations!</p>
              <p id="a-little-medium"> Just one step away.</p>  
              <p id="a-little-small">Please check you inbox<span id="email_"><?=isset($_SESSION['emal'])?$_SESSION['email']:"";?></span></p> 

              
            </div>
          </div>
        </div>

    <?php
  }



  function show_item($link, $item_id) {

      $item = get_item($link, $item_id);
      $user_id = get_user_id($link, $_SESSION['username_']);
      
      if ($item != null && ($item->expiry_date > date('Y-m-d H:i'))) {

        $min = $item->bid_min_amt;
        $max = $item->bid_max_amt;
        $interval = $item->bid_interval;
        $seller = get_user_info($link, $item->user_id);
        $bids = get_bids($link, $item_id);

        if ($bids != null) 
          $min = get_max_bid($link, $item_id); 
        
    ?>

    <style type="text/css">
      body {
        background: #fff !important;
      }
    </style>
    <div class="container mrg-top">

      <div class="row">
        <div class="col-md-5">
          <div class="img-div">
            <div class="main-img" style="background: url('/mini-project-2017/clogs/<?=$item->img?>') "></div>
            <div class="sub-imgs">
              <div class="sub-img" onclick="change_img(event)" style="background: url('/mini-project-2017/clogs/<?=$item->img1?>') "></div>
              <div class="sub-img" onclick="change_img(event)" style="background: url('/mini-project-2017/clogs/<?=$item->img2?>') "></div>
              <div class="sub-img" onclick="change_img(event)" style="background: url('/mini-project-2017/clogs/<?=$item->img3?>') "></div>
            </div>
          </div>
        </div>
        <script type="text/javascript">
          function change_img(e) {
            var main_img = document.getElementsByClassName('main-img')[0];
            var img = main_img.style.backgroundImage;
              main_img.style.backgroundImage = e.target.style.backgroundImage;
              e.target.style.backgroundImage = img;

          }
        </script>
        <div class="col-md-7 text-left mrg-left">
          <div class="item-name">
            <p><?=ucwords($item->name)?></p>
          </div>
          <div id="time-left" class=""></div>
          <script type="text/javascript">
            setTimer('time-left', '<?=$item->expiry_date?>')
          </script>
          <div class="desc">
            <div class="desc-head">Description</div>
            <div class="desc-body"><p><?=$item->item_desc?></p>
            </div>
          </div>
          <hr>
          <div class="bider-area row">
            <div class="bid-input col-md-9">

              <input id="bid-inpt-bar" type="range" value="<?=$min?>" min="0" max="<?=$max?>" step="<?=$interval?>">           
            </div>

            <div class="bid-amt col-md-3">
              <i class="fa fa-inr fa-2x"></i><span id="amt"></span>
            </div>
            <div class="col-md-12">
            <button class="btn" id="bid_btn" onclick="make_bid(event)">Make BID</button>
            <script type="text/javascript">
              function make_bid(e) {
                var user_id = "<?=$user_id?>";
                var item_user_id = "<?=$item->user_id?>";
                var bids_left = "<?=get_bids_left($link, $user_id)?>";
                   alertify.set('notifier','position', 'top-right');

                if (user_id == item_user_id) 
                  alertify.warning('Ooops! Seems like you are not allowed to bid on this Item.');
                
                else if (bids_left <= 0) 
                  alertify.warning('Ooops! Seems like you crossed your daily bid chances');
                
                else {
                  // bid
                  var amt = document.getElementById('bid-inpt-bar').value;
                  $.ajax({
                    type : 'POST',
                    url : '/mini-project-2017/clogs/make_my_bid.php',
                    data : {'user_id': user_id, 'item_id' : '<?=$item_id?>', 'bid_amt' : amt },
                    success : function(res) {
                      alertify.success(res);
                      bids_left--;
                    }, 
                    error : function(a,b,c) {
                      alert('Could not connect to the server. Please try again!');
                    }
                  })
                }
              }
            </script>
            </div>
          </div>
        </div>
      </div>
      <hr>
      <div class="row top-marg text-left">
        <div class="col-md-4">
          <div class="seller-info">
            <div class="head-heading text-left">
              <p> Seller Info</p>
              <div class="small-border"></div>
            </div>
            <div class="head">
              <div class="head-img">
                
              </div>
              <div class="seller-details text-center">
                <div id="name"><?=$seller->f_name." ".$seller->l_name?></div>
                <div id="contact"><?=$seller->contact_number?></div>
                <div id="email"><?=$seller->email?></div>
              </div>

            </div>
            <div class="info">
              <div class="head-heading text-left">
              <p>Product Info</p>
              <div class="small-border"></div>
            </div>
              <div class="i-info text-left">
                <div class="li-list">Product ID : <span class="num-info"><?=$item->id?></span></div>
                <div class="li-list">Auction Start : <span class="num-info"><?=$item->auction_date?></span></div>
                <div class="li-list">Auction End : <span class="num-info"><?=addDayswithdate($item->auction_date, $item->auction_dur)?></span></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="top-bidders">
            <div class="head-heading text-left">
              <p>Top Bids</p>
              <div class="small-border"></div>
            </div>

          <?php
            if ($bids != null) {
              while ($x = mysqli_fetch_object($bids)){
                $user = get_user_info($link, $x->user_id);
                ?>

            <div class="user-div">
              <div class="user-img"></div>
              <div class="user-info">
                <div class="user-name"><?=$user->f_name." ".$user->l_name?></div>
                <div class="user-bid">
                  <i class="fa fa-inr"></i><span class="bid-amt-ss"><?=$x->bid_amt?></span>
                </div>
              </div>
            </div>

                <?php
              }
            }else
            echo "<div class='text-left' style='padding-top : 10px;'><h3>Be the first to bid!<h3></div>"
          ?>


            
            
            
          </div>
        </div>
        <div class="col-md-4 text-left">
          <div class="head-heading text-left">
              <p>Similar Products</p>
              <div class="small-border"></div>
            </div>
            <!--  limit the product name to max 4 words-->

            <?php
              $today = date('Y-m-d');
              $sim_items = get_active_items($link, $item->category, $today);
              if ($sim_items != null) {
                  while($sim_item = mysqli_fetch_object($sim_items)) {

                    if ($sim_item->id != $item_id) {

                      $price = get_max_bid($link, $sim_item->id);
                      if ($price == null)
                        $max_price = $sim_item->bid_min_amt;
                      else
                        $max_price = $price;
                    ?>


            <div class="product-div">
              <div class="product-img-div" style="background : url('/mini-project-2017/clogs/<?=$sim_item->img?>')"></div>
              <div class="product-info-div">
                <div class="product-name-div"><a href="/mini-project-2017/item/<?=$sim_item->id?>/<?=$sim_item->item_url_name?>"><?=substr($sim_item->name,0,17)."..."?></a></div>
                <div class="lower-part">
                <div class="bid-btn"><a href="/mini-project-2017/item/<?=$sim_item->id?>/<?=$sim_item->item_url_name?>" class="bid-btn-small">Bid</a></div>
                <div class="bid-amt-small"><i class="fa fa-inr"></i><span class="bid-amt-ss"><?=$max_price?></span></div>
                </div>
              </div>
            </div>

                    <?php
                  }
                }
              }

            ?>

          
           
        </div>
      </div>
    </div>
    <style type="text/css">
      .rangeslider,.rangeslider__fill {
        transition: background 0.3s;
      }

      .rangeslider--is-lowest-value {
        background-color: white;
      }

      .rangeslider--is-highest-value .rangeslider__fill {
        background-color: hotpink;
      }
    </style>
    <script type="text/javascript">
    $(function() {

      $('#amt').html($('input[type=range]')[0].value);
            
      const cssClasses = [
        'rangeslider--is-lowest-value',
        'rangeslider--is-highest-value'
      ];
      
      $('input[type=range]')
        .rangeslider({
          polyfill: false
        })
        .on('input', function() {
          const fraction = (this.value - this.min) / (this.max - this.min);
          if (fraction === 0) {
            this.nextSibling.classList.add(cssClasses[0]);
          } else if (fraction === 1) {
            this.nextSibling.classList.add(cssClasses[1]);
          } else {
            this.nextSibling.classList.remove(...cssClasses)
          }

          $('#amt').html(this.value);

        });
    });
    </script>
       
    <?php
    }
    else
    {

      ?>
  <style type="text/css">
    body {
      background:  none !important;
    }

  </style>
  <h2 style="margin-top: 80px;">Item has been Expired!</h2>
      <?php

    }

  }


  function show_category($link, $cat_code) {
        
        $cat_name = get_category_name($link, $cat_code);
        $items = get_all_items($link, $cat_code, date('Y-m-d H:i'));
?>
<style type="text/css">
  body {
    background: none !important;;
  }
</style>
<div class="container text-left" style="margin-top: 30px;">
<div class="headign-section">
  <h3><?=ucwords($cat_name)?></h3>
  <div class="small-border"></div>
</div>
<div class="row">
<?php
        if ($items != null) {
          $i = 0;
          while($item = mysqli_fetch_object($items)) {
            $max_bid = get_max_bid($link, $item->id);
            $i++;
            ?>
      <div class="col-md-4" style="margin-top: 40px;">
                <div class="panel panel-info"  style="margin-left: 30px, margin-right: 30px">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?=$item->name?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="thumbnail">
                          <img src="/mini-project-2017/clogs/<?=$item->img?>" alt="books" style="text-align: center;">
                      <div class="panel panel-footer">
                        <div class="bid-money">
                          <p class="bid-money">MRP: <?=isset($mix_bid)?$max_bid:$item->bid_min_amt?></p>
                          </div>
                        <div>
                        <small style="color: #FF8C00">Time left: <p id="d-<?=$i?>"> </small>
                        <p id="demo-1"></p>
                        </div>
                      </div>
                    <a href="/mini-project-2017/item/<?=$item->id?>/<?=$item->item_url_name?>" class="btn btn-block"><strong>PLACE BID</strong></a>
                </div>
                    </div>
                </div>
        </div>  
        <script type="text/javascript">
          setTimer('d-<?=$i?>', '<?=$item->expiry_date?>');
        </script>

            <?php
          }
        }

    ?>
</div>
<div class="popular-bids">
  <?php
    $auct_items = get_some_auct_items($link,3);
    if ($auct_items != null ) {
      ?>
  <div class="heading-section">
    <h3>Popular Bids</h3>
    <div class="small-border"></div>
    <div class="row">
  </div>
      <?php

      while($auct_item = mysqli_fetch_object($auct_items)) {
        $item = get_item($link, $auct_item->item_id);

        ?>
          <div class="col-md-4">
             <div class="product-div">
                      <div class="product-img-div" style="background:url('/mini-project-2017/clogs/<?=$item->img?>')"></div>
                      <div class="product-info-div">
                        <div class="product-name-div"><a href="/mini-project-2017/item/<?=$auct_item->item_id?>/<?=$item->item_url_name?>"><?=substr($item->name,0,17)."..."?></a></div>
                        <div class="lower-part">
                          <div class="bid-btn"><a href="/mini-project-2017/item/<?=$auct_item->item_id?>/<?=$item->item_url_name?>" class="bid-btn-small">Bid</a></div>
                          <div class="bid-amt-small"><i class="fa fa-inr"></i><span class="bid-amt-ss"><?=$auct_item->bid_amt?></span></div>
                        </div>
                      </div>
                  </div>
          </div>
        <?php
      }
      echo '</div>';
    }
  ?>
</div>
</div>


    <?php

  }

?>
