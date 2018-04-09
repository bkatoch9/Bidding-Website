
<nav class="navbar navbar-default"> <!-- navbar-fixed-top -->
      <div class="container">
        <div class="navbar-header">

          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

        <div class="div-header">
          <div class="img-header">
          <img src="/mini-project-2017/img/the_hammer.png" class="header-img">
        </div>
          <a class="navbar-brand" href="/mini-project-2017/">Auction Bay</a>
        </div>
      </div>
        <div id="navbar" class="navbar-collapse collapse">
          <?php 
            if (isset($_SESSION['is_logged_in'])){
              if ($_SESSION['is_logged_in'] == 1){
                ?>

                <ul class="nav navbar-nav navbar-right">
                  <li><a href="/mini-project-2017/user/">Welcome<?=get_user_name($link, $_SESSION['username_'])?> <span class="badge"><?=get_bids_left($link,get_user_id($link, $_SESSION['username_']))?></span></a></li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell" aria-hidden="true"></i></a>
                    <ul class="dropdown-menu">
                      <?php
                        $user_id = get_user_id($link, $_SESSION['username_']);
                        $winners = get_all_winners($link);
                        if ($winners != null) {
                          $x = 0;
                          while ($winner = mysqli_fetch_object($winners)) {
                          
                            if ($winner->user_id == $user_id && ($winner->is_payment_done == 0)) {
                              $item = get_item($link, $winner->item_id);
                              ?>
                              <li>
                                <div class="notification">
                                  <div class="notify-item-name">Congratulations! You won the auction for <?=ucwords($item->name)?></div>
                                  <div class="pay-btn text-right">
                                      <a href="" class="btn-sm btn-success">Pay Now</a>
                                  </div>
                                </div>
                              </li>
                              <li>
                      
                              <?php
                            }
                            else
                              $x++;

                          }
                          if ($x == mysqli_num_rows($winners))
                            echo "<div style='width:350px'><h3>No New Notifications!</h3></div>"; 
                        }
                        else
                          echo "<div style='width:350px'><h3>No New Notifications!</h3></div>";

                      ?>
                        
                    </ul>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="/mini-project-2017/user/profile"><i class="fa fa-user-o"></i> Profile</a></li>
<!--                       <li><a href="#"><i class="fa fa-history" aria-hidden="true"></i> History</a></li>
                       -->                      <li><a href="/mini-project-2017/clogs/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
                      <li role="separator" class="divider"></li>
                      <li class="dropdown-header">Auction Categories</li>
                      <li><a href="/mini-project-2017/category/xx-1/">Books</a></li>
                      <li><a href="/mini-project-2017/category/xx-2/">Mobile Phones</a></li>
                      <li><a href="/mini-project-2017/category/xx-3/">Electronic Appliances</a></li>
                    </ul>
                  </li>
                </ul>

                <?php
              }
            }
              else {
                ?>
                <ul class="nav navbar-nav navbar-right no_login">
                  <li><a href="/mini-project-2017/login">Login</a></li>
                  <li class="active_"><a href="/mini-project-2017/login" >Register</a></li>
                </ul>

          <?php
              }
          ?>
          <!--  -->
            
          
        </div><!--/.nav-collapse -->
      </div>
    </nav>