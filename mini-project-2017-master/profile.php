<?php

	function show_profile($link, $username, $user_id) {
		?>
<script type="text/javascript">


		 window.onload = function() {
                  document.getElementById('open_default').click();
                  var r=document.querySelectorAll("html")[0];
                  r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2");
   }
   </script>
		<style type="text/css">
			body {
				background: none;
			}
		</style>

		<script type="text/javascript">

			function f(e, id_) {

		       var x = document.getElementsByClassName('content_');
		       var y = document.getElementsByClassName("tab_link");

		       for (let i = 0 ; i < x.length ; i++)
		            x[i].style.display = "none";

		       for (let i = 0 ; i < y.length ; i++)
		            y[i].className = y[i].className.replace(" active_tab","");

		        document.getElementById(id_).style.display = "block";
		        e.currentTarget.parentElement.className += " active_tab";

		    }

        function file_upload() {
          var fileData = new FormData($('#bulk_file_upload')[0]); 
          $.ajax({
            type : 'POST',
            url : '/mini-project-2017/clogs/item_bulk_upload.php',
            data : fileData,
            async: false,
            success: function (data) {
                alert(data)
            },
            cache: false,
            contentType: false,
            processData: false
            
          })  
        }

			$('#file_form').on('submit', function(e) {


				e.preventDefault();
				var fileData = new FormData(this); 
				$.ajax({
					type : 'POST',
					url : '/mini-project-2017/clogs/item_bulk_upload.php',
					data : fileData,
					async: false,
			        success: function (data) {
			            alert(data)
			        },
			        cache: false,
			        contentType: false,
			        processData: false
					
				})
			})
		</script>

		<div class="container" style="min-height: 100vh; margin-top: 40px;">
			<!-- <form id='file_form' action="">
      <input type="file" name="file_inp">
      <button class="btn" id="btn_file_inp">Submit</button>
      </form>
       -->
			<div class="row">
				<div class="col-md-3 text-left">
					<div class="side_tab">
                        <ul class="tab_list">
                            <!-- <li class="tab_link active_tab">
                                <button onclick="f(event,'p_g')" id="open_default">
                                    <i class="fa fa-user fa-1x" aria-hidden="true"></i>
                                    Profile
                                                       </button>
                            </li> -->
                            <li class="tab_link">
                                <button onclick="f(event,'b_h')" id="open_default">
                                    <i class="fa fa-upload fa-1x" aria-hidden="true"></i>
                                    Check Items
                                </button>
                            </li>
                            <li class="tab_link">
                                <button onclick="f(event,'new_itms')">
                                    <i class="fa fa-plus fa-1x" aria-hidden="true"></i>
                                    New Item(s)
                                </button>
                            </li>
                            <li class="tab_link">
                                <button onclick="f(event,'r')">
                                    <i class="fa fa-star fa-1x" aria-hidden="true"></i>
                                    Bid History
                                </button>
                            </li>
                        </ul>
                        <script type="text/javascript">
                            function log_me_out() {
                                window.location = "/clogs/logout.php";
                            }
                            function edit_profile() {
                                window.location = '';
                            }
                        </script>
                    </div>
				</div>
				<div class="col-md-8">
					<div class="content">

              <div class="content_ text-left" id="r">
                <div class="heading-section">
                  <h3 style="color : #000">Previous Bids</h3>
                  <div class="small-border"></div>
                </div>
               <div class="row">
                <?php
                   $bids = get_user_bids($link, $user_id);
                    if ($bids != null) {
                      while ($bid = mysqli_fetch_object($bids)){
                        $max_bid = get_max_bid($link, $bid->item_id);
                        $item = get_item($link, $bid->item_id);
                        ?>
                         <div class="col-md-6" style="margin-top: 20px">
                          <div class="history-bid-panel text-left">
                            <div class="img-section" style="background : url('/mini-project-2017/clogs/<?=$item->img?>')"></div>
                            <div class="info-section">
                              <div class="item-name-section"><a href="/mini-project-2017/item/<?=$item->id?>/<?=$item->item_url_name?>"><?=ucwords(substr($item->name,0,17))?></a></div>
                                <div class="price-section">
                                <div class="your-bid">Your Bid<br><i class="fa fa-inr"></i><span class="lg-text"><?=$bid->bid_amt?></span></div>
                                <div class="max-bid">Max Bid<br><i class="fa fa-inr"></i><span class="lg-text"><?=$max_bid?></span></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php
                    }
                  }

                ?>
             
               
              </div>
                
              </div>
					    <div class="content_" id="new_itms">

                <div class="single-item-upload">
                  <div class="text-right"><a href="#" style="color: #000"><i class="fa fa-times close_btn" id="close_btn" aria-hidden="true"></i></a></div>
<!-- 
                  Name, ..
                  Main-Image,
                  Image-1,
                  Image-2,Image-3,
                  Category, ..
                  Starting-Price,
                  Max-Price,
                  Bid-Interval,
                  Auction-Start-Date,
                  Auction-time,
                  Auction-Duration,
                  Description -->

                  <form id="itm_form" class="text-left">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="name">Item Name</label><br>
                          <input type="text" name="itm_name" class="form-control" required="required" placeholder="eg- Apple iPhone 6 Gold">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="name">Category</label><br>
                          <select class="select-tag form-control" name="itm_cat">
                            <option value="xx-1">Electronics</option>
                            <option value="xx-3">Mobile Uploads</option>
                            <option value="xx-2">Books</option>
                          </select>
                        </div>                      
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="date">Auction Date</label><br>
                          <input type="text" name="auct_date" class="datepicker form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                          <label for="time">Auction Time</label><br>
                          <input type="text" name="auct_time" class="timepicker">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="integer">Auction Days</label><br>
                          <input type="number" name="auct_dur" class="form-control" required="required">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="integer">Starting Bid (<i class="fa fa-inr"></i>)</label><br>
                          <input type="number" name="auct_starting_price" class="form-control" required="required">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="integer">Bid Interval (<i class="fa fa-inr"></i>)</label><br>
                          <input type="number" name="auct_bid_interval" class="form-control" required="required">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="text">Item Description</label>
                          <textarea type="text" name="itm_desc" class="form-control"></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                      <label for="image">Item Images</label><br>
                      </div>
                      <div class="col-md-3 col-xs-6 col-sm-3">
                        <input type="file" name="itm_img[]" id="id_1" onchange="loadFile(event, 'img-hold-0')" style="display:none;">
                        <div class="img-hold" id="img-hold-0">
                          <i class="fa fa-upload fa-2x" onclick="img_inpt('id_1')"></i>
                        </div>
                      </div>
                      <div class="col-md-3 col-xs-6 col-sm-3">
                        <input type="file" name="itm_img[]" id="id_2" onchange="loadFile(event, 'img-hold-1')" style="display:none;">
                        <div class="img-hold" id='img-hold-1'>
                          <i class="fa fa-upload fa-2x" onclick="img_inpt('id_2')"></i>
                        </div>
                      </div>
                      <div class="col-md-3 col-xs-6 pad-mob col-sm-3">
                        <input type="file" name="itm_img[]" id="id_3" onchange="loadFile(event, 'img-hold-2')" style="display:none;">
                        <div class="img-hold" id="img-hold-2">
                          <i class="fa fa-upload fa-2x" onclick="img_inpt('id_3')"></i>
                        </div>
                      </div>
                      <div class="col-md-3 col-xs-6 pad-mob col-sm-3">
                        <input type="file" name="itm_img[]" id="id_4" onchange="loadFile(event, 'img-hold-3')" style="display:none;">
                        <div class="img-hold" id="img-hold-3">
                          <i class="fa fa-upload fa-2x" onclick="img_inpt('id_4')"></i>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="di">
                        <strong>*Note</strong> We recommend that you upload atleast 4 item images.
                      </div>
                      </div>
                      
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group"><br>
                          <input type="submit" name="itm_submit" class="btn" value="Save Item" style="background: #3ebd95;"> 
                          </div>
                      </div>
                    </div>
                  </form>
                </div>

                <script type="text/javascript">

                  var loadFile = function(event, id) {

                      var output = document.getElementById(id);
                      output.style.backgroundImage ="url("+ URL.createObjectURL(event.target.files[0])+")";
                      console.log(output.style.backgroundImage);
                  };

                  $('#itm_form').on('submit', function(e) {

                    e.preventDefault();
                    var data_ = new FormData($('#itm_form')[0]);
                    console.log(data_);
                    $.ajax({
                      type : 'POST',
                      url : '/mini-project-2017/clogs/save_item.php',
                      data : data_,
                      cache : false,
                      processData : false,
                      contentType: false,
                      beforeSend : function() {},
                      success : function(res) {
                            alertify.success(res);        
                      },
                      error : function(a,b,c) {
                        alert('Could not connect to the server!');
                      },
                      complete : function(res) {}
                    })
                  })
                </script>


                <div class="bulk-item-upload">
                  <div class="text-right"><a href="#" style="color: #000"><i class="fa fa-times close_btn" id="close_btn" aria-hidden="true"></i></a></div>
                  <div class="row">
                    <div class="col-md-3" style="padding : 0px;">
                    <div class="box">
                      <form action="" id="bulk_file_upload">
                      <input type="file" name="file_inp" id="file-5" class="inputfile inputfile-4" data-multiple-caption="{count} files selected" multiple onchange="file_upload()" />
                      <label for="file-5"><figure><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg></figure> <span>Choose a file&hellip;</span></label>
                      </form>
                    </div>
                  </div>
                  <div class="col-md-9 text-left">
                     <div class="heading">
                      <h3 style="margin : 0px; margin-bottom: 10px;">Rules for the CSV File</h3>
                    </div>
                    <div class="small-border"></div><br>
                      <li>The file should be in .csv format (Download the demo .csv below).</li>
                      <li>The first column should be the name of the item followed by the main image and 3 more images of the same item, category, starting-price, max-price, bid-interval, auction start time, auction duration and decription of the item.</li>
                      <li>The columns should be listed correctly as per the order given above.</li>
                      <li>The category code are as follows : Electronics and Appliances - xx-1, Books - xx-2, Mobile Phones - xx-3.</li>
                      <li>Any column should not have a comma in between (Ex. Description of Item) else it will show an error.</li>
                      <li>Use absolute path location for uploading the images of items.</li>
                      <li>The date should be in the format YYYY-MM-DD.</li>
                      <li>Auction starting time should be in the format HH:MM.</li>
                      <li>The auction duration should the number of days the item is available for bidding (should be a numeric value).</li>
                      <li>Do not leave any field empty.</li>
                  </div>
                </div>
              </div>
                <div class="row" id="new_itms_wrap">
                  <div class="cover-div">
                    <div class="cover-div">
                    <div class="left-img">
                      <a href="#" id="single-"><img src="/mini-project-2017/img/single_mns.png" class="image-round img-x"></a>
                      <div class="text-">Single Item Upload</div>
                    </div>
                    <div id="right-border"></div>
                    </div>
                    <div class="right-img">
                      <a href="#" id="bulk-"><img src="/mini-project-2017/img/many_mns.png " class="image-round img-x"></a>
                      <div class="text-">Bulk Item Upload</div>
                    </div>
                  </div>
                </div>

              </div>
					    <div class="content_ text-left" id="b_h">
                <div class="heading-section">
                  <h3 style="color : #000">Uploaded Items</h3>
                  <div class="small-border"></div>
                </div>
                  <div class="row">

                    <?php

                      $items = get_all_user_items($link, $user_id, date('Y-m-d H:i'));
                      if ($items != null) {
                        while ($item = mysqli_fetch_object($items)) {
                          $max_bid = get_max_bid($link, $item->id);

                          ?>
                      <div class="col-md-6" style="margin-top: 15px;">
                            <div class="history-bid-panel text-left">
                            <div class="img-section" style="background : url('/mini-project-2017/clogs/<?=$item->img?>')"></div>
                            <div class="info-section">
                              <div class="item-name-section"><a href="/mini-project-2017/item/<?=$item->id?>/<?=$item->item_url_name?>"><?=ucwords(substr($item->name,0,17))?></a></div>
                                <div class="price-section">
                                <div class="your-bid">Status<br></i><span class="lg-text">
                                  <?=($item->expiry_date<date('Y-m-d H:i')?"EXP":"ACT")?>
                                </span>
                              </div>
                                <div class="max-bid">Max Bid<br><i class="fa fa-inr"></i> <span class="lg-text"><?=isset($max_bid)?$max_bid:"--"?></span></div>
                              </div>
                            </div>
                          </div>

                        
                       </div>  
                          <?php
                        }
                      }
                      else
                      {
                        echo "<h2>No Items Uploaded yet!</h2>";
                      }

                    ?>
                  </div>

              </div>
					</div>
				</div>
        <!-- <div class="col-md-2">
          <div class="item-panel-side">
            <div class="img-div"></div>
            <div class="info-div">
              <div class="item-name-side">Notebook X503, Samsung</div>
              <div class="bid-btn-side">
                <a href="#" class="btn btn-green">Bid Now</a>
              </div>
            </div>
          </div>
        </div> -->
			</div>
		</div>

    <script type="text/javascript">
      $('#bulk-').on('click', function(e) {

        e.preventDefault();
        $('#new_itms_wrap').css('display', 'none');
        $('.bulk-item-upload').css('display', 'block');
      })
       $('#single-').on('click', function(e) {

        e.preventDefault();
        $('#new_itms_wrap').css('display', 'none');
        $('.single-item-upload').css('display', 'block');
      })
       $('.close_btn').on('click', function(e) {

        e.preventDefault();
        $('.bulk-item-upload').css('display', 'none');
        $('.single-item-upload').css('display', 'none');
        $('#new_itms_wrap').css('display', 'block');
       })

       $('.datepicker').pickadate({
          formatSubmit: 'yyyy-mm-dd',
          hiddenName: true

       });
       $('.timepicker').pickatime({
        formatSubmit: 'HH:i',
        hiddenName: true
        });

       function img_inpt(id) {
        console.log(id);
        $("#"+id).click();
       }
    </script>

		
		<?php
	}

	function show_index($link, $username) {
		?>
		<style type="text/css">
			body {
				background: none;
			}
		</style>

 
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <div class="carousel-inner" role="listbox" style="max-height: 400px;">
    <div class="item active">
      <img src="/mini-project-2017/img/books.jpg" alt="books">
     
    </div>

    <div class="item">
      <img src="/mini-project-2017/img/appliances.jpg" alt="appliances">
        
    </div>

    <div class="item">
      <img src="/mini-project-2017/img/mobile-group.png" alt="mobile phones">
      
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
<!--                   <p>Starts from Rs. <?=$item->bid_min_amt?></p>
                   -->                  <div class="thumbnail">
                    
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
<!--                   <p>Starts from Rs. <?=$item->bid_min_amt?></p>
                   -->                  <div class="thumbnail">
                    
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
     
      <a href="/mini-project-2017/category/xx-2" class="pull-right btn but">VIEW ALL</a>     </div>
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

    ?>     <a href="/mini-project-2017/category/xx-3" class="pull-right btn but">VIEW ALL</a>
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
                    <img src="/mini-project-2017/img/iphone.jpg" alt="iphone">
                  
                </div>

            </div>
            <div class="panel-footer upcoming">
                  <p><strong>Open after 3 days</strong></p>
                </div>
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
	<?php

	}

  function show_history($link, $user_id) {
      
     

    ?>

    <?php
  }

?>